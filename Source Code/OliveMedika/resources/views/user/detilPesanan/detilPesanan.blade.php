@extends('user.layouts.layouts')

@section('title', "Apotek Olive Medika")

@section('style')
    <style>
        .top-spacer {
            margin-top: 100px;

        }

        .barang-card {
            background-color: white;
            padding: 10px;
            display: flex;
            box-shadow: 1px 2px 10px #4d4d4d;
            border-radius: 20px;
        }

        .barang-image {
            width: 100px;
            height: 100px;
            margin-right: 20px;
            border-radius: 10px;
        }

        .barang-detail {
            width: 100%;

        }

        .nama-tag {
            font-size: 1.125rem;
            font-weight: bold;
        }

        .harga-tag {
            font-size: 0.875rem;
        }

        .qty {
            margin-top: 30px;
        }

        .qty-control {
            display: flex;
            margin-left: 20px;
        }

        .increase-qty, .decrease-qty {
            background-color: #584FF6;
            color: white;
            width: 20px;
            text-align: center;
        }

        .increase-qty:hover, .decrease-qty:hover {
            cursor: pointer;

        }

        .decrease-qty {
            border-radius: 10px 0 0 10px;
        }

        .increase-qty {
            border-radius: 0 10px 10px 0;
        }

        .amount-qty {
            width: 30px;
            text-align: center;
        }

        .tambah-barang-container {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .tambah-barang-btn {
            background-color: #584FF6;
            color: white;
            border-radius: 20px;
            text-align: center;
            margin-top: 30px;
            width: 250px;
            height: 50px;
            padding: 10px;
            font-weight: bold;
        }

        .tambah-barang-btn:hover {
            cursor: pointer;
        }

        .bottom-part {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100vw;
        }

        .bottom-btn {
            background-color: #584FF6;
            color: white;
            border-radius: 20px;
            text-align: center;
            width: 250px;
            height: 50px;
            padding: 10px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .bottom-btn:hover {
            cursor: pointer;
        }

        .harga {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: bold;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid detil-barang-page">
        <div class="row top-spacer"></div>

        @php $total_harga = 0 @endphp
        @foreach($barangs as $barang)
            @php
                $total_harga += $barang->getHarga();
            @endphp
            <div class="barang-card">
                <img class="barang-image"
                     src="{{ url(\Illuminate\Support\Facades\Storage::url($barang->getGambar())) }}"
                     alt="lorem-picsum"/>
                <div class="barang-detail">
                    <div class="nama-tag">{{$barang->getNama()}}</div>
                    <div class="harga-tag">Rp. {{$barang->getHarga()}}</div>
                    <div class="d-flex justify-content-end qty flex-fill">
                        Qty
                        <div class="qty-control">
                            <div class="decrease-qty"
                                 onClick="onQtyChanged({{$barang->getId()}},{{$barang->getHarga()}}, -1)">-
                            </div>
                            <div class="amount-qty" id="qty-{{$barang->getId()}}">1</div>
                            <div class="increase-qty"
                                 onClick="onQtyChanged({{$barang->getId()}}, {{$barang->getHarga()}}, 1)">+
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="tambah-barang-container">
            <div class="tambah-barang-btn">
                Tambah Barang
            </div>
        </div>

        <div class="bottom-part">
            <div class="harga">Total Rp. <a id="harga">{{$total_harga}}</a></div>
            <div class="d-flex justify-content-center">
                <div class="bottom-btn">
                    Selesaikan Pesanan
                </div>
            </div>
        </div>

    </div>

@endsection

@section('script')
    <script>
        $(window).ready(() => {
            $('.tambah-barang-btn').click(() => {
                window.location.replace('/user')
            })

            $('.bottom-btn').click(() => {
                $.ajax(
                    {
                        url: '/user/pesan',
                        type: 'POST',
                        data: {
                            barang: [
                                @foreach($barangs as $barang)
                                {{"{
                                    id: {$barang->getId()},
                                    quantity:"}}
                                Number($('#qty-' + {{$barang->getId()}}).html())
                                {{"},"}}
                                    @endforeach
                            ],
                            _token: '{{csrf_token()}}'
                        },
                        success: function () {
                            window.location.replace('/user')
                        },
                        error: function (error) {
                            console.log(error)
                        }
                    }
                )

            })
        })

        function onQtyChanged (id, harga, amount) {
            let qty_element = $('#qty-' + id)
            let qty = Number(qty_element.html())
            if (qty + amount < 1) return
            qty += amount
            qty_element.html(qty)

            let total_element = $('#harga')
            let total_harga = Number(total_element.html())
            total_harga += harga * amount
            total_element.html(total_harga)
        }

    </script>
@endsection
