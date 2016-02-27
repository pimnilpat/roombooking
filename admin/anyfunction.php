<?php

function getArrayFirstIndex($arr)
{
    foreach ($arr as $key => $value)
    return $key;
}

function getArrayLastIndex($arr)
{
     foreach ($arr as $key => $value)
     {
         $last=$key;
     }
     return $last;
}

 function greaterDate($start_date,$end_date)
{
      $start = strtotime($start_date);
      $end = strtotime($end_date);
      if ($start-$end > 0)
        return 1;
      else
       return 0;
}
    
function subtrackTime($time)
{
        $thistime = $time;
        $hour = floor($thistime/3600);
        $T_minute = $thistime % 3600;

        $minute = floor($T_minute / 60);
        $second = $T_minute % 60;

        $word = "$hour:$minute:$second";

        return $word;
}

function validName($buffer)
{
    if (ereg("[A-Za-z0-9]", $buffer) === false)
    {
                   return  0;
    }
}
function validIntervalName($string)
{
              return is_numeric(substr($string, -1, 1));

}
function validIntervalNamePrefix($string)
{
              return is_numeric(substr($string, 1, 1));

}
function validNumber($string)
{
          return is_numeric($string);  
}


/**
 * check string that begin with charactor and end with numeric
 */
function isShortName($name)
{
    $is = preg_match("/^[a-zA-Z][a-zA-Z]+[0-9]+$/",$name,$new);
    
    return $is;
}

?>
