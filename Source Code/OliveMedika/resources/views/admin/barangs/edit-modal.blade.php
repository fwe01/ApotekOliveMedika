@foreach($barangs as $barang)
    <div id="edit-barang-modal-{{$barang->getId()}}" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Barang</h5>
                </div>
                <div class="modal-body">
                    @include('admin.barangs.form', [
                        'form_action' => route('admin.barangs.update'),
                        'submit_btn' => 'Update',
                        'barang' => $barang
                    ])
                    <button type="button" class="btn btn-default float-left" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endforeach