@section('style')
    @include('style.delete-modal')
@endsection

<div id="confirm-cancel" class="delete-confirmation">
    <form class="content" action="{{route('admin.reseps.cancel')}}" method="post">
        @csrf
        <div class="container">
            <h2>Tolak Resep</h2>
            <p>Apakah anda yakin untuk menolak resep ini?</p>
            <input id="cancel-resep-id" type="text" name="id" value="" hidden>
            <div class="clearfix">
                <button type="button"
                        onclick="document.getElementById('confirm-cancel').style.display='none';
                                    document.getElementById('resep-tables').style.display='block'"
                        class="cancelbtn">
                    Batal
                </button>
                <button type="submit" class="deletebtn">Ya, saya yakin!</button>
            </div>
        </div>
    </form>
</div>
