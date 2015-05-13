/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function DoSubmission() {

        document.MyForm.submit();

        }
function writeText(id,p)
{
    
//alert("id   "+id);
/*
var p1="<form name="+'"'+ "MyForm" +'"'+" action  = "+'"' +"foto-do-dia.php"+'"'+" method = "+'"'+"get"+'"' +">";
p1=p1+"Detalhe <input type="+'"'+"radio"+'"'+ "name="+'"'+"gal"+'"'+" value="+'"'+id+'"'+" onclick="+'"'+"DoSubmission()"+'"'+" />";
p1=p1+"<input type="+'"'+"hidden"+'"'+" name="+'"'+"foto_id"+'"'+" value="+'"'+id+'"'+" /> ";
  */
var p1="<form name="+'"'+ "MyForm" +'"'+" action  = "+'"' +"foto-do-dia.php"+'"'+" method = "+'"'+"get"+'"' +">";
p1=p1+"Detalhe <input type="+'"'+"radio"+'"'+ " style= \"position: relative; z-index: 3\" "+"name="+'"'+"gal"+'"'+" value="+'"'+id+'"'+" onclick="+'"'+"DoSubmission()"+'"'+" />";
p1=p1+"<input type="+'"'+"hidden"+'"'+" name="+'"'+"foto_id"+'"'+" value="+'"'+id+'"'+" /> ";
 
 
p1=p1+"</form>";
//alert (p1);
    
document.getElementById("box_r_id").innerHTML=p;
document.getElementById("box_r_det").innerHTML=p1;
}


        function myFunction()
        {
        //alert ("in");

        window.open("contactos.html",'mywin','right=20,top=20,width=400,height=210,toolbar=1,resizable=0,scrollbars=0');

        }
        function DoSubmission() {

        document.MyForm.submit();

        }
        


function getXmlHttpRequestObject() {
if (window.XMLHttpRequest) {
return new XMLHttpRequest(); //To support the browsers IE7+, Firefox, Chrome, Opera, Safari
} else if(window.ActiveXObject) {
return new ActiveXObject("Microsoft.XMLHTTP"); // For the browsers IE6, IE5
} else {
alert("Error due to old verion of browser upgrade your browser");
}
}
var rcvReq = getXmlHttpRequestObject();


function alterContent(req) {
    
var urlpage = document.URL;
Date.prototype.today = function(){ 
  //  return ((this.getDate() < 10)?"0":"") + this.getDate() +"/"+(((this.getMonth()+1) < 10)?"0":"") + (this.getMonth()+1) +"/"+ this.getFullYear() 
  return this.getFullYear() +"-"+(((this.getMonth()+1) < 10)?"0":"") + (this.getMonth()+1) +"-"+ ((this.getDate() < 10)?"0":"") + this.getDate()
};
//For the time now
Date.prototype.timeNow = function(){
     return ((this.getHours() < 10)?"0":"") + this.getHours() +":"+ ((this.getMinutes() < 10)?"0":"") + this.getMinutes() +":"+ ((this.getSeconds() < 10)?"0":"") + this.getSeconds();
};
var newDate = new Date();
var datetime =  newDate.today() + " " + newDate.timeNow();
//alert(datetime);
var request=datetime+" "+"152"+" "+"232";
//document.getElementById("1").innerHTML = "teste";
//alert(req);
if (rcvReq.readyState === 4 || rcvReq.readyState === 0) {
//rcvReq.open("GET", 'http://localhost:8080/AMAAFWA_SERVLET/AccessServlet?urlpage='+document.URL+'&request='+req, true);
//rcvReq.open("GET", 'http://1000palavras.pt:8080/AMAAFWA_SERVLET/AccessServlet?urlpage='+document.URL+'&request='+req, true);
rcvReq.open("GET", 'files.php?dir='+req+"&tipo=h", true);
rcvReq.onreadystatechange = handleAlterContent; 
rcvReq.send(null);
} 
}


