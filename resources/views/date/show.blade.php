@extends('layouts.app')

@section('content')
    {{-- Date Index --}}
    <livewire:date.index :date_id="$dateId" />
    {{-- Date Index --}}
@endsection
