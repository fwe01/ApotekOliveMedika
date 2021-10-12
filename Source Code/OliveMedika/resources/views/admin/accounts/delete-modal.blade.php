@section('style')
    @include('style.delete-modal')
@endsection

<div id="confirm-delete" class="delete-confirmation">
    <form class="content" action="" method="post">
        @csrf
        <div class="container">
            <h2>Hapus Admin</h2>
            <p>Apakah anda yakin untuk menghapus admin ini?</p>
            <input id="delete-admin-username" type="text" name="username" value="" hidden>
            <div class="clearfix">
                <button type="button"
                        onclick="document.getElementById('confirm-delete').style.display='none';
                                    document.getElementById('admin-tables').style.display='block'"
                        class="cancelbtn">
                    Batal
                </button>
                <button type="submit" class="deletebtn">Ya, saya yakin!</button>
            </div>
        </div>
    </form>
</div>