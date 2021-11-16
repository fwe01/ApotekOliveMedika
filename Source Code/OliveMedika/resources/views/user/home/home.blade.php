@extends('user.layouts.layouts')

@section('title', "Apotek Olive Medika")

@include("user.home.billboard")
@include("user.home.promo", ['barang_promos' => $barang_promos])
@include("user.home.product", ['barangs' => $barang])

@section('style')
    @stack("user-home-style")
@endsection
@section('content')
    <div class="container">
        @stack("user-home-content")
    </div>
@endsection

@section('script')
    @stack('user-home-scripts')
@endsection
