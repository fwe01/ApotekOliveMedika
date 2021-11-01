<div id="add-promo-modal" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Promo Baru</h5>
            </div>
            <div class="modal-body">
                @include('admin.promos.form', [
                    'form_action' => route('admin.promos.add'),
                    'submit_btn' => 'Tambah'
                ])
                <button type="button" class="btn btn-default float-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>