@section('style')
    @include('style.delete-modal')
@endsection

<div id="confirm-cancel" class="delete-confirmation">
    <form class="content" action="{{route('admin.pemesanans.cancel')}}" method="post">
        @csrf
        <div class="container">
            <h2>Batalkan Pemesanan</h2>
            <p>Apakah anda yakin untuk membatalakn pemesanan ini?</p>
            <input id="cancel-pemesanan-id" type="text" name="id" value="" hidden>
            <div class="clearfix">
                <button type="button"
                        onclick="document.getElementById('confirm-cancel').style.display='none';
                                    document.getElementById('pemesanan-tables').style.display='block'"
                        class="cancelbtn">
                    Batal
                </button>
                <button type="submit" class="deletebtn">Ya, saya yakin!</button>
            </div>
        </div>
    </form>
</div>
