@if ($errors->any())
    <div class="alert alert-danger mt-3" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
            @endforeach
        </ul>
    </div>
@endif
<form id="tambah_pemesanan" name="tambah_pemesanan" method="POST"
      action="{{$form_action}}" enctype="multipart/form-data">
    @csrf
    <h5>Pilih Pengguna</h5>
    <div class="row">
        <select class="select2 select2-hidden-accessible" name="user_id"
                id="user_id" style="width: 100%">
            <option value=""> Pilih Pengguna</option>
            @foreach($users as $user)
                <option value="{{$user->id}}"> {{$user->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="tambah-barang mt-4 mb-4">
        <h5>Tambah Barang</h5>
        <div class="row">
            <div class="col-7">
                <select class="select2 select2-hidden-accessible" name=""
                        id="pilihan_barang" style="width: 100%">
                    <option value="0"> Pilih Barang</option>
                    @foreach($barangs as $barang)
                        <option value="{{$barang->getId()}}"> {{$barang->getNama()}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <input id="jumlah_barang_dipesan" name="jumlah_barang_dipesan" type="number" class="form-control"
                       value="" placeholder="Jumlah">
            </div>
            <div class="col-1">
                <button type="button" class="btn btn-success" onclick="addBarangDipesan()">Tambah</button>
            </div>
        </div>
    </div>
    <div id="container mt-4">
        <div class="table-responsive">
            <table id="tabel_barang_dipesan" class="table table-striped table-valign-middle"
                   style="font-size: large">
                <thead class="text-primary">
                <th class="text-center w-13p">ID Barang</th>
                <th class="text-center w-13p">Nama Barang</th>
                <th class="text-center w-13p">Jumlah</th>
                <th class="text-center w-13p">Action</th>
                </thead>
                <tbody id="list-barang-dipesan">

                </tbody>
            </table>
        </div>
        <div class="form-group row">
            <button type="submit" class="btn btn-success float-right"
                    style="position:relative; left: 89%; bottom: -50px;">{{$submit_btn}}
            </button>
        </div>
    </div>
</form>

@section('script')
    <script>
        let id = 1;

        function validateTambahBarang() {
            var jumlah_barang = $('#jumlah_barang_dipesan').val();
            var id_barang = $('#pilihan_barang').find(':selected').val();

            if (isNaN(jumlah_barang) || jumlah_barang < 1) {
                alert('Jumlah Barang harus angka dan minimal 1')
                return false;
            } else if (id_barang === "" || isNaN(id_barang)) {
                alert('Pilih barang terlebih dahulu')
                return false;
            }
            return true;
        }

        function addBarangDipesan() {
            if (validateTambahBarang()) {
                var barang_pilihan = $('#pilihan_barang').find(':selected');
                var list_barang = $('#list-barang-dipesan');
                var form = $('#tambah_pemesanan');
                var row = document.createElement('tr')
                var input = document.createElement('div');
                row.id = "barang-pesanan-" + id;
                input.id = "barang-pesanan-input-" + id;

                var jumlah_barang = $('#jumlah_barang_dipesan').val();

                var element_id_barang = document.createElement('td');
                element_id_barang.classList.add('text-center');
                element_id_barang.classList.add('w-13p');
                element_id_barang.innerHTML = barang_pilihan.val();
                input.innerHTML = '<input hidden type="number" name="id[]" value="' + barang_pilihan.val() + '">';
                row.appendChild(element_id_barang);

                var element_nama_barang = document.createElement('td');
                element_nama_barang.classList.add('text-center');
                element_nama_barang.classList.add('w-13p');
                element_nama_barang.innerHTML = barang_pilihan.text();
                row.appendChild(element_nama_barang);

                var element_jumlah = document.createElement('td');
                element_jumlah.classList.add('text-center');
                element_jumlah.classList.add('w-13p');
                element_jumlah.innerHTML = jumlah_barang;
                input.innerHTML += '<input hidden  type="number" name="jumlah[]" value="' + jumlah_barang + '">';
                row.appendChild(element_jumlah);

                var element_action = document.createElement('td');
                element_action.classList.add('text-center');
                element_action.classList.add('w-13p');
                element_action.innerHTML = '<button type="button" class="btn btn-danger" onclick="hapusBarang(' + id + ')"><i class="fa fa-trash"></i> Hapus</button>'
                row.appendChild(element_action);

                form.append(input)
                list_barang.append(row)
                id++;

                $('#jumlah_barang_dipesan').val("")
                $('#pilihan_barang').select2("val", "0");
            }
        }

        function hapusBarang(id) {
            $('#barang-pesanan-' + id).remove();
            $('#barang-pesanan-input-' + id).remove();
        }
    </script>
@endsection
