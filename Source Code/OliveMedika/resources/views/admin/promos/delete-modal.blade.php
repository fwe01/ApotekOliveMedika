@section('style')
    @include('style.delete-modal')
@endsection

<div id="confirm-delete" class="delete-confirmation">
    <form class="content" action="{{route('admin.promos.delete')}}" method="post">
        @csrf
        <div class="container">
            <h2>Hapus Promo</h2>
            <p>Apakah anda yakin untuk menghapus promo ini?</p>
            <input id="delete-promo-id" type="text" name="id" value="" hidden>
            <div class="clearfix">
                <button type="button"
                        onclick="document.getElementById('confirm-delete').style.display='none';
                                    document.getElementById('promo-tables').style.display='block'"
                        class="cancelbtn">
                    Batal
                </button>
                <button type="submit" class="deletebtn">Ya, saya yakin!</button>
            </div>
        </div>
    </form>
</div>