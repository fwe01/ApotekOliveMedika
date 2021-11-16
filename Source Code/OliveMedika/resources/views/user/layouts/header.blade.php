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
    </style>
@endpush
@push('layout-style-stack')
    <div class="huge-circle"></div>
    <div class="navbar">
        <input class="search-bar" placeholder="search"/>
        <img src="{{asset("img/list.svg")}}" class="list-icon" alt="list"/>
        <img src="{{asset("img/user-icon.svg")}}" class="list-icon" alt="list"/>
    </div>
@endpush
