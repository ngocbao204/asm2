<div class="one-time">
    @foreach ($banners as $banner)
        <div><img src="{{ asset($banner->image) }}" width="100%" height="370px" alt=""></div>
    @endforeach
</div>