function handleAlterContent() {
if (rcvReq.readyState === 4) {
    var resp =rcvReq.responseText;
var n=resp.split("-");
//alert(resp);
//document.getElementById("1").innerHTML =document.getElementById("1").innerHTML ="<img src= \""+resp+"\""+ "height=\"4%\" width=\"4%\" onclick=\"calPHPPage(5)\"/>"+"  "+"<img src= \""+resp+"\""+ "height=\"4%\" width=\"4%\" onclick=\"calPHPPage(3)\"/>";
document.getElementById("artigo").innerHTML =resp;
document.getElementById("files").innerHTML = "";
//document.getElementById("files").innerHTML =resp;
//<img src="imageFilename.jpg" height="100" width="100">
//document.getElementById("1").innerHTML ="<img src = \"https://lh3.googleusercontent.com/-CcUGopqR1RA/S-wWOiGU-TI/AAAAAAAABNQ/nYudo3NgTFo/s144/IMG_1377_dpp.jpg\" height=\"4%\" width=\"4%\" alt = \"logo\" />"
}
}

function hsearcher(query) {
//alert(query);
if (rcvReq.readyState === 4 && rcvReq.status === 200) {
//rcvReq.open("GET", 'http://localhost:8080/AMAAFWA_SERVLET/AccessServlet?urlpage='+document.URL+'&request='+req, true);
//rcvReq.open("GET", 'http://1000palavras.pt:8080/AMAAFWA_SERVLET/AccessServlet?urlpage='+document.URL+'&request='+req, true);

rcvReq.onreadystatechange = handleSearcher; 
rcvReq.open("GET", 'http://localhost:8080/fileSearcher/searcherServlet?query='+query, true);
rcvReq.send();
} 
}

function searcher_ORI(str,s_type) { //Original usa servlet
    //alert (str+" "+s_type);
    var today = new Date();
    if (str.length <= 2) {
        //document.getElementById("files").innerHTML = "Introduza texto a pesquisar";
        return;
    } else {//pesquisa no repositório
        if (s_type == "repos"){
        var header= "<h2>Documentos com: '"+str+"'</h2>"+today+"<br />";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
               document.getElementById("artigo").innerHTML = header+ xmlhttp.responseText;
            }
        };
        //xmlhttp.open("GET", 'http://localhost:8080/fileSearcher/searcherServlet?action=search&query='+str, true);

        xmlhttp.open("GET", 'http://docrep.lnec.pt:8080/fileSearcher/searcherServlet?action=search&query='+str, true);xmlhttp.send();
        //callPHPUpdateSWords(str);
        } else{//pesquisa na BD de missões
          var header= "<h2>Missões com: '"+str+"'</h2>"+today+"<br />";
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
               document.getElementById("artigo").innerHTML = header+xmlhttp.responseText;
               document.getElementById("files").innerHTML = "";
            }
        };
        //xmlhttp.open("GET", 'http://localhost:8080/fileSearcher/searcherServlet?action=search&query='+str, true);
        xmlhttp.open("GET", "ajaxPHP.php?func=search_in_missions&word="+str, true);
        //xmlhttp.open("GET", 'http://docrep.lnec.pt:8080/fileSearcher/searcherServlet?action=search&query='+str, true);
        xmlhttp.send();
        //callPHPUpdateSWords(str);  
        }
    }
}

function searcher(str,s_type) {
    //alert (str+" "+s_type);
    var today = new Date();
    if (str.length <= 2) {
        //document.getElementById("files").innerHTML = "Introduza texto a pesquisar";
        return;
    } else {//pesquisa no repositório
        if (s_type == "repos"){
        var header= "<h2>Documentos com: '"+str+"'</h2>"+today+"<br />";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
               document.getElementById("artigo").innerHTML = header+ xmlhttp.responseText;
               document.getElementById("files").innerHTML = "";
            }
        };
        //xmlhttp.open("GET", 'http://localhost:8080/fileSearcher/searcherServlet?action=search&query='+str, true);

       // xmlhttp.open("GET", 'http://docrep.lnec.pt:8080/fileSearcher/searcherServlet?action=search&query='+str, true);
        
          xmlhttp.open("GET", "ajaxPHP.php?func=search_in_docs&word="+str, true);
          xmlhttp.send();
        //callPHPUpdateSWords(str);
        } else{//pesquisa na BD de missões
          var header= "<h2>Missões com: '"+str+"'</h2>"+today+"<br />";
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
               document.getElementById("artigo").innerHTML = header+xmlhttp.responseText;
                document.getElementById("files").innerHTML = "";
            }
        };
        //xmlhttp.open("GET", 'http://localhost:8080/fileSearcher/searcherServlet?action=search&query='+str, true);
        xmlhttp.open("GET", "ajaxPHP.php?func=search_in_missions&word="+str, true);
        //xmlhttp.open("GET", 'http://docrep.lnec.pt:8080/fileSearcher/searcherServlet?action=search&query='+str, true);
        xmlhttp.send();
        //callPHPUpdateSWords(str);  
        }
    }
}

