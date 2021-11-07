@extends('user.layouts.layouts')

@section('title', "Apotek Olive Medika")

@section('style')
    <style>
        .detil-barang-page {
            margin-top: 75px;
        }

        .product-image {
            width: 100%;
            border-radius: 10px;
        }

        .product-name {
            margin-top: 20px;
            font-size: 1.375rem;
            font-weight: bold;
        }

        .pesan-btn {
            margin-top: 50px;
            text-align: center;
            background-color: #584FF6;
            width: 100%;
            color: white;
            font-size: 1.5rem;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid detil-barang-page">
        <img class="product-image"
             src="{{ url(\Illuminate\Support\Facades\Storage::url($barang->getGambar())) }}"
             alt="lorem-picsum"/>

        <div class="row">
            <div class="col product-name">
                {{$barang->getNama()}}
            </div>
        </div>

        <div class="row">
            <div class=" col product-price">
                Rp. {{$barang->getHarga()}}
            </div>
            <div class="col-2 product-stock">
                <img src="{{asset("img/bi_box.svg")}}" alt="list"/>
                {{$barang->getStock()}}
            </div>
        </div>
        {{--TODO: DESCRIPTION--}}

        <div class="btn pesan-btn">
            Pesan Sekarang
        </div>
    </div>
@endsection

@section('script')
@endsection
