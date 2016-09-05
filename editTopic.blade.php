@extends('app')

@section('head')
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
    <script src="/js/jquery-3.0.0"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="{{asset('/ueditor/ueditor.config.js')}}"></script>
    <script src="{{asset('/ueditor/ueditor.all.min.js')}}"></script>
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
@stop

@section('body')
    <div class="jumbotron">
        <div class="container">
            <h2>编辑话题</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div>
                <form action="/admin/topic/edit/submit" method="post" id="myForm" enctype="multipart/form-data">
                    @foreach( $result as $res )
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="kind" value="{{ $res->kind }}">
                    <input type="hidden" name="topicId" value="{{ $res->topicId }}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">标题</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="title" placeholder="标题" value="{{ $res->title }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">封面图片</label>
                        <input type="file" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">文章内容</label>
                        <div style="width: 100%;">
                            <script id="textEditor" type="text/plain" style="width:100%;height:500px;">
                                <?php echo $res->text; ?>
                            </script>
                        </div>
                        <input type="hidden" class="form-control" id="text" name="text" placeholder="活动亮点">
                    </div>
                    @endforeach
                    <div id="sub" onclick="sub(this)" class="btn btn-default">Submit</div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        //实例化编辑器
        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
        var ue = UE.getEditor('textEditor');


        function isFocus(e){
            alert(UE.getEditor('editor').isFocus());
            UE.dom.domUtils.preventDefault(e)
        }
        function setblur(e){
            UE.getEditor('editor').blur();
            UE.dom.domUtils.preventDefault(e)
        }
        function insertHtml() {
            var value = prompt('插入html代码', '');
            UE.getEditor('editor').execCommand('insertHtml', value)
        }
        function createEditor() {
            enableBtn();
            UE.getEditor('editor');
        }
        function getAllHtml() {
            alert(UE.getEditor('editor').getAllHtml())
        }
        function getContent() {
            var arr = [];
            arr.push(UE.getEditor('textEditor').getContent());
//            alert(arr.join("\n"));
            document.getElementById('text').value = arr;
        }
        function sub(obj)
        {
            getContent();
            var ifSub = 1;
            var inputArr = obj.parentNode.getElementsByTagName('input');
            var num = inputArr.length;
            for (var i=0;i<num;i++)
            {
                if (inputArr[i].value==''&&inputArr[i].type!='file')
                {
                    ifSub = 0;
                }
            }
            if (ifSub == 1) {
                document.getElementById('myForm').submit();
            }
            else
            {
                alert('请补全信息');
            }
        }
        function getPlainTxt() {
            var arr = [];
//            arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
//            arr.push("内容为：");
            arr.push(UE.getEditor('editor').getPlainTxt());
            alert(arr.join('\n'));
//            document.getElementById('editor')
        }
        function setContent(isAppendTo) {
            var arr = [];
            arr.push("使用editor.setContent('欢迎使用ueditor')方法可以设置编辑器的内容");
            UE.getEditor('editor').setContent('欢迎使用ueditor', isAppendTo);
            alert(arr.join("\n"));
        }
        function setDisabled() {
            UE.getEditor('editor').setDisabled('fullscreen');
            disableBtn("enable");
        }

        function setEnabled() {
            UE.getEditor('editor').setEnabled();
            enableBtn();
        }

        function getText() {
            //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
            var range = UE.getEditor('editor').selection.getRange();
            range.select();
            var txt = UE.getEditor('editor').selection.getText();
            alert(txt)
        }

        function getContentTxt() {
            var arr = [];
            arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
            arr.push("编辑器的纯文本内容为：");
            arr.push(UE.getEditor('editor').getContentTxt());
            alert(arr.join("\n"));
        }
        function hasContent() {
            var arr = [];
            arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
            arr.push("判断结果为：");
            arr.push(UE.getEditor('editor').hasContents());
            alert(arr.join("\n"));
        }
        function setFocus() {
            UE.getEditor('editor').focus();
        }
        function deleteEditor() {
            disableBtn();
            UE.getEditor('editor').destroy();
        }
        function disableBtn(str) {
            var div = document.getElementById('btns');
            var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
            for (var i = 0, btn; btn = btns[i++];) {
                if (btn.id == str) {
                    UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
                } else {
                    btn.setAttribute("disabled", "true");
                }
            }
        }
        function enableBtn() {
            var div = document.getElementById('btns');
            var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
            for (var i = 0, btn; btn = btns[i++];) {
                UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
            }
        }

        function getLocalData () {
            alert(UE.getEditor('editor').execCommand( "getlocaldata" ));
        }

        function clearLocalData () {
            UE.getEditor('editor').execCommand( "clearlocaldata" );
            alert("已清空草稿箱")
        }
    </script>
@stop