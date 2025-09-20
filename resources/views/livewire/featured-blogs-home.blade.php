<div id="blog" class="our-blog section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.25s">
                <div class="section-heading">
                    <h2>{!! $components !!}</h2>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.25s">
                <div class="top-dec">
                    <img src="assets/images/blog-dec.png" alt="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
                @if($featuredPost)
                <div class="left-image">
                    <a href="{{ route('post.view', ['slug' => $featuredPost->slug]) }}">
                        <img src="{{ asset('storage/' .$featuredPost->featured_image )}}" alt="{{ $featuredPost->title }}"></a>
                    <div class="info">
                        <div class="inner-content">
                            <ul>
                                <li><i class="fa fa-calendar"></i> {{ $featuredPost->published_at}}</li>
                                <li><i class="fa fa-users"></i> {{ $featuredPost->user->name}}</li>
                                {{-- Select First Category --}}
                                @if($featuredPost->categories->isNotEmpty())
                                <li><i class="fa fa-folder"></i> {{ $featuredPost->categories->first()->name }}</li>
                                @endif
                            </ul>
                            <a href="{{ route('post.view', ['slug' => $featuredPost->slug]) }}">
                                <h4>{!!$featuredPost->title!!}</h4>
                            </a>
                            <p>{{ strip_tags(Str::limit($featuredPost->content, 100))}}</p>
                            <div class="main-blue-button">
                                <a href="{{ route('blog')}}">Discover More</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
                @if($nonFeaturedPosts &&  $nonFeaturedPosts->count())
                <div class="right-list">
                    <ul>
                        @foreach($nonFeaturedPosts as $posts)
                        <li>
                            <div class="left-content align-self-center">
                                <span><i class="fa fa-calendar"></i> {{ $posts->published_at}}</span>
                                <a href="{{ route('post.view', ['slug' => $posts->slug]) }}">
                                    <h4>{{$posts->title}}</h4>
                                </a>
                                <p>{{strip_tags(Str::limit($posts->content, 80))}}</p>
                            </div>
                            <div class="right-image">
                                <a href="{{ route('post.view', ['slug' => $posts->slug]) }}"><img src="{{ asset('storage/' .$posts->featured_image)}}" alt="{{  $posts->slug }}"></a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
