<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
    <title>MainPage</title>
    <style>
        *
        {
            padding: 0;
            border: none;
            margin: 0;
            font-family: "微软雅黑 Light","微软雅黑", arial,sans-serif;
        }
        textarea
        {
            border: none;
            outline: none;
        }
        .heading
        {
            position: relative;
            top: 0;
            left: 0;
            height: 230px;
            width: 100%;
            background: #3498db;
            background: url("/moonImages/images/2.jpg");
            background-position: center;
            background-size: cover;
            z-index: 5;
        }
        .title
        {
            position: absolute;
            top: 180px;
            height: 50px;
            padding-left: 5%;
            width: 95%;
            font-size: 30px;
            color: white;
            background: transparent;
            display: table;
            z-index: 6;
        }

        /*评论区*/
        .commentsarea
        {
            position: absolute;
            top: 230px;
            left: 0;
            width: 100%;
            padding-bottom: 15%;
        }
        .commentsPanel
        {
            position: relative;
            top: 5%;
            left: 5%;
            width: 90%;
            border-bottom: 1px solid gray;
        }
        .comments
        {
            position: relative;
            padding-top: 18px;
            padding-bottom: 10px;
            padding-left: 40px;
            padding-right: 60px;
            word-break:break-all;
        }
        .compic
        {
            position: relative;
            left: 10%;
            width: 80%;
        }
        .usericon
        {
            position: absolute;
            float: left;
            left: 4px;
            top: 14px;
            width: 32px;
            height: 32px;
        }
        .replyicon
        {
            position: relative;
            float: right;
            right: 8px;
            top: 14px;
            width: 24px;
            height: 24px;
        }
        .likeicon
        {
            position: relative;
            float: right;
            right: 4px;
            top: 14px;
            width: 24px;
            height: 24px;
        }
        .likenum
        {
            position: relative;
            float: right;
            right: -44px;
            top: 40px;
            font-size: 80%;
            width: 24px;
            text-align: center;
        }
        .username
        {
            position: relative;
            top: 0;
            left: 0;
            font-weight: bolder;
        }

        /*以下底部的‘添加评论’按钮*/
        .addcom
        {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 50px;
            background: #3498db;
            z-index: 2;
            display: table;
        }
        .addcomtxt
        {
            display: table-cell;
            vertical-align: middle;
            width: 100%;
            text-align: center;
            color: white;
            font-size: 20px;
        }

        /*以下是发布新评论的弹窗*/
        .block
        {
            background: rgba(255,255,255,0.5);
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 10;
        }
        .newcom
        {
            position: absolute;
            display: none;
            top: 0;
            height: 0;
            left: 5%;
            width: 90%;
            background: #3498db;
        }
        .closenewcom
        {
            width: 40px;
            height: 40px;
            float: right;
            background: #3498db;
        }
        .icn20-40
        {
            width: 20px;
            height: 20px;
            position: relative;
            top: 10px;
            left: 10px;
        }
        .newarea
        {
            position: relative;
            top: 0;
            left: 0;
            width: 90%;
            resize: none;
            font-size: 18px;
            word-break:break-all;
            height: 120px;
        }
        .newarea-out
        {
            position: relative;
            height: 205px;
            top: 40px;
            left: 5%;
            width: 88%;
            padding-left: 10px;
            padding-top: 10px;
            background: white;
        }
        
        /*以下为添加图片*/
        .addpicpanel
        {
            position: relative;
            height: 80px;
            width: 90%;
            top: 0;
            left: 0;
        }
        .addpicbtn
        {
            float: left;
            height: 70px;
            width: 70px;
            border: 1px solid #3498db;
            z-index: 20;
        }
        .addpicicon
        {
            position: relative;
            top: 10px;
            left: 10px;
            height: 50px;
            width: 50px;
        }
        .picpreview
        {
            float: left;
            height: 70px;
            width: 70px;
            border: 1px solid #3498db;
            margin-right: 10px;
            display: none;
        }

        /*以下为发布按钮*/
        .btn1
        {
            position: relative;
            background: transparent;
            top: 40px;
            left: 5%;
            width: 90%;
            height: 50px;
            display: table;
        }
        .btn1txt
        {
            display: table-cell;
            vertical-align: middle;
            color: white;
            text-align: center;
            font-weight: bold;
        }
        .text
        {
            width: 90%;
            margin-left: 5%;
        }
        .text img
        {
            width: 100%;
        }
    </style>
    @foreach( $result['topic'] as $topic )
    <style>
        .heading
        {
            background: url({{ $topic->image }});
            background-position: center;
            background-size: cover;
        }
    </style>
    @endforeach
