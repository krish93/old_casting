$(document).ready(function(){
  $("#weight").change(function(){
    var get_weight=$("#get_weight").val();
    if(get_weight==0)
    {
      alert("enter the weight !!!");
    }
    else
    {
      var weight=$("#weight").val();
    
      $("#cast_value").val(weight*get_weight);
      
    }
  });
   $.ajax({
     url:'get_box_size.php',
     type:'POST',
     dataType:'json',
     success:function(data)
     {
       for(i=1;i<=data[0];i++)
       {
         $("#box_size").append("<option>"+data[i]+"</option>");
       }
     },
     error:function()
     {
       console.log("error");
     }
   });
  
  
                   
  });