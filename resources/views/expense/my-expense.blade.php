@extends('layouts.app')

@section('content')
    {{-- Livewire my-expense index --}}
    <livewire:my-expense.index :user='$user' />
    {{-- Livewire my-expense index --}}
@endsection
