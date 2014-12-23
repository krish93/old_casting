<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
      <?php include 'script_link.php';?>
      <script src="upload_check.js">
      
      </script>
    </head>
    <body>
      
      
      <div class="container">
        <div class="row">
          <?php if(isset($_GET['error'])) { echo "<p class='alert alert-danger alert-dismissible fade-in' role=''>".$_GET["error"]."<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button></p>";}?>
          <p id="message"></p>
          <p id="size_message"></p>
          <form action="upload_file.php" method="POST" id="myForm"  enctype="multipart/form-data" class="form-horizontal">
            <div class="form-group">
            <label class="col-md-3">PR Requested Form</label>
              <div class="col-md-7">
                <input type="file" name="file[]" id="pr_request" required>
              </div>
            </div>
         <!--   <div class="form-group">
            <label class="col-md-3">Tax Working Sheet</label>
              <div class="col-md-5">
                <input type="file" name="file[]" id="tax_work_sheet" required>
              </div>
            </div>
            <div class="form-group">
            <label class="col-md-3">Tool Cost break up</label>
              <div class="col-md-7">
                <input type="file" name="file[]" id="tool_cost_break" required>
              </div>
            </div>
            <div class="form-group">
            <label class="col-md-3">Awarding document </label>
              <div class="col-md-7">
                <input type="file" name="file[]" id="awarding_doc" required>
              </div>
            </div>
            <div class="form-group">
            <label class="col-md-3">Letter Of Nomination</label>
              <div class="col-md-7">
                <input type="file" name="file[]" id="loc" required>
              </div>
            </div>
            <div class="form-group">
            <label class="col-md-3">Change Request</label>
              <div class="col-md-7">
                <input type="file" name="file[]" id=change_request"" required>
              </div>
            </div>
            --><div class="form-group">
            <label class="col-md-3">Date Picker</label>
              <div class="col-md-7">
            <input type="text" id="date_picker" class="form-control span3" >
            </div>
            </div>
            <input type="submit" id="submit" value="Start Upload" class="btn btn-primary">
          </form>
        </div>
      </div>
      
  
  

    </body>
</html>
