<form action="http://127.0.0.1:8000/houses" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name"> <br>
    <input type="file" name="photo"> <br>
    <input type="submit" value="Upload">
</form>