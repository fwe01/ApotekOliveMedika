@php
    if (!isset($promo)){
	    $promo = null;
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
        <div id="label">{{$submit_btn}} Promo</div>
        <p style="color:red;">* : wajib diisi.</p>
        @if($promo)
            <div class="form-group row">
                <input type="text" hidden name="id" value="{{$promo ? $promo->getId() : ""}}">
            </div>
        @endif
        @include('admin.layouts.form_group', [
            'label' => 'Nama Barang',
            'name' => 'id_barang',
            'id_input' => 'id_barang' . ($promo ? $promo->getId() : ""),
            'required' => true,
            'type' => $promo ? 'text' : 'select',
			'options' => $promo ? null : $barang_options,
			'readonly' => (bool)$promo,
			'value' => $promo ? $promo->getNamaBarang() : ""
        ])
        @include('admin.layouts.form_group', [
            'label' => 'Harga promo per unit',
            'name' => 'harga_promo_per_unit',
            'id_input' => 'harga_promo_per_unit',
            'required' => true,
            'type' => 'number',
			'value' => $promo ? $promo->getHargaPromoPerUnit() : ""
        ])
        @include('admin.layouts.form_group', [
            'label' => 'Tanggal Promo Mulai',
            'name' => 'tanggal_mulai',
            'id_input' => 'tanggal_mulai' . ($promo ? $promo->getId() : ""),
            'required' => true,
            'type' => 'datetime',
			'value' => $promo ? $promo->getTanggalMulai()->format('d/m/Y') : ""
        ])
        @include('admin.layouts.form_group', [
            'label' => 'Tanggal Promo Berakhir',
            'name' => 'tanggal_berakhir',
            'id_input' => 'tanggal_berakhir' . ($promo ? $promo->getId() : ""),
            'required' => true,
            'type' => 'datetime',
			'value' => $promo ? $promo->getTanggalBerakhir()->format('d/m/Y') : ""
        ])
        <div class="form-group row">
            <button type="submit" class="btn btn-success float-right"
                    style="position:relative; left: 89%; bottom: -50px;">{{$submit_btn}}
            </button>
        </div>
    </div>
</form>
