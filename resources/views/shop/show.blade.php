@extends('default')
@section('contents')
    <h1>{{ $shop->shop_name }}</h1>
    <img src="{{ $shop->shop_img }}" height="300" alt="">
    <div>{{ $shop->shop_category->name }}</div>
@endsection    