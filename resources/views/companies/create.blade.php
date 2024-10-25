<form action="{{ route('companies.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name"> <br>
    <input type="file" name="photo"> <br>
    <input type="submit" value="Send Photo">
</form>