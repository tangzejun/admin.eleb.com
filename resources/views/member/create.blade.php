@extends('default')
@section('contents')
    <form action="{{ route('members.store') }}" method="post">
        @include('_error')
        <div class="form-group">
            <label for="exampleInput1">用户名</label>
            <input type="text" name="username"  value="{{ old('username') }}" class="form-control" id="exampleInput1" placeholder="username">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">电话号码</label>
            <input type="tel" name="tel" value="{{ old('tel') }}" class="form-control" id="exampleInputEmail1" placeholder="tel">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">密码</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword2">确认密码</label>
            <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2" placeholder="Password">
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