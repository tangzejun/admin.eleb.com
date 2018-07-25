@extends('default')
@section('contents')
    <table class="table table-bordered table-hover">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>邮箱</th>
            <th>操作</th>
        </tr>
        @foreach($admins as $admin)
        <tr>
            <td>{{ $admin->id }}</td>
            <td>{{ $admin->name }}</td>
            <td>{{ $admin->email }}</td>
            <td>
                <a href="{{ route('admins.edit',[$admin]) }}">
                    <button class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></button>
                </a>
                <form action="{{ route('admins.destroy',[$admin]) }}" method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                </form>
                <a href="{{ route('admins.show',[$admin]) }}">
                    <button class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </a>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="17" style="text-align: center">
                <a href="{{ route('admins.create') }}"><span class="glyphicon glyphicon-plus"></span></a>
            </td>
        </tr>
    </table>
    {{ $admins->links() }}
@endsection