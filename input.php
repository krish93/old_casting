<?php
$no_of_cavity[50]=0;
$box_dimension_length[50]=0;
$box_dimension_breadth[50]=0;
$box_dimension_cope_height[50]=0;
$box_dimension_drag_height[50]=0;
$sand_requirement[50]=0;
@$final_return_requirement[[]];
$new_sand[50]=0;
$bertonite[50]=0;
$lustrous[50]=0;
$return_sand[50]=0;
$weight=@$_POST['weight'];
$casting_weight=@$_POST['casting_weight'];
$cast_value=$weight*$casting_weight;
$core_weight=@$_POST['core_weight'];
$casting_length=@$_POST['casting_length'];
$casting_breadth=@$_POST['casting_breadth'];
$casting_height=@$_POST['casting_height'];

$quantity=@$_POST['quantity'];
@$sg_iron=@$_POST['sg_post'];
@$pig_iron=@$_POST['pig_iron'];
$grade=@$_POST['grade'];
@$type=@$_POST['iron'];

$crca=@$_POST['crca'];
$pig_iron=@$_POST['pig_iron'];
@$foundry=@$_POST['foundry'];

$sand_mix=@$_POST['sand_mixer'];
$box_dimension=@$_POST['box_dimension'];
$box_dimension=trim($box_dimension,"X");
$str=preg_replace('/\s+/','',$box_dimension);

$dimension=explode('X',$box_dimension);
$box_length=$dimension[0];
$box_breadth=$dimension[1];
$box_cope_height=$dimension[2];
$box_drag_height=$dimension[3];

?>