@extends('default')
@section('contents')
    <table class="table table-bordered table-hover">
        <tr>
            <th>会员ID</th>
            <th>用户名</th>
            <th>电话号码</th>
            <th>操作</th>
        </tr>
        @foreach($members as $member)
        <tr>
            <td>{{ $member->id }}</td>
            <td>{{ $member->username }}</td>
            <td>{{ $member->tel }}</td>
            <td>
                <a href="{{ route('members.edit',[$member]) }}">
                    <button class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></button>
                </a>
                <form action="{{ route('members.destroy',[$member]) }}" method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                </form>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="17" style="text-align: center">
                <a href="{{ route('members.create') }}"><span class="glyphicon glyphicon-plus"></span></a>
            </td>
        </tr>
    </table>
    {{ $members->links() }}
@endsection