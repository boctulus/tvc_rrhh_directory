<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageUploadController extends Controller
{
    protected $uploadPath = 'public/uploads';
    protected $maxFileSize = 5242880; // 5MB

    public function index()
    {
        return view('image-upload.index');
    }

    function debug($path){
        // Verifica que el directorio existe
        if (!is_dir($path)) {
            Log::error("El directorio no existe: $path");
            return response()->json(['error' => "El directorio no existe: $path"], 404);
        }

        // Obtener el contenido del directorio
        $files = array_diff(scandir($path), ['.', '..']);

        // Registrar el contenido en el log
        Log::debug('Contenido del directorio:', ['path' => $path, 'files' => $files]);

        return json_encode(['path' => $path, 'files' => $files]);
    }

    public function store(Request $request)
    {
        try {
            // Verificar si la petición es Ajax
            if (!$request->ajax()) {
                throw new \Exception('Solo se permiten peticiones Ajax');
            }

            // Validación
            $validator = Validator::make($request->all(), [
                'image' => [
                    'required',
                    'image',
                    'mimes:jpeg,png,gif,webp',
                    'max:5120',
                    function ($attribute, $value, $fail) {
                        if ($value->getSize() > $this->maxFileSize) {
                            $fail('La imagen excede el tamaño máximo permitido de 5MB.');
                        }
                    },
                ]
            ]);

            if ($validator->fails()) {
                Log::warning('Validación fallida en upload de imagen: ' . $validator->errors()->first());
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            // $this->debug(storage_path('app/' . $this->uploadPath));

            // Verificar directorio
            $uploadPath = storage_path('app/' . $this->uploadPath);
            if (!file_exists($uploadPath)) {
                Storage::makeDirectory($this->uploadPath);
            }
            
            if (!is_writable(dirname($uploadPath))) {
                Log::error("Directorio no escribible: $uploadPath");
                throw new \Exception("Error de permisos en el servidor");
            }

            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs($this->uploadPath, $filename);

            if (!$path) {
                throw new \Exception("Error al guardar la imagen");
            }

            $publicUrl = Storage::url($path);

            return response()->json([
                'success' => true,
                'url' => URL::to("/img-uploads/{$filename}"),
                'message' => 'Imagen subida exitosamente'
            ]);

        } catch (\Exception $e) {
            Log::error('Error en upload de imagen: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}