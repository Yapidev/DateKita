<div>
    <div class="note-has-grid row">
        @foreach ($notes as $index => $note)
            <div class="col-md-4 single-note-item all-category {{ $classes[$loop->index % count($classes)] }}"
                wire:key='{{ $note->id }}'>
                <div class="card card-body">
                    <span class="side-stick"></span>
                    <h6 class="note-title text-truncate w-75 mb-0" data-noteHeading="Book a Ticket for Movie">
                        {{ $note->title }}</h6>
                    <p class="note-date fs-2">
                        {{ $note->created_at->translatedFormat('l, d F Y') }}
                    </p>
                    <div class="note-content">
                        <p class="note-inner-content">
                            {{ $note->description }}
                        </p>
                    </div>
                    <div class="d-flex align-items-center">
                        <a class="cursor-pointer link me-1" wire:click='toggleFavorite({{ $note }})'>
                            <i
                                class="ti ti-star fs-4 favourite-note
                                {{ $note->isFavoritedBy(auth()->id()) ? 'text-warning' : '' }}
                            "></i>
                        </a>
                        <span>{{ $note->favorites->count() }}</span>
                        @if ($note->user_id == auth()->id())
                            <a wire:ignore class="cursor-pointer link text-warning ms-2"
                                @click="$dispatch('edit-note', {note: {{ $note }}})">
                                <i class="ti ti-edit fs-4 edit-note"></i>
                            </a>
                            <a wire:ignore class="cursor-pointer link text-danger ms-2"
                                @click="$dispatch('delete-confirmation',{
                                title: 'Apakah anda yakin?',
                                message: 'Note berjudul {{ $note->title }} akan terhapus',
                                note: {{ $note }}
                            })">
                                <i class="ti ti-trash fs-4 remove-note"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @script
        <script>
            $wire.on('delete-confirmation', data => {
                Swal.fire({
                    title: data.title,
                    text: data.message,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, hapus!"
                }).then((result) => {
                    if (result.value) {
                        $wire.dispatch('delete-note', {
                            note: data.note
                        })
                    }
                });
            });

            $wire.on('notify', data => {
                Swal.fire({
                    icon: data.icon,
                    title: data.title,
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false,
                });
            });
        </script>
    @endscript
</div>
