<div>
    {{-- Header --}}
    <livewire:my-expense.header :$user />
    {{-- Header --}}

    {{-- Card Detail Expense --}}
    <livewire:my-expense.detail-expense />
    {{-- Card Detail Expense --}}

    {{-- Chart Pengeluaran --}}
    <livewire:my-expense.chart :$user />
    {{-- Chart Pengeluaran --}}

    {{-- Card Table List Pengeluaran --}}
    <livewire:my-expense.table-expense :$user />
    {{-- Card Table List Pengeluaran --}}

</div>
