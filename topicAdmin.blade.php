@extends('app')

@section('head')
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/css/alert.css">
    <script src="/js/jquery-3.0.0.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <style>
        .jumbotron{
            background-image: url(../images/bg.jpg);
            background-position: center;
            background-size: cover;
        }
        .jumbotron h2{
            color: #ffffff;
        }
    </style>
    <script>
        function auto()
        {

//            location.href='http://localhost:8000/admin/activity';
        }
        window.onload=auto();
    </script>
@stop

@section('body')
    <div class="jumbotron">
        <div class="container">
            <h2>话题管理</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">


            @foreach( $result as $res )
                <h2 class="" role="button" data-toggle="collapse" href="#{{ $res->topicId }}" aria-expanded="false" aria-controls="{{ $res->topicId }}">
                    {{ $res->title }}
                </h2>
                <div class="collapse" id="{{ $res->topicId }}">
                    <div class="well">
                        <div class="form-group">
                            <label for="exampleInputName2">
                                <h4><a href="{{ url('/admin/topic/edit',$res->topicId) }}">编辑</a></h4>
                                <h4><a href="{{ url('/admin/comment/edit',$res->topicId) }}">管理</a></h4>
                                <h4 style="color: #ff0000;" onclick="checkDel('{{ $res->topicId }}')">删除</h4>
                            </label>
                        </div>
                    </div>
                </div>
            @endforeach

            <h2 class="" role="button" data-toggle="collapse" href="#add" aria-expanded="false" aria-controls="add" style="color: #269abc;text-align: center">
                添加话题
            </h2>
            <div class="collapse" id="add">
                <div class="well">
                    <form class="form-inline" action='/admin/kind/add' method='post'>
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <a href="/admin/topic/addTextTopic">普通话题</a>
                            <br>
                            <a href="/admin/topic/addImageTopic">可图片评论话题</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <form method="post" action="kind/delete" id="deleteForm">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input name="kindId" id='kindId' value="" type="hidden">
    </form>

    <div class="alertBg" style="display: none;" id="alertBg">
        <div class="menu">
            <div class="menuHead">确定要删除吗?</div>
            <div class="menuBody">
                <div class="leftBtn" onclick="hideAlert()">取消</div>
                <div class="rightBtn" onclick="del()">删除</div>
            </div>
        </div>
    </div>

    <script>
        var delId;
        function checkDel(obj)
        {
            document.getElementById('alertBg').style.display = 'block';
            delId = obj;
        }
        function hideAlert()
        {
            document.getElementById('alertBg').style.display = 'none';
        }
        function del(){
            document.getElementById('kindId').value = delId;
            document.getElementById('deleteForm').submit();
        }
    </script>
@stop