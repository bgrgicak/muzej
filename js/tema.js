function temaEd(){
    var H=window.innerHeight;
    var W=window.innerWidth;
    var box=document.getElementById('box');
    box.style.width=W*0.9+'px';
    box.style.height=H*0.95+'px';
    delete box;
    
    document.getElementById('menuTop').style.width=(W*0.9)-10+'px';
    
    document.getElementById('menuLeft').style.height=(H*0.6)-23+'px';
    
    var main=document.getElementById('main');
    main.style.width=((W*0.9)-220)+'px';
    main.style.height=((H*0.95)-52)+'px';
    delete main;
    
    document.getElementById('foot').style.width=((W*0.9)-220)+'px';
    
    document.getElementById('menuRight').style.height=(H*0.6)-23+'px';
}
function temaFn() {
    document.write("<html>");
        document.write("<head>");
            document.write("<title>Muzej</title>");
            $('<link rel="stylesheet" href="css/temaJS.css" type="text/css" />').appendTo('html');
        document.write("</head>");
        document.write("<body class='BODY'>");
                document.write("<div id='box' class='box'>");

                document.write('<header id="menuTop" class="menuTop"></header>');

                document.write('<nav id="menuLeft" class="menuLeft"></nav>');

                document.write('<section id="main" class="main"></section>');

                document.write('<footer id="foot" class="foot"></footer>');

                document.write('<nav id="menuRight" class="menuRight"></nav>');

            document.write("</div>");
        document.write("</body>");
    document.write("</html>");
    temaEd();
    $(window).bind('resize', temaEd);
}
$(document).ready(temaFn);