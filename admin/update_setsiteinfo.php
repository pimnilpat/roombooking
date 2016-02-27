<?php

if($_POST['sitename']=='' || $_POST['companyname']=='')
{
    echo "<script type='text/javascript'>";
    echo "alert('Enter site name and company name')";    
    echo "</script>";    
}
else
{
   
    include_once '../connectdb.php';
    
    if($_FILES['siteimage']['error']==4)
    {
        $imagesite= $_POST['oldsitepicture'];
        
    }
    elseif($_FILES['siteimage']['error']==0)
    {
        $imgtype=$_FILES['siteimage']['type']; 
        $type=explode("/",$imgtype); 
        if(strtolower($type[0])==strtolower("image"))
        {
            $imagesite="images/".$_FILES['siteimage']['name']; 
            
        }
        else
        {            
            $imagesite='0';
        }
        if($imagesite=='0')
        {
            echo "<script type='text/javascript'>";
            echo "alert('File must a image type')";    
            echo "</script>";
        }
        else
        {
            //echo "ready";
            $destination = "../".$imagesite;
            $uploaded = move_uploaded_file($_FILES['siteimage']['tmp_name'], $destination); 
        } 
    }
            
            $sitename=trim($_POST['sitename']);
            $sitecompany = trim($_POST['companyname']);
            $sitewelcome = trim($_POST['sitewelcome']);
            if(strlen($sitewelcome)>0)
            {
                $sitewelcome=$sitewelcome;
            }
            else
            {
                $sitewelcome=$_POST['oldwellcome'];
            }
            $welcomecapture = trim($_POST['welcomecapture']);
            if(strlen($welcomecapture)>0)
            {
                $welcomecapture=$welcomecapture;
            }
            else
            {
                $welcomecapture=$_POST['oldwelcomecapture'];
            }
            $welcomedetail = trim($_POST['welcomedetail']);
            if(strlen($welcomedetail)>0)
            {
                $welcomedetail=$welcomedetail;
            }
            else
            {
                $welcomedetail= $_POST['oldwelcomedetail'];
            }
            
            $suggest[0] = $_POST['suggest1'];
            $suggest[1] = $_POST['suggest2'];
            $suggest[2] = $_POST['suggest3'];
            $vote[0] = $_POST['vote1'];
            $vote[1] = $_POST['vote2'];
            $vote[2] = $_POST['vote3'];
            
            $query_update = "update site_infomation
                                set site_name = '$sitename',
                                    site_company = '$sitecompany',
                                    site_image = '$imagesite',
                                    wellcome = '$sitewelcome',
                                    wellcome_capture = '$welcomecapture',
                                    wellcome_detail = '$welcomedetail'
                                 where site_name = '{$_POST['oldsitename']}'
                            ";
            $result_updated = mysql_query($query_update) ;
            
            $result_updated=mysql_query("update list_room set suggest=''
                                    where suggest is not null
                                ");
            $result_updated=mysql_query("update list_room set vote=''
                                    where vote is not null
                                ");
            
            for($i=0;$i<count($suggest);$i++)
            {
                $result_updated = mysql_query("update list_room set suggest='suggest'
                                                where name= '{$suggest[$i]}'
                                            "); 
            }
            for($i=0;$i<count($vote);$i++)
            {
                $result_updated = mysql_query("update list_room set vote='vote'
                                                where name='$vote[$i]'
                                            ");
            }
            if($result_updated)
            {
                 echo "<script type='text/javascript'>";
                 echo "alert('Updated complete')";    
                 echo "</script>";
            }
           
}
?>
<html>
    <head>
         
    </head>
    <body>
        <?php
                  $sql_query = mysql_query("select site_image from site_infomation ");
                  while($pic = mysql_fetch_array($sql_query))
                  {
                      $imgsrc = $pic['site_image'];
                  }
                ?>
                <script type="text/javascript">
                    var divimg = document.getElementById("display_siteimg");
                    var img=document.createElement("img");
                    img.setAttribute("src", "<?php echo $imgsrc; ?>")
                    img.setAttribute("width","340")
                    img.setAttribute("heigh","150")
                    divimg.appendChild("img");
                </script>
    </body>
</html>