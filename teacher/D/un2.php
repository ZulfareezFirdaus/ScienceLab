 <script>  
    $(document).ready(function(){ 
          $('#submitBtnClass').click(function(){
              
          var class_folder = $("[name=class_folder]:checked").val();
          var descriptionText = $('#editor').html().trim();
          var title_form = $('#title_form').val();
          var chapter_no = $('#chapter_no').val();   
          var total_checked=  $("[name=class_name]:checked").length;
          var chapter_forms = $('#chapter_forms').val();
              
          var form_data = new FormData();
          var totalfiles = document.getElementById('files').files.length;
          for (var index = 0; index < totalfiles; index++) {
            form_data.append("files[]", document.getElementById('files').files[index]);
          }
            
          var class_name = [];  
           $('.class_name').each(function(){  
                if($(this).is(":checked"))  
                {  
                     class_name.push($(this).val());  
                }  
           });  
           class_name = class_name.toString(); 
           
           if(title_form == '')  
           {  
                $('#class_editor_alert').show();

           }

           if($.trim(title_form).length > 0) 
           {
               $.ajax({
                url:"insertEditorProcess.php",
                method:"POST",
                dataType:"json",
                contentType: false,
                processData: false,
                data:{form_data,class_name:class_name,class_folder:class_folder,descriptionText:descriptionText,title_form:title_form,total_checked:total_checked,chapter_forms:chapter_forms,chapter_no:chapter_no},
                success:function(data)
                {
                    if(data == 'Success'){  
                        $('#editor_id').trigger("reset");
                        $('#editor').empty();
                        $('#class_name').empty();
                        $("#hideDiv").hide();
                        $("#hide").show();
                        $('#chapter-form').hide();
                        $('#display_option').hide();
                        $('#addChapter').show();
                        $('#copied-success').show();
                        setTimeout(function() { 
                                $('#copied-success').hide();
                          }, 4000);
                        $('#posted_material').load("fetch_posted_material.php").fadeIn("slow");
                    }
                    else if(data == 'Failed'){  
                        alert("Please contact the administrator");
                    }
                    else if(data == 'Problem'){
                        alert("Please contact the administrator");
                    }
                    else if(data == 'Heeo'){
                        alert("yey");
                    }

                }
               });
           }

          }); 

     });  
     </script>