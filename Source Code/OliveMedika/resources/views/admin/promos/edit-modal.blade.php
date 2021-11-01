@foreach($promos as $promo)
    <div id="edit-promo-modal-{{$promo->getId()}}" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Promo</h5>
                </div>
                <div class="modal-body">
                    @include('admin.promos.form', [
                        'form_action' => route('admin.promos.update'),
                        'submit_btn' => 'Update',
                        'promo' => $promo
                    ])
                    <button type="button" class="btn btn-default float-left" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endforeach