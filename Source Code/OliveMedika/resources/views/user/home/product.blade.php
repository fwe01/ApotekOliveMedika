@push("user-home-style")
    <style>
        .product-section {
            margin-top: 20px;
        }

        .product-row {
            margin-bottom: 40px;
        }

        .product-card {
            padding: 10px;
            border-radius: 20px;
            display: flex;
            box-shadow: 5px 5px 10px #9a9a9a;
            margin-bottom: 40px;
        }

        .product-image {
            width: 100px;
            height: 100px;
            margin-right: 20px;
            border-radius: 10px;
        }

        .product-detail {
            display: block;
            flex-grow: 1
        }

        .product-name {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .product-stock-and-button {
            display: flex;
            width: 100%
            justify-content: space-between;
            flex-grow: 1
        }

        .product-stock {
            margin: 0;
            flex: 50%;
        }

        .button-pesan:hover {
            cursor: pointer;

        }

        .button-resep {
            margin-top: 25px;
            background-color: #584FF6;
            border-radius: 5px;
            padding: 5px 10px;
            color: white;
            text-align: center;
        }

        .button-resep:hover {
            cursor: pointer;
        }

        @media only screen and (min-width: 600px) {
            .product-container {
                display: flex;
                flex-wrap: wrap;
            }

            .product-card {
                width: 15vw;
                margin-right: 50px;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .product-card img {
                width: 100%;
                height: auto;
                margin: 0;
            }

            .product-detail {
                width: 100%;

            }

            .product-name {
                font-size: 1.5rem;
            }

            .line {
                width: 100%;
                height: 2px;
                background-color: #584FF6;
            }
        }
    </style>
@endpush
@push("user-home-content")

    <div class="row justify-content-center promo-title-row">
        <div class="col-11">
            <div class="button-resep" onclick="pesan_resep()">Pesan Menggunakan Resep</div>
        </div>
    </div>
    <div class="product-section">
        <div class="row justify-content-center product-row">
            <div class="col-11 product-container">
                @foreach($barangs as $barang)
                    <div class="product-card" onclick="open_detail({{$barang->getId()}})">
                        <img class="product-image"
                             src="{{ url(\Illuminate\Support\Facades\Storage::url($barang->getGambar())) }}"
                             alt="lorem-picsum"/>
                        <div class="product-detail">
                            <p class="product-name">{{$barang->getNama()}}</p>
                            <div class="line"></div>
                            <div class="harga-stock">
                                <p class="product-price">Rp. {{$barang->getHarga()}}</p>
                                <div class="product-stock-and-button">
                                    <p class="product-stock">stock {{$barang->getStock()}} pcs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endpush

@push("user-home-scripts")
    <script>
        function open_detail (id) {
            window.location.replace('/user/detil_barang/' + id)
        }

        function pesan_resep () {
            window.location.replace('/user/resep/create')
        }
    </script>
@endpush


