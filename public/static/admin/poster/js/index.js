$(function () {
    //初始化二维码位置
    if(InitImage){
        $('#pieceTargetImg1').attr('src',InitImage);
        $('.pieceImgBox1').css({
            'background':'url('+InitImage+')  no-repeat',
            'background-size':'100%'
        });
        $('.pieceImgBox1 .se').css({'display':'block'});
    }
    var _move=false;
    var _x,_y;
    var _semove=false;
    $(".pieceImgBox1").mousedown(function(e){
        _move=true;
        _x=e.pageX-parseInt($(".pieceImgBox1").css("left"));
        _y=e.pageY-parseInt($(".pieceImgBox1").css("top"));
    });
    $(document).mousemove(function(e){
        if(_move){
            var x=e.pageX-_x;//移动时根据鼠标位置计算控件左上角的绝对位置
            var y=e.pageY-_y;
            $(".pieceImgBox1").css({top:y,left:x});//控件新位置
        }
        if(_semove){
            var left=parseInt($(".pieceImgBox1").css("left"));
            $(".pieceImgBox1").css({width:e.pageX-20-left,height:e.pageX-20-left});
        }
    }).mouseup(function(){
        _move=false;
        _semove=false;
    });
    $(".pieceImgBox1 .se").mousedown(function(e){
        e.stopPropagation();
        _semove=true;
    });
    //合成图片
    $(document).on('click','.imgBtn',function () {
        var img1Width;
        var img1Height;
        var bgimgWidth;
        var bgimgHeight;
        var w1,h1,l1,t1,wBg,hBg;
        var img1=$('#pieceTargetImg1').attr('src');
        var bgimg=$('#backgroundImg').attr('src');
        if(bgimg!=undefined){
            bgimgWidth = document.getElementById('backgroundImg').naturalWidth;
            bgimgHeight = document.getElementById('backgroundImg').naturalHeight;
        }
        if(img1!=undefined){
            img1Width = document.getElementById('pieceTargetImg1').naturalWidth;
            img1Height = document.getElementById('pieceTargetImg1').naturalHeight;
            w1=$('.pieceImgBox1').width();
            h1=$('.pieceImgBox1').height();
            l1=$('.pieceImgBox1').css('left');
            t1=$('.pieceImgBox1').css('top');
            l1=l1.split('px');
            l1=l1[0];
            t1=t1.split('px');
            t1=t1[0];
        }
        var img1 = new Image();
        img1.src = $('#pieceTargetImg1').attr('src');
        var bgimg= new Image();
        bgimg.src = $('#backgroundImg').attr('src');
        var canvas = document.createElement("canvas");
        var ctx = canvas.getContext('2d');
        var base64;
        if(img1!=undefined){
            var w=$('.head').width();
            var h=$('.head').height();
            canvas.width = w;
            canvas.height = h;
            ctx.drawImage(bgimg, 0, 0, bgimgWidth, bgimgHeight,0,0,w,h);
            ctx.drawImage(img1, 0, 0, img1Width, img1Height,l1,t1,w1,h1);
            base64 = canvas.toDataURL('image/jpeg', 1);
            $("#jg").attr("src",base64);
        }
    });
    //上传图片
    $(document).on('click','.pieceImgModel .upImg1',function () {
        // openBrowseImg1()
        changeFileImgQRCode();
    });
    $(document).on('change','.pieceImgModel #pieceFileImg1',function(){
        // changeFileImg1()
        changeFileImgQRCode();
    });
    //上传背景图
    $(document).on('click','.upImg',function () {
        openBrowseImg()
    });
    $(document).on('change','#pieceFileImg',function(){
        changeFileImg()
    });

    function changeFileImgQRCode(){
        $.post("{:url('upload/getQRCode')}",{
            id:id,
        },function(res){
            if(res.status == 1){
                var  url = "/"+res.data;
                $('#pieceTargetImg1').attr('src',url);
                $('.pieceImgBox1').css({
                    'background':'url('+url+')  no-repeat',
                    'background-size':'100%'
                });
                $('.pieceImgBox1 .se').css({'display':'block'});
            }else{
                layer.msg(res.message);
            }
        });
        return false;
    }
    function getFileUrlImg(sourceId) {
        var url;
        if (navigator.userAgent.indexOf("MSIE")>=1) { // IE
            url = document.getElementById(sourceId).value;
        } else if(navigator.userAgent.indexOf("Firefox")>0) { // Firefox
            url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0));
        } else if(navigator.userAgent.indexOf("Chrome")>0) { // Chrome
            url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0));
        } else if(navigator.userAgent.indexOf("Safari")>0) { // Chrome
            url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0));
        }
        return url;
    }
    //图片上传
    function openBrowseImg1(){
        var ie=navigator.appName=="Microsoft Internet Explorer" ? true : false;
        if(ie){
            document.getElementById("pieceFileImg1").click();
        }else{
            var a=document.createEvent("MouseEvents");
            a.initEvent("click", true, true);
            document.getElementById("pieceFileImg1").dispatchEvent(a);
        }
    }
    function openBrowseImg(){
        var ie=navigator.appName=="Microsoft Internet Explorer" ? true : false;
        if(ie){
            document.getElementById("pieceFileImg").click();
        }else{
            var a=document.createEvent("MouseEvents");
            a.initEvent("click", true, true);
            document.getElementById("pieceFileImg").dispatchEvent(a);
        }
    }
    function changeFileImg() {
        var url = getFileUrlImg("pieceFileImg");
        $('#backgroundImg').attr('src',url);
        $('.head').css({
            'background':'url('+url+') no-repeat ',
            'background-color':'aquamarine',
            'background-size':'100%'
        });
        return false;
    }
    function changeFileImg1() {
        var url = getFileUrlImg("pieceFileImg1");
        //手动创建一个Image对象
        var img = new Image();
        //创建Image的对象的url
        img.src = url ;
        img.onload = function () {
            var onLoadHeight = (Math.round(logo_width/this.width * 100)/100)*this.height;
            onLoadHeightData[1] = (Math.round(this.height/this.width * 100)/100);
            $(".pieceImgBox1").css('height',onLoadHeight+'px');
        };
        $('#pieceTargetImg1').attr('src',url);
        $('.pieceImgBox1').css({
            'background':'url('+url+')  no-repeat',
            'background-size':'100%'
        });
        $('.pieceImgBox1 .se').css({'display':'block'});
        return false;
    }
});