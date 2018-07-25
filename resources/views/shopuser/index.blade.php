@extends('default')
@section('contents')
    <table class="table table-bordered table-hover">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>邮箱</th>
            <th>状态</th>
            <th>所属商家</th>
            <th>操作</th>
        </tr>
        @foreach($shopusers as $shopuser)
        <tr>
            <td>{{ $shopuser->id }}</td>
            <td>{{ $shopuser->name }}</td>
            <td>{{ $shopuser->email }}</td>
            <td>{{ $shopuser->status==1?'启用':'禁用' }}</td>
            <td>{{ $shopuser->shop->shop_name}}</td>
            <td>
                <a href="{{ route('shopusers.edit',[$shopuser->id]) }}">
                    <button class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></button>
                </a>
                <form action="{{ route('shopusers.destroy',[$shopuser]) }}" method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                </form>
                <a href="{{ route('shopusers.show',[$shopuser]) }}">
                    <button class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </a>
                <div>
                    <a href="{{ route('shopusers.reset',[$shopuser]) }}"><button class="btn btn-default"><span class="glyphicon glyphicon-edit"></span></button></a>
                </div>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="6" style="text-align: center">
                <a href="{{ route('shopusers.create') }}"><span class="glyphicon glyphicon-plus"></span></a>
            </td>
        </tr>
    </table>
    {{ $shopusers->links() }}
@endsection