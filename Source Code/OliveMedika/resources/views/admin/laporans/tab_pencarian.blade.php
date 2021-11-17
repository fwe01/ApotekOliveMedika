<div class="tab-pane fade" id="tab-pencarian" role="tabpanel"
     aria-labelledby="pencarian-tab">
    <div class="card-header">
        <h4 class="d-inline card-title">Cari Laporan</h4>
    </div>
    <div class="card-body">
        <form action="{{route('admin.laporans.find')}}" method="post">
            {{--        <form action="">--}}
            @csrf
            {{--            <div class="row flex justify-content-center text-center">--}}
            {{--                <div class="col-3">--}}
            {{--                    Tanggal Mulai--}}
            {{--                </div>--}}
            {{--                <div class="col-3">--}}
            {{--                    Tanggal Berakhir--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="row flex justify-content-center">
                <div class="col-2 form-group">
                    <div class="input-group date date-input" id="tanggal_mulai" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="tanggal_mulai"
                               data-target="#tanggal_mulai" value="" placeholder="Tanggal Mulai">
                        <div class="input-group-append" data-target="#tanggal_mulai" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                &nbsp;-&nbsp;
                <div class="col-2 form-group">
                    <div class="input-group date date-input" id="tanggal_berakhir" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="tanggal_berakhir"
                               data-target="#tanggal_berakhir" value="" placeholder="Tanggal Berakhir">
                        <div class="input-group-append" data-target="#tanggal_berakhir"
                             data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row flex justify-content-center">
                <button class="btn btn-success">Cari</button>
            </div>
        </form>
    </div>
</div>
