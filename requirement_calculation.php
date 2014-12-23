<?php include 'script_link.php'; ?>

<head>
  <script>
   $("document").ready(function(){
     $(".requirement-table").hide();
     
     $("#display_diagram").hide();
     $("#view_diagram").click(function(){
       $("#display_diagram").toggle();
     });
     $("#select_all").click(function(){
       $(".requirement-table").toggle();
     });
     $("#draw_0").click(function(){
       drawCasting($("#draw_0").data("index"));
     });
     $("#draw_1").click(function(){
       drawCasting($("#draw_1").data("index"));
     });
     $("#draw_2").click(function(){
       drawCasting($("#draw_2").data("index"));
     });
     $("#draw_3").click(function(){
       drawCasting($("#draw_3").data("index"));
     });
     $("#draw_4").click(function(){
       drawCasting($("#draw_4").data("index"));
     });
     $("#draw_5").click(function(){
       drawCasting($("#draw_5").data("index"));
     });
     $("#draw_6").click(function(){
       drawCasting($("#draw_6").data("index"));
     });
     $("#draw_7").click(function(){
       drawCasting($("#draw_7").data("index"));
     });
     $("#draw_8").click(function(){
       drawCasting($("#draw_8").data("index"));
     });
     $("#draw_9").click(function(){
       drawCasting($("#draw_9").data("index"));
     });
     $("#draw_10").click(function(){
       drawCasting($("#draw_10").data("index"));
     });
     $("#draw_11").click(function(){
       drawCasting($("#draw_11").data("index"));
     });
     function drawCasting(i)
     {
       $("#fit_inside .box").remove();
       $("#fit_inside #actual_box").remove();
       $(".actual-box .cavity").remove();
     var cast_width=$("#casting_length").data("cast-width");
     var cast_height=$("#casting_breadth").data("cast-height");
     var actual_box_width=$("#box_length_"+i).data("box-width");
     var actual_box_height=$("#box_breadth_"+i).data("box-height");
       
     var row=$("#cavity_"+i).data("cavity");
       console.log(actual_box_width);
       $("#display_diagram #fit_inside").append("<div class='box' data-toggle='tooltip' data-placement='top' title='"+actual_box_width+"X"+actual_box_height+"' data-original-title='original box' id='original_box'> <div class='actual-box' id='actual_box' data-toggle='tooltip' data-placement='top' title='"+(actual_box_width-80)+" X "+(actual_box_height-80)+"' data-original-title='actual box'></div></div>");
        
      
     console.log(row);
     var cavity=0;
     var temp_cast_width=cast_width,temp_cast_height=cast_height;
     var box_width=$("#original_box").css("width");
     var box_height=$("#original_box").css("height");
      
     box_width=box_width.split("px");
       
     box_height=box_height.split("px");
       
    
      var new_cast_width=(parseInt(box_width[0])/actual_box_width);
      var new_cast_height=(parseInt(box_height[0])/actual_box_height);
       cast_width*=new_cast_width;
      cast_height*=new_cast_height;
     
    // }

     var margin_left=30*new_cast_width;
     var margin_top=30*new_cast_height;
     margin_left=parseInt(margin_left);
       margin_top=parseInt(margin_top);
     while(cavity<row)
     {
        $(".actual-box").append("<div class='cavity' style='margin-left:"+margin_left+"px;margin-top:"+margin_top+"px;border:1px solid black;height:"+parseInt(cast_height)+"px;  width:"+parseInt(cast_width)+"px;float:left' data-toggle='tooltip' data-placement='top' title='"+temp_cast_width+"X"+temp_cast_height+"' data-original-title='actual box'></div>");
       
       cavity++;
     }
       $('[data-toggle="tooltip"]').tooltip();          
        
    }
     drawCasting(0);
     $('[data-toggle="tooltip"]').tooltip();
   });
  </script>
</head>
<body>
      
<?php

