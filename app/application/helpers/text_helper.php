<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function short_text($text, $n)
{
    $len = strlen($text);
    if ($len > $n)
    {
        $text = mb_substr($text,0,$n);
        $text = $text . '...';
    }
    return $text;
}
?>