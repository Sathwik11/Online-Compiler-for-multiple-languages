<?php

require_once('connection.php');
?>
<html>


<body background="BG.jpg">
<center><img src="header.jpg" width="750" height="150">
</center>
<br><br><br><br>

<?php
echo "<script>
function show()
{
str=document.getElementById('password').value;
str1=document.getElementById('conpassword').value;



if(str==str1)
document.getElementById('pri').innerHTML=\"Password Matches\";
else
document.getElementById('pri').innerHTML=\"Password not Matches\";

}
</script>";

if(isset($_POST['submit']))
{
session_start(); 
if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  { 
     echo  "<script>alert(\"Incorrect verification code\");</script>"; 
}
else
{
$user=$_POST['user'];
$pass=$_POST['password'];
$con=$_POST['conpassword'];
if($pass==$con)
{
$query1=mysql_query("select * from register where username='$user'") or die(mysql_error());
$res=mysql_fetch_array($query1);
if($res)
echo "<center><h3><font color=red>username already exits please try with another username</font></h3></center>";

else{

$query=mysql_query("INSERT INTO register (username,password) values('$user','$pass')") or die(mysql_error());
if($query)
{
$query=mysql_query("SELECT * FROM register where username='$user'") or die(mysql_error());
$row=mysql_fetch_array($query);
$id=$row['id'];
mkdir("users/".$id,0777);
if (!copy("code.php", "users/".$id."/code.php")) {
    echo "failed to copy $file...\n";
}
echo "<center><h3>Successfully Created</h3></center>";
echo "<br><center>please wait we are redirecting you to login page.if it not redirected in 3 seconds please <a href=index.php>click here</a> </center><br>";

header("refresh:3;url=index.php");
}
}
}
else
echo "password doesnot match";

}


}



echo "
<center><form name=\"form\" id=\"form\" method=\"post\" action=\"\">
<table>
<tr><td>Username</td><td><input type=\"text\" name=\"user\" id=\"user\"></td></tr>
<tr><td>Password</td><td><input type=\"password\" name=\"password\" id=\"password\"></td></tr>
<tr><td>Confrim Password</td><td><input type=\"password\" name=\"conpassword\" id=\"conpassword\" onkeyup=\"show();\"></td><td><span id=\"pri\"></span></td></tr></table>
<tr><img src=\"captcha.php\"></tr><br><tr><td>Enter Code</td><td><input type=\"text\" name=\"vercode\" /></td></tr>
<center><input type=\"submit\" name=\"submit\" value=\"submit\" id=\"submit\"></center>
</form></center>";

?>
