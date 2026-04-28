<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Category;
use App\Models\PackageInclude;

class PackageController extends Controller
{
    /**
     * List semua paket
     */
    public function index()
    {
        $packages = Package::with('category')->latest()->get();
        return view('admin.packages.index', compact('packages'));
    }

    /**
     * Form create
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.packages.create', compact('categories'));
    }

    /**
     * Simpan data
     */
public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'price' => 'required|numeric',
            'max_per_day' => 'required|integer|min:1',
            'notes' => 'nullable|string', // Tambahkan validasi
            // ... validasi lainnya
        ]);

        $package = Package::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'notes' => $request->notes, // Pastikan ini tersimpan
            'price' => $request->price,
            'prewedding_duration' => $request->prewedding_duration,
            'wedding_duration' => $request->wedding_duration,
            'intimate_duration' => $request->intimate_duration,
            'duration_hours' => $request->duration_hours,
            'max_per_day' => $request->max_per_day,
            'is_active' => $request->has('is_active'),
        ]);

        $this->saveIncludes($package->id, $request);

        return redirect()->route('admin.packages.index')
            ->with('success','Paket berhasil ditambahkan');
    }
    /**
     * Form edit
     */
    public function edit($id)
    {
        $package = Package::with('includes')->findOrFail($id);
        $categories = Category::all();

        return view('admin.packages.edit', compact('package','categories'));
    }

    /**
     * Update
     */
public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'price' => 'required|numeric',
            'notes' => 'nullable|string', // Tambahkan validasi
            // ... validasi lainnya
        ]);

        // Karena sudah menggunakan $request->all(), notes otomatis terupdate 
        // selama sudah ada di $fillable di Model.
        $package->update($request->all());

        $package->includes()->delete();
        $this->saveIncludes($package->id, $request);

        return redirect()->route('admin.packages.index')
            ->with('success','Paket berhasil diupdate');
    }
    /**
     * Delete
     */
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();

        return back()->with('success','Paket dihapus');
    }

    /**
     * Simpan Item Include (Prewed, Wedding, Intimate, General)
     */
    private function saveIncludes($packageId, $request)
    {
        // Tambahkan 'intimate' ke dalam daftar tipe
        $types = ['prewedding', 'wedding', 'intimate', 'general'];

        foreach($types as $type){
            if($request->$type){
                foreach($request->$type as $item){
                    if(!empty($item)){
                        PackageInclude::create([
                            'package_id' => $packageId,
                            'type' => $type,
                            'title' => $item
                        ]);
                    }
                }
            }
        }
    }

    /**
     * Detail Paket
     */
    public function show($id)
    {
        $package = Package::with(['category', 'includes'])->findOrFail($id);
        return view('admin.packages.show', compact('package'));
    }
}