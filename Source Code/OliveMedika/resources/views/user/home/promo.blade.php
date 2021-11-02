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
            margin-top: 5px;
            height: 30px;
        }

        .discount-tag {
            width: 18px;
            height: 18px;
            padding: 5px;
            background-color: #FFACAC;
            color: #FF4949;
            border-radius: 5px;
            font-size: .375rem;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 5px;
        }

        .old-price {
            color: #A4A4B2;
            text-decoration: line-through;
            font-size: .375rem;
            display: flex;
            align-items: center;
            height: 18px;
            margin-right: 5px;
        }

        .stock {
            font-size: .5rem;
            height: 18px;
            display: flex;
            align-items: center;

        }
    </style>
@endpush
@push("user-home-content")
    <div class="row justify-content-center promo-title-row">
        <div class="col-11">
            <div class="promo-title"> ON Sale</div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="promo-item-row">
            @for($i = 0; $i < 4;$i++)
                <div class="promo-item">
                    <img class="promo-image" src="https://picsum.photos/1000/1000" alt="lorem-picsum"/>
                    <p class="promo-name">
                        Masker King Murah
                    </p>
                    <div class="price-tag"> Rp. 7000</div>
                    <div class="item-min-detail">
                        <div class="discount-tag"> 50%</div>
                        <div class="old-price"> Rp. 12.000</div>
                        <div class="stock"> Sisa 10 pcs</div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endpush
