    <html>
   

<head>
        <title>每隔一定时间更换图片</title>
        <script language="javascript">
        Img = new Array("202002201039_1_cut.png", "202002201130_1_cut.png", "202002201230_1_cut.png",);
        size = Img.length;
        i = 0;

        function chImg() {
            picID.src = Img[i];
            i++;
            if (i >= size) i = 0;
            setTimeout("chImg()", 500);
        }
    </SCRIPT>
        </head>
   

<body onLoad="chImg()">
        <a href=""><img id="picID" border="0"></a>
        </body>
   

</html>