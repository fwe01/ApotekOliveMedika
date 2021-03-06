@push("user-home-style")
    <style>
        .promo-title-row {
            margin-bottom: 40px;
        }

        .promo-title {
            margin-top: 25px;
            background-color: #584FF6;
            border-radius: 5px;
            padding: 5px 10px;
            color: white;
        }

        .promo-item-row {
            overflow-x: scroll;
            flex-direction: row;
            display: flex;
        }

        .promo-item {
            margin: 10px 10px 10px;
            border-radius: 10px;
            width: 100px;
            box-shadow: 5px 10px 18px #888888;
        }

        .promo-image {
            width: 100px;
            height: 100px;
        }

        .promo-name {
            font-size: .8rem;
            margin: 0 5px 10px;
        }

        .price-tag {
            width: 100%;
            background-color: #584FF6;
            padding: 0 5px;
            color: white;
        }

        .item-min-detail {
            display: flex;
            flex-direction: row;
            margin-top: 10px;
            height: 30px;
            padding-left: 10px;
        }

        .discount-tag {
            width: 24px;
            height: 24px;
            padding: 5px;
            background-color: #FFACAC;
            color: #FF4949;
            border-radius: 5px;
            font-size: .5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 5px;
        }

        .old-price {
            color: #A4A4B2;
            text-decoration: line-through;
            font-size: .5rem;
            display: flex;
            align-items: center;
            height: 18px;
            margin-right: 5px;
        }

        .stock {
            font-size: .8rem;
            height: 18px;
            display: flex;
            align-items: center;
            padding-left: 10px;
            margin-bottom: 10px;

        }

        @media only screen and (min-width: 600px) {
            .promo-title {
                margin-top: 150px;
                position: absolute;
                z-index: -10;
                font-size: 2.8rem;
                width: 250px;
                height: 425px;
                border-radius: 20px;
            }

            .promo-item-row {
                margin-top: 200px;
                margin-left: 250px;
            }

            .promo-item {
                box-shadow: none;
                background-color: white;
                width: 150px;
                height: 300px;
            }

            .promo-image {
                width: 150px;
                height: 150px;
                border-radius: 10px;
            }

            .promo-name {
                font-size: 1rem;
                font-weight: bold;
            }

            .price-tag {
                background-color: white;
                color: black;
            }
        }
    </style>
@endpush
@push("user-home-content")
    @if(count($barang_promos) > 0)
        <div class="row justify-content-center promo-title-row">
            <div class="col-11">
                <div class="promo-title"> ON Sale</div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="promo-item-row">
                @foreach($barang_promos as $barang_promo)
                    <div class="promo-item">
                        <img class="promo-image"
                             src="{{ url(\Illuminate\Support\Facades\Storage::url($barang_promo->getGambar())) }}"
                             alt="lorem-picsum"/>
                        <p class="promo-name">
                            {{$barang_promo->getNama()}}
                        </p>
                        <div class="price-tag"> Rp. {{$barang_promo->getHargaPromo()}}</div>
                        <div class="item-min-detail">
                            <div class="discount-tag"> 50%</div>
                            <div class="old-price"> Rp. {{$barang_promo->getHarga()}}</div>
                        </div>
                        <div class="stock"> Sisa {{$barang_promo->getStock()}} pcs</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endpush
