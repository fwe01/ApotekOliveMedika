@php
    if (!isset($barang)){
	    $barang = null;
    }
@endphp
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
<form id="unit_info" name="unit_info" method="POST"
      action="{{$form_action}}" enctype="multipart/form-data">
    @csrf
    <div id="container">
        <div id="label">{{$submit_btn}} Barang</div>
        <p style="color:red;">* : wajib diisi.</p>
        @if($barang)
            <div class="form-group row">
                <input type="text" hidden name="id" value="{{$barang ? $barang->getId() : ""}}">
            </div>
        @endif
        @include('admin.layouts.form_group', [
            'label' => 'Nama',
            'name' => 'nama',
            'id_input' => 'nama_barang',
            'required' => true,
            'type' => 'text',
            'value' => $barang ? $barang->getNama() : "",
        ])
        @include('admin.layouts.form_group', [
            'label' => 'Harga',
            'name' => 'harga',
            'id_input' => 'harga_barang',
            'required' => true,
            'type' => 'number',
            'value' => $barang ? $barang->getHarga() : "",
        ])
        {{--        @include('admin.layouts.form_group', [--}}
        {{--            'label' => 'Stock',--}}
        {{--            'name' => 'stock',--}}
        {{--            'id_input' => 'stock_barang',--}}
        {{--            'required' => false,--}}
        {{--			'readonly' => true,--}}
        {{--            'type' => 'number',--}}
        {{--            'value' => $barang ? $barang->getStock() : "0",--}}
        {{--        ])--}}
        @include('admin.layouts.form_group', [
            'label' => 'Generic',
            'name' => 'is_generic',
            'id_input' => 'is_generic_barang',
            'required' => true,
            'type' => 'select',
			'options' => [
                'Ya'  => true,
                'Tidak' => false
            ],
            'value' => $barang ? $barang->isGeneric() : "",
        ])
        @include('admin.layouts.form_group', [
            'label' => 'Tipe Barang',
            'name' => 'type',
            'id_input' => 'type_barang',
            'required' => true,
            'type' => 'select',
			'options' => [
                'Obat'  => \App\Models\TypeBarang::OBAT_OBATAN,
                'Peralatan Medis' => \App\Models\TypeBarang::PERALATAN
            ],
            'value' => $barang ? $barang->getType() : "",
        ])
        @include('admin.layouts.form_group', [
            'label' => 'Gambar',
            'name' => 'gambar',
            'id_input' => 'gambar_barang',
            'required' => !(bool) $barang,
            'type' => 'image',
            'value' => $barang ? $barang->getGambar() : "",
        ])
        <div class="form-group row">
            <button type="submit" class="btn btn-success float-right"
                    style="position:relative; left: 89%; bottom: -50px;">{{$submit_btn}}
            </button>
        </div>
    </div>
</form>