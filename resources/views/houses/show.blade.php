@php
    $url_photo = str_replace('houses/','', route('houses.show', 2));
@endphp
<img src="{{ $url_photo . '/storage/' . $house->photo }}" alt="bh-pti" style="width: 100px; height: 100px;">

