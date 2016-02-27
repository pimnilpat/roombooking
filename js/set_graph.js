jQuery(document).ready(function(){
    var tb = document.getElementById("tb_porduct_bar").getElementsByTagName("tr");
    //alert(tb.length);
    var max = 0;
    for(i=0;i<tb.length;i++)
    {
           var col = tb[i].getElementsByTagName("td");
           //alert("td="+col.length);  
           var value = col[2].firstChild.nodeValue;
           val = value.substr(0, value.length-1);
           //var type = typeof(val); alert(type);
           val = parseFloat(val);
           //var type = typeof(val); alert(type+":"+val);
           if(val > max)
           {
                 max = val;  
           }           
    }
    for(i=0;i<tb.length;i++)
    {
           var col = tb[i].getElementsByTagName("td");
           //alert("td="+col.length);  
           var value = col[2].firstChild.nodeValue;
           val = value.substr(0, value.length-1);           
           val = parseFloat(val);          
           
           var id = col[1].getElementsByTagName("div")[0].getElementsByTagName("div")[0].getAttribute("id");
           jQuery("#"+id+"").css({"width":""+val+"%"});
           if(val==max)
           {
               jQuery("#"+id+"").removeClass("process-bar-blue");   
               jQuery("#"+id+"").addClass("process-bar-darkblue");
           }
    }
    
    var td2 = document.getElementById("tb_product_type_bar").getElementsByTagName("tr")[0].getElementsByTagName("td");
    for(i=0;i<td2.length;i++)
    { 
        var div1 = td2[i].getElementsByTagName("div")[0].getElementsByTagName("div")[0]; 
        var id1 = div1.getAttribute("id"); 
        var span1 = div1.getElementsByTagName("span")[0].childNodes[0].nodeValue;
        var span_new1=span1.substr(0,span1.length-1);
        var width1 = parseFloat(span_new1);        
        
        var div2 =  div1.getElementsByTagName("div")[0];
        var id2 = div2.getAttribute("id");
        var span2 = div2.getElementsByTagName("span")[0].childNodes[0].nodeValue; 
        var span_new2 = span2.substr(0,span2.length-1);
        var width2 = parseFloat(span_new2);        
          
        var width_sky = width2;
        var width_blue = width1+width_sky;
        jQuery("#"+id1+"").css({"height":width_blue});
        jQuery("#"+id2+"").css({"height":width_sky});
    }
        
 
}); /*.ready ends*/