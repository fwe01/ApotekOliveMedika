<div class="tab-pane fade" id="tab-pengeluaran" role="tabpanel"
     aria-labelledby="pengeluaran-tab">
    <div class="card-header">
        <h4 class="d-inline card-title">Pengeluaran</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="pengeluaran_table" class="table table-striped">
                <thead class="text-primary">
                <th class="text-center w-13p">Id Pemesanan</th>
                <th class="text-center w-13p">Nama Pemesan</th>
                <th class="text-center w-13p">Total</th>
                <th class="text-center w-13p">Dibuat Pada</th>
                <th class="text-center w-13p">Detail</th>
                {{--        <th class="text-center w-13p">Aksi</th>--}}
                </thead>
                <tbody>
                @foreach($laporan->getPengeluaran() as $pengeluaran)
                    <tr>
                        <td class="text-center w-13p">{{ $pengeluaran->getIdPemesanan()}}</td>
                        <td class="text-center w-13p">{{ $pengeluaran->getName()}}</td>
                        <td class="text-center w-13p">{{ $pengeluaran->getTotal() }}</td>
                        <td class="text-center w-13p">{{ $pengeluaran->getCreatedAt()->format('d-m-Y h:i:s')}}</td>
                        <td class="text-center w-13p">
                            <a href="{{route('admin.pemesanans.detail', ['id'=> $pengeluaran->getIdPemesanan()])}}"
                               class="btn btn-primary">Detail Pemesanan</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
