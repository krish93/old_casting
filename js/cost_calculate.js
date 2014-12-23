 function appendTable(div_name,material_name,qty,rate,cost)
  {
    var new_name=material_name.replace(" ","_");
    //new_name=new_name.toLocaleLowerCase();
    $("#"+div_name).append("<tr><td>"+material_name+"</td><td>"+qty+"</td><td id='"+new_name+"_rate'>"+rate+"</td><td id='"+new_name+"_cost'>"+cost+"</td></tr>"); 
  }

$("document").ready(function(){
  var new_sand_qty,new_sand_cost,bentonite_qty,bentonite_cost,lustron_qty,lustron_cost,total_new_sand_cost,total_bentonite_cost,total_lustron_cost;
  var yields=62,lm,good_casting,sand_cost_good_casting,no_of_boxes=1,i,sand_mix,pouring_weight,total_cost,total_qty,change_total_cost;
  
 
  
  
  function changeRate(rate_id,total_id,change_name,change_cost,rate)
  {
      $(rate_id).empty();
      $(rate_id).append(rate);
    
      var sand_qty=$(rate_id).siblings()[1].innerHTML;
      sand_qty=parseFloat(sand_qty);
      rate=parseFloat(rate);
      var change_value=sand_qty*rate;
      change_value=parseFloat(change_value);
      
      var total_value=$("#Total_cost").html();
      total_value=parseFloat(total_value);
      change_total_cost=total_value-parseFloat(change_cost)+change_value;
      console.log(change_total_cost);
      $(total_id).empty();
      $(total_id).append(change_value);
      $("#Total_cost").empty();
      $("#Total_cost").append(change_total_cost );
    
      if(isNaN(rate))
      {
        $(rate_id).append(change_name);
        $(total_id).append(change_cost);
        $("#Total_cost").append(total_cost);
      }
  }
  
  
  $("#form-rate").hide();
  new_sand_qty = $("#new_sand").data("qty");
  bentonite_qty = $("#bentonite").data("qty");
  lustron_qty = $("#lustron").data("qty");
  sand_mix = $("#sand_mix").data("qty");
  total_qty = new_sand_qty + bentonite_qty + lustron_qty;
  
  new_sand_cost = $("#new_sand").data("cost");
  bentonite_cost = $("#bentonite").data("cost");
  lustron_cost = $("#lustron").data("cost");
  
  total_new_sand_cost = new_sand_qty * new_sand_cost;
  total_bentonite_cost = bentonite_qty * bentonite_cost;
  total_lustron_cost = lustron_qty * lustron_cost;
  total_cost = total_new_sand_cost + total_bentonite_cost + total_lustron_cost;
  
  var actual_box_width=$("#box_length_"+0).data("box-width");
  var actual_box_height=$("#box_breadth_"+0).data("box-height");     
  var row=$("#cavity_"+0).data("cavity");
  var sand_requirement=$("#sand_requirement_"+0).data("sand-requirement");
  //console.log(actual_box_width+" "+actual_box_height+" "+row+" "+sand_requirement);
  var new_sand_requirement=sand_requirement;

  while(new_sand_requirement<sand_mix)
  {
    new_sand_requirement+=sand_requirement;
    
    no_of_boxes++;
  }
  console.log(no_of_boxes);
  pouring_weight=$("#casting_weight").data("cast-weight");
  console.log(pouring_weight);
  lm = no_of_boxes * pouring_weight;
  good_casting = (yields / 100) * lm;
  sand_cost_good_casting = total_cost / good_casting;
  
  $("#sand_cost").append("<table id='sand_cost_table' class='table table-hover table-bordered text-center'><tr><th colspan='4' >For 3000kgs mix</th></tr><tr><th>Material</th><th>Qty</th><th>Rate/Kg</th><th>Total Cast</th></tr>")
  
  appendTable("sand_cost_table","New Sand",new_sand_qty,new_sand_cost,total_new_sand_cost);
  appendTable("sand_cost_table","Bentonite",bentonite_qty,bentonite_cost,total_bentonite_cost);
  appendTable("sand_cost_table","Lustron",lustron_qty,lustron_cost,total_lustron_cost);
  appendTable("sand_cost_table","Total",total_qty,"-",total_cost);
  appendTable("sand_cost_table","Yield",yields,"-","-");
  appendTable("sand_cost_table","LM(kgs)",parseInt(lm),"-","-");
        appendTable("sand_cost_table","Good Casting",parseInt(good_casting),"-","-");
  appendTable("sand_cost_table","Sand Cost Per Kg Of Good Casting ",sand_cost_good_casting.toFixed(2),"-","-");
  $("#sand_cost").append("</table>");
  
  
  
  
  $("#new_sand_rate").keyup(function(){
      var rate=$("#new_sand_rate").val();
      if(isNaN(rate))
      {
        $("#text_message").addClass("alert alert-danger");
        $("#text_message").text("Enter Only Numbers.");
      }
    else
    {
      $("#text_message").removeClass("alert alert-danger");
      $("#text_message").text("");
      changeRate("#New_Sand_rate","#New_Sand_cost",new_sand_cost,total_new_sand_cost,rate);
    }
    });
  
  $("#new_bentonite_rate").keyup(function(){
      var rate=$("#new_bentonite_rate").val();
      if(isNaN(rate))
      {
        $("#text_message").addClass("alert alert-danger");
        $("#text_message").text("Enter Only Numbers.");
      }
    else
    {
      $("#text_message").removeClass("alert alert-danger");
      $("#text_message").text("");
      changeRate("#Bentonite_rate","#Bentonite_cost",bentonite_cost,total_bentonite_cost,rate);
    }
    });
  
  $("#new_lustron_rate").keyup(function(){
      var rate=$("#new_lustron_rate").val();
    if(isNaN(rate))
      {
        $("#text_message").addClass("alert alert-danger");
        $("#text_message").text("Enter Only Numbers.");
      }
    else
    {
      $("#text_message").removeClass("alert alert-danger");
      $("#text_message").text("");
      changeRate("#Lustron_rate","#Lustron_cost",lustron_cost,total_lustron_cost,rate);
    }
    });
  
  $("#manual").click(function(){
    $("#form-rate").fadeIn();
    
  });
  
  $("#default").click(function(){
    $("#form-rate").fadeOut();
  });
  
  $("#change_value").click(function(){
    var sand_changed_value=$("#new_sand_rate").val();
    var bentonite_changed_value=$("#new_bentonite_rate").val();
    var lusrton_changed_value=$("#new_lustron_rate").val();
    if(isNaN(sand_changed_value)||isNaN(bentonite_changed_value)||isNaN(lusrton_changed_value))
    {
      $("#text_message").addClass("alert alert-danger");
      $("#text_message").text("Rate Value Contains Alphabet");
    }
    else
    {
    var data_string="sand="+sand_changed_value+"&bentonite="+bentonite_changed_value+"&lustron="+lusrton_changed_value;
    $.ajax({
      url:'update_cost.php',
      type: 'POST',
      data: data_string,
      success:function(data)
      {
        console.log(data);
        if(data==1)
        {
          console.log("Updation successfull...");
        }
        else
        {
          console.log("Updating the rate failed..");
        }
      },
      error:function(data)
      {
        console.log("error");
        
      }
    });
    }
  });
                           
  
});