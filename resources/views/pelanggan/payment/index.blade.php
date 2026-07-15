<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-slate-800 leading-tight">
            {{ __('Menunggu Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto px-4">
        @if ($pendingPayments->isEmpty())
            <div class="bg-white p-8 text-center rounded-xl border border-slate-200 shadow-sm">
                <p class="text-slate-500 font-medium">Tidak ada tagihan reservasi aktif yang memerlukan pembayaran saat
                    ini.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($pendingPayments as $booking)
                    <div
                        class="bg-white p-5 border border-slate-200 rounded-xl shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <span
                                class="text-xs font-semibold uppercase tracking-wider bg-amber-100 text-amber-800 px-2 py-0.5 rounded">
                                {{ $booking->reservation_code }}
                            </span>
                            <h3 class="font-semibold text-slate-800 text-lg mt-1">Meja Nomer:
                                {{ $booking->table->table_number }}</h3>
                            <p class="text-sm text-slate-500 font-medium">
                                Jadwal: {{ \Carbon\Carbon::parse($booking->reservation_date)->format('d M Y') }} |
                                {{ substr($booking->start_time, 0, 5) }} - {{ substr($booking->end_time, 0, 5) }} WIB
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('payment.create', $booking->id) }}"
                                class="inline-flex items-center px-4 py-2 bg-slate-900 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-wider hover:bg-slate-800 active:bg-slate-950 transition ease-in-out duration-150">
                                Bayar Sekarang
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
