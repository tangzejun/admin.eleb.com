@extends('default')
@section('contents')
    <h1>{{ $activity->title }}</h1>
    <div>
        开始时间:
        {{ $activity->start_time }}
    </div>
    <div>
        结束时间:
        {{ $activity->end_time }}
    </div>
    <div>{!! $activity->content !!}</div>
@endsection