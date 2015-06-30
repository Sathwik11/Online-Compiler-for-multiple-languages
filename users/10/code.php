


<?php

require_once('../../auth.php');
$sample_ip="";


$sample_code="";
$output=array();
$error=array();
if(isset($_POST['submit']))
{
     $ip=mysql_real_escape_string($_POST['ip']);

	if(isset($ip))
	{
	$ip=str_replace('\r',"",$ip);

   $ip=str_replace('\"','"',$ip);
	$f1=fopen("inp.txt",'w');


        
	$fi_str1=str_replace('\n',"\n",$ip);
	

	$fi_str1=$fi_str1;
	fwrite($f1,$fi_str1,strlen($fi_str1));
	
	
    $sample_ip=str_replace("\n",'&#13;&#10;',$fi_str1);
	
	
	}

   $code=mysql_real_escape_string($_POST['code']);
//$sample_code=$code;
  $ext=$_POST['extension'];
  $allowedExts = array("c", "c++", "java");
 //echo "hello in main";
		
if( isset($_FILES['file']['name']) && ($_FILES["file"]["size"] / 1024)>0) 
{     //echo "hello in file";
    $file_name=$_FILES["file"]["name"];
    $temp = explode(".", $_FILES["file"]["name"]);

      $extension = end($temp);
   if(($_FILES["file"]["size"] / 1024)>0)
    {
   //echo "hello";
     if (in_array($extension, $allowedExts))
      {
       if ($_FILES["file"]["error"] > 0)
       {
      echo "Error in file " . $_FILES["file"]["error"] . "<br>";
       }

       else
       {
    
	$info=pathinfo($_FILES['file']['name']);
    
	
	  $name=$_FILES['file']['name'];
	  $target = $name;
	  move_uploaded_file($_FILES["file"]["tmp_name"],
      $target);
      }
	  $codename=$temp[0];
	  $code1=$codename.".".$extension;
	  
     
     if($extension=="java")//if java
	 {
	 
	
	     $cmd="javac"." ".$code1;

	    system($cmd.'>error.txt 2>&1');

       $error = file_get_contents("error.txt");
       if(empty($error))
        {

        $run="java"." ".$codename;

        system($run.'< inp.txt >err1.txt 2>&1');
	
	   $output=explode("\n",file_get_contents("err1.txt"));

         unlink($codename."."."class");
        }
       else
       {
        unset($output);

         $error = explode("\n",file_get_contents("error.txt"));
       }
     }
	 else if($extension=="c")
	 {
	   $cmd="cc "." ".$code1;
	 
	   system($cmd.'>error.txt 2>&1');

	   $error = file_get_contents("error.txt");
		if(empty($error))
		{

		$run="./a.out";

		system($run.'< inp.txt >err1.txt 2>&1');
		$output=explode("\n",file_get_contents("err1.txt"));

		unlink($run);
		}
	   else
	    {
	    unset($output);

	    $error = explode("\n",file_get_contents("error.txt"));
	    }
	 
	 
	 
	 }
	 else if($extension=="c++")
	 {
		
		$cmd="g++ "." ".$code1;
	 
	   system($cmd.'>error.txt 2>&1');

	   $error = file_get_contents("error.txt");
		if(empty($error))
		{

		$run="./a.out";

		system($run.'< inp.txt >err1.txt 2>&1');
		$output=explode("\n",file_get_contents("err1.txt"));

		unlink($run);
		}
	   else
	    {
	    unset($output);

	    $error = explode("\n",file_get_contents("error.txt"));
	    }
	 
	 
	 
	 }
	 
	}
 }
  
  
}//end for file 
  
  

  
  

else if($code!="")// if  file not uploaded
{
//echo "hello";
  if($ext=='java')
  {

  $code=str_replace('\r',"",$code);

  $code=str_replace('\"','"',$code);

//get class name
  $class_pos=strpos($code,"class");

  $class_brac=strpos($code,"{");

  $start=$class_pos+6;
  $len=$class_brac-$start;


  $file=substr($code,$start,$len);
  $file2=explode(" ",$file);
  $file=str_replace('\n',"",$file2[0]);

//end of get class name



  $file_name=$file.".".$ext;


  $fp=fopen($file_name,'w');
  $i=0; 

        
	$fi_str=str_replace('\n',"\n",$code);
	

	$fi_str=$fi_str;
	fwrite($fp,$fi_str,strlen($fi_str));
	
	
  $sample_code=str_replace("\n",'&#13;&#10;',$fi_str);
	

  $cmd="javac"." ".$file_name;

  system($cmd.'>error.txt 2>&1');

   $error = file_get_contents("error.txt");
   if(empty($error))
   {

    $run="java"." ".$file;

     system($run.'< inp.txt >err1.txt 2>&1');
   $output=explode("\n",file_get_contents("err1.txt"));
   
   //echo $output;
   unlink($file."."."class");
  }
  else
  {
  unset($output);

  $error = explode("\n",file_get_contents("error.txt"));
  }
//else echo $error;



 //unlink($file_name);



}
  else if($ext=='c')
  {
   $code=str_replace('\r',"",$code);

  $code=str_replace('\"','"',$code);

    $file="file";
    $file_name=$file.".".$ext;


    $fp=fopen($file_name,'w');
    $i=0; 

       $fi_str=str_replace('\n',"\n",$code);
	

	$fi_str=$fi_str;
	fwrite($fp,$fi_str,strlen($fi_str));

   $sample_code=str_replace("\n",'&#13;&#10;',$fi_str);
   $cmd="cc "." ".$file_name;
    //echo $cmd;
    system($cmd.'>error.txt 2>&1');

    $error = file_get_contents("error.txt");
    if(empty($error))
   {

   $run="./a.out";

   system($run.'< inp.txt >err1.txt 2>&1');
   $output=explode("\n",file_get_contents("err1.txt"));

   unlink($run);
  }
 
  else
  {
   unset($output);

   $error = explode("\n",file_get_contents("error.txt"));
  }

//unlink($file_name);
//unlink($run);


  }
  else if($ext=='c++')
  {
     $code=str_replace('\r',"",$code);

  $code=str_replace('\"','"',$code);
    $file="file";
	$ext="cpp";
    $file_name=$file.".".$ext;


    $fp=fopen($file_name,'w');
    $i=0; 

       $fi_str=str_replace('\n',"\n",$code);
	
    $sample_code=str_replace("\n",'&#13;&#10;',$fi_str);
	$fi_str=$fi_str;
	fwrite($fp,$fi_str,strlen($fi_str));

     
     $cmd="g++"." ".$file_name;

    system($cmd.'>error.txt 2>&1');

     $error = file_get_contents("error.txt");
    if(empty($error))
    {

    $run="./a.out";

    system($run.'< inp.txt >err1.txt 2>&1');
    $output=explode("\n",file_get_contents("err1.txt"));

    unlink($run);
    }
 
   else
   {
   unset($output);

   $error = explode("\n",file_get_contents("error.txt"));
   }
	
  
  
  }

}
else  // either of cases  ot choosen
{

   //echo "hello";
   echo "<script>alert(\"please upload a file or write a code in given text area\");</script>";
}

}

