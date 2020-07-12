@extends('shop.master')
@section('title')
    @yield('category_title')
@endsection
@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="/assets/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>
                        {{ Route::current()->getName() != 'category.index' ? $categoryName : trans('messages.products') }}
                    </h2>
                    <div class="breadcrumb__option">
                        <a href="{{ Route('shop.index.index') }}">{{ trans('messages.home') }}</a>
                        <span>
                            {{ trans('messages.product') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>{{ trans('messages.price') }}</h4>
                        <div class="price-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="{{ isset($min_price) ? $min_price : config('setting.min_price') }}"
                                data-max="{{ isset($max_price) ? $max_price : config('setting.max_price') }}">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                            <div class="range-slider">
                                <div class="price-input">
                                    {!! Form::open(['method' => 'POST', 'route' => 'search.sort_byprice', 'id' => 'form-sort-price']) !!}
                                    <span>$</span>{!! Form::text('min_price', '', ['id' => 'minamount']) !!}
                                    <span>$</span>{!! Form::text('max_price', '', ['id' => 'maxamount']) !!}
                                    @if (isset($category_id))
                                        {!! Form::hidden('category_id', $category_id, []) !!}
                                    @endif
                                    {!! Form::submit(trans('messages.search'), ['class' => 'btn_search-price']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar__item">
                        <div class="latest-product__text">
                            <h4>@lang('messages.latest_product')</h4>
                            <div class="latest-product__slider owl-carousel">
                                @foreach ($latestProducts as $category)
                                    @if ($category->products->count() != 0)
                                    @php
                                        $count = $category->products->count() > 5 ? 5 : $category->products->count();
                                    @endphp
                                    <div class="latest-prdouct__slider__item">
                                        @for ($i = 0; $i <= $count - 1; $i++)
                                        <a href="{{ route('product.show', $category->products[$i]->id) }}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="/assets/img/product/{{ $category->products[$i]->picture }}">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ $category->products[$i]->name }}</h6>
                                                <span>${{ $category->products[$i]->price }}</span>
                                            </div>
                                        </a>
                                        @endfor
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="product__discount">
                    <div class="section-title product__discount__title">
                        <h2>{{ trans('messages.sale_off') }}</h2>
                    </div>
                    <div class="row">
                        <div class="product__discount__slider owl-carousel">
                            @foreach ($sales as $sale)
                            @php
                                $discount = $sale->sales[0]->discount;
                                $newPrice = $sale->price - $sale->price * $discount / 100;
                            @endphp
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg"
                                        data-setbg="/assets/img/product/{{ $sale->picture }}">
                                        <div class="product__discount__percent">-{{ $discount }}%</div>
                                        <ul class="product__item__pic__hover">
                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                            <li>
                                                <a href="{{ route('shop.cart.fasting_add', $sale->id) }}">
                                                <i class="fa fa-shopping-cart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <h5><a href="{{ route('product.show', $sale->id) }}">{{ $sale->name }}</a></h5>
                                        <div class="product__item__price">
                                            ${{ number_format($newPrice, 2, '.', '') }}
                                            <span>${{ $sale->price }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>@lang('messages.sort_by_price')</span>
                                @php $valueSort = !isset($type) ? 1 : ($type == 'DESC' ? 1 : 0) ; @endphp
                                {!! Form::open(['method' => 'POST', 'route' => 'search.sort_bytype']) !!}
                                {!! Form::select('sort_bytype', [
                                    0 => trans('messages.increase'),
                                    1 => trans('messages.decrease')
                                    ], $valueSort, ['onchange' => 'this.form.submit()']) !!}
                                @if (isset($category_id))
                                    {!! Form::hidden('category_id', $category_id, []) !!}
                                @endif
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span>{{ $products->count() }}</span>{{ trans('messages.product') }}</h6>
                            </div>
                        </div>
                        {{-- <div class="col-lg-4 col-md-3">
                            <div class="filter__option">
                                <span class="icon_grid-2x2"></span>
                                <span class="icon_ul"></span>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="row">
                    @yield('category_content')
                </div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->
@endsection
