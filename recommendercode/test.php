<?php

                date_default_timezone_set("Asia/Calcutta");
                $todaydate = new DateTime();
                $currenttime = date_format($todaydate, 'Y-m-d H:i:s');
                echo $currenttime;


              /*  if($currenttime  < '18:33:06 27:05:2014')
                echo "yes";
                else
                echo "no";*/

?>