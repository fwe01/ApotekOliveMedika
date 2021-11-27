<div class="tab-pane fade" id="tab-barang-terlaris" role="tabpanel"
     aria-labelledby="barang-terlaris-tab">
    <div class="card-header">
        <h4 class="d-inline card-title">Barang Terlaris</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="pengeluaran_table" class="table table-striped table-valign-middle">
                <thead class="text-primary">
                <th class="text-center w-13p">Gambar</th>
                <th class="text-center w-13p">Nama</th>
                <th class="text-center w-13p">Harga</th>
                <th class="text-center w-13p">Stock</th>
                <th class="text-center w-13p">Type</th>
                <th class="text-center w-13p">Terjual</th>
                {{--        <th class="text-center w-13p">Aksi</th>--}}
                </thead>
                <tbody>
                @foreach($laporan->getBarangTerlaris() as $barang)
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
                        <td class="text-center w-13p">{{$barang->getTerjual()}} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
