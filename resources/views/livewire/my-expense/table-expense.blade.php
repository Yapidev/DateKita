<div>
    {{-- Table Expense List --}}
    <div class="card">
        <div class="card-body">
            <div class="mb-2">
                <div class="mb-2">
                    <h5 class="mb-0">Tabel List Pengeluaran</h5>
                </div>
            </div>
            <div class="table-responsive">
                <table id="expense-list" class="table border table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th width="10%">No.</th>
                            <th>Judul</th>
                            <th>Nominal</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody id="data-siswa-container">
                        @forelse ($expenses as $data)
                            <tr>
                                <td>{{ $expenses->firstItem() + $loop->index }}.</td>
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->formatted_amount }}</td>
                                <td>{{ $data->date->date_time }}</td>
                                <td class="desc" max-length="20" title="{{ $data->description }}">
                                    {{ Str::limit($data->description, 20) }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $expenses->links('livewire::bootstrap', data: ['scrollTo' => false]) }}
        </div>
    </div>
    {{-- Table Expense List --}}
</div>
