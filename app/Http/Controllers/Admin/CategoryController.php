<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')
            ->with('success','Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $categories = Category::all(); // Tetap ambil semua untuk tabel di kiri
        $category = Category::findOrFail($id); // Ambil satu data yang mau diedit
        
        // PENTING: Return ke view yang SAMA dengan index
        return view('admin.categories.index', compact('categories', 'category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required'
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.index')
            ->with('success','Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // biar ga error kalau masih dipakai
        if($category->packages()->exists()){
            return back()->with('error','Kategori masih digunakan');
        }

        $category->delete();

        return back()->with('success','Kategori dihapus');
    }
}