function listDirs(str) {
    //alert (str);
    if (str.length <= 2) {
        //document.getElementById("files").innerHTML = "Introduza texto a pesquisar";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
               var resp=xmlhttp.responseText;
               //alert(resp);
               document.getElementById("menu").innerHTML = resp;
            }
        };
        xmlhttp.open("GET", 'http://localhost:8080/fileSearcher/searcherServlet?action=list&path='+str+'&type=d', true);
        xmlhttp.send();
    }
}



function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
}



function showMissions() {
   // alert("oi");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var resp=xmlhttp.responseText;
                //alert(resp);
                document.getElementById("artigo").innerHTML = resp;
                document.getElementById("files").innerHTML = "";
            }
        }
        xmlhttp.open("GET", "ajaxPHP.php?func=getAllMissions", true);
        xmlhttp.send();
    
}

/*  Esta solução bloqueia o tomcat
function IndexRepDocFiles() {
    
    document.getElementById("artigo").innerHTML = "Indexing repository files ...";
    
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
               var resp=xmlhttp.responseText;
               alert(resp);
               document.getElementById("artigo").innerHTML = resp;
            }
        };
        xmlhttp.open("GET", 'http://localhost:8080/fileSearcher/searcherServlet?action=index', true);
        xmlhttp.send();
    
}
*/

function IndexRepDocFiles(){
     document.getElementById("artigo").innerHTML = "Indexing repository files ...";
     var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var resp=xmlhttp.responseText;
               // alert(resp);
                document.getElementById("artigo").innerHTML = resp;
                document.getElementById("files").innerHTML = "";
            }
        }
        xmlhttp.open("GET", "ajaxPHP.php?func=IndexRepDocFiles", true);
        xmlhttp.send();
    
    
}

function IndexDbMissions(){
     document.getElementById("artigo").innerHTML = "Indexing from Missions ...";
     var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var resp=xmlhttp.responseText;
               // alert(resp);
                document.getElementById("artigo").innerHTML = resp;
                document.getElementById("files").innerHTML = "";
            }
        }
        xmlhttp.open("GET", "ajaxPHP.php?func=IndexDbMissions", true);
        xmlhttp.send();
    
    
}

function handleSearcher() {
//alert(rcvReq.readyState);
if (rcvReq.readyState === 4 && rcvReq.status === 200) {
    var resp =rcvReq.responseText;
var n=resp.split("-");
alert(resp);
document.getElementById("artigo").innerHTML =resp;
}
}



function alterContent_files(req) {
//alert(req);
if (rcvReq.readyState === 4 || rcvReq.readyState === 0) {
//rcvReq.open("GET", 'http://localhost/RepDoc/files.php?dir='+req+"&tipo=f", true);
rcvReq.open("GET", 'files.php?dir='+req+"&tipo=f", true);

rcvReq.onreadystatechange = handleAlterContent_files; 
rcvReq.send(null);
} 
}


function handleAlterContent_files() {
if (rcvReq.readyState === 4) {
    var resp =rcvReq.responseText;
var n=resp.split("-");
document.getElementById("files").innerHTML =resp;
//document.getElementById("files").innerHTML = "";
}
}

function prepareList() {
  $('#expList').find('li:has(ul)')
  	.click( function(event) {
  		if (this == event.target) {
  			$(this).toggleClass('expanded');
  			$(this).children('ul').toggle('medium');
  		}
  		return false;
  	})
  	.addClass('collapsed')
  	.children('ul').hide();
  };
 
  $(document).ready( function() {
      prepareList();
  });
  
  
function callPHPUpdateSWords(str){
  //alert(str);
  var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var resp=xmlhttp.responseText;
               // alert(resp);
                //document.getElementById("artigo").innerHTML = resp;
                //document.getElementById("files").innerHTML = "";
            }
        };
        xmlhttp.open("GET", "ajaxPHP.php?func=updateSWords&word="+str, true);
        xmlhttp.send();
}


