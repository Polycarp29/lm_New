
@foreach($getFooter as $footer)
<div class="col-lg-12 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.25s">
    <p> {{ $footer->footer_copyright}}

    <br>Design: <a rel="nofollow" href="{{url('')}}">{{ $footer->botton_desc }}</a>
    </p>
</div>
@endforeach
