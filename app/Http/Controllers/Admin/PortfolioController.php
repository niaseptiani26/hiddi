<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with('category')->latest()->get();
        $categories = Category::all();

        return view('admin.portfolios.index', compact('portfolios', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.portfolios.create', compact('categories'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required',
            'description' => 'nullable|string',
            'type' => 'required|in:image,video',

            'image_path' => 'nullable|image|max:204800|required_if:type,image',
            'video_path' => 'nullable|mimes:mp4,mov,avi|max:204800|required_if:type,video',
        ]);

        $data = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'is_featured' => $request->has('is_featured'),
            'type' => $request->type,
        ];

        // ===== HANDLE VIDEO =====
        if ($request->type === 'video') {
            $file = $request->file('video_path');

            if (!$file || !$file->isValid()) {
                return back()->with('error', 'Video gagal upload');
            }

            $data['video_path'] = $file->store('videos', 'public');
            $data['image_path'] = null;
        }

        // ===== HANDLE IMAGE =====
        if ($request->type === 'image') {
            $file = $request->file('image_path');

            if (!$file || !$file->isValid()) {
                return back()->with('error', 'Gambar gagal upload');
            }

            $data['image_path'] = $file->store('portfolios', 'public');
            $data['video_path'] = null;
        }

        Portfolio::create($data);

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio berhasil ditambahkan');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $categories = Category::all();

        return view('admin.portfolios.edit', compact('portfolio', 'categories'));
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required',
            'description' => 'nullable|string',
            'type' => 'required|in:image,video',

            'image_path' => 'nullable|image|max:204800',
            'video_path' => 'nullable|mimes:mp4,mov,avi|max:204800',
        ]);

        $data = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'is_featured' => $request->has('is_featured'),
            'type' => $request->type,
        ];

        // ===== UPDATE VIDEO =====
        if ($request->type === 'video' && $request->file('video_path')) {
            $file = $request->file('video_path');

            if ($file->isValid()) {

                if ($portfolio->video_path) {
                    Storage::disk('public')->delete($portfolio->video_path);
                }
                if ($portfolio->image_path) {
                    Storage::disk('public')->delete($portfolio->image_path);
                }

                $data['video_path'] = $file->store('videos', 'public');
                $data['image_path'] = null;
            }
        }

        // ===== UPDATE IMAGE =====
        if ($request->type === 'image' && $request->file('image_path')) {
            $file = $request->file('image_path');

            if ($file->isValid()) {

                if ($portfolio->image_path) {
                    Storage::disk('public')->delete($portfolio->image_path);
                }
                if ($portfolio->video_path) {
                    Storage::disk('public')->delete($portfolio->video_path);
                }

                $data['image_path'] = $file->store('portfolios', 'public');
                $data['video_path'] = null;
            }
        }

        $portfolio->update($data);

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio berhasil diupdate');
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        if ($portfolio->image_path) {
            Storage::disk('public')->delete($portfolio->image_path);
        }

        if ($portfolio->video_path) {
            Storage::disk('public')->delete($portfolio->video_path);
        }

        $portfolio->delete();

        return back()->with('success', 'Portfolio dihapus');
    }
}