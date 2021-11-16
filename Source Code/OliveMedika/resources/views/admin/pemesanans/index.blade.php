@extends('admin.layouts.master')

@section('title', 'Barangs')

@section('content')
    {{--    @include('admin.pemesanans.add-modal')--}}
    @include('admin.pemesanans.delete-modal')
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
                            <th class="text-center w-13p">Action</th>
                            </thead>
                            <tbody>
                            @foreach($pemesanans as $pemesanan)
                                <tr>
                                    <td class="text-center w-13p">{{ $pemesanan->getId()}}</td>
                                    <td class="text-center w-13p">{{ $pemesanan->getName()}}</td>
                                    <td class="text-center w-13p">{{ $pemesanan->getTotal() }}</td>
                                    <td class="text-center w-13p">{{ $pemesanan->getCreatedAt()->format('d-m-Y h:i:s')}}</td>
                                    <td class="text-center w-13p">
                                        <a href="{{route('admin.pemesanans.detail', ['id' =>$pemesanan->getId()])}}"
                                           class="btn btn-primary">
                                            <i class="fas fa-tasks"></i>
                                            <h7 class="d-inline"> Detail</h7>
                                        </a>
                                        &nbsp
                                        <div class="btn btn-danger" onclick="confirmDelete({{$pemesanan->getId()}})">
                                            <i class="fas fa-trash-alt"></i>
                                            <h7 class="d-inline"> Hapus</h7>
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
        function confirmDelete(value) {
            updateToBeDeletedId(value)
            document.getElementById('pemesanan-tables').style.display = 'none'
            document.getElementById('confirm-delete').style.display = 'block'
        }

        function updateToBeDeletedId(value) {
            document.getElementById('delete-pemesanan-id').value = value
        }
    </script>
    <script>
        function updateFilename(obj) {
            obj.labels[0].innerHTML = obj.value
        }
    </script>
@endsection
