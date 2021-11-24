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

        .popup {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            z-index: 10;

            background-color: rgba(0, 0, 0, 0.74);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hidden {
            display: none;
        }

        .popup-card {
            padding: 10px;
            background-color: white;
            width: 300px;
            height: 400px;
            border-radius: 25px;
        }

        .close-icon {
            cursor: pointer;
        }

        .check-list-icon {
            margin: 30px 0;
            width: 76px;
            height: 76px;
        }

        .popup-card-message {
            font-size: 1.375rem;

        }

        .check-pesanan-btn {
            margin-top: 50px;
            text-align: center;
            font-weight: bold;
            background-color: #584FF6;
            width: 100%;
            color: white;
            font-size: 1.5rem;
        }

        @media only screen and (min-width: 600px) {
            .detil-barang-page {
                margin-top: 150px;
                padding: 0 250px;
                display: flex;

            }

            .product-image {
                width: 50%;
                margin-right: 50px;
            }

            .product-name {
                font-size: 2rem;
            }


            .product-price {
                font-size: 1rem;

            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid detil-barang-page">
        <img class="product-image"
             src="{{ url(\Illuminate\Support\Facades\Storage::url($barang->getGambar())) }}"
             alt="lorem-picsum"/>

        <div class="detail-container">
            <div class="row">
                <div class="col product-name">
                    {{$barang->getNama()}}
                </div>
            </div>

            <div class="row">
                <div class=" col product-price">
                    Rp. {{$barang->getHarga()}}
                </div>
                <div class="col-2 col-lg-4 product-stock">
                    <img src="{{asset("img/bi_box.svg")}}" alt="list"/>
                    {{$barang->getStock()}}
                </div>
            </div>
            {{--TODO: DESCRIPTION--}}

            <div class="btn pesan-btn">
                Pesan Sekarang
            </div>
        </div>
    </div>
    <div class="popup hidden">
        <div class="popup-card">
            <div class="d-flex justify-content-end">
                <img class="close-icon" src="{{asset("img/eva_close-fill.svg")}}" alt="list"/>
            </div>
            <div class="d-flex flex-column popup-card-body align-items-center">
                <img class="check-list-icon" src="{{asset("img/bi_check-circle-fill.svg")}}" alt="list"/>
                <div class="text-center popup-card-message"> Pesanan berhasil ditambahkan</div>
                <div class="btn check-pesanan-btn">
                    Check Pesanan
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.pesan-btn').click(() => {
            addBarangToSession()
        })

        function showPopUp () {
            $('.popup').removeClass('hidden')
        }

        function addBarangToSession () {
            $.ajax(
                {
                    url: '/user/detil_pesanan_proses',
                    type: 'POST',
                    data: {
                        barang_id: {{$barang->getId()}},
                        _token: '{{csrf_token()}}'
                    },
                    success: function () {
                        showPopUp()
                    },
                    error: function (error) {
                        console.log(error)
                    }
                }
            )
        }

        $('.check-pesanan-btn').click(() => {
            window.location.replace('/user/detil_pesanan')
        })

        $('.close-icon').click(() => {
            $('.popup').addClass('hidden')
        })

    </script>
@endsection
