@extends('default')
@section('contents')
    <form action="{{ route('admins.update',[$admin]) }}" method="post">
        @include('_error')
        <div class="form-group">
            <label for="exampleInput1">名称</label>
            <input type="text" name="name"  value="{{ $admin->name }}" class="form-control" id="exampleInput1" placeholder="name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">邮箱</label>
            <input type="email" name="email" value="{{ $admin->email }}" class="form-control" id="exampleInputEmail1" placeholder="Email">
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