<div>
    @assets
        {{-- Import Script Datatable --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    @endassets

    {{-- Table Expense List --}}
    <div class="card">
        <div class="card-body">
            <div class="mb-2">
                <div class="mb-2">
                    <h5 class="mb-0">Tabel List Pengeluaran</h5>
                </div>
                {{-- <div class="input-group">
                    <button class="btn bg-info-subtle text-info  dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Urutkan</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item cursor-pointer">Terbaru <i class="ti ti-check"></i></a>
                        <a class="dropdown-item cursor-pointer">Terlama</a>
                    </div>
                    <input type="search" class="form-control" placeholder="Cari data berdasarkan kolom..">
                </div> --}}
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
                                <td wire:ignore max-length="20" data-toggle="tooltip" title="{{ $data->description }}">
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

    {{-- Script --}}
    @script
        <script>
            $('[data-toggle="tooltip"]').tooltip()
        </script>
    @endscript
    {{-- Script --}}
</div>
