var xmlhttp;
var repeatextinfo;
var repeatextstate;

if (window.XMLHttpRequest)
  {
     xmlhttp=new XMLHttpRequest();
  }
else
  {
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

function  gettab(tab)
{  
      var menu = document.getElementById(tab);
      var url="display_post.php?ts=";  
        url+=new Date().getTime();
        url+="&tab="+tab;  
        xmlhttp.onreadystatechange=function()        
        {
            
            if(xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var response = xmlhttp.responseText; 
                    document.getElementById("div-allpost").innerHTML=response;
                    getpostsummary();
                }
            
        }
        xmlhttp.open("GET",url,true);
        xmlhttp.send(null); 
}
function getpostsummary()
{      
        var url="summarypost.php?ts=";  
        url+=new Date().getTime(); 
        
        xmlhttp.onreadystatechange=function()        
        {
            
            if(xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var response = xmlhttp.responseXML; 
                    var allpost = response.getElementsByTagName("sumofpost")[0].firstChild.nodeValue;
                    var newpost = response.getElementsByTagName("sumofnew")[0].firstChild.nodeValue; 
                    document.getElementById("label-allpost").innerHTML = "("+allpost+")";
                    document.getElementById("label_newallpost").innerHTML = "("+newpost+")";
                    document.getElementById("label_newpost").innerHTML = newpost;
                }
            
        }
        xmlhttp.open("GET",url,true);
        xmlhttp.send(null);
}