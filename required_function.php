<?php
  @$CRCA=0;
  @$PIGIRON=0;
  @$RR=0;
  $crca_weight[50]=0.0;
  $pig_weight[50]=0.0;
  $rr_weight[50]=0.0;
  
function sandRequirement($length,$breadth,$height,$box_length,$box_breadth,$box_cope_height,$box_drag_height,$cavity)
{
  $casting=($length*$breadth*$height*1510)/pow(10,9);
  $box=($box_length*$box_breadth*($box_cope_height+$box_drag_height)*1510)/pow(10,9);
  return $box-($casting*$cavity);
}

function getPercentageValue($sand_requirement,$percent)
{
  return $sand_requirement*($percent/100);
}


function printTable($content,$count,$index)
{
  for($i=$index;$i<$count;$i++)
  {
    echo "<td>".round($content[$i],0)."</td>";
  }
}

function getCalculation($quantity,$grade,$crca,$pig_iron,$foundry,$type)
{

  $percentage_material[50][50]=0.0;
  $raw_cost=31.6;
  if($crca)
  {
    $CRCA=(60/100)*$quantity;
  }
  if($pig_iron&&$foundry)
  {
    $RR=(30/100)*$quantity;
    $PIGIRON=(10/100)*$quantity;
  }
  else if($foundry)
  {
    $RR=(40/100)*$quantity;
  }
  $i=0;

  $sql="select * from grade where type='$type'";
  $res=mysql_query($sql);
  $j=0;
  $user_requested=0;
  while($ans=mysql_fetch_assoc($res))
  {
    
    $i=0;
    if($grade==$ans['grade'])
    {
      $user_requested=$j;
    }
    $percentage_material[$j][$i++]=$ans['grade'];
    $percentage_material[$j][$i++]=$ans['carbon'];
    $percentage_material[$j][$i++]=$ans['silicon'];
    $percentage_material[$j][$i++]=$ans['manganese'];
    $percentage_material[$j][$i++]=$ans['copper'];
    $j++;
  }
  $no_of_grade=$j;
  $no_of_elements=$i;

  $sql_weight="select * from grade where type='crca'";
  $res=mysql_query($sql_weight);
  $i=0;
  
  while($ans=mysql_fetch_assoc($res))
  {
    $crca_weight[$i++]=($ans['carbon']/100)*$CRCA;
    $crca_weight[$i++]=($ans['silicon']/100)*$CRCA;
    $crca_weight[$i++]=($ans['manganese']/100)*$CRCA;
    $crca_weight[$i++]=($ans['copper']/100)*$CRCA;
  }


 $sql_weight="select * from grade where type='pig_iron'";
  $res=mysql_query($sql_weight);
  $i=0;
  while($ans=mysql_fetch_assoc($res))
  {
    $pig_weight[$i++]=($ans['carbon']/100)*@$PIGIRON;
    $pig_weight[$i++]=($ans['silicon']/100)*@$PIGIRON;
    $pig_weight[$i++]=($ans['manganese']/100)*@$PIGIRON;
    $pig_weight[$i++]=($ans['copper']/100)*@$PIGIRON;
  }

 $sql_weight="select * from grade where type='foundry'";
  $res=mysql_query($sql_weight);
  $i=0;
  while($ans=mysql_fetch_assoc($res))
  {
    $rr_weight[$i++]=($ans['carbon']/100)*$RR;
    $rr_weight[$i++]=($ans['silicon']/100)*$RR;
    $rr_weight[$i++]=($ans['manganese']/100)*$RR;
    $rr_weight[$i++]=($ans['copper']/100)*$RR;
  }

$total_weight[50]=0.0;
$count=$i;
  
for($j=0;$j<$count;$j++)
{
  $total_weight[$j]=$crca_weight[$j]+$pig_weight[$j]+$rr_weight[$j];
  $total_weight[$j]=($total_weight[$j]/$quantity)*100;
  
  
}
$required[50][50]=0.0;
$recovery[50]=0.0;
$cost[50]=0.0;
$individual_cost[50][50]=0.0;
$material[50]="";
  $sql="select * from raw_material where type='sg_iron'";
  $res=mysql_query($sql);
  $i=0;
  while($ans=mysql_fetch_assoc($res))
  {
    $material[$i]=$ans['material'];
    $recovery[$i]=$ans['recovery'];
    $cost[$i]=$ans['cost'];
    $i++;
  }
  $material_count=$i;
  
  for($index=0;$index<$no_of_grade;$index++)
  {
    $elements=1;
      for($i=0;$i<$material_count;$i++)
      {
          if($material[$i]=="graphite")
          {
            
            $required[$index][$i]=($percentage_material[0][1]-$total_weight[0])*$quantity/$recovery[$i];
            
            $individual_cost[$index][$i]=$cost[$i]*$required[$index][$i];
            $required[$index][$i]=round($required[$index][$i],2);
            $individual_cost[$index][$i]=round($individual_cost[$index][$i],2);
            //echo $required[$index][$i]." ";  
          }
          else
          {
            $required[$index][$i]=($percentage_material[$index][$elements]-$total_weight[$i])*$quantity/$recovery[$i];
            $individual_cost[$index][$i]=$cost[$i]*$required[$index][$i];
            $required[$index][$i]=round($required[$index][$i],2);
            $individual_cost[$index][$i]=round($individual_cost[$index][$i],2);
            //echo $required[$index][$i]." ";  
          }
          
          $elements++;
        
        
      }
  }
  $zero=0;
  if(isset($PIGIRON))
  {
    $pig_raw_cost=$raw_cost;
    $total_pig_raw_cost=$PIGIRON*$raw_cost;
  }
  else
  {
    $PIGIRON=0;
    $pig_raw_cost=0;
    $total_pig_raw_cost=0;
  }
  $total_crca_raw_cost=$CRCA*$raw_cost;
  $total_rr_raw_cost=$RR*$raw_cost;
  $total_raw_cost=$total_pig_raw_cost+$total_crca_raw_cost+$RR*$raw_cost;
  echo "<div class='container table-responsive' id='material'> <div class='row'>";
  echo "<h3>Raw Material Cost</h3>";
  echo "<table class='table table-bordered table-hover'>
  <tr class='info'>";
  echo "<td>SG IRON</td>";
  echo "<td>Grade $grade</td>";
  echo "<td>Cost Per Kg</td>";
  echo "<td>Total Cost</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>CRCA</td>";
  echo "<td>".$CRCA."</td>";
  echo "<td>$raw_cost</td>";
  echo "<td>".$total_crca_raw_cost."</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Pig Iron</td>";
  echo "<td>".@$PIGIRON ."</td>";
  echo "<td>$pig_raw_cost</td>";
  echo "<td>$total_pig_raw_cost</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>Foundry R/R</td>";
  echo "<td>".$RR."</td>";
  echo "<td>$raw_cost</td>";
  echo "<td>".$total_rr_raw_cost."</td>";
  echo "</tr>";
  
  echo "<tr>";
  echo "<td>Total</td>";
  echo "<td>".$quantity."</td>";
  echo "<td></td>";
  echo "<td>$total_raw_cost</td>";
  echo "</tr>";
  
  for($i=0;$i<$material_count;$i++)
  {
    
  echo "<tr>";
  echo "<td>".strtoupper($material[$i])."</td>";
  echo "<td>".$required[$user_requested][$i]."</td>";
  echo "<td>".$cost[$i]."</td>";
  echo "<td>".$individual_cost[$user_requested][$i]."</td>";
  echo "</tr>";
  }
  echo "</table>";
  echo "</div></div>";
}

