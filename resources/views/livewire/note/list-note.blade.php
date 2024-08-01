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
                    <div class="d-flex align-items-center gap-3">
                        <a class="cursor-pointer link" wire:click='toggleFavorite({{ $note }})'>
                            <i
                                class="ti ti-star fs-6 favourite-note me-2
                                @if ($note->is_favorited) text-warning @endif
                            "></i>
                            <span>{{ $note->favorites_count }}</span>
                        </a>
                        <a class="cursor-pointer link" @click="$dispatch('add-comment', {note: {{ $note }}})">
                            <i class="ti ti-message-plus fs-6 me-2"></i>
                            <span>{{ $note->comments_count }}</span>
                        </a>
                        @if ($note->user_id == auth()->id())
                            <a wire:ignore class="cursor-pointer link text-warning"
                                @click="$dispatch('edit-note', {note: {{ $note }}})">
                                <i class="ti ti-edit fs-6 edit-note"></i>
                            </a>
                            <a wire:ignore class="cursor-pointer link text-danger"
                                @click="$dispatch('delete-confirmation',{
                                title: 'Apakah anda yakin?',
                                message: 'Note berjudul {{ $note->title }} akan terhapus',
                                note: {{ $note }}
                            })">
                                <i class="ti ti-trash fs-6 remove-note"></i>
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
