@foreach($admins as $admin)
    <div id="edit-admin-modal-{{$admin->getId()}}" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Admin</h5>
                </div>
                <div class="modal-body">
                    @include('admin.accounts.form', [
                        'form_action' => route('admin.accounts.update'),
                        'submit_btn' => 'Update',
                        'admin' => $admin
                    ])
                    <button type="button" class="btn btn-default float-left" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endforeach