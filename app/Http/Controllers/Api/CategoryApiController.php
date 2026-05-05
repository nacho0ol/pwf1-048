<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryApiController extends Controller
{
    // GET: Menampilkan semua kategori
    public function index()
    {
        try {
            $categories = Category::withCount('products')->get();
            
            return response()->json([
                'message' => 'Berhasil mengambil data kategori',
                'data' => $categories
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error get category API: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    // POST: Menyimpan kategori baru (Butuh Token)
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:category,name',
            ]);

            $category = Category::create([
                'name' => $request->name
            ]);

            return response()->json([
                'message' => 'Kategori berhasil ditambahkan!',
                'data' => $category
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Error store category API: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menyimpan kategori'], 500);
        }
    }

    // GET: Menampilkan detail satu kategori berdasarkan ID
    public function show($id)
    {
        try {
            $category = Category::with('products')->find($id);

            if (!$category) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            return response()->json([
                'message' => 'Detail kategori berhasil diambil',
                'data' => $category
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error show category API: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    // PUT/PATCH: Mengupdate kategori (Butuh Token)
    public function update(Request $request, $id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            $request->validate([
                'name' => 'required|string|max:255|unique:category,name,' . $id,
            ]);

            $category->update([
                'name' => $request->name
            ]);

            return response()->json([
                'message' => 'Kategori berhasil diupdate!',
                'data' => $category
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error update category API: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengupdate kategori'], 500);
        }
    }

    // DELETE: Menghapus kategori (Butuh Token)
    public function destroy($id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            $category->delete();

            return response()->json([
                'message' => 'Kategori berhasil dihapus!'
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error delete category API: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menghapus kategori'], 500);
        }
    }
}