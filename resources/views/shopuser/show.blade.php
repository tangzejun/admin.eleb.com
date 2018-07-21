@extends('default')
@section('contents')
    <div class="form-group">
        <label for="exampleInput1">名称</label>
        <input type="text" name="name"  value="{{ $shopuser->name }}" class="form-control" id="exampleInput1" placeholder="name">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">邮箱</label>
        <input type="email" name="email" value="{{ $shopuser->email }}" class="form-control" id="exampleInputEmail1" placeholder="Email">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">密码</label>
        <input type="password" name="password" value="{{ $shopuser->password }}" class="form-control" id="exampleInputPassword1" placeholder="Password">
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
@endsection