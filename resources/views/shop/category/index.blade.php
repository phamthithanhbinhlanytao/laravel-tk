@extends('shop.category.master')
@section('category_title')
    {{ trans('messages.products') }}
@endsection
@section('category_content')
@foreach ($products as $product)
<div class="col-lg-4 col-md-6 col-sm-6">
    <div class="product__item">
        <div class="product__item__pic set-bg" data-setbg="/assets/img/product/{{ $product->picture }}">
            <ul class="product__item__pic__hover">
                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                <li><a href="{{ route('shop.cart.fasting_add', $product->id) }}"><i class="fa fa-shopping-cart"></i></a></li>
            </ul>
        </div>
        <div class="product__item__text">
            <h6><a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></h6>
            <h5>${{ $product->price }}</h5>
        </div>
    </div>
</div>
@endforeach
@endsection
