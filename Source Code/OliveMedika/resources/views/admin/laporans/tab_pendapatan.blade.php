<div class="tab-pane fade" id="tab-pendapatan" role="tabpanel"
     aria-labelledby="pendapatan-tab">
    <div class="card-header">
        <h4 class="d-inline card-title">Pendapatan</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="pendapatan_table" class="table table-striped">
                <thead class="text-primary">
                <th class="text-center w-13p">Id Pemesanan</th>
                <th class="text-center w-13p">Nama Pemesan</th>
                <th class="text-center w-13p">Total</th>
                <th class="text-center w-13p">Dibuat Pada</th>
                <th class="text-center w-13p">Detail</th>
                {{--        <th class="text-center w-13p">Aksi</th>--}}
                </thead>
                <tbody>
                @foreach($laporan->getPendapatan() as $pendapatan)
                    <tr>
                        <td class="text-center w-13p">{{ $pendapatan->getIdPemesanan()}}</td>
                        <td class="text-center w-13p">{{ $pendapatan->getName()}}</td>
                        <td class="text-center w-13p">{{ $pendapatan->getTotal() }}</td>
                        <td class="text-center w-13p">{{ $pendapatan->getCreatedAt()->format('d-m-Y H:i:s')}}</td>
                        <td class="text-center w-13p">
                            <a href="{{route('admin.pemesanans.detail', ['id'=> $pendapatan->getIdPemesanan()])}}"
                               class="btn btn-primary">Detail Pemesanan</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
