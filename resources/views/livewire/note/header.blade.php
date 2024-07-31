<div>
    <div>
        {{-- Header Content --}}
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Note</h4>
                        <p class="mb-8">Ini adalah list note yang kita buat.</p>
                        <a href="{{ route('home') }}" class="btn btn-warning me-2 mb-2" wire:navigate>
                            Kembali
                        </a>
                        <button class="btn btn-primary mb-2" wire:click='create' wire:loading.delay.attr='disabled'>
                            Tambah Note
                        </button>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" alt=""
                                class="img-fluid mb-n4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Header Content --}}

        {{-- Add Expense Modal --}}
        <div class="modal fade animated pulse" id="addNoteModal" tabindex="-1" role="dialog"
            aria-labelledby="addExpenseModalTitle" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-0">
                    <div class="modal-header text-bg-primary">
                        <h6 class="modal-title text-white">{{ $modal_title }}</h6>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form
                        @if ($modal_title == 'Tambah Note') wire:submit='store'
                    @else
                    wire:submit='update({{ $note }})' @endif>
                        <div class="modal-body">
                            <div class="notes-box">
                                <div class="notes-content">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="note-created_at">
                                                <label class="form-label">Tanggal</label>
                                                <input type="date" id="created_at"
                                                    class="form-control @error('created_at') is-invalid @enderror"
                                                    placeholder="Isi deskripsi pengeluaran" wire:model.blur='created_at' />
                                                @error('created_at')
                                                    <div class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="note-title">
                                                <label class="form-label">Judul</label>
                                                <input type="text" id="title"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    placeholder="Isi deskripsi pengeluaran" wire:model.blur='title' />
                                                @error('title')
                                                    <div class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="note-title">
                                                <label class="form-label">Deskripsi</label>
                                                <textarea type="text" id="description" class="form-control @error('description') is-invalid @enderror"
                                                    style="height: 100px" placeholder="Isi deskripsi pengeluaran" wire:model.blur='description'></textarea>
                                                @error('description')
                                                    <div class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="d-flex gap-6">
                                <button class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal" type="button">Batal</button>
                                <button type="submit" id="btn-n-add" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Add Expense Modal --}}

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

                $wire.on('close-modal', () => {
                    $('#addNoteModal').modal('hide');
                });

                $wire.on('open-modal', () => {
                    $('#addNoteModal').modal('show');
                });
            </script>
        @endscript

    </div>
</div>
