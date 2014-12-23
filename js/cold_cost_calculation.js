
$("document").ready(function(){
  var washed_sand_qty=0,washed_sand_rate=0,total_cost_washed_sand=0,resin_qty=0,resin_rate=0,total_cost_resin=0,hardener_qty=0,hardener_rate=0;
  var total_cost_hardener=0,amine_qty=0,amine_rate=0,total_cost_amine=0;
  var qty=0,total_qty=0,total_cost=0;
  
  function appendTable(div_name,material_name,qty,rate,cost)
  {
    var new_name=material_name.replace(" ","_");
    //new_name=new_name.toLocaleLowerCase();
    $("#"+div_name).append("<tr><td>"+material_name+"</td><td>"+qty+"</td><td id='"+new_name+"_rate'>"+rate+"</td><td id='"+new_name+"_cost'>"+cost+"</td></tr>"); 
  }
  
  qty=$("#cold_cost").data("qty");
  washed_sand_qty=$("#washed_sand").data("qty");
  resin_qty=$("#resin").data("qty");
  hardener_qty=$("#hardener").data("qty");
  amine_qty=$("#amine").data("qty");
  
  
  washed_sand_rate=$("#washed_sand").data("cost");
  resin_rate=$("#resin").data("cost");
  hardener_rate=$("#hardener").data("cost");
  amine_rate=$("#amine").data("cost");
  
  total_qty=washed_sand_qty + resin_qty + hardener_qty + amine_qty;
  console.log(washed_sand_rate);
  total_cost_washed_sand=parseFloat(washed_sand_qty)*parseFloat(washed_sand_rate);
  total_cost_resin=parseFloat(resin_qty)*parseFloat(resin_rate);
  total_cost_hardener=parseFloat(hardener_qty)*parseFloat(hardener_rate);
  total_cost_amine=parseFloat(amine_qty)*parseFloat(amine_rate);
  
  total_cost = total_cost_washed_sand + total_cost_resin + total_cost_hardener + total_cost_amine;
  
  console.log(total_cost_washed_sand+" "+total_cost_resin+" "+total_cost_hardener+" "+total_cost_amine);
  $("#cold_cost").append("<h3>Cold Box Core Cost:</h3>");
  $("#cold_cost").append("<table id='cold_cost_table' class='table table-hover table-bordered text-center'><tr class='warning'><th colspan='4' >For "+qty+"gs mix</th></tr><tr><th>Material</th><th>Qty</th><th>Rate/Kg</th><th>Total Cast</th></tr>");
  appendTable("cold_cost_table","Washed Sand",washed_sand_qty,washed_sand_rate,total_cost_washed_sand.toFixed(2));
  appendTable("cold_cost_table","Resin",resin_qty,resin_rate,total_cost_resin.toFixed(2));
  appendTable("cold_cost_table","Hardener",hardener_qty,hardener_rate,total_cost_hardener.toFixed(2));
  appendTable("cold_cost_table","Amine",amine_qty,amine_rate,total_cost_amine.toFixed(2));
  $("#cold_cost_table").append("<tr><td>Total</td><td>"+total_qty+"</td><td>-</td><td>"+total_cost+"</td></tr>");
});
                    