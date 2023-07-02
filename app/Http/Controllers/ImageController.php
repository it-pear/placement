<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class ImageController extends Controller
{
    public function deleteImageById($id) {
        $image = Image::find($id);

        if ($image) {
            // Удаляем изображение из файловой системы
            if (Storage::exists($image->url)) {
                Storage::delete($image->url);
            }

            // Удаляем запись из базы данных
            $image->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Картинка удалена'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Картинка не найдена'
        ], 404);
    }
}
