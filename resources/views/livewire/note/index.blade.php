<div>
    {{-- Header --}}
    <livewire:note.header @saved="$refresh" />
    {{-- Header --}}

    {{-- List Note --}}
    <livewire:note.list-note :notes="$notes" @saved="$refresh" />
    {{-- List Note --}}

    {{-- Infinite Scroll --}}

    @if ($notesCount >= $perPage)
        <div x-intersect.half="$wire.loadMore()">
        </div>
    @endif
    {{-- Infinite Scroll --}}
</div>
