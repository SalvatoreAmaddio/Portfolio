<?php
namespace SAR;
class Sys 
{
    public static function enter() 
    {
        echo "<br>";
    }

    public static function contains($what, $in, $toLower=false) : bool 
    {
        if ($toLower) 
        {
            $what = Sys::toLower($what); 
            $in = Sys::toLower($in); 
        }        
        return str_contains($in,$what);
    }

    public static function toLower(string $str) : string 
    {
        return strtolower($str);
    }
}
?>