function missionDetail(str){
  //alert(str);
  var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var resp=xmlhttp.responseText;
               // alert(resp);
                //document.getElementById("artigo").innerHTML = resp;
                //document.getElementById("files").innerHTML = "";
            }
        };
        xmlhttp.open("GET", "ajaxPHP.php?func=missionDetail="+str, true);
        xmlhttp.send();
}

function ValidateRequiredFields()
{
//alert("validate");
var message = new String('\nCampos obrigatórios:\n');
    var flag=true;

    var x="";
    //x=document.forms["addMission"]["assunto"].value;
    x=document.getElementById("assunto").value;
    //alert(x);
    if (x.length===1){  
        //message += '\nNº do processo\n'; alert (message);
        document.getElementById("assunto").style.borderColor="red";
     //   document.getElementById("assunto").innerHTML="Campo obrigatório!";
        flag = false;
    }
    var y="";
    //y=document.forms["addMission"]["descricao"].value;
    y=document.getElementById("descricao").value;
    if (y.length===1){  
        //message += '\nNº do processo\n'; alert (message);
        document.getElementById("descricao").style.borderColor="red";
       // document.getElementById("descricao").innerHTML="Campo obrigatório!";
        flag = false;
    }
    var z="";
    //z=document.forms["addMission"]["palavras"].value;
    z=document.getElementById("palavras").value;
    if (z.length===1){  
        //message += '\nNº do processo\n'; alert (message);
        document.getElementById("palavras").style.borderColor="red";
        //document.getElementById("palavras").innerHTML="Campo obrigatório!";
        flag = false;
    }
   
    //z=document.forms["addMission"]["palavras"].value;
    z=document.getElementById("ano").value;
    if (z.length===0){  
        //message += '\nNº do processo\n'; alert (message);
        document.getElementById("ano").style.borderColor="red";
        //document.getElementById("alert").innerHTML="Campo obrigatório!";
        flag = false;
    }
    z=document.getElementById("p1").value;
    if (z.length===0){  
        //message += '\nNº do processo\n'; alert (message);
        document.getElementById("p1").style.borderColor="red";
        //document.getElementById("ano").innerHTML="Campo obrigatório!";
        flag = false;
    }
    z=document.getElementById("rel1").value;
    if (z.length===0){  
        //message += '\nNº do processo\n'; alert (message);
        document.getElementById("rel1").style.borderColor="red";
        //document.getElementById("ano").innerHTML="Campo obrigatório!";
        flag = false;
    }
    z=document.getElementById("nome").value;
    if (z.length===0){  
        //message += '\nNº do processo\n'; alert (message);
        document.getElementById("nome").style.borderColor="red";
        //document.getElementById("ano").innerHTML="Campo obrigatório!";
        flag = false;
    }
//alert(flag);

//process_addMission();
 if  (!flag) {
     document.getElementById("alert").innerHTML="Os Campos marcados a vermelho são obrigatórios!";
     document.getElementById("alert").style.color="red";
 }
 return flag;
    
    

}


function process_addMission() {
     //alert("oi_process_new_mission  ");
     if (!ValidateRequiredFields()) return true;
     var update=document.getElementById("update").value;
     var nome=document.getElementById("nome").value;
     var descricao=document.getElementById("descricao").value;
     var assunto=document.getElementById("assunto").value;
     var palavras=document.getElementById("palavras").value;
     //var dep=document.getElementById("departamento").value;
     var ano=document.getElementById("ano").value;
     var link_to_apresentacao=document.getElementById("link").value;
    
     var p1=document.getElementById("p1").value;
     var r1=document.getElementById("rel1").value;
     
     var p2=document.getElementById("p2").value;
     var r2=document.getElementById("rel2").value;
     var p3=document.getElementById("p3").value;
     var r3=document.getElementById("rel3").value;
    
     
     var postData="update="+update+"&nome="+nome+"&descricao="+descricao+"&assunto="+assunto+"&palavras="+palavras+"&ano="+ano+"&link_to_apresentacao="+link_to_apresentacao+"&p1="+p1+"&p2="+p2+"&p3="+p3+"&r1="+r1+"&r2="+r2+"&r3="+r3; 
     //alert("dados"+postData);
       // process_addMission(postData);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                var resp=xmlhttp.responseText;
                alert(resp);
                document.getElementById("artigo").innerHTML = resp;
                document.getElementById("files").innerHTML = "process new Mission";
                //location.reload();
            }
        };
        xmlhttp.open("POST", "novaMissao.php", true);
       // xmlhttp.open("POST", "login/process_login.php", true);
       // xmlhttp.open("POST", "novaMissao.php", true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        //alert("vai enviar");
        //postData="update="+update;
        xmlhttp.send(postData);
    
}




