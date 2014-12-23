<?php
include 'dbconfig.php';
$result[50]=null;
$sql="select * from box_dimension";
$res=mysql_query($sql);
$count=mysql_num_rows($res);
$result[0]=$count;
$i=1;
while($ans=mysql_fetch_assoc($res))
{
  $length=$ans['length'];
  $breadth=$ans['breadth'];
  $cope_height=$ans['cope_height'];
  $drag_height=$ans['drag_height'];
  $result[$i++]=$length." X ".$breadth." X ".$cope_height." X ".$drag_height;
}

echo json_encode($result);
?>