include 'dbconfig.php';
include 'required_function.php';
include 'input.php';
if($box_length<$casting_length && $box_breadth < $casting_breadth)
{
  header('location:index.php?error=casting dimension must be less than box dimension');
}
$select_dimension="select * from box_dimension where length >= $box_length and breadth >= $box_breadth and cope_height >= $box_cope_height and drag_height >= $box_drag_height";
$result_dimension=mysql_query($select_dimension);
//echo $select_dimension."<br>";
$count=mysql_num_rows($result_dimension);
$i=0;
$no_of_rows=0;
$no_of_columns=0;
while($search=mysql_fetch_assoc($result_dimension))
{
  $length=$search['avl_length'];
  $breadth=$search['avl_breadth'];
  
  $no_of_rows=0;
  $no_of_columns=0;
  
  
  
  $temp_casting_length=$casting_length+30;
  $temp_casting_breadth=$casting_breadth+30;
  
  while( ($length - 30 ) > $temp_casting_length )
  {
    $no_of_rows++;
    $temp_casting_length+=$casting_length+30;
  
  }
  
  while( ($breadth - 30 ) > $temp_casting_breadth)
  {
    $no_of_columns++;
    $temp_casting_breadth+=$casting_breadth+30;
  }
 
  $cavity=$no_of_rows*$no_of_columns;
  $no_of_cavity[$i]=$cavity; 
  $box_dimension_length[$i]=$search['length'];
  $box_dimension_breadth[$i]=$search['breadth'];
  $box_dimension_cope_height[$i]=$search['cope_height'];
  $box_dimension_drag_height[$i]=$search['drag_height'];
  $i++;
}


for($i=0;$i<$count;$i++)
{
$sand_requirement[$i]=round(sandRequirement($casting_length,$casting_breadth,$casting_height,$box_dimension_length[$i],$box_dimension_breadth[$i],$box_dimension_cope_height[$i],$box_dimension_drag_height[$i],$no_of_cavity[$i]),2);
 
  $new_sand[$i]=round(getPercentageValue($sand_requirement[$i],2),2);
  $bertonite[$i]=round(getPercentageValue($sand_requirement[$i],0.8),2);
  $lustrous[$i]=round(getPercentageValue($sand_requirement[$i],0.4),2);
  $return_sand[$i]=round(($sand_requirement[$i]-($new_sand[$i]+   $bertonite[$i]+$lustrous[$i])),2);
}

echo "<div class='container'>
<div class='row'>";
echo "<h3 class='text-center'>Sand Requirement</h3>";
echo "<div class='single_content_table'>";
  echo "<table class='table table-hover table-bordered'><tr>";
    echo "<td class='active'>Length</td>";
    echo "<td class='success'>Breadth</td>";
    echo "<td class='warning'>Cope Height</td>";
    echo "<td class='danger'>Drag Height</td>";
    echo "<td class='info' >Sand Requirement</td>";
    echo "<td class='success' >No of cavity</td>";
    echo "<td class='success' >New Sand (2%)</td>";
    echo "<td class='warning' >Bentonite (0.8%)</td>";
    echo "<td class='danger' >Lustrous (0.4%)</td>";
    echo "<td class='info' >Return Sand</td>";
    echo "</tr>";
      printTable($box_dimension_length,1,0);
      printTable($box_dimension_breadth,1,0);
      printTable($box_dimension_cope_height,1,0);
      printTable($box_dimension_drag_height,1,0);
      printTable($sand_requirement,1,0);
      printTable($no_of_cavity,1,0);
      printTable($new_sand,1,0);
      printTable($bertonite,1,0);
      printTable($lustrous,1,0);
      printTable($return_sand,1,0);
  echo "</tr>";
echo "</table>";
echo "</div>";
echo "</div>
</div>";
 
?>
<div class="container" style="float:left" >
  <div class="row">
  <button class="btn btn-primary col-md-3 col-md-offset-5" id="select_all" style="margin-bottom:10px;">Click to Get All Requirement</button>
  <button id="view_diagram" class="btn btn-primary col-md-3 col-md-offset-5" id="select_all" style="margin-bottom:10px;">View Diagram</button>
    </div>
</div>

<div class="container">
  <div class="row">