function getSandCost()
{
  global $sand_mix;
  $sand=preg_replace('/[a-z]*/','',$sand_mix);
  $sand_qty[0]=$sand*0.02;
  $sand_qty[1]=$sand*0.008;
  $sand_qty[2]=$sand*0.004;
  $sql="select * from raw_material where type='sand_cost'";
  $res=mysql_query($sql);
  $i=0;
  while($ans=mysql_fetch_assoc($res))
  {
    $material[$i]=$ans['material'];
    $cost[$i]=$ans['cost'];
    $i++;
  }
  $count=$i;
  echo "<div class='container'><div class='row'><div data-qty='$sand' id='sand_mix'></div>";
  for($i=0;$i<$count;$i++)
  {
    echo "<div data-qty='$sand_qty[$i]' data-cost='$cost[$i]' id='$material[$i]'></div>";
  }
  echo "<div id='display_sand'></div></div></div>";
}

function getColdCost()
{
  global $core_weight;
  $core_weight=preg_replace('/[a-z]*/','',$core_weight);
  $sql="select * from raw_material where type='cold_cost'";
  $res=mysql_query($sql);
  $i=0;
  while($ans=mysql_fetch_assoc($res))
  {
    $material[$i]=$ans['material'];
    $cost[$i]=$ans['cost'];
    $i++;
  }
  
  $cold_qty[0]=$core_weight*(100/100);
  $cold_qty[1]=$core_weight*(0.85/100);
  $cold_qty[2]=$core_weight*(0.85/100);
  $cold_qty[3]=$core_weight*(0.0023/100);
  
   
  $count=$i;
  echo "<div class='container'><div class='row'><div data-qty='$core_weight' id='cold_cost'></div>";
  for($i=0;$i<$count;$i++)
  {
    echo "<div data-qty='$cold_qty[$i]' data-cost='$cost[$i]' id='$material[$i]'></div>";
  }
  echo "<div id='display_cold_cost'></div></div></div>";
}
?>