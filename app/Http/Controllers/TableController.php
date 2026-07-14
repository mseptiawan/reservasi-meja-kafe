<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TableController extends Controller
{
    /**
     * Tampilkan semua daftar meja.
     */
    public function index()
    {
        $tables = Table::orderBy('table_number', 'asc')->get();
        return view('admin.tables.index', compact('tables'));
    }

    /**
     * Tampilkan form tambah meja baru.
     */
    public function create()
    {
        return view('admin.tables.create');
    }

    /**
     * Simpan data meja baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'table_number' => 'required|string|max:50|unique:tables,table_number',
            'area'         => 'required|string|max:100',
            'capacity'     => 'required|integer|min:1',
            'status'       => 'required|in:available,reserved,occupied,maintenance',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description'  => 'nullable|string',
        ]);

        $data = $request->only(['table_number', 'area', 'capacity', 'status', 'description']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        // Proses unggah gambar jika ada
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('tables', 'public');
            $data['image'] = $path;
        }

        Table::create($data);


        return redirect()->route('admin.tables.index')->with('success','meja berhasil ditambah.');

    }

    /**
     * Tampilkan form edit data meja.
     */
    public function edit(Table $table)
    {
        return view('admin.tables.edit', compact('table'));
    }

    /**
     * Perbarui data meja di database.
     */
    public function update(Request $request, Table $table)
    {
        $request->validate([
            'table_number' => 'required|string|max:50|unique:tables,table_number,' . $table->id,
            'area'         => 'required|string|max:100',
            'capacity'     => 'required|integer|min:1',
            'status'       => 'required|in:available,reserved,occupied,maintenance',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description'  => 'nullable|string',
        ]);

        $data = $request->only(['table_number', 'area', 'capacity', 'status', 'description']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($table->image && Storage::disk('public')->exists($table->image)) {
                Storage::disk('public')->delete($table->image);
            }
            // Simpan gambar baru
            $path = $request->file('image')->store('tables', 'public');
            $data['image'] = $path;
        }

        $table->update($data);


        return redirect()->route('admin.tables.index')->with('success', "data berhasil diupdate");
    }

    /**
     * Hapus meja secara soft delete.
     */
    public function destroy(Table $table)
    {
        // Hapus file gambar dari storage jika ingin hemat penyimpanan
        if ($table->image && Storage::disk('public')->exists($table->image)) {
            Storage::disk('public')->delete($table->image);
        }

        $table->delete();


        return redirect()->route('admin.tables.index')->with('success', 'data berhasil dihapus.');
    }
}