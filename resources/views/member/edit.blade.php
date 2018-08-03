@extends('default')
@section('contents')
    <form action="{{ route('members.update',[$member]) }}" method="post">
        @include('_error')
        <div class="form-group">
            <label for="exampleInput1">用户名</label>
            <input type="text" name="username"  value="{{ $member->username }}" class="form-control" id="exampleInput1" placeholder="username">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">电话号码</label>
            <input type="tel" name="tel" value="{{ $member->tel }}" class="form-control" id="exampleInputEmail1" placeholder="tel">
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