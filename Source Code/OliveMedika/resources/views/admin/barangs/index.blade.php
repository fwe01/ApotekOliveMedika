@extends('admin.layouts.master')

@section('title', 'Barangs')

@section('content')
    {{--    @include('admin.accounts.delete-modal')--}}
    @include('admin.barangs.add-modal')
    {{--    @include('admin.accounts.edit-modal')--}}
    <div class="row" id="barang-tables">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Semua Barang</h3>
                    <button type="button" class="d-inline float-right btn btn-success" data-toggle="modal"
                            data-target="#add-barang-modal">
                        <i class="fa fa-plus"></i>
                        <h6 class="d-inline"> Tambah</h6>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="tables table table-striped">
                            <thead class="text-primary">
                            <th class="text-center w-13p">Gambar</th>
                            <th class="text-center w-13p">Nama</th>
                            <th class="text-center w-13p">Harga</th>
                            <th class="text-center w-13p">Stock</th>
                            <th class="text-center w-13p">Type</th>
                            <th class="text-center w-13p">Action</th>
                            </thead>
                            <tbody>
                            {{--                            @foreach($barangs as $barang)--}}
                            {{--                                <tr>--}}
                            {{--                                    <td class="text-center w-13p">{{ \Illuminate\Support\Facades\Storage::url($barang->getBarang()) }}</td>--}}
                            {{--                                    <td class="text-center w-13p">{{ $barang->getNama() }}</td>--}}
                            {{--                                    <td class="text-center w-13p">{{ $barang->getHarga() }}</td>--}}
                            {{--                                    <td class="text-center w-13p">{{ $barang->getStock() }}</td>--}}
                            {{--                                    <td class="text-center w-13p">{{ $barang->getType() }}</td>--}}
                            {{--                                    <td class="text-center w-13p">--}}
                            {{--                                        <div class="btn btn-primary" data-toggle="modal"--}}
                            {{--                                             data-target="#edit-admin-modal-{{$barang->getId()}}">--}}
                            {{--                                            <i class="fas fa-tasks"></i>--}}
                            {{--                                            <h7 class="d-inline"> Edit</h7>--}}
                            {{--                                        </div>--}}
                            {{--                                        &nbsp--}}
                            {{--                                        <div class="btn btn-danger" onclick="confirmDelete({{$barang->getId()}})">--}}
                            {{--                                            <i class="fas fa-trash-alt"></i>--}}
                            {{--                                            <h7 class="d-inline"> Hapus</h7>--}}
                            {{--                                        </div>--}}
                            {{--                                    </td>--}}
                            {{--                                </tr>--}}
                            {{--                            @endforeach--}}
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
            document.getElementById('barang-tables').style.display = 'none'
            document.getElementById('confirm-delete').style.display = 'block'
        }

        function updateToBeDeletedId(value) {
            document.getElementById('delete-barang-id').value = value
        }
    </script>
@endsection