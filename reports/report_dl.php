<html>
<head>
<style>
div.header-dl {
    display: block; text-align: center; 
    position: running(header);
}
div.footer-dl {
    display: block; text-align: center;
    position: running(footer);
}
@page {
    @top-center { content: element(header-dl) }
}
@page { 
    @bottom-center { content: element(footer-dl) }
}
</style>
</head>
<body>
    <div class='header-dl'>Header</div>
    <div class='footer-dl'>Footer</div>
</body>
</html>