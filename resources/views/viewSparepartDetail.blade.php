{{ $sparepart}}


@foreach($images as $image)
    <img src="{{ asset('images/' . $image->image_path) }}" alt="{{ $image->alt_text }}">
@endforeach
