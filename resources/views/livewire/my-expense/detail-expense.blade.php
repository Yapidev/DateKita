<div>
    <div class="card hover-img">
        <div class="card-header bg-primary">
            <h4 class="mb-0 text-white">Detail Pengeluaran</h4>
        </div>
        <div class="card-body">
            <div class="mb-2">
                <h6 class="text-dark fw-bold mb-0">Target Pengeluaran:</h6>
                <span>
                    {{ $user->getFormattedTargetExpenses() }}
                </span>
            </div>
            <div class="mb-2">
                <h6 class="text-dark fw-bold mb-0">Pengeluaran bulan ini ({{ now()->translatedFormat('F') }}):</h6>
                <span>
                    Rp. {{ number_format($currentMonthExpense, 0, ',', '.') }}
                </span>
                <small class="{{ $color }}">({{ number_format($percentage, 2, ',', '.') }}%)</small>
                <span>dari target pengeluaran</span>
            </div>
            <div class="mb-2">
                <h6 class="text-dark fw-bold mb-0">
                    @if ($difference > 0)
                        Kurang dari Target:
                    @else
                        Melebihi Target:
                    @endif
                </h6>
                <span>
                    Rp. {{ $differenceFormatted }}
                </span>
            </div>
        </div>
    </div>
</div>
