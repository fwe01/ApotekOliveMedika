@push("user-home-style")
    <style>
        .first-line {
            margin-top: 100px;
        }

        .card-info {
            padding: 10px;
        }

        .apotek-logo {
            width: 80px;
            height: 80px;
        }

        .waktu-buka {
            font-size: .9rem;
        }

        .contact-wa {
            font-size: .9rem;
        }
    </style>
@endpush

@push("user-home-content")
    <div class="row first-line justify-content-center">
        <div class="col-11">
            <div class="card card-info">
                <div class="row">
                    <div class="col-4">
                        <img class="apotek-logo" src="{{asset("img/logo-olive-medika-icon.png")}}" alt="logo apotek">
                    </div>
                    <div class="col">
                        <h3> Jam Buka</h3>
                        <div class="waktu-buka">07.00 WIB - 21.00 WIB</div>
                        <div class="contact-wa">
                            <img src="{{asset("img/wa-icon.svg")}}" alt="wa-icon">+62 8954-2481-123
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
