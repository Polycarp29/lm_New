
@foreach($getFormData as $data)
<div class="col-lg-6 align-self-center wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.25s">
    <div class="section-heading">
        <h2>{{ $description }}</h2>
        <p>{{ strip_tags($data->description)}}</p>
        <div class="phone-info">
            <h4>For any enquiry, Call Us: <span><i class="fa fa-phone"></i> <a
                        href="#">{{ $data->contacts}}</a></span></h4>
        </div>
    </div>
</div>
@endforeach
