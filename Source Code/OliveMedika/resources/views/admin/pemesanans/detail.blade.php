@extends('admin.layouts.master')

@section('title', 'Barangs')

@section('content')
    {{--    @include('admin.barangs.add-modal')--}}
    @include('admin.barangs.delete-modal')
    <div class="row" id="barang-tables">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Infomasi Pemesanan</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="myTable table table-bordered table-striped table-valign-middle"
                               style="font-size: large">
                            <tbody>
                            <tr>
                                <th class="text-center w-13p">ID Pemesanan</th>
                                <th class="text-center w-13p">{{$pemesanan->getId()}}</th>
                            </tr>
                            <tr>
                                <th class="text-center w-13p">Nama Pemesan</th>
                                <th class="text-center w-13p">{{$pemesanan->getName()}}</th>
                            </tr>
                            <tr>
                                <th class="text-center w-13p">Dibuat pada</th>
                                <th class="text-center w-13p">{{$pemesanan->getCreatedAt()->format('d-m-Y H:i:s')}}</th>
                            </tr>
                            <tr>
                                <th class="text-center w-13p">Status Pemesanan</th>
                                @if($pemesanan->getStatus()->getValue() == \App\Models\StatusPemesanan::DIBATALKAN)
                                    <th class="text-center w-13p"><p class="badge badge-danger">Dibatalkan</p></thj>
                                @elseif($pemesanan->getStatus()->getValue() == \App\Models\StatusPemesanan::SEDANG_DIPROSES)
                                    <th class="text-center w-13p"><p class="badge badge-primary">Diproses</p></th>
                                @elseif($pemesanan->getStatus()->getValue() == \App\Models\StatusPemesanan::SELESAI)
                                    <th class="text-center w-13p"><p class="badge badge-success">Selesai</p></th>
                                @endif
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="barang-tables">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Barang Pemesanan</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable2" class="myTable table table-striped table-valign-middle"
                               style="font-size: large">
                            <thead class="text-primary">
                            <th class="text-center w-13p">Nama Barang</th>
                            <th class="text-center w-13p">Harga</th>
                            <th class="text-center w-13p">Jumlah</th>
                            <th class="text-center w-13p">Subtotal</th>
                            </thead>
                            <tbody>
                            @foreach($pemesanan->getBarangs() as $barang)
                                <tr>
                                    <td class="text-center w-13p">{{ $barang->getNama() }}</td>
                                    <td class="text-center w-13p">{{ $barang->getHarga() }}</td>
                                    <td class="text-center w-13p">{{ $barang->getQuantity() }}</td>
                                    <td class="text-center w-13p">
                                        Rp. {{ $barang->getHarga() * $barang->getQuantity() }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th class="text-center w-13p" colspan="3">TOTAL</th>
                                <th class="text-center w-13p">Rp. {{$pemesanan->getTotal()}}</th>
                            </tr>
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
