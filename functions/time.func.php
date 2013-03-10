<?php 
function time_is($time,$seconds=false){
	$format = $seconds ? "g:i:s A" : "g:i A";
	$yesterday_is = date('d', mktime(0, 0, 0, date("m") , date("d") - 1, date("Y")));
	$today_is = date('d', time());
	$relative_time = date($format,$time);
	$day_of = date("d",$time);
	   if($day_of==$today_is)
	   {
	   	$day_string = "";
	   	}
	   elseif($day_of==$yesterday_is)
	   {
	   	$day_string =  ", yesterday";
	   	}
	   else {
	   	$day_string =  date(" , n/j",$time);
	   }
	
	$relative_time .= $day_string;
	return $relative_time;
}
function time_ago($fromTime, $showLessThanAMinute = true) {
	$toTime = time();
    $distanceInSeconds = round(abs($toTime - $fromTime));
    $distanceInMinutes = round($distanceInSeconds / 60);
        
        if ( $distanceInMinutes <= 1 ) {
            if ( !$showLessThanAMinute ) {
                return ($distanceInMinutes == 0) ? 'less than a minute' : '1 minute';
            } else {
               
                if ( $distanceInSeconds < 60 ) {
                	if($distanceInSeconds == 0)
                	{
                	return 'just now';	
                	}
                	if($distanceInSeconds==1)
                	{
                	return 'about a second ago';
                	}
                    return 'about ' . $distanceInSeconds . " seconds ago";
                }
                
                return 'about one minute ago';
            }
        }
        if ( $distanceInMinutes < 45 ) {
            return "about " . $distanceInMinutes . ' minutes ago';
        }
        if ( $distanceInMinutes < 90 ) {
        	$time = date('g:i A', $fromTime);
            return 'about an hour ago at ' . $time;
        }
        if ( $distanceInMinutes < 1440 ) {
        	   	$time = date('g:i A', $fromTime);
            return round(floatval($distanceInMinutes) / 60.0) . ' hours ago at ' . $time . '.';
        }
        if ( $distanceInMinutes < 2880 ) {
        	$time = date('g:i A', $fromTime);
            return 'yesterday ' . 'at ' . $time . '.';
        }
        if ( $distanceInMinutes < 43200 ) {
        		$time = date('g:i A n/j/y', $fromTime);
            return round(floatval($distanceInMinutes) / 1440) . ' days ago';
        }
        if ( $distanceInMinutes < 86400 ) {
            return 'about one month ago';
        }
        if ( $distanceInMinutes < 525600 ) {
            return round(floatval($distanceInMinutes) / 43200) . ' months ago';
        }
        if ( $distanceInMinutes < 1051199 ) {
            return 'about one year ago';
        }
        
        return 'over ' . round(floatval($distanceInMinutes) / 525600) . ' years';
}

?>
