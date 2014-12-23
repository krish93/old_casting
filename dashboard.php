<?php include'script_link.php'?>
<script>
$(document).ready(function(){
  function getGrade(grade_name)
  {
     $.ajax({
      url:'get_grade.php',
     type:'POST',
      data:grade_name,
     dataType:'json',
     success:function(data)
      {
  
        for(var i=1;i<=data[0];i++)
        {
          $("#grade").append("<option class='new_grade'>"+data[i]+"</option");
        }
      },
      error:function()
      {
        console.log("error in getting grade");
      }
    });
  }
  
  $("#iron_new").click(function(){
    $(".new_grade").remove();
    var name=$("#iron_new").data("name");
    var grade_name="name="+name;
  
   getGrade(grade_name);
  });
  $("#iron_new1").click(function(){
    $(".new_grade").remove();
    var name=$("#iron_new1").data("name");
    var grade_name="name="+name;
  
   getGrade(grade_name);
  });
});
</script>
<body>

  <div class="container">
    <div class="row">
      <div class="col-md-5 col-md-offset-0" style="float:left">
      <form method="post"  id="ajax_form" role="form" class="form form-horizontal" action="requirement_calculation.php">
        <div class="form-group">
          <label class="col-sm-4 control-label">Weight:</label>
            <div class="col-sm-8">
              <input type="text" pattern="[0-9]*.[0-9]*"name="weight" id="get_weight" placeholder="weight" class="form-control" required />
            </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-4 control-label">Casting Weight:</label>
            <div class="col-sm-8">
              <select name="casting_weight" class="form-control" id="weight">
                <option disabled selected >Select the value</option>
                <option>1.1</option>
                <option>1.14</option> 
                <option>1.2</option>
                <option>1.25</option>
              </select>
            </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-4 control-label">Casting Value:</label>
            <div class="col-sm-8">
              <input type="text" name="cast_value" placeholder="casting weight value" id="cast_value" class="form-control" value="" disabled>
            </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-4 control-label">Casting Length:</label>
            <div class="col-sm-8">
              <input type="text" pattern="[0-9]*" id="casting_length" name="casting_length" placeholder="Casting Length" class="form-control" required>
            </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-4 control-label">Casting Breadth:</label>
            <div class="col-sm-8">
              <input type="text" pattern="[0-9]*" id="casting_breadth" name="casting_breadth" placeholder="Casting Breadth" class="form-control" required>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-4 control-label">Casting Height:</label>
            <div class="col-sm-8">
              <input type="text" pattern="[0-9]*" id="casting_height" name="casting_height" placeholder="Casting Height" class="form-control" required>
            </div>
        </div>
   <!--     
        <div class="form-group">
          <label class="col-sm-4 control-label">Box Length:</label>
            <div class="col-sm-8">
              <input type="text" pattern="[0-9]*" id="box_length" class="form-control" name="box_length" placeholder="Box Length" required>
            </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-4 control-label">Box Breadth:</label>
            <div class="col-sm-8">
              <input type="text" pattern="[0-9]*"   id="box_breadth" name="box_breadth"  placeholder="Box Breadth" class="form-control" required>
            </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-4 control-label">Box Cope Height:</label>
            <div class="col-sm-8">
              <input type="text" pattern="[0-9]*" id="box_cope_height" name="box_cope_height" placeholder="Cope Height" class="form-control" required>
            </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-4 control-label">Box Drag Height:</label>
            <div class="col-sm-8">
              <input type="text" pattern="[0-9]*" id="box_drag_height" name="box_drag_height" placeholder="Drag Height" class="form-control" required>
            </div>
        </div>-->
        <div class="form-group">
          <label class="col-sm-4 control-label">Box Dimensions:</label>
            <div class="col-sm-8">
              <select id="box_size" class="form-control" name="box_dimension">
                <option disabled selected>Choos Dimensions:</option>
              </select>  
              <div class="help-block">Box Dimension: Length X Breadth X Cope Height X Drag Height</div>
            </div>
        </div>
        </div>
        <div class="col-sm-5 form-horizontal">
          <div class="form-group">
          <label class="col-sm-4 control-label">Quantity:</label>
            <div class="col-sm-8">
              <input type="text" pattern="[0-9]*.[0-9]*"name="quantity" id="quantity" placeholder="Quantity" class="form-control" required />
            </div>
        </div>
          
          <div class="form-group">
          <label class="col-sm-4 control-label">Type of iron:</label>
            <div class="col-sm-8">
              <input type="radio" name="iron" data-name="sg_iron" value="sg_iron" id="iron_new" >SG Iron
              <input type="radio" name="iron" data-name="pig_iron" value="pig_Iron" id="iron_new1" >Pig Iron              
            </div>
            <div class="help-block col-sm-8">Select the Type of iron to see its grade</div>
        </div>
          <div class="form-group">
          <label class="col-sm-4 control-label">Grade:</label>
            <div class="col-sm-8">
              <select class="form-control" id="grade" name="grade" required>
                <option disabled selected>Choose the Grade</option>
              </select>
            </div>
        </div>
          
        <div class="form-group">
          <label class="col-sm-4 control-label">Type of iron:</label>
            <div class="col-sm-8">
              <input type="checkbox" name="crca" value="crca" id="crca" required>CRCA
              <input type="checkbox" name="pig_iron" value="pig_iron" id="pig_iron">Pig Iron
              <input type="checkbox" name="foundry" value="foundry" id="foundry" required>Foundry R/R
            </div>
        </div>
          
        <div class="form-group">
          <label class="col-sm-4 control-label">Sand Mixer Capacity:</label>
            <div class="col-sm-8">
              <select class="form-control" id="sand_mixer" name="sand_mixer">
                <option disabled selected>Choose the sand mixer capacity</option>
                <option>3000kgs</option>
                <option>1000kgs</option>
                <option>500kgs</option>
              </select>
            </div>
        </div>
        
             <div class="form-group">
          <label class="col-sm-4 control-label">Core Weight:</label>
            <div class="col-sm-8">
              <input type="text" pattern="[0-9]*" id="core_weight" name="core_weight" placeholder="Core Weight" class="form-control" required>
            </div>
        </div>
          </div>
        <div class="form-group">
          
          <input type="submit" value="Get Cast!!"  class="btn btn-primary form-control">
            
        </div>
    
</form>
    </div>
    </div>
  </div>
</body>