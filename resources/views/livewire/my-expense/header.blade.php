<div>
    {{-- Header --}}
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Pengeluaranku</h4>
                    <p class="mb-0">Ini adalah halaman yang berisi detail pengeluaran anda.</p>
                    <button class="btn btn-primary my-2 text-capitalize" @click="$dispatch('open-modal')">
                        Atur target pengeluaran</button>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Header --}}

    {{-- Add Targer Expense Modal --}}
    <div class="modal fade" id="addTargetExpense" tabindex="-1" role="dialog" aria-labelledby="addExpenseModalTitle"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-header text-bg-primary">
                    <h6 class="modal-title text-white">Atur Target Pengeluaran</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="notes-box">
                        <div class="notes-content">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="note-title">
                                        <label class="form-label">Nominal</label>
                                        <input type="number" id="target_expense"
                                            class="form-control @error('target_expense') is-invalid @enderror"
                                            minlength="25" placeholder="Isi nominal target pengeluaran"
                                            wire:model='target_expense' />
                                        @error('target_expense')
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
                        <button class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal"
                            wire:click='resetModal'>Batal</button>
                        <button id="btn-n-add" class="btn btn-primary" wire:click='addTargetExpense'>Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Add Targer Expense Modal --}}

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
                $('#addTargetExpense').modal('hide');
            });

            $wire.on('open-modal', () => {
                $('#addTargetExpense').modal('show');
            });
        </script>
    @endscript
</div>
