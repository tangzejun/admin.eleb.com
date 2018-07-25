@extends('default')
@section('contents')
    <table class="table table-bordered table-hover">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>邮箱</th>
        </tr>
        <tr>
            <td>{{ $admin->id }}</td>
            <td>{{ $admin->name }}</td>
            <td>{{ $admin->email }}</td>
        </tr>
    </table>
@endsection