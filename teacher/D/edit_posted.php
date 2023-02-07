<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script> 

<?php  
 session_start();

if(isset($_POST["material_ID"]))
{
    $output = '';
    $connect = mysqli_connect("localhost", "root", "", "sciencelab");
    
    $query = "SELECT class.*,materials.* FROM class_material INNER JOIN class ON class.class_ID = class_material.class_ID INNER JOIN materials ON materials.material_ID = class_material.material_ID  WHERE materials.material_ID = '".$_POST['material_ID']."' ";
    $result = mysqli_query($connect, $query);
    $data_materials = mysqli_fetch_assoc($result);
    
    $sql_class = "SELECT * FROM class ORDER BY class_displayOrder,class_form";
    $query_class = mysqli_query($connect,$sql_class);
    
 $output .= '
    <form id="editor_id" >
        <div class="bg-editor" style="z-index:99;box-shadow: none;padding:0;">
            <div class="col-lg-12" style="padding:0px;" >
                <div class="col-lg-12">
                    <label for="postal-code" class=" form-control-label" style="font-weight:600;font-size:16px;">Title</label>
                    <input type="text" id="title_form2" name="title_form2" value="'.$data_materials['material_title'].'" class="form-control editor-form">
                    <input type="hidden" name="material_ID" value="'.$data_materials['material_ID'].'" id="material_ID">
                    <div class="alert alert-danger" id="class_editor_alert" role="alert" 
                    style="display:none;margin-bottom: -8px !Important;margin-top: 12px;font-weight:600;background: none;border: none;padding: 0;color: red;">
                        This field is required!
                    </div>
                    <label for="postal-code" class=" form-control-label" style="margin-top:15px;font-weight:600;font-size:16px;">Instructions (Optional)</label>
                    <div class="editor-toolbar" style="border-radius:0.5rem 0.5rem 0 0;">
                      <a href="javascript:void(0)" role="button" class="toolbar-btn unselectable" onclick="runCommand(this, \'bold\', null)" unselectable="on"><i class="fa fa-bold"></i></a>
                      <a href="javascript:void(0)" role="button" class="toolbar-btn" onclick="runCommand(this, \'italic\', null)"><i class="fa fa-italic"></i></a>
                      <a href="javascript:void(0)" role="button" onclick="runCommand(this, \'underline\', null)"><i class="fa fa-underline"></i></a> 
                      <a href="javascript:void(0)" role="button" onclick="runCommand(this, \'indent\', null)"><i class="fa fa-indent"></i></a> 
                      <a href="javascript:void(0)" role="button" onclick="runCommand(this, \'insertUnorderedList\', null)"><i class="fa fa-list-ul"></i></a> 
                      <a href="javascript:void(0)" role="button" onclick="runCommand(this, \'insertOrderedList\', null)"><i class="fa fa-list-ol"></i></a>
                      <a href="javascript:void(0)" role="button" onclick="runCommand(this, \'redo\', null)"><i class="fa fa-repeat"></i></a>
                      <a href="javascript:void(0)" role="button" onclick="runCommand(this, \'undo\', null)"><i class="fa fa-undo"></i></a>   
                    </div>
                    <div id="editor" class="editor"  contenteditable="true" style="border-radius:0 0 0.5rem 0.5rem;" >'.$data_materials['material_description'].'</div>
                    <textarea name="descriptionText" class="descriptionText" id="descriptionText" style="display:none"></textarea>
                    </div>
                </div>
                <div class="col-lg-5" style="position:relative;z-index:999999;" >
                    <div style="color:#000000;font-weight:500;font-size:15px;padding-bottom: 10px;padding-top:15px;">Posted For :</div>
                    <div class="animated fadeIn dropdown-css select-edit" style="position: relative;" >
                        <select type="text" name="class_name" class="multiselect class_name" id="class_name" multiple="multiple" role="multiselect" >';
                            
                            do{
                                $output .= '<option value="'.$data_materials["class_ID"].'"  class="class_name" name="class_name" selected>'.$data_materials["class_form"].' '.$data_materials["class_name"].'</option>';
                            }while($data_materials = mysqli_fetch_assoc($result));
    
                            while($data_class = mysqli_fetch_assoc($query_class)){
                                $output .= '<option value="'.$data_class["class_ID"].'"  class="class_name" name="class_name" >'.$data_class["class_form"].' '.$data_class["class_name"].'</option>';
                            }
                        
                        $output .= '
                        </select> 
                    </div>
                </div>
                <div class="col-lg-7">
                    
                </div>
                <div class="col-lg-12" style="text-align:right;margin: 40px 0px 0px 0px;position:relative;z-index:1">
                    <a id="show" class="link-post-announcement">Cancel</a>
                    <button type="button" id="updateBtnClass" class="btn-post-announcement">Save</button>
                    <br><br>
                </div>
            </div>
        </div>
    </form>
 ';
    echo $output;
}
?>

<script src="../assets/js/select.js"></script>
<script src="../vendors/jquery/dist/jquery.min.js"></script>

<!-- Jquery -->        
<script>  
$(document).ready(function(){ 
      $('#updateBtnClass').click(function(){

      var descriptionText = $('.editor').html().trim();
      var title_form2 = $('#title_form2').val();   
      var total_checked=  $("[name=class_name]:checked").length;
      var material_ID = $('#material_ID').val(); 

      var class_name = [];  
       $('.class_name').each(function(){  
            if($(this).is(":checked"))  
            {  
                 class_name.push($(this).val());  
            }  
       });  
       class_name = class_name.toString(); 

       if(title_form2 == '')  
       {  
            $('#class_editor_alert').show();

       }

       if($.trim(title_form2).length > 0) 
       {
           $.ajax({
            url:"updateEditorProcess.php",
            method:"POST",
            dataType:"json",
            data:{class_name:class_name,descriptionText:descriptionText,title_form2:title_form2,total_checked:total_checked,material_ID:material_ID},
            success:function(data)
            {
                if(data == 'success'){  
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

            }
           });
       }

      }); 

 });  
 </script>


