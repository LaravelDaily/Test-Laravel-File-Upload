<form action="http://127.0.0.1:8000/houses/{{ $house->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ $house->name }}"> <br>
    <input type="file" name="photo"> <br>
    <input type="submit" value="Upload">
</form>