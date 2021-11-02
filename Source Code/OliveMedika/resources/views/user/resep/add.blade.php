<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form method="post" action="{{route('user.reseps.add')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="gambar" name="gambar"
                       accept="image/*"
                >
                <label class="custom-file-label"
                       for="gambar">Pilih file</label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <button type="submit" class="btn btn-success float-right"
                style="position:relative; left: 89%; bottom: -50px;">Tambah
        </button>
    </div>
</form>
</body>
</html>