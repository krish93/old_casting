$("document").ready(function(){
  
    function isAvailableExtension(ext)
    {
      console.log(ext);
      var ext_ret=$.inArray(ext,['doc','docx','pdf','xls','xlsx']);
      if( parseInt(ext_ret)== -1 )
      {
       $("#message").addClass("alert alert-danger alert-dismissible fade-in");
      $("#message").text("Invalid file Format ");
      }
      
      
    }
    function checkSize(size)
    {
      if(size > 5000000)
      {
          
          $("#message").append("File Size Exceed (5MB)")
      }
    }
    
    $("#pr_request").change(function(){
            var f=this.files[0];
			var size=f.size||f.fileSize;
            
            var ext = $("#pr_request").val().split('.').pop().toLowerCase();
            isAvailableExtension(ext);
            checkSize(size);
            
        });
        $("#tax_work_sheet").change(function(){
            var f=this.files[0];
			var size=f.size||f.fileSize;
            
            var ext = $("#tax_wok_sheet").val().split('.').pop().toLowerCase();
            isAvailableExtension(ext);
            checkSize(size);
            
        });
      $("#tool_cost_break").change(function(){
            var f=this.files[0];
			var size=f.size||f.fileSize;
            
            var ext = $("#tool_cost_break").val().split('.').pop().toLowerCase();
            var ext_ret=$.inArray(ext,['csv']);
          console.log("CSV"+ext_ret);
            if(parseInt(ext_ret) != 0)
            {
              $("#message").addClass("alert alert-danger alert-dismissible fade-in");
              $("#message").text("Upload only csv format ");
            }
            checkSize(size);
            
        });
        $("#awarding_doc").change(function(){
            var f=this.files[0];
			var size=f.size||f.fileSize;
            
            var ext = $("#awarding_doc").val().split('.').pop().toLowerCase();
            isAvailableExtension(ext);
            checkSize(size);
            
        });
      $("#loc").change(function(){
            var f=this.files[0];
			var size=f.size||f.fileSize;
            
            var ext = $("#loc").val().split('.').pop().toLowerCase();
            isAvailableExtension(ext);
            checkSize(size);
            
        });
        $("#change_request").change(function(){
            var f=this.files[0];
			var size=f.size||f.fileSize;
            
            var ext = $("#change_request").val().split('.').pop().toLowerCase();
            isAvailableExtension(ext);
            checkSize(size);
            
        });
        var now_date=new Date(); 
        var now = new Date(now_date.getFullYear,now_date.getMonth,now_date.getDate,0,0,0,0);
        var click_date=$("#date_picker").datepicker({
          onRender: function(date) {
           return date.valueOf() <now.valueOf ? 'disabled' : '' ; 
          }
        })
      
      });
        