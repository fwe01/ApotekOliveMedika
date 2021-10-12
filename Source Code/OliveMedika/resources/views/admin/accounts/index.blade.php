@extends('admin.layouts.master')

@section('title', 'Accounts')

@section('content')
    @include('admin.accounts.delete-modal')
    @include('admin.accounts.add-modal')
    @include('admin.accounts.edit-modal')
    <div class="row" id="admin-tables">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Semua Admin</h3>
                    <button type="button" class="d-inline float-right btn btn-success" data-toggle="modal"
                            data-target="#add-admin-modal">
                        <i class="fa fa-plus"></i>
                        <h6 class="d-inline"> Tambah</h6>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="tables table table-striped">
                            <thead class="text-primary">
                            <th class="text-center w-13p">Nama</th>
                            <th class="text-center w-13p">Alamat</th>
                            <th class="text-center w-13p">No Telp</th>
                            <th class="text-center w-13p">Username</th>
                            <th class="text-center w-13p">Action</th>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td class="text-center w-13p">{{ $admin->getNama() }}</td>
                                    <td class="text-center w-13p">{{ $admin->getAlamat() }}</td>
                                    <td class="text-center w-13p">{{ $admin->getNoTelp() }}</td>
                                    <td class="text-center w-13p">{{ $admin->getUsername() }}</td>
                                    <td class="text-center w-13p">
                                        <div class="btn btn-primary" data-toggle="modal"
                                             data-target="#edit-admin-modal-{{$admin->getId()}}">
                                            <i class="fas fa-tasks"></i>
                                            <h7 class="d-inline"> Edit</h7>
                                        </div>
                                        &nbsp
                                        <div class="btn btn-danger" onclick="confirmDelete({{$admin->getId()}})">
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
            document.getElementById('admin-tables').style.display = 'none'
            document.getElementById('confirm-delete').style.display = 'block'
        }

        function updateToBeDeletedId(value) {
            document.getElementById('delete-admin-id').value = value
        }
    </script>
@endsection