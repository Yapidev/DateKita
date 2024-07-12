<div>
    @assets
        {{-- Import Script Datatable --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    @endassets

    {{-- Table Expense List --}}
    <div class="card hover-img">
        <div class="card-body">
            <div class="mb-2">
                <h5 class="mb-0">Tabel List Pengeluaran</h5>
            </div>
            <div class="table-responsive">
                <table id="expense-list" class="table border table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Judul</th>
                            <th>Nominal</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody id="data-siswa-container">
                        @forelse ($expenses as $data)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->amount }}</td>
                                <td max-length="20" data-bs-toggle="tooltip" title="{{ $data->description }}">
                                    {{ Str::limit($data->description, 20) }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Table Expense List --}}

    @script
        <script>
            $('#expense-list').DataTable({
                "lengthMenu": [
                    [10, 20, 50, -1],
                    [10, 20, 50, "All"]
                ],
                "pageLength": 10,

                "language": {
                    "decimal": "",
                    "emptyTable": "Tidak ada data yang tersedia",
                    "info": "Menampilkan _START_ sampai _END_ dari total _TOTAL_ baris",
                    "infoEmpty": "Tidak ada data yang tersedia",
                    "infoFiltered": "(disaring dari total _MAX_ baris)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Tampilkan _MENU_ baris",
                    "loadingRecords": "Memuat...",
                    "processing": "Sedang diproses...",
                    "search": "Cari:",
                    "zeroRecords": "Tidak ditemukan data yang cocok",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                    "aria": {
                        "sortAscending": ": aktifkan untuk mengurutkan kolom secara ascending",
                        "sortDescending": ": aktifkan untuk mengurutkan kolom secara descending"
                    }
                }
            });
        </script>
    @endscript
</div>
