function time()
{
       date_default_timezone_set("Asia/Calcutta");
        $todaydate = new DateTime();
        $currenttime = date_format($todaydate, 'Y-m-d H:i:s');
        return $currenttime;
        
        
}