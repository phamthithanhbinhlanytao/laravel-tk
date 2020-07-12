@extends('shop.master')
@section('title')
{{ $product->name }}
@endsection
@section('content')
<section class="breadcrumb-section set-bg" data-setbg="/assets/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                <h2>{{ $product->name }}</h2>
                    <div class="breadcrumb__option">
                    <a href="{{ Route('shop.index.index') }}">{{ trans('messages.home') }}</a>
                        <a href="#">{{ trans('messages.products') }}</a>
                        <span>{{ $product->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            src="/assets/img/product/{{ $product->picture }}" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        @foreach ($product->images as $image)
                            <img data-imgbigurl="/assets/img/product/{{ $image->image }}"
                                src="/assets/img/product/{{ $image->image }}" alt="">
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{ $product->name }}</h3>
                    <div class="product__details__rating">
                        @if ($product->rating % 2 != 0)
                            @php
                            $rating = round($product->rating,1);
                            $arrRate = explode('.',$rating);
                            @endphp
                            @for ($i = 1; $i <= $arrRate[0]; $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                            @if(isset($arrRate[1]) && $arrRate[1] > config('setting.display_rate_condition'))
                                <i class="fa fa-star-half-o"></i>
                            @endif
                        @else
                            @for ($i = 1; $i <= $product->rating; $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                        @endif
                        <span>({{ $countReview }} {{ trans('messages.reviews') }})</span>
                    </div>
                    <div class="product__details__price">
                        ${{ $price }}
                        @if (!empty($product->sales->toArray()))<span>${{ $product->price }}</span>@endif
                    </div>
                    <p>{{ $product->description }}</p>
                    {!! Form::open(['method' => 'POST', 'url' => 'cart', 'class' => 'form-cart']) !!}
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                {!! Form::text('amount', '1', []) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::hidden('product_id', $product->id, []) !!}
                    {!! Form::submit(trans('messages.add_to_cart'), ['class' => 'primary-btn']) !!}
                    {!! Form::close() !!}
                    <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                    <ul>
                        <li><b>{{ trans('messages.availability') }}</b> <span>{{ $product->status }}</span></li>
                        <li><b>{{ trans('messages.shipping') }}</b> <span>{{ trans('messages.1_day_shipping') }}<samp>{{ trans('messages.free_pickup') }}</samp></span></li>
                        <li><b>{{ trans('messages.share_on') }}</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                aria-selected="false">{{ trans('messages.infomation') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                aria-selected="false">{{ trans('messages.reviews') }} <span>({{ $countReview }})</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-2" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>{{ trans('messages.product_infomation') }}</h6>
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <div class="rating" data-product-id={{ $product->id }}
                                    data-user-id="{{ Auth::check() ? Auth::user()->id : '' }}">
                                    @for ($i = 5; $i >= 1; $i--)
                                    @php $j = $i - 1 == 0 ? '' : $i - 1; $haft = $i - 1 + 0.5; @endphp
                                    <input class="star" type="radio" id="star{{$i}}" name="rating" value="{{$i}}" />
                                    <label class= "full" for="star{{$i}}"></label>

                                    <input class="star" type="radio" id="star{{$j}}half" name="rating" value="{{$haft}}" />
                                    <label class="half" for="star{{$j}}half"></label>
                                    @endfor
                                </div><br><br><br>
                                {!! Form::open(['method' => 'POST', 'url' => 'rating']) !!}
                                {!! Form::hidden('point', '5', ['id' => 'input-point']) !!}
                                {!! Form::hidden('product_id', $product->id, []) !!}
                                <div class="review-box">
                                    <div class="checkout__input">
                                        {!! Form::text('content', '', ['placeholder' => trans('messages.content_review')]) !!}
                                    </div>
                                    {!! Form::submit('Submit', ['class' => 'site-btn place-order']) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <div class="comments-list">
                                @foreach ($reviews as $review)
                                <div class="media">
                                    <div class="media-left">
                                        <div class="media-object">
                                        <img src="/assets/img/user/{{ $review->user->avatar }}" alt="">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ $review->user->fullname }}&nbsp;
                                            <span>({{ $review->rating_point }}&#9733;)</span>
                                        </h4>
                                        <div>{{ $review->content }}</div>
                                    </div>
                                </div>
                                @endforeach


                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->
<style>

</style>
<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>{{ trans('messages.related_products') }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($relatedProducts as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="/assets/img/product/{{ $product->picture }}">
                        <ul class="product__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                    <h6><a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></h6>
                        <h5>${{ $product->price }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Related Product Section End -->
@endsection
