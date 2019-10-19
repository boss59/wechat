@extends('layout.layui')

@section('title')
    菜单 添加
@endsection


@section('content')
    <marquee><h2><font color='blue'>菜单管理</font></h2></marquee>
   <center>
        <form  action="{{ url('/wechat/menu_create') }}" method="post">
        @csrf
            菜单等级：<select name="type">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select><br /><br />

            <div id="first_name">
                一级菜单名称: <input type="text" name="first_name">
            </div><br>

            <div id="name" style="display: none;">
                一级菜单名称:<select name="name">
                @foreach($menu as $k=>$v)
                    <option value="{{ $v->mid }}">{{ $v->name }}</option>
                @endforeach
                </select><br><br>
                二级菜单名称:<input type="text" name="second_name"><br /><br />
            </div>

            <div id="event">
            菜单类型:<select name="event">
                <option value="click">click</option>
                <option value="view">view</option>
            </select><br/><br/>
            菜单事件值：<input type="text" name="event_key"><br /><br />
            </div>

            <input type="submit" class="layui-btn layui-btn-normal" value="立即提交">
        </form>
   </center>

    <script>
        $(function(){
            $(function(){
                $("select[name=type]").change(function(){
                    var type_val=$(this).val();
                    if (type_val==2) {
                        $('#event').show();
                        $('#first_name').hide();
                        $('#name').show();
                    }else if(type_val==1) {
                        $('#event').show();
                        $('#first_name').show();
                        $('#name').hide();
                    }else if(type_val==3) {
                        $('#event').hide();
                        $('#first_name').show();
                        $('#name').hide();
                    }
                })
            })
        });
    </script>
@endsection