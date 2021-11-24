@push('layout-style-stack')
    <style>
        .huge-circle {
            width: 1000px;
            height: 1000px;
            border-radius: 50%;
            background-color: #584FF6;
            position: fixed;
            display: inline-block;
            transform: translate(-30%, -88%);
            top: 0;
            z-index: -1;
        }

        .navbar {
            background-color: #584FF6;
            position: fixed;
            display: flex;
            width: 100vw;
            justify-content: center;
            align-content: center;
            margin-top: 10px;
            top: 0;
            z-index: 10;
        }

        .nama-toko {
            display: none;

        }

        .search-bar {
            width: 60%;
            border-radius: 5px;
            padding: 5px 10px;
            background-color: white;
        }

        .list-icon {
            width: 35px;
            height: 35px;
        }

        .list-icon:hover {
            cursor: pointer;
            fill: red;
        }

        @media only screen and (min-width: 600px) {
            .huge-circle {
                display: none;
            }

            .navbar {
                margin-top: 0;
                width: 100vw;
                height: 75px;
                background-color: #584FF6;
                padding: 0 30px;
                justify-content: space-between;
            }

            .nama-toko {
                display: block;
                color: white;
                font-size: 3rem;
            }

        }
    </style>
@endpush
@push('layout-style-stack')
    <div class="huge-circle"></div>
    <div class="navbar">
        <div class="nama-toko"> Olive Medika</div>
        <input class="search-bar" placeholder="search"/>
        <div class="wrapper">

            <img src="{{asset("img/list.svg")}}" class="list-icon" alt="list" onclick="open_list()"/>
            <img src="{{asset("img/home-icon.svg")}}" class="list-icon" alt="list"/>
        </div>
    </div>
@endpush

@push('layout-script-stack')
    <script>
        function open_list () {
            window.location.replace('/user/list_pemesanan')
        }
    </script>
@endpush
