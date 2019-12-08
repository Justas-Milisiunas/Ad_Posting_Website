<div id="imagesCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
    <ol class="carousel-indicators">
        @for ($i = 0; $i < count($images); $i++)
            <li data-target="#imagesCarousel" data-slide-to="{{$i}}" class="{{$i == 0 ? 'active' : ''}}"></li>
        @endfor
    </ol>
    <div class="carousel-inner">
        @foreach ($images as $index=>$image)
            <div class="carousel-item {{$index == 0 ? 'active' : ''}}">
                <img src="{{asset('storage/uploads/'.$image->link)}}" class="d-block w-100" alt="Uploaded image {{$index}}">
            </div>
        @endforeach
        <a class="carousel-control-prev" href="#imagesCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Ankstesnė</span>
        </a>
        <a class="carousel-control-next" href="#imagesCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Kita</span>
        </a>
    </div>
</div>
