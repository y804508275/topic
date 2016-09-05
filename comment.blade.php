@extends('app')

@section('head')
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/css/alert.css">
    <script src="/js/jquery-3.0.0.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <style>
        .jumbotron{
            background-image: url(/images/bg.jpg);
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


            @foreach( $comments as $comment )
                <p class="" role="button" data-toggle="collapse" href="#{{ $comment->commentId }}" aria-expanded="false" aria-controls="{{ $comment->commentId }}">
                    {{ $comment->text }}
                    <img src="{{ $comment->image }}" width="150px">
                </p>


                <div class="collapse" id="{{ $comment->commentId }}">
                    <div class="well">
                        <div class="form-group">
                            <label for="exampleInputName2">
                                <h4 style="color: #ff0000;" onclick="checkDel('{{ $comment->commentId }}')">删除</h4>
                            </label>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <form method="post" action="/admin/comment/delete" id="deleteForm">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input name="commentId" id='commentId' value="" type="hidden">
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
            document.getElementById('commentId').value = delId;
            document.getElementById('deleteForm').submit();
        }
    </script>
@stop