@extends('admin.layouts.master')

@section('title', 'Barangs')

@section('content')
    @include('admin.barangs.delete-modal')
    @include('admin.barangs.add-modal')
    @include('admin.barangs.edit-modal')
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
                        <table id="myTable" class="myTable table table-striped table-valign-middle"
                               style="font-size: large">
                            <thead class="text-primary">
                            <th class="text-center w-13p">Gambar</th>
                            <th class="text-center w-13p">Nama</th>
                            <th class="text-center w-13p">Harga</th>
                            <th class="text-center w-13p">Stock</th>
                            <th class="text-center w-13p">Type</th>
                            <th class="text-center w-13p">Action</th>
                            </thead>
                            <tbody>
                            @foreach($barangs as $barang)
                                <tr>
                                    <td class="text-center w-13p" style="width: fit-content">
                                        <img src="{{ url(\Illuminate\Support\Facades\Storage::url($barang->getGambar())) }}"
                                             alt="" width="300px" height="300px">
                                    </td>
                                    <td class="text-center w-13p">
                                        {{ $barang->getNama() }}
                                    </td>
                                    <td class="text-center w-13p">{{ $barang->getHarga() }}</td>
                                    <td class="text-center w-13p">{{ $barang->getStock() }}</td>
                                    <td class="text-center w-13p">
                                        @if($barang->getType() === \App\Models\TypeBarang::OBAT_OBATAN)
                                            <p class="badge badge-primary">Obat</p>
                                        @elseif ($barang->getType() === \App\Models\TypeBarang::PERALATAN)
                                            <p class="badge badge-secondary">Peralatan Medis</p>
                                        @endif
                                    </td>
                                    <td class="text-center w-13p">
                                        <div class="btn btn-primary" data-toggle="modal"
                                             data-target="#edit-barang-modal-{{$barang->getId()}}">
                                            <i class="fas fa-tasks"></i>
                                            <h7 class="d-inline"> Edit</h7>
                                        </div>
                                        &nbsp
                                        <div class="btn btn-danger" onclick="confirmDelete({{$barang->getId()}})">
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
            document.getElementById('barang-tables').style.display = 'none'
            document.getElementById('confirm-delete').style.display = 'block'
        }

        function updateToBeDeletedId(value) {
            document.getElementById('delete-barang-id').value = value
        }
    </script>
    <script>
        function updateFilename(obj) {
            obj.labels[0].innerHTML = obj.value
        }
    </script>
@endsection