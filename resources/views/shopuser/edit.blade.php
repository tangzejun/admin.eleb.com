@extends('default')
@section('contents')
    <form action="{{ route('shopusers.update',[$shopuser]) }}" method="post">
        @include('_error')
        <div class="form-group">
            <label for="exampleInput1">名称</label>
            <input type="text" name="name"  value="{{ $shopuser->name }}" class="form-control" id="exampleInput1" placeholder="name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">邮箱</label>
            <input type="email" name="email" value="{{ $shopuser->email }}" class="form-control" id="exampleInputEmail1" placeholder="Email">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="status" value="{{ $shopuser->status }}" @if($shopuser->status==1)checked @endif> 启用
            </label>
        </div>
        <div class="form-group">
            <label>所属商家</label>
            <select name="shop_id" class="form-control">
                @foreach($shops as $shop)
                    <option value="{{ $shop->id }}" @if($shopuser->shop_id==$shop->id)selected @endif>{{ $shop->shop_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>验证码</label>
            <input id="captcha" class="form-control" name="captcha" >
            <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
        </div>
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@endsection