<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    // per-section quotas
    protected $limits = [
        'blog' => 8,
        'security' => 6,
        'cleaning' => 6,
        'companies' => 20,
        'business' => 6,
    ];
    public function index()
    {
        $sections = ['blog','security','cleaning','companies','business'];
        $images = Image::orderBy('created_at','desc')->get()->groupBy('section');
        return view('admin.upload', compact('sections','images'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'section' => 'required|string',
            'images' => 'required|array',
            'images.*' => 'file|image|max:5120',
        ]);

        $section = preg_replace('/[^a-z0-9_\-]/i','', $request->input('section'));
        $allowed = ['blog','security','cleaning','companies','business'];
        if (!in_array($section, $allowed)) {
            return back()->withErrors(['section' => 'Invalid section selected']);
        }

        // enforce quota
        $currentCount = Image::where('section', $section)->count();
        $toAdd = count($request->file('images'));
        $limit = $this->limits[$section] ?? 9999;
        if ($currentCount + $toAdd > $limit) {
            return back()->withErrors(['section' => "Upload would exceed quota for {$section} (max {$limit}). Currently {$currentCount} images."]);
        }

        $uploaded = [];
        $baseDir = public_path('assets/images/' . $section);
        if (!is_dir($baseDir)) {
            File::makeDirectory($baseDir, 0755, true);
        }

        foreach ($request->file('images') as $file) {
            // capture metadata before moving the uploaded tmp file (avoid stat fail after move)
            $originalName = $file->getClientOriginalName();
            $mime = $file->getClientMimeType();
            $size = $file->getSize();

            $name = time() . '_' . bin2hex(random_bytes(6)) . '.' . $file->getClientOriginalExtension();
            $file->move($baseDir, $name);

            $img = Image::create([
                'section' => $section,
                'filename' => $name,
                'original_name' => $originalName,
                'mime' => $mime,
                'size' => $size,
                'path' => 'assets/images/' . $section . '/' . $name,
            ]);

            $uploaded[] = asset($img->path);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'uploaded' => $uploaded,
                'count' => count($uploaded)
            ]);
        }

        return back()->with('status', 'Uploaded ' . count($uploaded) . ' file(s).')->with('uploaded', $uploaded);
    }

    public function destroy($id)
    {
        $img = Image::find($id);
        if (!$img) {
            if(request()->ajax() || request()->wantsJson()){
                return response()->json(['success'=>false,'message'=>'Image not found'],404);
            }
            return back()->withErrors(['notfound' => 'Image not found']);
        }

        $full = public_path($img->path);
        if (file_exists($full)) {
            @unlink($full);
        }

        $img->delete();

        if(request()->ajax() || request()->wantsJson()){
            return response()->json(['success'=>true,'message'=>'Image removed.']);
        }

        return back()->with('status', 'Image removed.');
    }

    public function edit($id)
    {
        $img = Image::find($id);
        if (!$img) {
            if(request()->ajax() || request()->wantsJson()){
                return response()->json(['success'=>false,'message'=>'Image not found'],404);
            }
            return back()->withErrors(['notfound'=>'Image not found']);
        }

        $sections = array_keys($this->limits);
        // If request is AJAX (modal load), return only the form partial
        if(request()->ajax() || request()->wantsJson()){
            return view('admin.partials.edit_form', compact('img','sections'));
        }

        return view('admin.edit', compact('img','sections'));
    }

    public function update(Request $request, $id)
    {
        $img = Image::find($id);
        if (!$img) return back()->withErrors(['notfound'=>'Image not found']);

        $request->validate([
            'section' => 'required|string',
            'replace' => 'nullable|file|image|max:5120',
        ]);

        $newSection = preg_replace('/[^a-z0-9_\\-]/i','', $request->input('section'));
        $allowed = array_keys($this->limits);
        if (!in_array($newSection, $allowed)) {
            return back()->withErrors(['section'=>'Invalid section']);
        }

        // if changing section, enforce quota for target
        if ($newSection !== $img->section) {
            $targetCount = Image::where('section', $newSection)->count();
            $limit = $this->limits[$newSection] ?? 9999;
            if ($targetCount + 1 > $limit) {
                return back()->withErrors(['section' => "Cannot move image — quota reached for {$newSection} (max {$limit})."]);
            }
        }

        // handle file replacement
        if ($request->hasFile('replace')) {
            $file = $request->file('replace');
            $baseDir = public_path('assets/images/' . $newSection);
            if (!is_dir($baseDir)) File::makeDirectory($baseDir, 0755, true);

            // capture metadata before moving and remove old file
            $originalName = $file->getClientOriginalName();
            $mime = $file->getClientMimeType();
            $size = $file->getSize();

            $old = public_path($img->path);
            if (file_exists($old)) @unlink($old);

            $name = time() . '_' . bin2hex(random_bytes(6)) . '.' . $file->getClientOriginalExtension();
            $file->move($baseDir, $name);

            $img->filename = $name;
            $img->original_name = $originalName;
            $img->mime = $mime;
            $img->size = $size;
            $img->path = 'assets/images/' . $newSection . '/' . $name;
        } else {
            // if only changing section, move file on disk
            if ($newSection !== $img->section) {
                $oldFull = public_path($img->path);
                $baseDir = public_path('assets/images/' . $newSection);
                if (!is_dir($baseDir)) File::makeDirectory($baseDir, 0755, true);
                $newPath = $baseDir . DIRECTORY_SEPARATOR . $img->filename;
                if (file_exists($oldFull)) {
                    @rename($oldFull, $newPath);
                    $img->path = 'assets/images/' . $newSection . '/' . $img->filename;
                }
            }
        }

        $img->section = $newSection;
        $img->save();

        if ($request->ajax() || $request->wantsJson()) {
            // render the card partial HTML for the updated image
            $cardHtml = view('admin.partials.image_card', ['img' => $img])->render();
            return response()->json([
                'success' => true,
                'message' => 'Image updated.',
                'id' => $img->id,
                'section' => $img->section,
                'card_html' => $cardHtml,
                'url' => asset($img->path),
            ]);
        }

        return redirect('admin/images')->with('status','Image updated.');
    }
}
