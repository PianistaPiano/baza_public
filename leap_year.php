<?php

function year_check($my_year)
{
    $is_leap = false;
   if ($my_year % 400 == 0)
        $is_leap = true;
   if ($my_year % 4 == 0)
        $is_leap = true;
   else if ($my_year % 100 == 0)
        $is_leap = false;
   else
        $is_leap = false;

   return $is_leap;
}

?>