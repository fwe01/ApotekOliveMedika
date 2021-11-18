@extends('admin.layouts.master')

@section('title', 'Barangs')

@section('content')
    @include('admin.pemesanans.add-modal')
    @include('admin.pemesanans.delete-modal')
    @include('admin.pemesanans.cancel-modal')
    <div class="row" id="pemesanan-tables">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Semua Pemesanan</h3>
                    <button type="button" class="d-inline float-right btn btn-success" data-toggle="modal"
                            data-target="#add-pemesanan-modal">
                        <i class="fa fa-plus"></i>
                        <h6 class="d-inline"> Tambah</h6>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="myTable table table-striped table-valign-middle"
                               style="font-size: large">
                            <thead class="text-primary">
                            <th class="text-center w-13p">ID Pemesanan</th>
                            <th class="text-center w-13p">Nama Pemesan</th>
                            <th class="text-center w-13p">Total</th>
                            <th class="text-center w-13p">Dibuat pada</th>
                            <th class="text-center w-13p">Status</th>
                            <th class="text-center w-13p">Action</th>
                            </thead>
                            <tbody>
                            @foreach($pemesanans as $pemesanan)
                                <tr>
                                    <td class="text-center w-13p">{{ $pemesanan->getId()}}</td>
                                    <td class="text-center w-13p">{{ $pemesanan->getName()}}</td>
                                    <td class="text-center w-13p">{{ $pemesanan->getTotal() }}</td>
                                    <td class="text-center w-13p">{{ $pemesanan->getCreatedAt()->format('d-m-Y h:i:s')}}</td>
                                    @if($pemesanan->getStatus()->getValue() == \App\Models\StatusPemesanan::DIBATALKAN)
                                        <td class="text-center w-13p"><p class="badge badge-danger">Dibatalkan</p></td>
                                    @elseif($pemesanan->getStatus()->getValue() == \App\Models\StatusPemesanan::SEDANG_DIPROSES)
                                        <td class="text-center w-13p"><p class="badge badge-primary">Diproses</p></td>
                                    @elseif($pemesanan->getStatus()->getValue() == \App\Models\StatusPemesanan::SELESAI)
                                        <td class="text-center w-13p"><p class="badge badge-success">Selesai</p></td>
                                    @endif
                                    <td class="text-center w-13p">
                                        <a href="{{route('admin.pemesanans.detail', ['id' =>$pemesanan->getId()])}}"
                                           class="btn btn-primary">
                                            <i class="fas fa-tasks"></i>
                                            <h7 class="d-inline"> Detail</h7>
                                        </a>
                                        @if($pemesanan->getStatus()->getValue() == \App\Models\StatusPemesanan::SEDANG_DIPROSES)
                                            &nbsp
                                            <div class="btn">
                                                <form action="{{route('admin.pemesanans.finish')}}" method="post">
                                                    @csrf
                                                    <input hidden type="text" name="id" value="{{$pemesanan->getId()}}">
                                                    <button class="btn btn-success" type="submit">
                                                        <i class="fas fa-check"></i>
                                                        <h7 class="d-inline"> Selesai</h7>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                        @if($pemesanan->getStatus()->getValue() == \App\Models\StatusPemesanan::SEDANG_DIPROSES)
                                            &nbsp
                                            <div class="btn btn-warning"
                                                 onclick="confirmCancel({{$pemesanan->getId()}})">
                                                <i class="fas fa-times"></i>
                                                <h7 class="d-inline"> Cancel</h7>
                                            </div>
                                        @endif
                                        @if($pemesanan->getStatus()->getValue() == \App\Models\StatusPemesanan::DIBATALKAN)
                                        &nbsp
                                        <div class="btn btn-danger"
                                             onclick="confirmDelete({{$pemesanan->getId()}})">
                                            <i class="fas fa-trash-alt"></i>
                                            <h7 class="d-inline"> Hapus</h7>
                                        </div>
                                        @endif
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

@section('scripts')
    <script>
        function confirmDelete(value) {
            updateToBeDeletedId(value)
            document.getElementById('pemesanan-tables').style.display = 'none'
            document.getElementById('confirm-delete').style.display = 'block'
        }

        function confirmCancel(value) {
            updateToBeCanceledId(value)
            document.getElementById('pemesanan-tables').style.display = 'none'
            document.getElementById('confirm-cancel').style.display = 'block'
        }

        function updateToBeDeletedId(value) {
            document.getElementById('delete-pemesanan-id').value = value
        }

        function updateToBeCanceledId(value) {
            document.getElementById('cancel-pemesanan-id').value = value
        }
    </script>
    <script>
        function updateFilename(obj) {
            obj.labels[0].innerHTML = obj.value
        }
    </script>
@endsection
