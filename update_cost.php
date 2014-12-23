<?php
  include 'dbconfig.php';
  $sand=@$_POST['sand'];
  $bentonite=@$_POST['bentonite'];
  $lustron=@$_POST['lustron'];
  @$reply=0;
  if(isset($sand))
  {
    $reply=update($sand,"new_sand");
    if($reply==0)
      echo $reply;
    else 
      $reply=1;
  }
  if(isset($bentonite))
  {
    $reply=update($bentonite,"bentonite");
    if($reply==0)
      echo $reply;
    else
      $reply=1;
  }
  if(isset($lustron))
  {
    $reply=update($lustron,"lustron");
    if($reply==0)
        echo $reply;
    else 
      $reply=1;
  }

  function update($value,$name)
  {
    global $reply;
    $sql="update raw_material  set cost=$value where material='$name'";
    $ans=mysql_query($sql);
    if($ans)
      return 1;
    else
      return 0;
  }
  echo $reply;
?>