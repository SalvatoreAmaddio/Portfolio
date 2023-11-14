<?php
session_start();
class Sys 
{
    public static function exit() 
    {
        header("Location: /personal/login.php");
    }

    public static function isLogged() : bool 
    {
        return isset($_SESSION["logged"]) && $_SESSION["logged"] == 1;
    }

    public static function enter() 
    {
        echo "<br>";
    }

    public static function yesNo(bool $val) : string
    {
        return ($val) ? "Yes" : "No";
    }

    public static function trueFalse(string $val) : bool
    {
        return ($val=="true") ? true : false;
    }

    public static function contains(string $what, string $in, bool $toLower=false) : bool 
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
