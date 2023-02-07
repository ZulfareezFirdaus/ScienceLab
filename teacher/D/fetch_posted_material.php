<!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<?php

    session_start();  
    $connect = mysqli_connect("localhost", "root", "", "sciencelab"); 

    $sql = "SELECT class.*,theme.* FROM class INNER JOIN theme ON class.theme_ID = theme.theme_ID";
    
    $sql_class = $sql." WHERE class.class_ID = '".$_SESSION['class_ID']."'";
    $query_class = mysqli_query($connect, $sql_class);
    $data_class = mysqli_fetch_assoc($query_class);

    $dataMaterial = [];
    $sql_materials = "SELECT class.*,materials.* FROM class_material INNER JOIN class ON class.class_ID = class_material.class_ID INNER JOIN materials ON materials.material_ID = class_material.material_ID  WHERE class.class_ID = '".$_SESSION['class_ID']."' ";
    $query_materials = mysqli_query($connect, $sql_materials);
    $numrowsmaterials = mysqli_num_rows($query_materials);
    while($data_materials = mysqli_fetch_assoc($query_materials)){
        $dataMaterial[] = $data_materials;
    }
    
        
        $output = '';
        if($numrowsmaterials > 0){
        foreach($dataMaterial as $dataMaterials) {
        $date = date('F j, Y', strtotime($dataMaterials['material_startDate']));
        if($dataMaterials['folder_ID'] == 'Stream'){

         $output .= '
                <div class="col-lg-12" style="margin-top:20px;">
                    <div class="post-element-stream" >
                        <div class="post-logo post-announcement" style="border-bottom:none;" >
                            <center>
                                <i  class="ti-bookmark icon" ></i>
                            </center>
                        </div>
                        <div class="post-text" >
                            <span class="title title-style" >You posted a new announcement</span>
                            <span class="due-date" >'.$date.'</span>
                        </div>
                        <div class="editor-blob" style="padding-bottom: 10px;">
                            <span class="due-date" >'.$dataMaterials['material_description'].'</span>
                        </div>
                        <div>
                            <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i style="color:'.$data_class['theme_codeColor'].';position: absolute;right: 45px;top: 28px;font-weight:600;" class="ti-view-grid"></i></a>
                            <div class="dropdown-menu dropdown-menus">
                                <a class="dropdown-item edit_data" type="button" name="edit"  data-toggle="modal" data-target="#editModal" value="edit" id="'.$dataMaterials["material_ID"].'" style="font-size: 14px;" >Edit</a>
                                <a class="dropdown-item" href="#" style="font-size: 14px;" >Copy Link</a>
                                <a class="dropdown-item" href="#" style="font-size: 14px;" >Delete</a>
                                <a class="dropdown-item view_data" type="button" name="view"  data-toggle="modal" data-target="#propertiesModal" value="view" id="'.$dataMaterials["material_ID"].'" style="font-size: 14px;" >Properties</a>
                            </div>
                        </div>
                        <hr>
                        <div class="add-comment" >
                            <button id="text-comment" class="btn-comment" >
                                <div class="post-logo post-announcement" style="border-bottom:none;" >
                                    <center>
                                        <i  class="ti-comments icon" ></i>
                                    </center>
                                </div>
                                <div class="post-text post" >
                                    <span class="title post" >Add class comment..</span>
                                </div>
                            </button>
                            <div style="position:relative;top:5px;padding-bottom:5px;display:none;" id="comment" >
                                <div class="post-logo post-announcement" style="border-bottom:none;" >
                                    <center>
                                        <i  class="ti-comments icon" ></i>
                                    </center>
                                </div>
                                <div class="post-text post" id="text-comment" style="padding-top: 14px;" >
                                    <input type="text" placeholder="Add class comment.." class="form-control" style="width:80%;position:relative;left:-25px;border-radius: 40px;">
                                    <button type="button" class="btn-submit-comment"> <i style="color:'.$data_class['theme_codeColor'].'" class="fa fa-send-o icon" ></i> </button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
         ';
                }
            else{
                $output .= '
                <div class="col-lg-12" style="margin-top:20px;">
                    <a href="../F?W='.urlencode(base64_encode($dataMaterials["class_ID"])).'&Q='.urlencode(base64_encode($dataMaterials["material_ID"])).'">
                    <div class="post-element" >
                        <div class="post-logo" >
                            <center>
                            <i class="ti-agenda icon" ></i>
                                </center>
                        </div>
                        <div class="post-text" style="left: 15px;" >
                            <span class="title title-style" >You posted a new material: '.$dataMaterials['material_title'].'</span>
                            <span class="due-date" >'.$date.'</span>
                        </div>
                        <div>
                            <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i style="color:'.$data_class['theme_codeColor'].';position: absolute;right: 45px;top: 28px;font-weight:600;" class="ti-view-grid"></i></a>
                            <div class="dropdown-menu dropdown-menus">
                                <a class="dropdown-item" href="#" style="font-size: 14px;" >Edit</a>
                                <a class="dropdown-item" href="#" style="font-size: 14px;" >Copy Link</a>
                                <a class="dropdown-item view_data" type="button" name="view"  data-toggle="modal" data-target="#propertiesModal" value="view" id="'.$dataMaterials["material_ID"].'" style="font-size: 14px;" >Properties</a>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
         ';
            }
            }
        }
        else{
            $output .= '<div class="col-lg-12" style="margin-top:20px;">
                <div class="" style="border: 0.0625rem solid #dadce0;border-radius: 0.5rem;padding:20px 40px;">
                    <center>
                        <span style="font-weight:600;font-size:22px;color:'.$data_class['theme_codeColor'].'">Start Communicate with your class now</span><br><br>
                        <img src="../images/icon/ico-05.png" width="25%"><br>
                        <span style="font-weight:600;position:relative;top:10px;color:#808080">No Posts Yet..</span>
                    </center><br><br>
                    <div>
                        <center>
                            <div style="background:'.$data_class['theme_codeColor'].'24;padding:20px 20px 25px 20px;font-weight:600;font-size:16px">
                                <i class="far fa-comment-alt" style="font-size:18px;color:'.$data_class['theme_codeColor'].'" ></i> Create and schedule announcements<br>
                                <span style="position:relative;top:6px;">
                                    <i class="far fa-comments" style="font-size:21px;color:'.$data_class['theme_codeColor'].'" ></i> Respond to student posts
                                </span>
                            </div>
                        </center>
                    </div>
                </div>
            </div> ';
                
            
        }
        echo $output;

?>

<script>
    $(document).ready(function(){
      $("#text-comment").click(function(){
        $("#comment").show();
        $("#text-comment").hide();
      });
    });
</script>

<script>
    $(document).on('click', '.view_data', function(){
  var material_ID = $(this).attr("id");
  $.ajax({
   url:"view_Properties.php",
   method:"POST",
   data:{material_ID:material_ID},
   success:function(data){
    $('#properties_detail').html(data);
    $('#propertiesModal').modal('show');
   }
  });
 });
</script>

<script>
    $(document).on('click', '.edit_data', function(){
  var material_ID = $(this).attr("id");
  $.ajax({
   url:"edit_posted.php",
   method:"POST",
   data:{material_ID:material_ID},
   success:function(data){
    $('#edit_detail').html(data);
    $('#editModal').modal('show');
   }
  });
 });
</script>