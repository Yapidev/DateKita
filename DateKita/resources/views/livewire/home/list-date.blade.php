<div>
    <div class="row">
        <div id="note-full-container" class="note-has-grid row">
            @forelse ($dates as $index => $item)
                <div class="col-md-4 single-note-item all-category {{ $classes[$loop->index % count($classes)] }}">
                    <div class="card card-body">
                        <span class="side-stick"></span>
                        <h6 class="note-title text-truncate w-75 mb-0" data-noteHeading="Book a Ticket for Movie">
                            {{ $item->location }}</h6>
                        <p class="note-date fs-2">
                            {{ \Carbon\Carbon::parse($item->date_time)->translatedFormat('d F Y') }}
                        </p>
                        <div class="note-content">
                            <p class="note-inner-content"
                                data-noteContent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">
                                {{ $item->description ? $item->description : 'Tidak ada deskripsi' }} </p>
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('date.show', $item->id) }}" class="btn btn-primary" wire:navigate>
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Tidak ada jadwal kencan</p>
            @endforelse
        </div>
    </div>
</div>
