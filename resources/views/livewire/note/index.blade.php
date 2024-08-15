<div>
    {{-- Header --}}
    <livewire:note.header @saved="$refresh" />
    {{-- Header --}}

    <div class="card">
        <div class="card-body">
            {{-- Filter --}}
            <livewire:note.filter wire:model.live="filter" />
            {{-- Filter --}}

            {{-- Search --}}
            <livewire:note.search wire:model.live="search" />
            {{-- Search --}}
        </div>
    </div>

    {{-- List Note --}}
    <livewire:note.list-note :notes="$notes" @saved="$refresh" />
    {{-- List Note --}}

    {{-- Comment Modal --}}
    <livewire:note.comment-modal />
    {{-- Comment Modal --}}

    {{-- Infinite Scroll --}}
    @if ($notesCount >= $perPage)
        <div class="d-flex justify-content-center my-2" x-intersect.half="$wire.loadMore()">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    @endif
    {{-- Infinite Scroll --}}
</div>
