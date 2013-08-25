var op=document.getElementsByTagName("input");
for(var i=0;i<op.length;i++){
	op[i].addEventListener("focus",function(){
			ID=this;
                        ID.style.borderColor="#01A9DB";
                        ID.style.borderStyle="2px solid";
        });
	op[i].addEventListener("blur",function(){
			ID=this;
                        ID.style.borderColor="#FFFFFF";
        });
}
var op=document.getElementsByTagName("textarea");
for(var i=0;i<op.length;i++){
	op[i].addEventListener("focus",function(){
			ID=this;
                        ID.style.borderColor="#01A9DB";
                        ID.style.borderStyle="2px solid";
        });
	op[i].addEventListener("blur",function(){
			ID=this;
                        ID.style.borderColor="#FFFFFF";
        });
}
var op=document.getElementsByTagName("select");
for(var i=0;i<op.length;i++){
	op[i].addEventListener("focus",function(){
			ID=this;
                        ID.style.borderColor="#01A9DB";
                        ID.style.borderStyle="2px solid";
        });
	op[i].addEventListener("blur",function(){
			ID=this;
                        ID.style.borderColor="#FFFFFF";
        });
}



var $_GET=[];
window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(a,name,value){$_GET[name]=value;});
if($_GET['id']=='reg'){
    
var lab = document.getElementsByTagName("label");
for (var i=0;i<lab.length;i++){
	lab[i].addEventListener("mouseover", function() {this.className='hov';});
	lab[i].addEventListener("mouseout", function() {this.className='';});
}
    
    
    
    
    var grad = [];
    $.getJSON("podaci/gradovi.json", function(data){
        for (var i=0, len=data.length; i < len; i++) {
                    grad[i]=data[i];
        }
    });
    $( "#grad" ).autocomplete({
        source: grad
    })
}
else if(location.pathname.substring(1).split("/")[3]=='dokumentacija.html' || $_GET['Jsearch'] || $_GET['search'] || $_GET['id']=='Kpocetna' || $_GET['id']=='kosarica'  || $_GET['id']=='odjavio' || !$_GET['id'] || $_GET['id']=='suveniri' || $_GET['id']=='galerija'){
    $(document).ready(function() {
        $('#ludaTAB').dataTable({'bFilter': false}); 
    });
}
else if($_GET['id']=='eksponat'){
    $(document).ready(function() {
		$(".fancybox").fancybox();
	});
}