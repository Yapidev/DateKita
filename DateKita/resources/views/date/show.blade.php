@extends('layouts.app')

@section('content')
    {{-- Header --}}
    @livewire('date.header', ['date_id' => $date->id])
    {{-- Header --}}

    <!-- Nav tabs -->
    <ul class="nav nav-pills flex-column flex-sm-row mt-4" role="tablist">
        <li class="nav-item flex-sm-fill text-sm-center">
            <a class="nav-link active" data-bs-toggle="tab" href="#navpill-11" role="tab">
                <span>Pengeluaran</span>
            </a>
        </li>
        <li class="nav-item flex-sm-fill text-sm-center">
            <a class="nav-link" data-bs-toggle="tab" href="#navpill-22" role="tab">
                <span>Statistik</span>
            </a>
        </li>
        <li class="nav-item flex-sm-fill text-sm-center">
            <a class="nav-link" data-bs-toggle="tab" href="#navpill-33" role="tab">
                <span>Review Date</span>
            </a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content mt-2">
        <div class="tab-pane active" id="navpill-11" role="tabpanel">
            {{-- List Pengeluaran --}}
            @livewire('date.list-pengeluaran', ['date' => $date])
            {{-- List Pengeluaran --}}
        </div>
        <div class="tab-pane" id="navpill-22" role="tabpanel">
            {{-- Statistik --}}
            @livewire('date.statistik', ['date_id' => $date->id])
            {{-- Statistik --}}
        </div>
        <div class="tab-pane" id="navpill-33" role="tabpanel">
            {{-- Review Date --}}
            @livewire('date.review-date', ['date_id' => $date->id])
            {{-- Review Date --}}
        </div>
    </div>
@endsection
