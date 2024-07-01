<div>
    {{-- Header Content --}}
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">{{ $date->location }}</h4>
                    <p class="mb-8">{{ $date->description }}</p>
                    <p class="mb-8" x-on:expense-deleted.window="$wire.$refresh">
                        <span class="fw-semibold text-dark">Total Pengeluaran:</span>
                        {{ $date->total_expenses }}
                    </p>
                    <a href="{{ route('home') }}" class="btn btn-warning me-2 mb-2" wire:navigate>Kembali</a>
                    <button class="btn btn-primary mb-2" wire:click='addExpense' wire:loading.delay.attr='disabled'>Tambah
                        Pengeluaran</button>
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
    <div class="modal fade" id="addExpenseModal" tabindex="-1" role="dialog" aria-labelledby="addExpenseModalTitle"
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
                                        <label class="form-label">Deskripsi</label>
                                        <input type="text" id="description"
                                            class="form-control @error('description') is-invalid @enderror"
                                            minlength="25" placeholder="Isi deskripsi pengeluaran"
                                            wire:model='description' />
                                        @error('description')
                                            <div class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="note-title">
                                        <label class="form-label">Biaya</label>
                                        <input type="number" id="amount"
                                            class="form-control @error('amount') is-invalid @enderror" minlength="25"
                                            placeholder="Isi biaya pengeluaran" wire:model='amount' />
                                        @error('amount')
                                            <div class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="note-description">
                                        <label class="form-label">Pembayar</label>
                                        <select id="paid_by"
                                            class="form-control @error('paid_by') is-invalid @enderror" minlength="60"
                                            placeholder="Isi pembayar" rows="3" wire:model='paid_by'>
                                            <option>Pilih Pembayar</option>
                                            @forelse ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('paid_by')
                                            <div class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="note-description">
                                        <label class="form-label">
                                            Warna Card
                                            @if ($modal_title == 'Tambah Pengeluaran')
                                                <span class="text-warning ms-1">*Jika tidak
                                                    diisi akan
                                                    berwarna biru tua</span>
                                            @endif
                                        </label>
                                        <select id="text-bg-color" wire:model='card_color' class="form-select">
                                            <option>Pilih Warna Card</option>
                                            <option value="primary">Biru tua</option>
                                            <option value="secondary">Biru muda</option>
                                            <option value="warning">Kuning</option>
                                            <option value="success">Hijau</option>
                                            <option value="danger">Merah</option>
                                        </select>
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
                            @if ($modal_title == 'Tambah Pengeluaran') wire:click='storeExpense' @else wire:click='updateExpense({{ $expense_id }})' @endif
                            wire:loading.delay.attr='disabled'>Simpan</button>
                    </div>
                </div>
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
                $('#addExpenseModal').modal('hide');
            });

            $wire.on('open-modal', () => {
                $('#addExpenseModal').modal('show');
            });
        </script>
    @endscript

</div>
