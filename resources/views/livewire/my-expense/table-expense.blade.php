<div>
    @assets
        {{-- Import Script Datatable --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    @endassets

    {{-- Table Expense List --}}
    <div class="card">
        <div class="card-body">
            <div class="mb-2">
                <div class="d-xl-flex align-items-center justify-content-between">
                    <div class="mb-2">
                        <h5>Tabel List Pengeluaran</h5>
                    </div>
                    <div class="mb-2">
                        <input type="search" class="form-control" placeholder="Cari data berdasarkan kolom..">
                    </div>
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
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->formatted_amount }}</td>
                                <td>{{ $data->date->date_time }}</td>
                                <td max-length="20" data-bs-toggle="tooltip" title="{{ $data->description }}">
                                    {{ Str::limit($data->description, 20) }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $expenses->links('pagination::tailwind') }}
        </div>
    </div>
    {{-- Table Expense List --}}
</div>
