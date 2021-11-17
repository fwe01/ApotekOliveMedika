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

        .batal-popup {
            position: fixed;
            background-color: rgba(0, 0, 0, 0.45);
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            z-index: 10;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .popup-card {
            background-color: white;
            border-radius: 20px;
            width: 80vw;
            height: 50vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .popup-card img {
            width: 100px;
            height: 100px;
        }

        .popup-card-body {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .text {
            text-align: center;
        }

        .popup-buttons {
            padding: 30px;
            display: flex;
            justify-content: space-around;
            width: 100%;
        }

        .btn-tidak:hover, .btn-ya:hover {
            cursor: pointer;
        }

        .btn-tidak {
            color: #FF4949;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-ya {
            color: white;
            background-color: #04D141;
            font-weight: bold;
            width: 100px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hidden {
            display: none;
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
        @if($pemesanan->getStatus()->getValue() != "selesai" && $bisa_batal)
            <div class="bottom-btn btn-batal" onclick="showPopup()"> Batalkan Pesanan</div>
        @endif
        <div class="bottom-btn btn-kembali" onclick="kembali()">Kembali</div>
    </div>

    <div class="batal-popup hidden">
        <div class="popup-card">
            <img alt="lorem-picsum" src="{{ url("img/batal-warning.svg") }}"/>
            <div class="popup-card-body">
                <div class="text">
                    Apakah anda yakin ingin membatalkan pesanan ?
                </div>

                <div class="popup-buttons">
                    <div class="btn-tidak" onclick="closePopup()">Tidak</div>

                    <div class="btn-ya" onclick="batalkan()">Iya</div>
                </div>

            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        function kembali () {
            console.log('test')
            window.location.replace('/user/list_pemesanan')
        }

        function batalkan () {
            $.ajax(
                {
                    url: '/user/batalkan_pesanan',
                    type: 'POST',
                    data: {
                        id_pemesanan: {{$pemesanan->getId()}},
                        _token: '{{csrf_token()}}'
                    },
                    success: function () {
                        console.log('success')
                    },
                    error: function (error) {
                        console.log(error)
                    }
                }
            )
        }

        function closePopup () {
            $('.batal-popup').addClass('hidden')

        }

        function showPopup () {
            $('.batal-popup').removeClass('hidden')
        }

    </script>
@endsection
