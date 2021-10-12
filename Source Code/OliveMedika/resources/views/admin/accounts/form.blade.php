@php
    if (!isset($admin)){
	    $admin = null;
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
      action="{{$form_action}}">
    @csrf
    <div id="container">
        <div id="label">{{$submit_btn}} Admin</div>
        <p style="color:red;">* : wajib diisi.</p>
        @if($admin)
            <div class="form-group row">
                <input type="text" hidden name="id" value="{{$admin ? $admin->getId() : ""}}">
            </div>
        @endif
        @include('admin.layouts.form_group', [
            'label' => 'Nama',
            'name' => 'nama',
            'id_input' => 'nama_admin',
            'required' => true,
            'type' => 'text',
            'value' => $admin ? $admin->getNama() : "",
        ])
        @include('admin.layouts.form_group', [
            'label' => 'Alamat',
            'name' => 'alamat',
            'id_input' => 'alamat_admin',
            'required' => true,
            'type' => 'text',
            'value' => $admin ? $admin->getAlamat() : "",
        ])
        @include('admin.layouts.form_group', [
            'label' => 'Nomor Telepon',
            'name' => 'no_telp',
            'id_input' => 'no_telp_admin',
            'required' => true,
            'type' => 'text',
            'value' => $admin ? $admin->getNoTelp() : "",
        ])
        @include('admin.layouts.form_group', [
            'label' => 'Username',
            'name' => 'username',
            'id_input' => 'username_admin',
            'required' => true,
            'type' => 'text',
            'value' => $admin ? $admin->getUsername() : "",
            'readonly' => (bool)$admin
        ])
        @include('admin.layouts.form_group', [
            'label' => 'Password',
            'name' => 'password',
            'id_input' => 'password_admin',
            'required' => !(bool)$admin,
            'type' => 'password',
        ])
        @include('admin.layouts.form_group', [
            'label' => 'Ulangi Password',
            'name' => 'password_confirmation',
            'id_input' => 'password_confirmation_admin',
            'required' => !(bool)$admin,
            'type' => 'password',
        ])
        <div class="form-group row">
            <button type="submit" class="btn btn-success float-right"
                    style="position:relative; left: 89%; bottom: -50px;">{{$submit_btn}}
            </button>
        </div>
    </div>
</form>