<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->query('sort') === 'oldest' ? 'asc' : 'desc';
        $images = Gallery::orderBy('created_at', $sort)->get();

        // Transform to add full URL
        $images->transform(function ($image) {
            $image->url = asset('uploads/gallery/' . $image->file_name);
            return $image;
        });

        return response()->json($images);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // 5MB max
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalName = $file->getClientOriginalName();
            $mimeType = $file->getClientMimeType();
            $fileSize = $file->getSize();

            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Define upload path
            $path = public_path('uploads/gallery');

            // Ensure directory exists
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            // Move file
            $file->move($path, $filename);

            // Create DB record
            $gallery = Gallery::create([
                'file_name' => $filename,
                'original_name' => $originalName,
                'mime_type' => $mimeType,
                'file_size' => $fileSize,
            ]);

            $gallery->url = asset('uploads/gallery/' . $filename);

            return response()->json([
                'message' => 'Image uploaded successfully',
                'data' => $gallery
            ], 201);
        }

        return response()->json(['message' => 'No file uploaded'], 400);
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);

        if (!$gallery) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        // Delete file from storage
        $filePath = public_path('uploads/gallery/' . $gallery->file_name);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Delete DB record
        $gallery->delete();

        return response()->json(['message' => 'Image deleted successfully']);
    }
}