</head>
<body>
    <div class="block" id="block">
        <div class="newcom" id="newcom">
            <div id="closenewcom" class="closenewcom">
                <img class='icn20-40' src="/moonImages/images/closeicon.png">
            </div>
            <div class="newarea-out">
                <textarea class="newarea" id="newarea" placeholder="Comment here"></textarea>
                <div class="addpicpanel">
                    <!-- 这是预览以及添加的部分 -->
                    <form id="myForm" action="/admin/comment/receive" method="post">
                    @foreach( $result['topic'] as $topic )
                    <input type="hidden" name="topicId" value="{{ $topic->topicId }}">
                    @endforeach
                    <input type='hidden' name='text' id='docInput' /> 
                    <input type=file name="doc" id="doc" style="display:none;" onchange="javascript:setImagePreview();">
                    </form>
                    <p><div id="localImag"><img class="picpreview" id="preview" width=-1 height=-1 style="diplay:none" /></div></p>
                    <!-- 这是分割线 -->
                    <div id="addpicbtn" class="addpicbtn" onclick='javascript:$("#doc").click();'><!-- 转移事件本体 -->
                        <img class="addpicicon" src="/moonImages/images/jiahao.png" />
                    </div>
                </div>
            </div>
            <div class="btn1" id="btn1" onclick="addnewcom('zzz')">
                <div class="btn1txt">Release</div>
            </div>
        </div>
    </div>
    <div id="others">
        <div class="heading" id="heading"></div>
        <div class="title" id="title"><div style="display:table-cell;vertical-align:middle;">This is a title</div></div>
        <div class="addcom">
            <div class="addcomtxt" id="add">
                <img src="/moonImages/images/pinglun.png" style="vertical-align: middle"/>
                Add new comments
            </div>
        </div>
        <div class="commentsarea" id="commentsarea">
            <br>
            <br>
            @foreach( $result['topic'] as $topic )
                <div class="text"><?php echo $topic->text; ?></div>
            @endforeach
            <br>
            <br>
            @foreach( $result['comments'] as $res )
                <div class="commentsPanel">
                    <img class="usericon" src="/moonImages/images/yonghu.png">
                    <img class="likeicon" src="/moonImages/images/dianzan.png">
                    <img class="replyicon" src="/moonImages/images/huifu.png">
                    <div class="likenum">0</div>
                    <div class="comments">
                        <div class="username">username</div>
                        {{ $res->text }}
                    </div>
                    @if( $res->image != 'none' )
                        <img class="compic" src="{{ $res->image }}">
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
<script src="/js/jquery-3.0.0.js"></script>
<script src="/js/jquery.form.js"></script>
<script>
    $("#add").click(function()
    {
        $("#newcom").show();
        $(document.body).css({
            "overflow-x":"hidden",
            "overflow-y":"hidden"
        });
        $("#newcom").animate({top:'-305px',height:'305px'},0,function(){
            $("#newcom").animate({top:'25%'},200);
            $("#block").show();
            $("#closenewcom").show();
        });
    });
    $("#closenewcom").click(function()
    {
        $(document.body).css({
            "overflow-x":"auto",
            "overflow-y":"auto"
        });
        $("#newcom").animate({top:'-305px'},200,function(){
            $("#newcom").animate({top:'0',height:'0'},0);
            $("#block").hide();
            $("#newcom").hide();
            $("#closenewcom").hide();
        });
        $("#others").show();
    });
    $('#btn1').on('click',(function(e)
    {
        document.getElementById('docInput').value = document.getElementById('newarea').value;
        if((document.getElementById("docInput").value=="") && (document.getElementById("doc").value==""))
        {
            alert('请输入内容');
        }
        else
        {
            $('#myForm').ajaxSubmit({
                        success : function(returnData){
                            if (returnData.result == 'success')
                            {
                                alert('success');
                                addNew('username');
                            }
                        },fail:function(){
                            alert(0);
                        }}
            );
        }
    }));
    //release事件
    function addNew(username1)
    {
        var parent=document.getElementById("commentsarea");

        var companel=document.createElement("div");
        companel.setAttribute("class","commentsPanel");

        var user=document.createElement("img");
        user.setAttribute("class","usericon");
        user.src="/moonImages/images/yonghu.png";

        var like=document.createElement("img");
        like.setAttribute("class","likeicon");
        like.src="/moonImages/images/dianzan.png";

        var reply=document.createElement("img");
        reply.setAttribute("class","replyicon");
        reply.src="/moonImages/images/huifu.png";

        var likenum=document.createElement("div");
        likenum.setAttribute("class","likenum");
        var num=document.createTextNode("0");
        likenum.appendChild(num);

        var comments=document.createElement("div");
        comments.setAttribute("class","comments");
        var username=document.createElement("div");
        username.setAttribute("class","username");
        var name=document.createTextNode(username1);
        username.appendChild(name);
        comments.appendChild(username);
        var txt=document.createTextNode(document.getElementById("newarea").value);
        comments.appendChild(txt);

        var pic=document.createElement("img");
        pic.setAttribute("class","compic");
        pic.src=document.getElementById("preview").src;

        companel.appendChild(user);
        companel.appendChild(like);
        companel.appendChild(reply);
        companel.appendChild(likenum);
        companel.appendChild(comments);
        companel.appendChild(pic);

        parent.appendChild(companel);



        document.getElementById("preview").src="";
        document.getElementById("preview").style.display="none";
        document.getElementById("newarea").value="";
        document.getElementById("addpicbtn").style.opacity="1";
        document.getElementById("addpicbtn").style.float="left";

        document.getElementById("closenewcom").click();

    }

    //输入框获得焦点上浮，保证不遮住键盘
    $("#newarea").focus(function()
    {
        //var pixel = document.documentElement.scrollTop || document.body.scrollTop;
        $("#others").hide();
        var top = document.documentElement.scrollTop || document.body.scrollTop;
        top=0;
        $("#newcom").animate({top: '140px'},100);
    });

    //滚动监听-暂时搁置
    // window.onscroll = function()
    // {
    //     var top = document.documentElement.scrollTop || document.body.scrollTop;
    //     if(top>=130)
    //     {
    //         document.getElementById("title").style.position="fixed";
    //         document.getElementById("title").style.top="50px";
    //         document.getElementById("heading").style.position="fixed";
    //         document.getElementById("heading").style.top="-130px";
    //     }
    //     else
    //     {
    //         document.getElementById("title").style.position="absolute";
    //         document.getElementById("title").style.top="180px";
    //         document.getElementById("heading").style.position="absolute";
    //         document.getElementById("heading").style.top="0";
    //     }
    // }

    // 上传图片预览
    function setImagePreview()
    {
        if(document.getElementById("addpicbtn").style.display=="none")
        {
            document.getElementById("doc").click();
        }
        else
        {
            var docObj=document.getElementById("doc");  
            var imgObjPreview=document.getElementById("preview");  
            if(docObj.files && docObj.files[0])
            {  
                //火狐下，直接设img属性  
                imgObjPreview.style.display = 'block';  
                imgObjPreview.style.width = '70px';  
                imgObjPreview.style.height = '70px';                      
                //imgObjPreview.src = docObj.files[0].getAsDataURL();  
                  
                //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要以下方式    
                imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);  
            }
            else
            {  
                //IE下，使用滤镜  
                docObj.select();  
                var imgSrc = document.selection.createRange().text;  
                var localImagId = document.getElementById("localImag");  
                //必须设置初始大小  
                localImagId.style.width = "70px";  
                localImagId.style.height = "70px";  
                //图片异常的捕捉，防止用户修改后缀来伪造图片  
                try
                {  
                    localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";  
                    localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;  
                }
                catch(e)
                {  
                    alert("您上传的图片格式不正确，请重新选择!");  
                    return false;  
                }  
                imgObjPreview.style.display = 'none';  
                document.selection.empty();  
            }  
            document.getElementById("addpicbtn").style.opacity="0";
            document.getElementById("addpicbtn").style.float="none";
            return true;  
        }
    }
</script>