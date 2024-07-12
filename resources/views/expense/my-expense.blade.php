@extends('layouts.app')

@section('content')
    {{-- Livewire my-expense index --}}
    <livewire:my-expense.index :user='$user' />
    {{-- Livewire my-expense index --}}
@endsection

@push('script')
    <!-- Apex Chart js files -->
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/apex-chart/apex.area.init.js') }}"></script>
@endpush
