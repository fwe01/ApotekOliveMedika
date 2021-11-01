@extends('admin.layouts.master')

@section('title', 'Barangs')

@section('content')
    @include('admin.promos.add-modal')
    @include('admin.promos.delete-modal')
    <div class="row" id="promo-tables">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Semua Restock</h3>
                    <button type="button" class="d-inline float-right btn btn-success" data-toggle="modal"
                            data-target="#add-promo-modal">
                        <i class="fa fa-plus"></i>
                        <h6 class="d-inline"> Tambah</h6>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="myTable table table-striped table-valign-middle"
                               style="font-size: large">
                            <thead class="text-primary">
                            <th class="text-center w-13p">Nama Barang</th>
                            <th class="text-center w-13p">Harga promo per unit</th>
                            <th class="text-center w-13p">Promo Mulai</th>
                            <th class="text-center w-13p">Promo Berakhir</th>
                            <th class="text-center w-13p">Dibuat pada</th>
                            <th class="text-center w-13p">Action</th>
                            </thead>
                            <tbody>
                            @foreach($promos as $promo)
                                <tr>
                                    <td class="text-center w-13p">{{$promo->getNamaBarang()}}</td>
                                    <td class="text-center w-13p">
                                        {{ $promo->getHargaPromoPerUnit() }}
                                    </td>
                                    <td class="text-center w-13p">{{ $promo->getTanggalMulai()->format('d-m-Y')}}</td>
                                    <td class="text-center w-13p">{{ $promo->getTanggalBerakhir()->format('d-m-Y')}}</td>
                                    <td class="text-center w-13p">{{ $promo->getCreatedAt()->format('d-m-Y h:i:s')}}</td>
                                    <td class="text-center w-13p">
                                        <div class="btn btn-primary" data-toggle="modal"
                                             data-target="#edit-promo-modal-{{$promo->getId()}}">
                                            <i class="fas fa-tasks"></i>
                                            <h7 class="d-inline"> Edit</h7>
                                        </div>
                                        &nbsp
                                        <div class="btn btn-danger" onclick="confirmDelete({{$promo->getId()}})">
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
            document.getElementById('promo-tables').style.display = 'none'
            document.getElementById('confirm-delete').style.display = 'block'
        }

        function updateToBeDeletedId(value) {
            document.getElementById('delete-promo-id').value = value
        }
    </script>
    <script>
        function updateFilename(obj) {
            obj.labels[0].innerHTML = obj.value
        }
    </script>
@endsection
