@extends('default')
@section('contents')
    <h1>添加商家分类</h1>
    @include('_error')
    <form action="{{ route('shops.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInput1">店铺名称</label>
            <input type="text" name="shop_name"  value="{{ old('shop_name') }}" class="form-control" id="exampleInput1" placeholder="shop_name">
        </div>
        <div class="form-group">
            <label>店铺分类</label>
            <select name="shop_category_id" class="form-control">
                @foreach($shop_categories as $shop_category)
                    <option value="{{ $shop_category->id }}">{{ $shop_category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>店铺图片</label>
            <input type="file" name="shop_img">
        </div>
        <div class="form-group">
            <label for="exampleInput2">店铺评分</label>
            <input type="text" name="shop_rating"  value="{{ old('shop_rating') }}" class="form-control" id="exampleInput2" placeholder="shop_ratinge">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="brand" value="1"> 是否品牌
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="on_time" value="1"> 是否准时达
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="fengniao" value="1"> 是否蜂鸟配送
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="bao" value="1"> 是否保标记
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="piao" value="1"> 是否票标记
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="zhun" value="1"> 是否准标记
            </label>
        </div>
        <div class="form-group">
            <label for="exampleInput3">起送金额</label>
            <input type="number" name="start_send"  value="{{ old('start_send') }}" class="form-control" id="exampleInput3" placeholder="start_send">
        </div>
        <div class="form-group">
            <label for="exampleInput4">配送费</label>
            <input type="number" name="send_cost"  value="{{ old('send_cost') }}" class="form-control" id="exampleInput4" placeholder="send_cost">
        </div>
        <div class="form-group">
            <label for="exampleInput5">店公告</label>
            {{--<input type="text" name="notice"  value="{{ old('notice') }}" class="form-control" id="exampleInput5" placeholder="notice">--}}
            <textarea class="form-control" rows="3" name="notice" placeholder="notice">{{ old('notice') }}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInput6">优惠信息</label>
            {{--<input type="text" name="notice"  value="{{ old('notice') }}" class="form-control" id="exampleInput6" placeholder="notice">--}}
            <textarea class="form-control" rows="3" name="discount" placeholder="discount">{{ old('discount') }}</textarea>

        </div>
        <div class="radio">
            <label>
                <input type="radio" name="status" id="optionsRadios1" value="0">正常
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="status" id="optionsRadios1" value="0">待审核
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="status" id="optionsRadios1" value="-1">禁用
            </label>
        </div>
        <div class="form-group">
            <label>验证码</label>
            <input id="captcha" class="form-control" name="captcha" >
            <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@endsection