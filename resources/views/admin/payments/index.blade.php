<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-slate-800 leading-tight">
            {{ __('Verifikasi Pembayaran Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div
                class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm rounded-lg font-medium shadow-sm flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-emerald-600"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 font-semibold">
                            <th class="p-4">Kode / Tanggal</th>
                            <th class="p-4">Nama Pelanggan</th>
                            <th class="p-4">Detail Reservasi</th>
                            <th class="p-4">Nominal</th>
                            <th class="p-4">Bukti Transfer</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-center">Tindakan Persetujuan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                        @forelse($payments as $pay)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-4">
                                    <span class="block font-bold text-slate-900">{{ $pay->payment_code }}</span>
                                    <span
                                        class="text-xs text-slate-400 font-normal">{{ $pay->created_at->format('d M Y, H:i') }}
                                        WIB</span>
                                </td>

                                <td class="p-4 text-slate-900">{{ $pay->reservation->user->name ?? 'User Terhapus' }}
                                </td>

                                <td class="p-4">
                                    <span class="block font-semibold">Meja
                                        {{ $pay->reservation->table->table_number ?? '-' }}</span>
                                    <span class="text-xs text-slate-500 font-normal">
                                        Jadwal:
                                        {{ \Carbon\Carbon::parse($pay->reservation->reservation_date)->format('d/m/Y') }}
                                        ({{ substr($pay->reservation->start_time, 0, 5) }} -
                                        {{ substr($pay->reservation->end_time, 0, 5) }})
                                    </span>
                                </td>

                                <td class="p-4 font-bold text-slate-900">Rp
                                    {{ number_format($pay->amount, 0, ',', '.') }}</td>

                                <td class="p-4">
                                    <a href="{{ asset('storage/' . $pay->proof_of_payment) }}" target="_blank"
                                        class="inline-flex items-center text-xs text-blue-600 hover:text-blue-800 font-semibold gap-1.5 bg-blue-50 hover:bg-blue-100 px-2.5 py-1.5 rounded-lg border border-blue-200/60 transition">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Gambar
                                    </a>
                                </td>

                                <td class="p-4">
                                    @if ($pay->status === 'pending')
                                        <span
                                            class="inline-block px-2.5 py-1 text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200 rounded-md uppercase tracking-wide">Pending</span>
                                    @elseif($pay->status === 'success')
                                        <span
                                            class="inline-block px-2.5 py-1 text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-md uppercase tracking-wide">Approved</span>
                                    @else
                                        <span
                                            class="inline-block px-2.5 py-1 text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200 rounded-md uppercase tracking-wide">Rejected</span>
                                    @endif
                                </td>

                                <td class="p-4">
                                    @if ($pay->status === 'pending')
                                        <form action="{{ route('admin.payments.verify', $pay->id) }}" method="POST"
                                            class="flex items-center justify-center gap-2">
                                            @csrf
                                            @method('PATCH')

                                            <input type="text" name="admin_note" placeholder="Catatan penolakan..."
                                                class="text-xs border border-slate-200 rounded-lg px-2.5 py-1.5 focus:ring-slate-900 focus:border-slate-900 w-44">

                                            <button type="submit" name="status" value="success"
                                                onclick="return confirm('Apakah Anda yakin uang sudah masuk dan ingin MENYETUJUI pembayaran ini?')"
                                                class="px-3 py-1.5 text-xs bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition shadow-sm flex items-center gap-1">
                                                <i class="fa-solid fa-check"></i> Acc
                                            </button>

                                            <button type="submit" name="status" value="failed"
                                                onclick="return confirm('Apakah Anda yakin ingin MENOLAK bukti pembayaran ini?')"
                                                class="px-3 py-1.5 text-xs bg-rose-600 hover:bg-rose-700 text-white font-semibold rounded-lg transition shadow-sm flex items-center gap-1">
                                                <i class="fa-solid fa-xmark"></i> Tolak
                                            </button>
                                        </form>
                                    @else
                                        <div
                                            class="text-center text-xs text-slate-400 italic bg-slate-50 py-1 rounded-md border border-slate-100">
                                            {{ $pay->admin_note ?? 'Terverifikasi tanpa catatan.' }}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-12 text-center text-slate-400 font-medium">
                                    <i class="fa-solid fa-inbox text-2xl block mb-2 text-slate-300"></i>
                                    Belum ada kiriman bukti pembayaran aktif dari pelanggan saat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
