@extends('user.layouts.layouts')

@section('title', "Apotek Olive Medika")

@section('style')
    <style>
        .list-pemesanan-page {
            margin-top: 150px;
            padding: 0 50px;
        }

        .list-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .pesanan-item {
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 5px 6px 10px #444444;
            padding: 20px;
            display: flex;
        }

        .pesanan-item:hover {
            cursor: pointer;
        }

        .pesanan-icon {
            width: 60px;
            height: 60px;
            border-radius: 30px;
            background-color: #584FF6;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 20px;
        }

        .pesanan-icon img {
            width: 30px;
            height: 30px;
        }

        .pesanan-detail {
            flex-shrink: 1;
        }

        .pesanan-total, .pesanan-id {
            margin: 0;
        }

        .status-icon {
            position: absolute;
            border-radius: 30px;
            width: 30px;
            height: 30px;
            transform: translateX(25px) translateY(25px);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .status-icon img {
            width: 20px;
            height: 20px;
        }

        @media only screen and (min-width: 600px) {
            .list-pemesanan-page {
                padding: 0 300px;

            }

            .list-title {
                background-color: #584FF6;
                color: white;
                padding: 5px 20px;
                border-radius: 20px;
                font-size: 1.5rem;
                font-weight: bold;

            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid list-pemesanan-page">
        <div class="list-title">
            List Pesanan
        </div>
        @foreach($pemesanans as $pemesanan)
            <div class="pesanan-item" onclick="open_detail_status_pesanan({{$pemesanan->getId()}})">
                <div class="pesanan-icon">
                    <img src="{{ url("img/bi_box_white.svg") }}" alt="lorem-picsum"/>
                    <div class="status-icon">
                        @if($pemesanan->getStatus()->getValue() == "selesai")
                            <img alt="lorem-picsum" src="{{ url("img/check.svg") }}"/>
                        @elseif($pemesanan->getStatus()->getValue() == "sedang_diproses")
                            <img alt="lorem-picsum" src="{{ url("img/clock.svg") }}"/>
                        @elseif($pemesanan->getStatus()->getValue() == "dibatalkan")
                            <img alt="lorem-picsum" src="{{ url("img/cross.svg") }}"/>
                        @endif
                    </div>
                </div>
                <div class="pesanan-detail">
                    <p class="pesanan-id"> ID : {{$pemesanan->getId()}} </p>
                    <p class="pesanan-total"> Total: Rp.{{$pemesanan->getTotal()}}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
    <script>
        $(window).ready(() => {

        })

        function open_detail_status_pesanan (id) {
            window.location.replace('/user/detil_status_pesanan/' + id)
        }
    </script>
@endsection
