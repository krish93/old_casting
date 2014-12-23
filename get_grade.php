<?php
include 'dbconfig.php';
$name=@$_POST['name'];
//@$result[50];
$sql="select grade from grade where type='$name'";
$res=mysql_query($sql);
$count=mysql_num_rows($res);
$result[0]=$count;
$i=1;
while($ans=mysql_fetch_array($res))
{
    $result[$i++]=$ans[0];
}
echo json_encode($result);
?>