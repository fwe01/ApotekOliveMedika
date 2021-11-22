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
    </style>
@endpush
@push("user-home-content")

    <div class="product-section">
        <div class="row justify-content-center product-row">
            <div class="col-11">
                @foreach($barangs as $barang)
                    <div class="product-card" onclick="open_detail({{$barang->getId()}})">
                        <img class="product-image"
                             src="{{ url(\Illuminate\Support\Facades\Storage::url($barang->getGambar())) }}"
                             alt="lorem-picsum"/>
                        <div class="product-detail">
                            <p class="product-name">{{$barang->getNama()}}</p>
                            <p class="product-price">Rp. {{$barang->getHarga()}}</p>
                            <div class="product-stock-and-button">
                                <p class="product-stock">stock {{$barang->getStock()}} pcs</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endpush

        @push("user-home-scripts")
            <script>
                function open_detail (id) {
                    window.location.replace('/user/detil_barang/' + id)
                }
            </script>
@endpush
