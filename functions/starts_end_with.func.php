<?php  
function starts_with($needle, $haystack)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function ends_with($needle, $haystack)
{
    $length = strlen($needle);
    $start  = $length * -1; //negative
    return (substr($haystack, $start) === $needle);
}
?>
