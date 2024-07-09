<div class="col-xl-4 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-header text-bg-{{ $expense->card_header_color }}">
            <h4 class="mb-0 text-white card-title">{{ $expense->title }}</h4>
        </div>
        <div class="card-body">
            <div class="mb-2">
                <h6 class="text-dark fw-bold mb-0">Biaya:</h6>
                <span>{{ $expense->formatted_amount }}</span>
            </div>
            <div class="mb-2">
                <h6 class="text-dark fw-bold mb-0">Deskripsi:</h6>
                <span>{{ $expense->description }}</span>
            </div>
            <div class="mb-4">
                <h6 class="text-dark fw-bold mb-2">Dibayar oleh:</h6>
                <div class="d-flex align-items-center gap-2">
                    <img src="{{ asset($expense->payer->showAvatar()) }}" alt="avatar" class="rounded-circle"
                        width="40" height="40">
                    <span>{{ $expense->payer->name }}</span>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-warning" @click="$dispatch('edit-expense', { expense_id: {{ $expense->id }} })"
                    wire:loading.delay.attr='disabled'>
                    <i class="ti ti-edit"></i></button>
                <button class="btn btn-danger"
                    @click="$dispatch('delete-confirmation', { title: 'Apakah anda yakin?', message: 'Data tidak bisa di kembalikan', expense_id: {{ $expense->id }} })"
                    wire:loading.delay.attr='disabled'>
                    <i class="ti ti-trash"></i></button>
            </div>
        </div>
    </div>

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
                        $wire.deleteExpense(data.expense_id)

                        console.log(data.expense_id)
                    }
                });
            })
        </script>
    @endscript
</div>
