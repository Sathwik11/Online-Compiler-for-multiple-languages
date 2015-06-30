<?php
$v=$_GET['q'];
//echo "hello";
if($v!='-')
{

$fp=fopen($v.".txt",'r');
while(!feof($fp))
  {
  echo fgets($fp). "";
  }
fclose($fp);
}
?>
