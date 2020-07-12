@extends('shop.master')
@section('title')
    {{ trans('messages.cart') }}
@endsection
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/assets/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ trans('messages.your_cart') }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('shop.index.index') }}">{{ trans('messages.home') }}</a>
                            <span>{{ trans('messages.cart') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        @if (empty(Cart::content()->toArray()))
                        <div class="alert alert-success" role="alert">
                            {{ trans('messages.cart_empty') }}
                        </div>
                        @endif
                        <table class="{{ empty(Cart::content()->toArray()) ? 'disappear' : '' }}">
                            <thead>
                                <tr>
                                    <th class="shoping__product">{{ trans('messages.product') }}</th>
                                    <th>{{ trans('messages.price') }}</th>
                                    <th>{{ trans('messages.quantify') }}</th>
                                    <th>{{ trans('messages.total') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                {!! Form::open(['method' => 'POST', 'route' => 'shop.cart.cart_update']) !!}
                                @foreach (Cart::content() as $product)
                                @php
                                    $price = $product->price * $product->qty;
                                    $total += $price;
                                @endphp
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="/assets/img/product/{{ $product->options->picture }}">
                                        <h5>{{ $product->name }}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        ${{ $product->price }}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                {!! Form::text('amount_'.$product->id, $product->qty, []) !!}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        ${{ $price }}
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a class="item-remove" href="{{ route('shop.cart.remove', $product->id) }}" data-confirm="{{ trans('messages.confirm_remove') }}">
                                            <span class="icon_close"></span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                {!! Form::submit('', ['class' => 'btn-update-cart disappear']) !!}
                                {!! Form::close() !!}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('category.index') }}" class="primary-btn cart-btn">{{ trans('messages.continue_shopping') }}</a>
                        <a href="javascript:void(0)"
                            class="primary-btn cart-btn cart-btn-right update-cart {{ empty(Cart::content()->toArray()) ? 'disappear' : '' }}">
                            {{ trans('messages.update_cart') }}
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>{{ trans('messages.discount_codes') }}</h5>
                            <form action="#">
                                <input type="text" placeholder="{{ trans('messages.enter_your_coupon') }}">
                                <button type="submit" class="site-btn">{{ trans('messages.apply_coupons') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>{{ trans('messages.cart_total') }}</h5>
                        <ul>
                            <li>{{ trans('messages.sub_total') }} <span>$0</span></li> <!-- Update when create apply coupon func -->
                            <li>{{ trans('messages.total') }} <span>${{ $total }}</span></li>
                        </ul>
                        <a href="{{ route('order.index') }}" class="primary-btn">{{ trans('messages.proceed_to_checkout') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection
