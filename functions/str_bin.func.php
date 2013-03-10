<?php
/**
 *    Returns an ASCII string containing
 *    the binary representation of the input data .
**/
function str_to_bin($str, $mode=0) {
    $out = false;
    for($a=0; $a < strlen($str); $a++) {
        $dec = ord(substr($str,$a,1));
        $bin = '';
        for($i=7; $i>=0; $i--) {
            if ( $dec >= pow(2, $i) ) {
                $bin .= "1";
                $dec -= pow(2, $i);
            } else {
                $bin .= "0";
            }
        }
        /* Default-mode */
        if ( $mode == 0 ) $out .= $bin;
        /* Human-mode (easy to read) */
        if ( $mode == 1 ) $out .= $bin . " ";
        /* Array-mode (easy to use) */
        if ( $mode == 2 ) $out[$a] = $bin;
    }
    return $out;
}
?>