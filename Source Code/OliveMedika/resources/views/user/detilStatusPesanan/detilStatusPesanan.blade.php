@extends('user.layouts.layouts')

@section('title', "Apotek Olive Medika")

@section('style')
    <style>
        .detil-status-pesanan-page {
            margin-top: 120px;
        }

        .announcement {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            border-radius: 20px;
            margin: 0 20px;
        }

        .announcement-success {
            background-color: #04D141;
        }

        .announcement-pending {
            background-color: #FFBC11;
        }

        .announcement img {
            width: 90px;
            height: 90px;
        }

        .announcement p {
            font-weight: bold;
            color: white;
            text-align: center;
        }

        .bottom {
            position: fixed;
            bottom: 0;
            width: 100vw;
        }

        .bottom-btn {
            margin: 10px 30px 20px;
            height: 50px;
            border-radius: 20px;
            color: white;
            font-weight: bold;
            text-align: center;
            align-items: center;
            display: flex;
            justify-content: center;
            cursor: pointer;
        }

        .btn-batal {
            background-color: #FF4949;
        }

        .btn-kembali {
            background-color: #584FF6;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid detil-status-pesanan-page">
        @if($pemesanan->getStatus()->getValue() == "selesai")
            <div class="announcement announcement-success">
                <img alt="lorem-picsum" src="{{ url("img/plain_clock.svg") }}"/>
                <p>
                    Pesanan anda selesai di proses !

                    silahkan ambil di

                    JL. MT. Haryono No 4, Kota Bontang, Kalimantan Timur
                </p>
            </div>
        @else
            <div class="announcement announcement-pending">
                <img alt="lorem-picsum" src="{{ url("img/plain_clock.svg") }}"/>
                <p>
                    Pesanan di proses, Mohon Tunggu...
                </p>
            </div>
        @endif
    </div>

    <div class="bottom">
        @if($pemesanan->getStatus()->getValue() != "selesai")
            <div class="bottom-btn btn-batal"> Batal</div>
        @endif
        <div class="bottom-btn btn-kembali" onclick="kembali()">Kembali</div>
    </div>
@endsection

@section('script')
    <script>
        function kembali () {
            console.log('test')
            window.location.replace('/user/list_pemesanan')
        }

    </script>
@endsection
