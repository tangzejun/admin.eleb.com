@extends('default')
@section('contents')

    <a href="{{route('statistics.menu')}}"><button class="btn btn-info">菜品统计</button></a>
    <hr>
    <form action="statistics" method="get">
        <input type="date"name="date">
        <input type="submit" value="查询">
    </form>
    <hr>
    按月查看
    <form action="{{route('statistics')}}" method="get">

        <select name="month">
            @for($i=1;$i<=12;$i++)
                <option value="{{$i}}">{{$i}}月</option>
            @endfor
        </select>
        <input type="submit" value="查询">
    </form>



  @foreach($shops as $shop)

    <table class="table table-bordered table-responsive">
       <h3>{{$shop->shop_name}}</h3>
        <tr>
            <th>店名</th>
            <th>订单数量</th>
        </tr>
        <tr>
            <td>
                {{$shop->shop_name}}
            </td>
            <td>
                {{$shop->sum}}
            </td>
        </tr>
    </table>
    @endforeach
   <h3>总计</h3>
    @foreach($data as $v)

        <table class="table table-bordered table-responsive">
            <h3>{{$v->shop_name}}</h3>
            <tr>
                <th>店名</th>
                <th>订单数量</th>
            </tr>
            <tr>
                <td>
                    {{$v->shop_name}}
                </td>
                <td>
                    {{$v->sum}}
                </td>
            </tr>
        </table>
    @endforeach



    @stop