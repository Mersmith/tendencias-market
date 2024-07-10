@extends('layouts.ecommerce.layout-ecommerce')

@section('tituloPagina', 'Inicio')

@section('content')
    <div>
        @include('ecommerce.partials.banner', ['imagenBanner_1' => $imagenBanner_1])

        @include('ecommerce.partials.slider-principal', ['sliders' => $sliders])

    </div>
@endsection
