<#
PowerShell helper to convert SVG placeholders to WebP/JPG using ImageMagick (magick.exe)
Usage:
  From project root:
    powershell -ExecutionPolicy Bypass -File .\scripts\convert-images.ps1
Requirements:
  - ImageMagick installed and `magick` available in PATH.
  - This script will convert any blog1.svg..blog4.svg into WebP and JPG variants.
#>

$projectRoot = Split-Path -Parent $MyInvocation.MyCommand.Path
Set-Location $projectRoot

$svgFiles = @('public/assets/images/blog1.svg','public/assets/images/blog2.svg','public/assets/images/blog3.svg','public/assets/images/blog4.svg')

foreach($svg in $svgFiles){
    if(Test-Path $svg){
        $base = [System.IO.Path]::ChangeExtension($svg, $null)
        $webp = "$base.webp"
        $jpg  = "$base.jpg"
        Write-Host "Converting $svg -> $webp and $jpg"
        # Create WebP (quality 80)
        & magick convert `"$svg`" -quality 80 -strip `"$webp`" 2>$null
        if($LASTEXITCODE -ne 0){ Write-Warning "WebP conversion failed for $svg (is ImageMagick installed?)" }
        # Create JPG fallback (quality 80)
        & magick convert `"$svg`" -background white -flatten -quality 80 -strip `"$jpg`" 2>$null
        if($LASTEXITCODE -ne 0){ Write-Warning "JPG conversion failed for $svg (is ImageMagick installed?)" }
    } else {
        Write-Host "Skipping missing file: $svg"
    }
}

Write-Host "Done. Generated files (if ImageMagick available)."
*** End Patch
