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
                                <td>{{ Carbon\Carbon::parse($data->date_date_time)->format('Y-m-d') }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning"
                                        @click="$dispatch('open-canvas', {description: '{{ str_replace(["\r", "\n"], ' ', $data->description) }}', title: '{{ $data->title }}'})">
                                        <i class="ti ti-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Tidak ada data!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $expenses->links('livewire::bootstrap', data: ['scrollTo' => false]) }}
        </div>
    </div>
    {{-- Table Expense List --}}

    {{-- Description Canvas --}}
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="desc-canvas" aria-labelledby="desc-canvas"
        wire:ignore.self>
        <div class="offcanvas-header text-bg-primary">
            <h5 class="offcanvas-title text-white" id="offcanvasBottomLabel"></h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div id="desc-canvas-content" style="word-break: break-all;">
                example description
            </div>
        </div>
    </div>
    {{-- Description Canvas --}}

    @script
        <script>
            $wire.on('open-canvas', data => {
                $('#offcanvasBottomLabel').text(data.title);
                $('#desc-canvas-content').text(data.description);
                $('#desc-canvas').offcanvas('show');
            });
        </script>
    @endscript
</div>
