<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/*
    Sirve imagenes desde "storage/uploads"  o su equivalente

    @author  Pablo Bozzolo <boctulus@gmail.com>

    Requiere configurar rutas en web.php

    Route::get('/image/{filename?}', [ImageController::class, 'show'])->name('image.show');

    Uso:

    # Sirve la ultima imagen subida a uploads

        /image

    # Sirve un imagen en particular

        /image/{archivo}

    Ej:

        /image/1738760703_67a361ffa14b0.jpeg
*/

class ImageController extends Controller
{
    /**
     * Show an image from the uploads directory.
     *
     * @param string|null $filename
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\Response
     */
    public function show($filename = null)
    {
        $basePath = 'uploads';
        $path = "public/{$basePath}";

        // Find the latest image if no filename is provided
        if (!$filename) {
            $files = Storage::files($path);

            if (empty($files)) {
                return response()->json([
                    'error' => "No images found in path '{$path}'"
                ], 404);
            }

            $filename = basename(end($files));
        }

        $fullPath = "{$path}/{$filename}";

        // Check if the file exists
        if (!Storage::exists($fullPath)) {
            return response()->json([
                'error' => "Image not found: '{$filename}'"
            ], 404);
        }

        // Return the file with the appropriate headers
        return response()->file(Storage::path($fullPath), [
            'Content-Disposition' => 'inline',
        ]);
    }
}
