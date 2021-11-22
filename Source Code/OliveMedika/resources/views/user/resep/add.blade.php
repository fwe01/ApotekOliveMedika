@extends('user.layouts.layouts')

@section('title', "Apotek Olive Medika")

@section('style')
    <style>
        .container {
            margin-top: 150px;
        }

        .custom-file .custom-file-input {
            visibility: hidden;
        }

        .custom-file label {
            background-color: #584FF6;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
        }

        .btn-custom {
            margin-top: 30px;
            width: 100%;
            background-color: #584FF6;
            color: white;
            font-weight: bold;
        }

        .pesanan-item {
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 5px 6px 10px #444444;
            padding: 20px;
            display: flex;
        }

        .pesanan-item:hover {
            cursor: pointer;
        }

        .pesanan-icon {
            width: 60px;
            height: 60px;
            border-radius: 30px;
            background-color: #584FF6;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 20px;
        }

        .pesanan-icon img {
            width: 30px;
            height: 30px;
        }

        .pesanan-detail {
            flex-shrink: 1;
        }

        .pesanan-total, .pesanan-id {
            margin: 0;
        }

        .status-icon {
            position: absolute;
            border-radius: 30px;
            width: 30px;
            height: 30px;
            transform: translateX(25px) translateY(25px);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .status-icon img {
            width: 20px;
            height: 20px;
        }
    </style>
@endsection
@section('content')
    <div class="container ">
        <form method="post" action="{{route('user.reseps.add')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar" name="gambar" accept="image/*">
                        <label class="custom-file-label" for="gambar">Pilih resep</label>
                    </div>
                </div>
            </div>
            <div class="form-group ">
                <button type="submit" class="btn btn-custom">Pesan Menggunakan Resep</button>
            </div>
        </form>
        <div class="resep-list-section">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('alert'))
                <div class="alert alert-danger alert-dismissible">
                    {{ session('alert') }}
                </div>
            @endif
            @foreach($reseps as $resep)
                <div class="pesanan-item" onclick="open_detail_status_pesanan({{$resep->getId()}})">
                    <div class="pesanan-icon">
                        <img src="{{ url("img/bi_box_white.svg") }}" alt="lorem-picsum"/>
                        <div class="status-icon">
                            @if($resep->getStatus() == "menunggu_konfirmasi")
                                <img alt="lorem-picsum" src="{{ url("img/clock.svg") }}"/>
                            @elseif($resep->getStatus() == "ditolak")
                                <img alt="lorem-picsum" src="{{ url("img/cross.svg") }}"/>
                            @elseif($resep->getStatus() == "diterima")
                                <img alt="lorem-picsum" src="{{ url("img/check.svg") }}"/>
                            @endif
                        </div>
                    </div>
                    <div class="pesanan-detail">
                        <p class="pesanan-id"> ID : {{$resep->getId()}} <br>
                            @if($resep->getStatus() == "menunggu_konfirmasi") Menunggu Konfirmasi
                            @elseif($resep->getStatus() == "ditolak") Ditolak
                            @elseif($resep->getStatus() == "diterima") Diterima
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
