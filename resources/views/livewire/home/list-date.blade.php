<div>

    @assets
        <link rel="stylesheet" href="{{ asset('css/date.css') }}">
    @endassets

    {{-- Search and Filter --}}
    <div class="card">
        <div class="card-header text-bg-primary">
            <h4 class="mb-0 text-white card-title">Filter dan Pencarian</h4>
        </div>
        <div class="card-body">
            <select class="form-select mb-2" wire:model.live='filter'>
                <option value="latest">Terbaru</option>
                <option value="oldest">Terlama</option>
            </select>
            <input type="search" class="form-control" placeholder="Cari Jadwal" wire:model.live="search">
        </div>
    </div>
    {{-- Search and Filter --}}

    {{-- List Date --}}
    <div id="note-full-container" class="note-has-grid date-container">
        @forelse ($dates as $index => $item)
            <div class="box single-note-item all-category {{ $classes[$loop->index % count($classes)] }}">
                <div class="card card-body">
                    <span class="side-stick"></span>
                    <h6 class="note-title text-truncate w-75 mb-0" data-noteHeading="Book a Ticket for Movie">
                        {{ $item->location }}
                    </h6>
                    <p class="note-date fs-2">
                        {{ \Carbon\Carbon::parse($item->date_time)->translatedFormat('l, d F Y') }}
                    </p>
                    <div class="note-content">
                        <p class="note-inner-content">
                            {{ Str::limit($item->description, 30, '...') }}
                        </p>
                    </div>
                    <div class="btn-group col-7 col-xl-8">
                        <a href="{{ route('date.show', $item->id) }}" class="btn btn-primary" wire:navigate>Lihat
                            Detail</a>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" wire:ignore>
                            <li>
                                <a class="dropdown-item cursor-pointer"
                                    @click="$dispatch('edit-date', {date_id: {{ $item->id }}})">Edit</a>
                            </li>
                            <li>
                                <a class="dropdown-item cursor-pointer"
                                    @click="$dispatch('delete-confirmation',
                                    {title: 'Apakah anda yakin?', message: 'Semua data pengeluaran dan rating juga akan terhapus', date_id: {{ $item->id }}}).self()">Hapus
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @empty
            <p>Tidak ada jadwal kencan</p>
        @endforelse
    </div>
    {{-- List Date --}}

    {{-- Infinite Scroll --}}
    @if ($datesCount >= $perPage)
        <div class="d-flex justify-content-center my-2" x-intersect.half="$wire.loadMore()">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    @endif
    {{-- Infinite Scroll --}}

    @script
        <script>
            $wire.on('notify', data => {
                Swal.fire({
                    icon: data.icon,
                    title: data.title,
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false,
                });
            });

            $wire.on('delete-confirmation', data => {
                Swal.fire({
                    title: data.title,
                    text: data.message,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, hapus!"
                }).then((result) => {
                    if (result.value) {
                        $wire.deleteDate(data.date_id)
                    }
                });
            });

            $wire.on('open-modal', () => {
                $('#addExpenseModal').modal('show');
            });
        </script>
    @endscript
</div>
