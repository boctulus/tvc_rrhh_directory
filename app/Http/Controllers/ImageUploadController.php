<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    protected $uploadPath = 'public/uploads';
    protected $maxFileSize = 5242880; // 5MB

    public function index()
    {
        return view('image-upload.index');
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
                'url' => asset($publicUrl),
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