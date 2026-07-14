<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    /**
     * Tampilkan semua daftar pengumuman.
     */
    public function index()
    {
        $announcements = Announcement::with('author')->orderBy('created_at', 'desc')->get();
        return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * Tampilkan form tambah pengumuman.
     */
    public function create()
    {
        return view('admin.announcements.create');
    }

    /**
     * Simpan pengumuman baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'type'    => 'required|in:info_internal,promo,event,maintenance,announcement',
            'status'  => 'required|in:draft,published,archived',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'type', 'status']);
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);

        if ($request->status === 'published') {
            $data['published_at'] = now();
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('announcements', 'public');
        }

        Announcement::create($data);

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit pengumuman.
     */
    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    /**
     * Perbarui data pengumuman.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'type'    => 'required|in:info_internal,promo,event,maintenance,announcement',
            'status'  => 'required|in:draft,published,archived',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'type', 'status']);

        if ($request->title !== $announcement->title) {
            $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        }

        if ($request->status === 'published' && !$announcement->published_at) {
            $data['published_at'] = now();
        } elseif ($request->status === 'draft') {
            $data['published_at'] = null;
        }

        if ($request->hasFile('image')) {
            if ($announcement->image && Storage::disk('public')->exists($announcement->image)) {
                Storage::disk('public')->delete($announcement->image);
            }
            $data['image'] = $request->file('image')->store('announcements', 'public');
        }

        $announcement->update($data);

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Hapus pengumuman.
     */
    public function destroy(Announcement $announcement)
    {
        if ($announcement->image && Storage::disk('public')->exists($announcement->image)) {
            Storage::disk('public')->delete($announcement->image);
        }

        $announcement->delete();

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
