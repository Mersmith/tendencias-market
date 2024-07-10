@extends('layouts.ecommerce.layout-ecommerce')

@section('tituloPagina', 'Inicio')

@section('content')
    <div>
        @include('ecommerce.partials.banner', ['imagenBanner_1' => $imagenBanner_1])

    </div>
@endsection
