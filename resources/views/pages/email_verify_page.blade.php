@extends('layouts.app')
@section('title', '提示')

@section('content')
    <div class="panel panel-default col-md-8 col-md-offset-2">
        <div class="panel-heading">提示</div>
        <div class="panel-body text-center">
            <h1>请先验证邮箱</h1>
            <a class="btn btn-primary" href="{{ route('email_verified.send') }}">重新发送</a>
        </div>
        <p style="float: right"><a href="{{route('root')}}">返回首页</a></p>
    </div>
@endsection