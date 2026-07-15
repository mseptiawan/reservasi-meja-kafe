<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.tables.index') }}"
                class="inline-flex items-center justify-center w-8 h-8 rounded-lg  text-slate-500 hover:text-slate-800 transition-all duration-150"
                title="Kembali ke Daftar Meja">
                <i class="fa-solid fa-arrow-left text-[11px]"></i>
            </a>
            <div>
                <h2 class="font-medium text-sm text-slate-800 leading-tight">
                    {{ __('Edit Meja ' . $table->table_number) }}
                </h2>
                <p class="text-[11px] text-slate-400 mt-0.5">Perbarui informasi, status, dan layout untuk meja ini</p>
            </div>
        </div>
    </x-slot>

    <div class="min-h-[calc(100vh-200px)] flex items-center justify-center p-6">
        <form action="{{ route('admin.tables.update', $table->id) }}" method="POST" enctype="multipart/form-data"
            class="w-full max-w-3xl bg-white rounded-lg border border-slate-200/60 overflow-hidden">
            @csrf
            @method('PUT')

            <!-- Body Form -->
            <div class="p-6 space-y-5">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nomor Meja -->
                    <div class="space-y-1.5">
                        <label for="table_number" class="text-xs font-semibold text-slate-700 tracking-wide uppercase">
                            Nomor / Kode Meja <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="table_number" id="table_number"
                            value="{{ old('table_number', $table->table_number) }}" placeholder="Contoh: 01, A1, VIP-02"
                            class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-xs transition-all"
                            required autofocus>
                        @error('table_number')
                            <p class="text-[10px] text-rose-500 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Area Lokasi -->
                    <div class="space-y-1.5">
                        <label for="area" class="text-xs font-semibold text-slate-700 tracking-wide uppercase">
                            Area Lokasi <span class="text-rose-500">*</span>
                        </label>
                        <select name="area" id="area"
                            class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-xs transition-all"
                            required>
                            <option value="Indoor" {{ old('area', $table->area) == 'Indoor' ? 'selected' : '' }}>Indoor
                                (Ber-AC)</option>
                            <option value="Outdoor" {{ old('area', $table->area) == 'Outdoor' ? 'selected' : '' }}>
                                Outdoor (Terbuka)</option>
                            <option value="Semi Outdoor"
                                {{ old('area', $table->area) == 'Semi Outdoor' ? 'selected' : '' }}>Semi Outdoor
                                (Teras/Kanopi)</option>
                            <option value="VIP Room" {{ old('area', $table->area) == 'VIP Room' ? 'selected' : '' }}>VIP
                                Room (Private)</option>
                        </select>
                        @error('area')
                            <p class="text-[10px] text-rose-500 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Baris 2: Kapasitas & Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="capacity" class="text-xs font-semibold text-slate-700 tracking-wide uppercase">
                            Kapasitas <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative flex items-center">
                            <input type="number" name="capacity" id="capacity"
                                value="{{ old('capacity', $table->capacity) }}" min="1"
                                class="w-full pl-3 pr-12 py-2 bg-white border border-slate-200 rounded-lg text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-xs transition-all"
                                required>
                            <span
                                class="absolute right-3 text-[10px] font-semibold text-slate-400 pointer-events-none">Kursi</span>
                        </div>
                        @error('capacity')
                            <p class="text-[10px] text-rose-500 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Meja -->
                    <div class="space-y-1.5">
                        <label for="status" class="text-xs font-semibold text-slate-700 tracking-wide uppercase">
                            Status <span class="text-rose-500">*</span>
                        </label>
                        <select name="status" id="status"
                            class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-xs transition-all"
                            required>
                            <option value="available"
                                {{ old('status', $table->status) == 'available' ? 'selected' : '' }}>Tersedia
                                (Available)</option>
                            <option value="reserved"
                                {{ old('status', $table->status) == 'reserved' ? 'selected' : '' }}>Dipesan (Reserved)
                            </option>
                            <option value="occupied"
                                {{ old('status', $table->status) == 'occupied' ? 'selected' : '' }}>Terisi (Occupied)
                            </option>
                            <option value="maintenance"
                                {{ old('status', $table->status) == 'maintenance' ? 'selected' : '' }}>Perbaikan
                                (Maintenance)</option>
                        </select>
                        @error('status')
                            <p class="text-[10px] text-rose-500 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Baris 3: Visual / Image -->
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 tracking-wide uppercase">Foto / Visual
                        Meja</label>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">

                        <!-- Box Preview -->
                        <div id="preview-container"
                            class="h-24 rounded-lg border border-dashed border-slate-200 bg-slate-50 flex flex-col items-center justify-center overflow-hidden text-slate-400 relative">
                            @if ($table->image)
                                <img id="image-preview" src="{{ asset('storage/' . $table->image) }}" alt="Preview"
                                    class="w-full h-full object-cover">
                                <div id="preview-placeholder" class="text-center flex flex-col items-center hidden">
                                    <i class="fa-solid fa-image text-lg mb-1 text-slate-300"></i>
                                    <span class="text-[8px] uppercase font-medium tracking-wider">No Preview</span>
                                </div>
                            @else
                                <img id="image-preview" src="#" alt="Preview"
                                    class="w-full h-full object-cover hidden">
                                <div id="preview-placeholder" class="text-center flex flex-col items-center">
                                    <i class="fa-solid fa-image text-lg mb-1 text-slate-300"></i>
                                    <span class="text-[8px] uppercase font-medium tracking-wider">No Preview</span>
                                </div>
                            @endif
                        </div>

                        <!-- Input File -->
                        <div class="md:col-span-3 space-y-1.5">
                            <input type="file" name="image" id="image" accept="image/*"
                                onchange="previewImage(event)"
                                class="block w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-500 focus:outline-none text-xs transition-all file:mr-4 file:py-0.5 file:px-2.5 file:rounded-md file:border-0 file:text-[11px] file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer">
                            <p class="text-[10px] text-slate-400">Format: JPG, JPEG, PNG, WEBP (Maksimal 2MB). Biarkan
                                kosong jika tidak ingin mengubah gambar.</p>
                            @error('image')
                                <p class="text-[10px] text-rose-500 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Baris 4: Deskripsi Meja -->
                <div class="space-y-1.5">
                    <label for="description"
                        class="text-xs font-semibold text-slate-700 tracking-wide uppercase">Deskripsi / Catatan
                        Tambahan</label>
                    <textarea name="description" id="description" rows="3"
                        placeholder="Tambahkan info detail (misal: dekat colokan listrik, dekat jendela utama, dll.)"
                        class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-xs transition-all">{{ old('description', $table->description) }}</textarea>
                    @error('description')
                        <p class="text-[10px] text-rose-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Baris 5: Status Aktif (Switch Inline) -->
                <div class="flex items-center justify-between bg-slate-50 p-4 rounded-lg border border-slate-200/50">
                    <div class="space-y-0.5">
                        <span class="block text-xs font-medium text-slate-700">Aktifkan Meja Dalam Sistem</span>
                        <span class="block text-[10px] text-slate-400 max-w-md">Jika dinonaktifkan, pelanggan tidak
                            akan bisa memesan meja ini secara langsung melalui aplikasi.</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer shrink-0">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                            {{ old('is_active', $table->is_active) ? 'checked' : '' }}>
                        <div
                            class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600">
                        </div>
                    </label>
                </div>

            </div>

            <!-- Footer Form / Tombol Aksi -->
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-2">
                <a href="{{ route('admin.tables.index') }}"
                    class="px-4 py-2 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold text-xs rounded-lg transition-all">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-lg transition-all">
                    <i class="fa-solid fa-floppy-disk mr-1.5 text-[10px]"></i> Simpan
                </button>
            </div>
        </form>
    </div>

    <!-- Script JavaScript untuk Preview Gambar -->
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
                {{-- Diperbaiki: Spasi pada -> dihapus agar tidak melempar ParseError --}}
                @if ($table->image)
                    preview.src = "{{ asset('storage/' . $table->image) }}";
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
