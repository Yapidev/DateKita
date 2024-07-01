<div>
    {{-- Header Content --}}
    <div class="card w-100 bg-light-info overflow-hidden shadow-none">
        <div class="card-body py-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-sm-6">
                    <h5 class="fw-semibold mb-9 fs-5">{{ $greeting }}</h5>
                    <p class="mb-9">
                        Buat jadwal kencan sekarang!
                    </p>
                    <button class="btn btn-primary" wire:click='addDate'>
                        Buat Jadwal
                    </button>
                </div>
                <div class="col-sm-5">
                    <div class="position-relative mb-n7 text-end">
                        <img src="{{ asset('assets/images/backgrounds/welcome-bg2.png') }}" alt=""
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Header Content --}}

    {{-- Add Dates Modal --}}
    <div class="modal fade" id="addDateModal" tabindex="-1" role="dialog" aria-labelledby="addnotesmodalTitle"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-header text-bg-primary">
                    <h6 class="modal-title text-white">{{ $modal_title }}</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="notes-box">
                        <div class="notes-content">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="note-title">
                                        <label class="form-label">Tanggal</label>
                                        <input type="date" id="date-time"
                                            class="form-control @error('date_time') is-invalid @enderror" minlength="25"
                                            placeholder="Isi tanggal" wire:model='date_time' />
                                        @error('date_time')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="note-title">
                                        <label class="form-label">Lokasi</label>
                                        <input type="text" id="location"
                                            class="form-control @error('location') is-invalid @enderror" minlength="25"
                                            placeholder="Isi lokasi kencan" wire:model='location' />
                                        @error('location')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="note-description">
                                        <label class="form-label">Deskripsi (Opsional)</label>
                                        <textarea id="description" class="form-control @error('description') is-invalid @enderror" minlength="60"
                                            placeholder="Isi deskripsi" rows="3" wire:model='description'></textarea>
                                        @error('description')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex gap-6">
                        <button class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal"
                            wire:click='resetModal'>Batal</button>
                        <button id="btn-n-add" class="btn btn-primary"
                            @if ($modal_title == 'Tambah Kencan') wire:click='storeDate'
                        @else
                        wire:click='updateDate({{ $date_id }})' @endif
                            wire:loading.attr='disabled'>Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Add Dates Modal --}}

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
                $('#addDateModal').modal('hide');
            });

            $wire.on('open-modal', () => {
                $('#addDateModal').modal('show');
            });
        </script>
    @endscript
</div>
