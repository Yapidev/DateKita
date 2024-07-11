<div>
    <div class="row">
        {{-- Total Expense --}}
        <div class="col-xl-4 mb-4">
            <div class="card w-100">
                <div class="card-header text-bg-success">
                    <h4 class="mb-0 text-white card-title">Total Pengeluaran</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span>{{ $date->total_expenses }}</span>
                    </div>
                </div>
            </div>
        </div>
        {{-- Total Expense --}}
        {{-- Total Expense User --}}
        <div class="col-xl-8">
            <div class="card w-100">
                <div class="card-header text-bg-secondary">
                    <h4 class="mb-0 text-white card-title">Total Pengeluaran Kita</h4>
                </div>
                <div class="card-body">
                    @forelse ($totalExpensesPerUser as $user)
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <img src="{{ asset($user['avatar']) }}" alt="avatar" class="rounded-circle" width="40"
                                height="40" style="object-fit: cover">
                            <span>
                                <span class="text-dark fw-bold">{{ $user['name'] }}:</span>
                                Rp. {{ number_format($user['total'], 0, ',', '.') }}
                                (<span class="{{ $user['color'] }}">{{ number_format($user['percentage'], 2) }}%
                                </span>)
                                dari total pengeluaran.
                            </span>
                        </div>
                        <hr>
                    @empty
                        <p>Belum ada pengeluaran</p>
                    @endforelse
                </div>
            </div>
        </div>
        {{-- Total Expense User --}}
    </div>
</div>
