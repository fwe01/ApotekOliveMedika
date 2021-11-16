@section('style')
    @include('style.delete-modal')
@endsection

<div id="confirm-delete" class="delete-confirmation">
    <form class="content" action="{{route('admin.pemesanans.delete')}}" method="post">
        @csrf
        <div class="container">
            <h2>Hapus Pemesanan</h2>
            <p>Apakah anda yakin untuk menghapus pemesanan ini?</p>
            <input id="delete-pemesanan-id" type="text" name="id" value="" hidden>
            <div class="clearfix">
                <button type="button"
                        onclick="document.getElementById('confirm-delete').style.display='none';
                                    document.getElementById('pemesanan-tables').style.display='block'"
                        class="cancelbtn">
                    Batal
                </button>
                <button type="submit" class="deletebtn">Ya, saya yakin!</button>
            </div>
        </div>
    </form>
</div>