<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <!-- Tombol Kembali -->
            <a href="{{ route('admin.tables.index') }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white hover:bg-slate-100 border border-slate-200 text-slate-500 hover:text-slate-800 transition-colors">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
            </a>
            <div>
                <h2 class="font-bold text-xl text-slate-800 leading-tight">
                    {{ __('Edit Meja ' . $table->table_number) }}
                </h2>
                <p class="text-[11px] text-slate-400 mt-1">Perbarui informasi, status, dan layout untuk meja ini</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-4">
        <!-- Form Card (Flat, Border Slate-200) -->
        <form action="{{ route('admin.tables.update', $table->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-200/80 p-6 space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Nomor Meja -->
                <div>
                    <label for="table_number" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nomor / Kode Meja <span class="text-rose-500">*</span></label>
                    <input type="text" name="table_number" id="table_number" value="{{ old('table_number', $table->table_number) }}" 
                           placeholder="Contoh: 01, A1" 
                           class="w-full px-3.5 py-2 rounded-xl border {{ $errors->has('table_number') ? 'border-rose-300 focus:border-rose-500 focus:ring-rose-200' : 'border-slate-200 focus:border-indigo-500 focus:ring-indigo-200' }} text-xs focus:ring transition-all placeholder:text-slate-400 text-slate-800" required>
                    @error('table_number')
                        <p class="text-[10px] text-rose-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Area Lokasi -->
                <div>
                    <label for="area" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1.5">Area / Lokasi <span class="text-rose-500">*</span></label>
                    <select name="area" id="area" 
                            class="w-full px-3.5 py-2 rounded-xl border {{ $errors->has('area') ? 'border-rose-300 focus:border-rose-500 focus:ring-rose-200' : 'border-slate-200 focus:border-indigo-500 focus:ring-indigo-200' }} text-xs focus:ring transition-all text-slate-800" required>
                        <option value="Indoor" {{ old('area', $table->area) == 'Indoor' ? 'selected' : '' }}>Indoor (Ber-AC)</option>
                        <option value="Outdoor" {{ old('area', $table->area) == 'Outdoor' ? 'selected' : '' }}>Outdoor (Terbuka)</option>
                        <option value="Semi Outdoor" {{ old('area', $table->area) == 'Semi Outdoor' ? 'selected' : '' }}>Semi Outdoor (Teras/Kanopi)</option>
                        <option value="VIP Room" {{ old('area', $table->area) == 'VIP Room' ? 'selected' : '' }}>VIP Room (Private)</option>
                    </select>
                    @error('area')
                        <p class="text-[10px] text-rose-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kapasitas Kursi -->
                <div>
                    <label for="capacity" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kapasitas (Jumlah Kursi) <span class="text-rose-500">*</span></label>
                    <div class="relative flex items-center">
                        <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $table->capacity) }}" min="1" 
                               class="w-full px-3.5 py-2 rounded-xl border {{ $errors->has('capacity') ? 'border-rose-300 focus:border-rose-500 focus:ring-rose-200' : 'border-slate-200 focus:border-indigo-500 focus:ring-indigo-200' }} text-xs focus:ring transition-all text-slate-800" required>
                        <span class="absolute right-4 text-[10px] font-semibold text-slate-400 pointer-events-none">Kursi</span>
                    </div>
                    @error('capacity')
                        <p class="text-[10px] text-rose-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Meja -->
                <div>
                    <label for="status" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1.5">Status <span class="text-rose-500">*</span></label>
                    <select name="status" id="status" 
                            class="w-full px-3.5 py-2 rounded-xl border {{ $errors->has('status') ? 'border-rose-300 focus:border-rose-500 focus:ring-rose-200' : 'border-slate-200 focus:border-indigo-500 focus:ring-indigo-200' }} text-xs focus:ring transition-all text-slate-800" required>
                        <option value="available" {{ old('status', $table->status) == 'available' ? 'selected' : '' }}>Tersedia (Available)</option>
                        <option value="reserved" {{ old('status', $table->status) == 'reserved' ? 'selected' : '' }}>Dipesan (Reserved)</option>
                        <option value="occupied" {{ old('status', $table->status) == 'occupied' ? 'selected' : '' }}>Terisi (Occupied)</option>
                        <option value="maintenance" {{ old('status', $table->status) == 'maintenance' ? 'selected' : '' }}>Perbaikan (Maintenance)</option>
                    </select>
                    @error('status')
                        <p class="text-[10px] text-rose-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Upload Gambar Meja dengan Real-Time Preview -->
            <div>
                <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-2">Foto / Visual Meja</label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    
                    <!-- Box Preview (Memunculkan gambar lama jika ada) -->
                    <div id="preview-container" class="h-28 rounded-xl border border-dashed border-slate-200 bg-slate-50 flex flex-col items-center justify-center overflow-hidden text-slate-400 relative">
                        @if($table->image)
                            <img id="image-preview" src="{{ asset('storage/' . $table->image) }}" alt="Preview" class="w-full h-full object-cover">
                            <div id="preview-placeholder" class="text-center flex flex-col items-center hidden">
                                <i class="fa-solid fa-image text-lg mb-1 text-slate-300"></i>
                                <span class="text-[9px] uppercase font-bold tracking-wider">No File Chosen</span>
                            </div>
                        @else
                            <img id="image-preview" src="#" alt="Preview" class="w-full h-full object-cover hidden">
                            <div id="preview-placeholder" class="text-center flex flex-col items-center">
                                <i class="fa-solid fa-image text-lg mb-1 text-slate-300"></i>
                                <span class="text-[9px] uppercase font-bold tracking-wider">No File Chosen</span>
                            </div>
                        @endif
                    </div>

                    <!-- Input File -->
                    <div class="md:col-span-2">
                        <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)"
                               class="block w-full text-[11px] text-slate-500 file:mr-4 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-[11px] file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 cursor-pointer">
                        <p class="text-[10px] text-slate-400 mt-1.5">Format: JPG, JPEG, PNG, WEBP. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah gambar.</p>
                        @error('image')
                            <p class="text-[10px] text-rose-500 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Deskripsi Meja -->
            <div>
                <label for="description" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi / Catatan Tambahan</label>
                <textarea name="description" id="description" rows="3" 
                          placeholder="Tambahkan info detail (misal: dekat colokan listrik, dekat jendela utama, dll.)"
                          class="w-full px-3.5 py-2 rounded-xl border {{ $errors->has('description') ? 'border-rose-300 focus:border-rose-500 focus:ring-rose-200' : 'border-slate-200 focus:border-indigo-500 focus:ring-indigo-200' }} text-xs focus:ring transition-all placeholder:text-slate-400 text-slate-800">{{ old('description', $table->description) }}</textarea>
                @error('description')
                    <p class="text-[10px] text-rose-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Aktif (Toggle Switch) -->
            <div class="flex items-center gap-3 bg-slate-50 p-3 rounded-xl border border-slate-200/50">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $table->is_active) ? 'checked' : '' }}>
                    <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
                <div>
                    <span class="block text-[11px] font-bold text-slate-700">Aktifkan Meja Dalam Sistem</span>
                    <span class="block text-[9px] text-slate-400">Jika dinonaktifkan, pelanggan tidak akan bisa memesan meja ini.</span>
                </div>
            </div>

            <!-- Action Buttons (Flat, Sesuai Tema) -->
            <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                <a href="{{ route('admin.tables.index') }}" class="px-4 py-2 bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-600 font-semibold text-xs rounded-xl transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-xl transition-all duration-150">
                    <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Perubahan
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
                // Jika input dibatalkan/kosong, periksa apakah sebelumnya sudah ada gambar bawaan
                @if($table->image)
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