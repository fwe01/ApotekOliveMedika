<div id="add-pemesanan-modal" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pemesanan Baru</h5>
            </div>
            <div class="modal-body">
                @include('admin.pemesanans.form', [
                    'form_action' => route('admin.pemesanans.add'),
                    'submit_btn' => 'Tambah'
                ])
                <button type="button" class="btn btn-default float-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>