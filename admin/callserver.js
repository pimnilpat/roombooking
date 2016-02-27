function call_setsiteinfo()
{ 
    jQuery("#heading_menu h2").html("ข้อมูลเกี่ยวกับเว็บไซต์");
    jQuery("#heading_menu").addClass("headings");
    jQuery("#heading_menu").addClass("altheading");
    
    jQuery.get("setsiteinfo.php", {value:""}, function(data){
        jQuery("#title_content").html(data);
        
    });
}
function  call_setuser()
{
    jQuery("#heading_menu h2").html("ข้อมูลผู้ดูแลระบบ");
    jQuery("#heading_menu").addClass("headings");
    jQuery("#heading_menu").addClass("altheading");
    
    jQuery.get("setuser.php", {value:""}, function(data){
        jQuery("#title_content").html(data);
        
    });
}
function call_contactinfo()
{
    jQuery("#heading_menu h2").html("ข้อมูลการติดต่อ");
    jQuery("#heading_menu").addClass("headings");
    jQuery("#heading_menu").addClass("altheading");
    
    jQuery.get("setcontactinfo.php", {value:""}, function(data){
        jQuery("#title_content").html(data);
        
    });
}
function call_aboutcompany()
{
    jQuery("#heading_menu h2").html("ข้อมูลเกี่ยวกับบริษัท");
    jQuery("#heading_menu").addClass("headings");
    jQuery("#heading_menu").addClass("altheading");
    
    jQuery.get("setaboutus.php", {value:""}, function(data){
        jQuery("#title_content").html(data);
        
    });
}
