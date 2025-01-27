@extends('layouts.layout')

@section('content')
    <div class="container mx-auto px-4">
        <h2 class="text-2xl mb-4 text-center">Ejemplo de Card</h2>
        
        <!-- Aquí incluimos la card como subvista -->
        @include('cards.instructor_card-v4')
    </div>
@endsection