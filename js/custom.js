
    $("document").ready(function(){
      jsonObj=[];
      item={};
      item["title"]="json";
      item["file"]="json_file";
      jsonObj.push(item);
      console.log(jsonObj);
      jsonString=JSON.stringify(jsonObj);
      console.log(jsonObj[0].title);
      
      var main_file_data;
      var file_lines=[];
      
      function inferFile()
      {
        //console.log(file_lines,length);
      }
      $("#input_file").change(function(){
        var file=this.files[0];
        var reader= new FileReader();
        reader.onload=function(progressEvent)
        {
            //console.log(this.result);
            main_file_data=this.result.split('\n');
            var lines=this.result.split('\n');
            console.log(lines[0]);
            console.log(lines[0].split(',')[0]);
            for(var line=0;line<lines.length;line++)
            {
                //console.log(lines[line]);
              file_lines.push(lines[line]);
            }
          inferFile();
        };
        reader.readAsText(file);
      });
      $('[data-toggle="tooltip"]').tooltip();
        
      
    });
    