?>

<div align="right"><a href="../../index.php" align="right">LOGOUT</a></div>
<script>
function Fun() {
str=document.getElementById('ques').value;

  if (str=="") {
    document.getElementById("code").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("code").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","../../getdat.php?q="+str,true);
  xmlhttp.send();
}
</script>

Select question number<select name="ques" id="ques" title="question" onchange="Fun()">
<option value="">-</option>
<option value="1">Question 1</option>
<option value="2">Question 2</option>
<option value="3">Question 3</option>
<option value="4">Question 4</option>
<option value="5">Question 5</option>
<option value="6">Question 6</option>
<option value="7">Question 7</option>
</select>
<br />
Question:<br />
<div id="txtHint" >
</div>
<form name="" id="" method="post" action="" enctype="multipart/form-data" >
<select name="extension" id="extension" >
<option value="c">C</option>
</select>

<table>
<tr><td><div name="ans" id="ans" ><textarea name="code" id="code" rows="30" cols="135"><?php echo $sample_code; ?></textarea></div>
</td>
<td><textarea name="ip" id="ip" cols="50" rows="30" ><?php echo $sample_ip; ?></textarea></td>
</tr>
<tr>
<td><input type="file"  name="file" id="file"  /></td> 

<td>
<input type="submit" value="submit" id="submit" name="submit" />
</td></tr>
</table>
</form>

<div name="output" align="left" >
output:<br />
<?php if(isset($output)){$output=str_replace("\n","<br >",$output); echo implode("<br >",$output);}else{echo "compilation error <br />";$error=str_replace("\n","<br >",$error); echo implode("<br >",$error);} ?></div>

<?php
header( "refresh:1200;url=http://localhost/codebeast/successfull.html" );
?>
