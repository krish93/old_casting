<?php
//if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES["file"])) {
mysql_connect("localhost","root","harikrishnancse");
mysql_select_db("casting");



$allowedExts = array("doc","xls","pdf","xlsx","csv","docx","acrobat");
print_r ($_FILES)."<br>";
$temp = explode(".", @$_FILES["file"]["name"][5]);
$extension = end($temp);
$ext = pathinfo($_FILES["file"]['name'][0], PATHINFO_EXTENSION);
echo $ext;
$finfo = finfo_open(FILEINFO_MIME_TYPE);
echo finfo_file($finfo, $_FILES["file"]["name"][0]);
finfo_close($finfo);

/*
upload(0,"a");
upload(1,"b");
upload(2,"c");
upload(3,"d");
upload(4,"e");
upload(5,"f");
*/
//application/acrobat, applications/vnd.pdf, text/pdf, text/x-pdf
function upload($i,$name)
{
  $allowedExts = array("doc","xls","pdf","xlsx","csv","docx","acrobat");
  $temp = explode(".", @$_FILES["file"]["name"][$i]);
  $extension = end($temp);
  print_r($_FILES);
if (((@$_FILES["file"]["type"][$i] == "application/pdf")
||(@$_FILES["file"]["type"][$i] == "application/x-pdf")
||(@$_FILES["file"]["type"][$i] == "application/acrobat")
||(@$_FILES["file"]["type"][$i] == "application/vnd.pdf")
||(@$_FILES["file"]["type"][$i] == "text/pdf")
||(@$_FILES["file"]["type"][$i] == "text/x-pdf")
|| (@$_FILES["file"]["type"][$i] == "application/ms-word")
|| (@$_FILES["file"]["type"][$i] == "application/vnd.ms-excel")) 
|| (@$_FILES["file"]["type"][$i] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
|| (@$_FILES["file"]["type"][$i] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
|| (@$_FILES["file"]["type"][$i] == "application/vnd.ms-word.document.macroEnabled.12")
&& in_array($extension, $allowedExts))
  {
  if(@$_FILES["file"]["size"][$i] > 5000000)
  {
    header("Location:upload.php?error=File Size exceeds(5MB)");
  }
  if ($_FILES["file"]["error"][$i] < 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"][$i] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"][$i] . "<br>";
    echo "Type: " . $_FILES["file"]["type"][$i] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"][$i] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"][$i] . "<br>";

    if (file_exists("upload/" . $_FILES["file"]["name"][$i]))
      {
      echo $_FILES["file"]["name"][$i] . " already exists. ";
      }
    else
      {
      $extension=explode(".",$_FILES["file"]["name"][$i]);
      $_FILES["file"]["name"][$i]=$name.".".$extension[1];
      move_uploaded_file($_FILES["file"]["tmp_name"][$i],
      "upload/" . $_FILES["file"]["name"][$i]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"][$i]."<br>";
      $loc= "upload/" . $_FILES["file"]["name"][$i]."<br>";
      
      $size=$_FILES["file"]["size"][$i];
      $type=$_FILES["file"]["type"][$i];
    //  $sql="insert into file values('','$name','$desc','$choice','$size','$loc','$type')";
    //  mysql_query($sql);
      }
    }
  }
else
  {
    //header("Location:upload.php?error=Invalid File Format");
  }
    // move_uploaded_file()
//}
}
?>