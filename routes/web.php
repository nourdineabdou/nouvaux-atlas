<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use Illuminate\Support\Facades\File;

Route::get('/', function () {
    $sections = ['blog','security','cleaning','companies','business'];
    $imagesBySection = [];

    $base = public_path('assets/images');
    foreach ($sections as $s) {
        $dir = $base . DIRECTORY_SEPARATOR . $s;
        $images = [];
        if (is_dir($dir)) {
            $files = File::files($dir);
            foreach ($files as $f) {
                $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg','jpeg','png','webp','svg'])) {
                    $images[] = asset('assets/images/' . $s . '/' . $f->getFilename());
                }
            }
        } else {
            // fallback: look for files in assets/images with prefix like blog1.webp
            $all = File::files($base);
            foreach ($all as $f) {
                $name = $f->getFilename();
                if (stripos($name, $s) === 0 && preg_match('/\.(jpg|jpeg|png|webp|svg)$/i', $name)) {
                    $images[] = asset('assets/images/' . $name);
                }
            }
        }
        $imagesBySection[$s] = $images;
    }

    return view('home', compact('imagesBySection'));
});

// Contact form route (prepared for controller)
use Illuminate\Http\Request;
Route::post('/contact', function (Request $request) {
    // This route is a placeholder prepared for a controller named ContactController@send
    // For now just validate and redirect back with a success message.
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string',
    ]);

    // In real usage, dispatch mail or save to DB in a controller.
    return back()->with('status', 'Thank you — your message was sent.');
});

// Language switcher
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en','fr'])) {
        session(['app_locale' => $locale]);
    }
    return redirect()->back();
});

use App\Http\Controllers\Admin\ImageController;

// Admin auth routes (simple session-based)
Route::get('admin/login', function(){
    return view('admin.login');
})->name('admin.login');

use App\Models\User;
use Illuminate\Support\Facades\Hash;
Route::post('admin/login', function(\Illuminate\Http\Request $request){
    $ruser = $request->input('username');
    $rpass = $request->input('password');
    $user = User::where('email', $ruser)->first();
    if ($user && Hash::check($rpass, $user->password)) {
        session(['admin_logged' => true, 'admin_user' => $user->email]);
        return redirect()->intended('admin/images');
    }
    return back()->withErrors(['login' => 'Invalid credentials']);
});

Route::post('admin/logout', function(){
    session()->forget('admin_logged');
    return redirect('admin/login');
})->name('admin.logout');

// Admin uploader routes (protected)
Route::group(['prefix' => 'admin', 'middleware' => 'admin.auth'], function(){
    Route::get('images', [ImageController::class, 'index']);
    Route::post('images/upload', [ImageController::class, 'upload']);
    Route::delete('images/{id}', [ImageController::class, 'destroy']);
    Route::get('images/{id}/edit', [ImageController::class, 'edit']);
    Route::put('images/{id}', [ImageController::class, 'update']);
});