<?php 
    echo "<div data-cast-width= '".$casting_length."' id='casting_length'></div>";
    echo "<div data-cast-height='".$casting_breadth."' id='casting_breadth'></div>";
    echo "<div data-cast-weight='".$cast_value."' id='casting_weight'></div>";
 for($i=0;$i<$count;$i++)
 {
    
    echo "<div data-box-width='". $box_dimension_length[$i]."' id='box_length_$i'></div>";
    echo "<div data-box-height='".$box_dimension_breadth[$i]."' id='box_breadth_$i'></div>";
    echo "<div data-cavity='". $no_of_cavity[$i]."' id='cavity_$i'></div>";
   echo "<div data-sand-requirement='". $sand_requirement[$i]."' id='sand_requirement_$i'></div>";
 }
?>
    </div>
</div>
<?php
  echo "<div class='container' style='margin-bottom:10px;'> <div class='row'>";
  echo "<div class='table-responsive requirement-table'>";
  echo "<table class='table table-hover table-bordered'><tr>";
    echo "<td class='active'>Length</td>";
    printTable($box_dimension_length,$count,0);
  echo "</tr>";
  echo "<tr>";
    echo "<td class='success'>Breadth</td>";
    printTable($box_dimension_breadth,$count,0);
  echo "</tr>";
  echo "<tr>";
    echo "<td class='warning'>Cope Height</td>";
      printTable($box_dimension_cope_height,$count,0);
  echo "</tr>";
  echo "<tr>";
    echo "<td class='danger'>Drag Height</td>";
    printTable($box_dimension_drag_height,$count,0);
  echo "</tr>";
  echo "<tr>";
    echo "<td class='info' >Sand Requirement</td>";
      printTable($sand_requirement,$count,0);
  echo "</tr>";
  echo "<tr>";
    echo "<td class='success' >No of cavity</td>";
      printTable($no_of_cavity,$count,0);
    echo "</tr>";
  echo "<tr>";
    echo "<td class='success' >New Sand (2%)</td>";
      printTable($new_sand,$count,0);
  echo "</tr>";
  echo "<tr>";
    echo "<td class='warning' >Bentonite (0.8%)</td>";
      printTable($bertonite,$count,0);
  echo "</tr>";
  echo "<tr>";
    echo "<td class='danger' >Lustrous (0.4%)</td>";
      printTable($lustrous,$count,0);
  echo "</tr>";
  echo "<tr>";
    echo "<td class='info' >Return Sand</td>";
      printTable($return_sand,$count,0);
  echo "</tr>";
  echo "<tr>";
    echo "<td>Select to view the cast diagram</td>";
    for($i=0;$i<$count;$i++)
    {
      echo "<td><button data-index='".($i)."' name='draw_diagram' id='draw_".($i)."' value='Click' class='btn btn-primary'>Click!!</button></td>";
    }
    
echo "</table>";
echo "</div></div></div>";

?>


<div class="container" id="display_diagram">
  <div class="row" id="fit_inside">
   
  </div>
  
</div>

  <?php getCalculation($quantity,$grade,$crca,$pig_iron,$foundry,$type);
        getSandCost();
        
  ?>
  
  
  <div class="container">
    <div class="row">
      <div id="sand_cost">
        <h3> Sand Cost:
        <small>
        <form class="form-inline">
          <div class="radio">
            <label>
              <input type="radio"  name="sand_cost_rate" id="default" checked>Default
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio"  name="sand_cost_rate" id="manual">Manual
            </label>
          </div>
        </form>
          <form id="form-rate" class="form-inline">
            <div class="form-group">
              <label class="col-md-5 control-label">New Sand Rate:</label>
              <input type="text" name="new_sand" id="new_sand_rate" class="form-control" pattern="[0-9]*.[0-9]*">
            </div>
            
            <div class="form-group">
              <label class="col-md-5 control-label">Bentonite Rate:</label>
              <input type="text" name="bentonite" id="new_bentonite_rate" class="form-control" pattern="[0-9]*.[0-9]*">
            </div>
            
            <div class="form-group">
              <label class="col-md-4 control-label">Lustron Rate:</label>
              <input type="text" name="lustron" id="new_lustron_rate" class="form-control" pattern="[0-9]*.[0-9]*">
            </div>
            <div class="form-group">
              <input type="button" name="change" id="change_value" value="Change the rate!!" class="btn btn-primary">
            </div>
          </form>
        </small>
        
        </h3>
        <p id="text_message"></p>
      </div>
    </div>
  </div>
  <?php getColdCost();?>
    
</body>
