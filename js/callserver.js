// function for showpost menu
function call_newpost()
{
    jQuery.get("../response/newpost_response.php", {value:""}, function(data){
        jQuery("#newpost").html(data);
        var num = jQuery("#label_newpost").html().match(/\([0-9]+\)/);         
        var num2 = num[0].match(/[0-9]+/);
        
        jQuery("#li_newpost span:first").html(""+num2+"");        
    });
}
function call_activepost()
{
    jQuery.get("../response/activepost_response.php", {value:""}, function(data){
        jQuery("#active").html(data);
        var num = jQuery("#label_activepost").html().match(/\([0-9]+\)/);         
        var num2 = num[0].match(/[0-9]+/);
        
        jQuery("#li_active span:first").html(""+num2+"");
        call_newpost();
        
        var repeat_active = setTimeout("call_activepost()", 5000);
    });
}
function call_noactivepost()
{
    jQuery.get("../response/noactivepost_response.php", {value:""}, function(data){
        jQuery("#non_active").html(data);
        var repeat_noactive = setTimeout("call_noactivepost()", 5000);
    });
}
function call_votepost()
{
    jQuery.get("../response/votepost_response.php", {value:""}, function(data){
        jQuery("#votepost").html(data);
        var repeat_vote = setTimeout("call_votepost()", 5000);
    });
}
function call_assignpost()
{
    jQuery.get("../response/assignpost_response.php", {value:""}, function(data){
        jQuery("#assigned").html(data);
        var repeat_assign = setTimeout("call_assignpost()", 5000);
    });
}
function call_allpost()
{
    jQuery.get("../response/allpost_response.php", {value:""}, function(data){
        jQuery("#allpost").html(data);
        var repeat_all = setTimeout("call_allpost()", 5000);
    });
}
// end funtion of showpost

// function for dashboard
function call_product_bar()
{
    jQuery.get("../response/stat_product_bar.php", {value:""}, function(data){
        jQuery("#stat_product_bar").html(data);
        call_product_chart();
        //var repeat_product_bar = setTimeout("call_product_bar()", 5000);
    });
}
function call_product_chart()
{
    jQuery.get("../response/stat_product_box.php", {value:""}, function(data){
        jQuery("#dashboard").html(data); 
        //var repeat_product_chart = setTimeout("call_product_chart()", 5000);
    });
}
function call_provider_chart()
{ 
    
    jQuery.get("../response/stat_provider_chart.php", {value:""}, function(data){
        jQuery("#provider").html(data); 
        //var repeat_provider_chart = setTimeout("call_provider_chart()", 5000);
    });
}
//end function of dashboard

// response for user
function call_agents_assign()
{
    jQuery.get("../response/agents_response.php", {value:""}, function(data){
        jQuery("#allassign_toagent").html(data);
        var repeat_agent = setTimeout("call_agents_assign()", 5000);
    });
}