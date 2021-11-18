@extends('admin.layouts.master')

@section('title', 'Reseps')

@section('content')
    @include('admin.reseps.cancel-modal')
    {{--    @include('admin.reseps.add-modal')--}}
    {{--    @include('admin.reseps.edit-modal')--}}
    <div class="row" id="resep-tables">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Semua Resep</h3>
                    {{--                    <button type="button" class="d-inline float-right btn btn-success" data-toggle="modal"--}}
                    {{--                            data-target="#add-resep-modal">--}}
                    {{--                        <i class="fa fa-plus"></i>--}}
                    {{--                        <h6 class="d-inline"> Tambah</h6>--}}
                    {{--                    </button>--}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="myTable table table-striped table-valign-middle"
                               style="font-size: large">
                            <thead class="text-primary">
                            <th class="text-center w-13p">Gambar</th>
                            <th class="text-center w-13p">Nama User</th>
                            <th class="text-center w-13p">Status</th>
                            <th class="text-center w-13p">Keterangan</th>
                            <th class="text-center w-13p">Dibuat pada</th>
                            <th class="text-center w-13p">Action</th>
                            </thead>
                            <tbody>
                            @foreach($reseps as $resep)
                                <tr>
                                    <td class="text-center w-13p" style="width: fit-content">
                                        <img src="{{ url(\Illuminate\Support\Facades\Storage::url($resep->getGambar())) }}"
                                             alt="" width="300px" height="300px">
                                    </td>
                                    <td class="text-center w-13p">
                                        {{ $resep->getNamaUser() }}
                                    </td>
                                    <td class="text-center w-13p">
                                        @if($resep->getStatus() === \App\Models\StatusResep::KONFIRMASI)
                                            <p class="badge badge-warning">Menunggu Konfirmasi</p>
                                        @elseif ($resep->getStatus() === \App\Models\StatusResep::DITERIMA)
                                            <p class="badge badge-success">Diterima</p>
                                        @elseif ($resep->getStatus() === \App\Models\StatusResep::DITOLAK)
                                            <p class="badge badge-danger">Ditolak</p>
                                        @endif
                                    </td>
                                    <td class="text-center w-13p">{{ $resep->getKeterangan() ? $resep->getKeterangan() : '-' }}</td>
                                    <td class="text-center w-13p">{{ $resep->getCreatedAt()->format('d-m-Y h:i:s') }}</td>
                                    <td class="text-center w-13p">
                                        <div class="btn btn-primary"
                                             data-toggle="modal"
                                             data-target="#edit-resep-modal-{{$resep->getId()}}">
                                            <i class="fas fa-check"></i>
                                            <h7 class="d-inline"> Buat Pemesanan</h7>
                                        </div>
                                        &nbsp
                                        <div class="btn btn-danger"
                                             onclick="confirmCancel({{$resep->getId()}})">
                                            <i class="fas fa-times"></i>
                                            <h7 class="d-inline"> Tolak</h7>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function confirmCancel(value) {
            updateToBeCanceldId(value)
            document.getElementById('resep-tables').style.display = 'none'
            document.getElementById('confirm-cancel').style.display = 'block'
        }

        function updateToBeCanceldId(value) {
            document.getElementById('cancel-resep-id').value = value
        }
    </script>
    <script>
        function updateFilename(obj) {
            obj.labels[0].innerHTML = obj.value
        }
    </script>
@endsection
