@extends('shop.master')
@section('title')
    {{ trans('messages.order') }}
@endsection
@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="/assets/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>@lang('messages.checkout')</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ route('shop.index.index') }}">Home</a>
                        <span>@lang('messages.checkout')</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6><span class="icon_tag_alt"></span>
                    @lang('messages.have_a_coupon')
                    <a href="#">@lang('messages.click_here')</a> @lang('messages.to_enter_your_code')
                </h6>
            </div>
        </div>
        @include('common.errors')
        <div class="checkout__form">
            <h4>@lang('messages.billing_detail')</h4>
            {!! Form::open(['method' => 'POST', 'route' => 'order.store']) !!}
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="checkout__input">
                            <p>@lang('messages.full_name')<span>*</span></p>
                            {!! Form::text('fullname', Auth::check() ? Auth::user()->fullname : '', []) !!}
                        </div>
                        <div class="checkout__input">
                            <p>@lang('messages.address')<span>*</span></p>
                            {!! Form::text('address', Auth::check() ? Auth::user()->address : '', ['class' => 'checkout__input__add', ]) !!}
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>@lang('messages.phone')<span>*</span></p>
                                    {!! Form::text('phone', Auth::check() ? Auth::user()->phone : '', []) !!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    {!! Form::text('', Auth::check() ? Auth::user()->email : '', ['disabled']) !!}
                                    {!! Form::hidden('email', Auth::check() ? Auth::user()->email : '', []) !!}
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>@lang('messages.order_note')</p>
                            {!! Form::text('note', '', ['placeholder' => trans('messages.order_note_message')]) !!}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>@lang('messages.your_order')</h4>
                            <div class="checkout__order__products">
                                @lang('messages.products') <span>@lang('messages.total')</span>
                            </div>
                            <ul>
                                @php $total = 0; @endphp
                                @foreach (Cart::content() as $product)
                                @php
                                    $price = $product->price * $product->qty;
                                    $total += $price;
                                @endphp
                                <li>
                                    {{ $product->name }}&nbsp;<span>({{ $product->qty }})</span>
                                    <span>${{ $price }}</span>
                                </li>
                                @endforeach
                            </ul>
                            <div class="checkout__order__subtotal">@lang('messages.sub_total') <span>$0</span></div>
                            <div class="checkout__order__total">@lang('messages.total') <span>${{ $total }}</span></div>
                            {!! Form::hidden('total', $total, []) !!}
                            {!! Form::submit(trans('messages.place_order'), ['class' => 'site-btn place-order']) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>
<!-- Checkout Section End -->
@endsection
