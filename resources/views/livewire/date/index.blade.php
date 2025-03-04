<div>
    {{-- Header --}}
    <livewire:date.header :$date />
    {{-- Header --}}

    <!-- Nav tabs -->
    <ul class="nav nav-pills flex-column flex-sm-row mt-4" role="tablist">
        <li class="nav-item flex-sm-fill text-sm-center">
            <a class="nav-link border border-primary active" data-bs-toggle="tab" href="#navpill-11" role="tab">
                <span>Pengeluaran</span>
            </a>
        </li>
        <li class="nav-item flex-sm-fill text-sm-center">
            <a class="nav-link border border-primary" data-bs-toggle="tab" href="#navpill-22" role="tab">
                <span>Statistik</span>
            </a>
        </li>
        <li class="nav-item flex-sm-fill text-sm-center">
            <a class="nav-link border border-primary" data-bs-toggle="tab" href="#navpill-33" role="tab">
                <span>Review Date</span>
            </a>
        </li>
    </ul>
    <!-- Nav tabs -->

    <!-- Tab panes -->
    <div class="tab-content mt-2">
        <div class="tab-pane active" id="navpill-11" role="tabpanel">
            <div class="row">
                {{-- List Pengeluaran --}}
                @forelse ($date->expenses as $expense)
                    <livewire:date.list-pengeluaran :$expense wire:key="{{ now() }}" />
                @empty
                    <x-no-data />
                @endforelse
                {{-- List Pengeluaran --}}
            </div>
        </div>
        <div class="tab-pane" id="navpill-22" role="tabpanel">
            {{-- Statistik --}}
            <livewire:date.statistik :$date />
            {{-- Statistik --}}
        </div>
        <div class="tab-pane" id="navpill-33" role="tabpanel">
            {{-- Review Date --}}
            <livewire:date.review-date :$date />
            {{-- Review Date --}}
        </div>
    </div>
</div>