function createMission(missao) {
    //alert("oi");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                var resp=xmlhttp.responseText;
               // alert(resp);
                document.getElementById("artigo").innerHTML = resp;
                document.getElementById("files").innerHTML = "";
            }
        };
        xmlhttp.open("GET", "ajaxPHP.php?func=createMission&missao="+missao, true);
        xmlhttp.send();
    
}

function browse(folder, tipo, outElement) {
    //alert(folder);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var resp=xmlhttp.responseText;
               // alert(resp);
                //document.getElementById("artigo").innerHTML = resp;
                document.getElementById(outElement).innerHTML = resp;
            }
        }
        xmlhttp.open("GET", "ajaxPHP.php?func=browse&folder="+folder+"&tipo="+tipo, true);
        xmlhttp.send();
    
}

function setValueByID(id,value){
    //alert(id);
    document.getElementById(id).value=value;
    document.getElementById(id).innerHtml=value;
}


function setElementToHide(id) {
   document.getElementById(id).style.display = "none";
}
function setElementToVisible(id) {
   document.getElementById(id).style.display = "block";
}

function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }

function switchVisibility(id_on,id_off){
    
    setElementToHide(id_off);
    setElementToVisible(id_on)
}


function showHelp(){
    
    //document.getElementById("artigo").innerHTML = "<h1>Aqui vai aparecer uma descrição da plataforma,com formação acerca de como usar </h1>";
    //document.getElementById("artigo").innerHTML='<object type="text/html" data="DocRep-Ajuda.html" ></object>';



   
   var con = document.getElementById('artigo')
   ,   xhr = new XMLHttpRequest();

   xhr.onreadystatechange = function () { 
    if (xhr.readyState == 4 && xhr.status == 200) {
     con.innerHTML = xhr.responseText;
    }
   }

 xhr.open("GET", "DocRep-Ajuda.html", true);
 xhr.setRequestHeader('Content-type', 'text/html charset=UTF-8');
 xhr.send();

}




function novaMissao() {
  //  alert("oi_nova");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                var resp=xmlhttp.responseText;
                //alert(resp);
                document.getElementById("artigo").innerHTML = resp;
                document.getElementById("files").innerHTML = "";
            }
        };
        xmlhttp.open("GET", "ajaxPHP.php?func=novaMissao", true);
        xmlhttp.send();
    
}


function login() {
    //alert("oi_nova");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                var resp=xmlhttp.responseText;
                //alert(resp);
                document.getElementById("artigo").innerHTML = resp;
                document.getElementById("files").innerHTML = "";
            }
        };
        xmlhttp.open("GET", "ajaxPHP.php?func=login", true);
        xmlhttp.send();
    
}

function logout() {
    //alert("oi_logout");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                var resp=xmlhttp.responseText;
                //alert(resp);
                document.getElementById("artigo").innerHTML = resp;
                document.getElementById("files").innerHTML = "Logout";
                location.reload();
            }
        };
        xmlhttp.open("GET", "ajaxPHP.php?func=logout", true);
        xmlhttp.send();
    
}

function viewPDF(pdf_file){  
    
   // alert(pdf_file);
  
    //pdf_file="'"+pdf_file+"'";
PDFJS.getDocument(pdf_file).then(function(pdf) {
// Using promise to fetch the page
pdf.getPage(1).then(function(page) {
var scale = 1.0;
var viewport = page.getViewport(scale);
//
// Prepare canvas using PDF page dimensions
//
var canvas = document.getElementById('the-canvas');
var context = canvas.getContext('2d');
canvas.height = viewport.height;
canvas.width = viewport.width;
//
// Render PDF page into canvas context
//
var renderContext = {
canvasContext: context,
viewport: viewport
};
page.render(renderContext);
});
});
}