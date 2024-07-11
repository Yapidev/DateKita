<div>
    {{-- Header --}}
    <livewire:my-expense.header :$user />
    {{-- Header --}}

    {{-- Card Expense --}}
    <div class="card">
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
                    {{ $currentMonthExpense }}
                </span>
            </div>
        </div>
    </div>
    {{-- Card Expense --}}
</div>
