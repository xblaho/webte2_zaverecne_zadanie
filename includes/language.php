<?php
session_start();
//header('Cache-control: private'); // IE 6 FIX
header('Cache-Control: no-cache');
header('Pragma: no-cache');
 
if(isSet($_GET['lang']))
{
  $lang = $_GET['lang'];
   
  $_SESSION['lang'] = $lang;
   
  setcookie('lang', $lang, time() + (3600 * 24 * 30));
}
else if(isSet($_SESSION['lang']))
{
  $lang = $_SESSION['lang'];
}
else if(isSet($_COOKIE['lang']))
{
  $lang = $_COOKIE['lang'];
}
else
{
  $lang = 'en';
}
 
switch ($lang) {
  case 'sk':
  $lang_file = 'sk.php';
  break;
 
  case 'en':
  $lang_file = 'en.php';
  break;
 
  default:
  $lang_file = 'en.php';
 
}
 
include_once 'languages/'.$lang_file;
?>