@extends('default')
@section('contents')

    <a href="{{route('statistics')}}"><button class="btn btn-info">订单统计</button></a>
    <hr>
    <form action="{{route('statistics.menu')}}" method="get">
        <input type="date"name="date">
        <input type="submit" value="查询">
    </form>
    <hr>
    按月查看
    <form action="{{route('statistics.menu')}}" method="get">

        <select name="month">
            @for($i=1;$i<=12;$i++)
                <option value="{{$i}}">{{$i}}月</option>
            @endfor
        </select>
        <input type="submit" value="查询">
    </form>





        <table class="table table-bordered table-responsive">


            <tr>
                <th>店名</th>
                <th>菜品名</th>
                <th>销售数量</th>
            </tr>
            @foreach($shops as $shop)
            <tr>
                <td>
                    {{$shop->shop_name}}
                </td>
                <td>
                    {{$shop->goods_name}}
                </td>
                <td>
                    {{$shop->sum}}
                </td>
            </tr>
            @endforeach
        </table>

    {{--@foreach($data as $v)--}}

        {{--<table class="table table-bordered table-responsive">--}}
            {{--<h3>{{$v->shop_name}}</h3>--}}
            {{--<tr>--}}
                {{--<th>店名</th>--}}
                {{--<th>订单数量</th>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td>--}}
                    {{--{{$shop->shop_name}}--}}
                {{--</td>--}}
                {{--<td>--}}
                    {{--{{$v->sum}}--}}
                {{--</td>--}}
            {{--</tr>--}}
        {{--</table>--}}
    {{--@endforeach--}}



@stop