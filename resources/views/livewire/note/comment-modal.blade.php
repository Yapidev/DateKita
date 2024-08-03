<div>
    {{-- Comment Modal --}}
    <div class="modal fade animated pulse" id="comment-modal" tabindex="-1" role="dialog"
        aria-labelledby="addExpenseModalTitle" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content border-0">
                <div class="modal-header text-bg-primary">
                    <h6 class="modal-title text-white">{{ $modal_title }}</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="chat-list chat active-chat" id="comment-list">
                        @if ($note != null)
                            @foreach ($note->comments as $comment)
                                @if ($comment->user_id == auth()->id())
                                    {{-- Komentar User yang sedang login --}}
                                    <div class="hstack gap-3 align-items-start justify-content-end {{ $loop->last ? 'mb-0' : 'mb-7' }}"
                                        wire:poll.visible>
                                        <div class="text-end">
                                            <h6 class="fs-2 text-muted">{{ $comment->created_at->diffForHumans() }}</h6>
                                            <div class="p-2 bg-info-subtle text-dark rounded-1 d-inline-block fs-3">
                                                {{ $comment->content }}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Komentar User yang sedang login --}}
                                @else
                                    {{-- Komentar User Lain --}}
                                    <div class="hstack gap-3 align-items-start justify-content-start {{ $loop->last ? 'mb-0' : 'mb-7' }}"
                                        wire:poll.visible>
                                        <img src="{{ asset($comment->user->showAvatar()) }}" alt="user"
                                            class="rounded-circle" width="40" height="40"
                                            style="object-fit: cover">
                                        <div>
                                            <h6 class="fs-2 text-muted">{{ $comment->created_at->diffForHumans() }}</h6>
                                            <div class="p-2 text-bg-light rounded-1 d-inline-block text-dark fs-3">
                                                {{ $comment->content }}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Komentar User Lain --}}
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex gap-6 w-100">
                        <input type="text" class="form-control @error('content') is-invalid @enderror"
                            placeholder="Tulis komentar anda" wire:model.blur='content'>
                        <button type="button" id="btn-n-add" class="btn btn-primary hstack gap-6" wire:click='store'
                            wire:loading.delay.attr='disabled'>
                            <i class="ti ti-send fs-4"></i>
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Comment Modal --}}

    @script
        <script>
            $wire.on('close-modal', () => {
                $('#comment-modal').modal('hide');
            });

            $wire.on('open-modal', () => {
                $('#comment-modal').modal('show');
            });

            $wire.on('comment-stored', () => {
                // Variable modal dan list comment
                let modal = $('#comment-modal');
                let list = document.getElementById('comment-list');

                // Mengubah list comment
                modal.find('.modal-body').scrollTop(list.scrollHeight);
            });
        </script>
    @endscript

</div>
