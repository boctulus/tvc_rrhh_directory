<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    function get_image($filename = null)
    {        
        $is_local = (env('APP_ENV') == 'local');

        /*
            # Archivos subidos en local:

            ./storage/app/public/uploads/*


            # Archivos subidos en produccion:

            ./public/storage/uploads/*
        */

        $path = $is_local ? __DIR__ . '/../../../storage/app/public/uploads' : __DIR__ . '/../../../public/storage/uploads';
        
        if (!is_dir($path)) {
            dd("El directorio no existe: $path");           
        }
        
        if ($filename == null){
            $files = array_diff(scandir($path), ['.', '..']);
            
            if (count($files) >0){
                $filename = end($files);
            } else {
                dd("No se encontraron imagenes en '$path'");

                // http_response_code(404);
                // echo "Image not found.";
                exit;
            }
        }

        $image_path = $path . DIRECTORY_SEPARATOR . $filename;

        if (!file_exists($image_path)) {
            dd("No se encuentra la imagen en '$image_path'");

            // http_response_code(404);
            // echo "Image not found.";
            exit;
        }

        // // Determinar el tipo MIME de la imagen
        $mime_type = mime_content_type($image_path);

        // // Enviar las cabeceras HTTP adecuadas
        header("Content-Type: $mime_type");
        header("Content-Length: " . filesize($image_path));

        // // Leer y mostrar la imagen
        readfile($image_path);
        exit;
    }
}
