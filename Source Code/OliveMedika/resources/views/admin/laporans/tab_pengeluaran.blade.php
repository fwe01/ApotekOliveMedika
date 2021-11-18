<div class="tab-pane fade" id="tab-pengeluaran" role="tabpanel"
     aria-labelledby="pengeluaran-tab">
    <div class="card-header">
        <h4 class="d-inline card-title">Pengeluaran</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="pengeluaran_table" class="table table-striped">
                <thead class="text-primary">
                <th class="text-center w-13p">Nama Barang</th>
                <th class="text-center w-13p">Nama Admin</th>
                <th class="text-center w-13p">Dibuat Pada</th>
                <th class="text-center w-13p">Jumlah Restock</th>
                <th class="text-center w-13p">Harga Per Unit</th>
                <th class="text-center w-13p">Total Biaya</th>
                {{--        <th class="text-center w-13p">Aksi</th>--}}
                </thead>
                <tbody>
                @foreach($laporan->getPengeluaran() as $pengeluaran)
                    <tr>
                        <td class="text-center w-13p">{{ $pengeluaran->getNamaBarang()}}</td>
                        <td class="text-center w-13p">{{ $pengeluaran->getUsernameAdmin()}}</td>
                        <td class="text-center w-13p">{{ $pengeluaran->getCreatedAt()->format('d-m-Y H:i:s')}}</td>
                        <td class="text-center w-13p">{{ $pengeluaran->getJumlah() }}</td>
                        <td class="text-center w-13p">{{ $pengeluaran->getHargaPerUnit() }}</td>
                        <td class="text-center w-13p">{{ $pengeluaran->getJumlah() * $pengeluaran->getHargaPerUnit() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
