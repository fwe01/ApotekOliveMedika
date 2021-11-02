@push("user-home-style")
    <style>
        .product-section {
            margin-top: 20px;
        }

        .product-row {
            margin-bottom: 10px;
        }

        .product-card {
            border: 1px #584FF6 solid;
            padding: 10px;
            border-radius: 5px;
            display: flex;
        }

        .product-image {
            width: 100px;
            height: 100px;
            margin-right: 20px;
        }

        .product-detail {
            display: block;
        }

        .product-name {
            font-size: .9rem;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .product-stock-and-button {
            display: flex;
            justify-content: space-between;
        }

        .product-stock {
            align-self: end;
            margin: 0;
        }

        .button-pesan:hover {
            cursor: pointer;

        }
    </style>
@endpush
@push("user-home-content")

    <div class="product-section">
        @for($i = 0; $i < 4;$i++)
            <div class="row justify-content-center product-row">
                <div class="col-11">
                    <div class="product-card">
                        <img class="product-image" src="https://picsum.photos/1000/1000" alt="lorem-picsum"/>
                        <div class="product-detail">
                            <p class="product-name">Masker King 25 Lembar</p>
                            <p class="product-price">Rp. 24.000</p>
                            <div class="product-stock-and-button">
                                <p class="product-stock">stock 10 pcs</p>
                                <img class="button-pesan" src="{{asset("img/plus-icon.svg")}}" alt="plus-icon"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endfor
    </div>
@endpush
