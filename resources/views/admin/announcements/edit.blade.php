<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <!-- Tombol Kembali -->
            <a href="{{ route('admin.announcements.index') }}"
                class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-500 hover:text-slate-800 transition-all duration-150"
                title="Kembali ke Daftar Pengumuman">
                <i class="fa-solid fa-arrow-left text-[11px]"></i>
            </a>
            <div>
                <h2 class="font-medium text-md text-slate-800 leading-tight">
                    {{ __('Edit Pengumuman') }}
                </h2>
                <p class="text-[11px] text-slate-400 mt-0.5">Perbarui data atau status rilis konten pengumuman</p>
            </div>
        </div>
    </x-slot>

    <div class="min-h-[calc(100vh-200px)] flex items-center justify-center p-6">
        <form method="POST" action="{{ route('admin.announcements.update', $announcement->id) }}" enctype="multipart/form-data"
            class="w-full max-w-3xl bg-white rounded-lg border border-slate-200/60 overflow-hidden">
            @csrf
            @method('PATCH')

            <!-- Body Form -->
            <div class="p-6 space-y-5">

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Judul Pengumuman -->
                    <div class="md:col-span-2 space-y-1.5">
                        <label for="title" class="text-xs font-semibold text-slate-700 tracking-wide uppercase">Judul Pengumuman <span class="text-rose-500">*</span></label>
                        <input id="title" type="text" name="title" value="{{ old('title', $announcement->title) }}" required autofocus
                            class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-xs transition-all" />
                        <x-input-error :messages="$errors->get('title')" class="mt-1 text-xs text-rose-500" />
                    </div>

                    <!-- Tipe -->
                    <div class="space-y-1.5">
                        <label for="type" class="text-xs font-semibold text-slate-700 tracking-wide uppercase">Tipe <span class="text-rose-500">*</span></label>
                        <select id="type" name="type" required
                            class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-xs transition-all">
                            <option value="announcement" {{ old('type', $announcement->type) == 'announcement' ? 'selected' : '' }}>Umum</option>
                            <option value="promo" {{ old('type', $announcement->type) == 'promo' ? 'selected' : '' }}>Promo</option>
                            <option value="event" {{ old('type', $announcement->type) == 'event' ? 'selected' : '' }}>Event</option>
                            <option value="info_internal" {{ old('type', $announcement->type) == 'info_internal' ? 'selected' : '' }}>Info Internal</option>
                            <option value="maintenance" {{ old('type', $announcement->type) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-1 text-xs text-rose-500" />
                    </div>

                    <!-- Status Publikasi -->
                    <div class="space-y-1.5">
                        <label for="status" class="text-xs font-semibold text-slate-700 tracking-wide uppercase">Status <span class="text-rose-500">*</span></label>
                        <select id="status" name="status" required
                            class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-xs transition-all">
                            <option value="draft" {{ old('status', $announcement->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $announcement->status) == 'published' ? 'selected' : '' }}>Terbitkan</option>
                            <option value="archived" {{ old('status', $announcement->status) == 'archived' ? 'selected' : '' }}>Arsip</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-1 text-xs text-rose-500" />
                    </div>
                </div>

                <!-- Baris 2: Konten Isi Pengumuman -->
                <div class="space-y-1.5">
                    <label for="content" class="text-xs font-semibold text-slate-700 tracking-wide uppercase">Isi Konten <span class="text-rose-500">*</span></label>
                    <textarea id="content" name="content" rows="5" required
                        class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-xs transition-all">{{ old('content', $announcement->content) }}</textarea>
                    <x-input-error :messages="$errors->get('content')" class="mt-1 text-xs text-rose-500" />
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 tracking-wide uppercase">Banner Gambar (Opsional)</label>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">

                        <!-- Box Preview -->
                        <div id="preview-container" class="h-24 rounded-lg border border-dashed border-slate-200 bg-slate-50 flex flex-col items-center justify-center overflow-hidden text-slate-400 relative">
                            @if($announcement->image)
                            <img id="image-preview" src="{{ asset('storage/' . $announcement->image) }}" alt="Preview" class="w-full h-full object-cover">
                            <div id="preview-placeholder" class="text-center flex flex-col items-center hidden">
                                <i class="fa-solid fa-image text-lg mb-1 text-slate-300"></i>
                                <span class="text-[8px] uppercase font-medium tracking-wider">No Preview</span>
                            </div>
                            @else
                            <img id="image-preview" src="#" alt="Preview" class="w-full h-full object-cover hidden">
                            <div id="preview-placeholder" class="text-center flex flex-col items-center">
                                <i class="fa-solid fa-image text-lg mb-1 text-slate-300"></i>
                                <span class="text-[8px] uppercase font-medium tracking-wider">No Preview</span>
                            </div>
                            @endif
                        </div>

                        <!-- Input File -->
                        <div class="md:col-span-3 space-y-1.5">
                            <input id="image" type="file" name="image" accept="image/*" onchange="previewImage(event)"
                                class="block w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-500 focus:outline-none text-xs transition-all file:mr-4 file:py-0.5 file:px-2.5 file:rounded-md file:border-0 file:text-[11px] file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer" />
                            <p class="text-[10px] text-slate-400">Format: JPG, JPEG, PNG, WEBP (Maksimal 2MB). Biarkan kosong jika tidak ingin mengubah banner.</p>
                            <x-input-error :messages="$errors->get('image')" class="mt-1 text-xs text-rose-500" />
                        </div>

                    </div>
                </div>
            </div>

            <!-- Footer Form / Tombol Aksi (Flat, Sesuai Tema) -->
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-2">
                <a href="{{ route('admin.announcements.index') }}"
                    class="px-4 py-2 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold text-xs rounded-lg transition-all">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-lg transition-all">
                    <i class="fa-solid fa-floppy-disk mr-1.5 text-[10px]"></i> Perbarui Pengumuman
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScript Real-time Image Preview -->
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('preview-placeholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                @if($announcement - > image)
                preview.src = "{{ asset('storage/' . $announcement->image) }}";
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                @else
                preview.src = "#";
                preview.classList.add('hidden');
                placeholder.classList.remove('hidden');
                @endif
            }
        }
    </script>
</x-app-layout>