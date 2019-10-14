@extends('layout.layui')

@section('title')
    品牌 展示
@endsection


@section('content')
<div align="center">
    <h2>标签列表</h2>
</div>
<div align="center">
    <button><a href="/wechat/sign">增加标签</a></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button><a href="/wechat/fans">粉丝列表</a></button>
</div>
<table class="layui-table" border="1" align="center">
    <colgroup>
        <col width="150">
        <col width="200">
        <col>
    </colgroup>
    <thead>
    <tr>
        <th align="center">编号</th>
        <th align="center">名称</th>
        <th align="center">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sign as $k=>$v)
        <tr>
            <td align="center">{{$v['id']}}</td>
            <td align="center">{{$v['name']}}</td>
            <td align="center">
                <buttion><a href="/wechat/delsign?id={{ $v['id'] }}">删除标签</a></button> ||
                <buttion><a href="/wechat/updatesign?id={{ $v['id'] }}&name={{$v['name']}}">修改标签</a></button> ||
                <buttion><a href="/wechat/tagfans?id={{ $v['id'] }}">标签粉丝</a></button> ||
                <buttion><a href="/wechat/fans?id={{ $v['id'] }}">为粉丝打标签</a></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
