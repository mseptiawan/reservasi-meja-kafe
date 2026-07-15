<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-slate-800 leading-tight">
            {{ __('Rincian Transfer & Konfirmasi') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-2xl mx-auto px-4">
        <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
            <!-- Informasi Singkat Reservasi -->
            <div class="p-5 bg-slate-50 border-b border-slate-100">
                <h3 class="font-semibold text-slate-800">Ringkasan Reservasi #{{ $reservation->reservation_code }}</h3>
                <p class="text-xs text-slate-500 mt-0.5">Meja {{ $reservation->table->table_number }} (Kapasitas
                    {{ $reservation->table->capacity }} Tamu)</p>
            </div>

            <div class="p-6 space-y-6">
                <!-- Informasi Nomor Rekening/VA Kafe -->
                <div>
                    <h4 class="text-sm font-semibold text-slate-700 mb-2.5">Silakan Transfer Ke Salah Satu Rekening Senja
                        Space:</h4>
                    <div class="grid gap-3">
                        @foreach ($bankInstructions as $bank)
                            <div class="p-3.5 bg-slate-50 border border-slate-200/60 rounded-lg">
                                <span class="text-xs font-bold text-slate-600 uppercase">{{ $bank['name'] }}</span>
                                <div class="flex items-center justify-between mt-1">
                                    <span
                                        class="font-mono text-base font-bold text-slate-900 tracking-wide">{{ $bank['number'] }}</span>
                                    <span class="text-xs text-slate-500 font-medium">a.n. {{ $bank['holder'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <hr class="border-slate-100">

                <!-- Form Konfirmasi Upload -->
                <form action="{{ route('payment.store', $reservation->id) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <!-- Simpan nominal pembayaran terhitung secara tersembunyi/eksplisit -->
                    <input type="hidden" name="amount" value="{{ $amountToPay }}">

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nominal Yang Harus Dibayar</label>
                        <div class="text-2xl font-black text-slate-900">
                            Rp {{ number_format($amountToPay, 0, ',', '.') }}
                        </div>
                        <span class="text-xs text-slate-400 font-medium">*Tarif komitmen pemesanan area meja.</span>
                    </div>

                    <div>
                        <label for="proof_of_payment" class="block text-sm font-medium text-slate-700 mb-1">Unggah Bukti
                            Transfer</label>
                        <input type="file" name="proof_of_payment" id="proof_of_payment" required
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 border border-slate-200 rounded-lg p-1">
                        @error('proof_of_payment')
                            <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 active:bg-slate-950 transition duration-150">
                            Kirim Bukti Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
