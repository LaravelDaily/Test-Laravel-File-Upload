<form action="http://127.0.0.1:8000/projects" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name"> <br>
    <input type="file" name="logo"> <br>
    <input type="submit" value="Upload">
</form>