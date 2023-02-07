<?php
    session_start();
    include("../../dbconn.php");
    unset($_SESSION["link"]);
    
    //decode $_GET[] 
    $loc = base64_decode(urldecode($_GET['W']));
    $loc2 = base64_decode(urldecode($_GET['Q']));
    
    $sql = "SELECT class.*,theme.* FROM class INNER JOIN theme ON class.theme_ID = theme.theme_ID";
    
    $sql_class = $sql." WHERE class.class_ID = '".$loc."'";
    $query_class = mysqli_query($dbconn, $sql_class);
    $data_class = mysqli_fetch_assoc($query_class);
    
    $sql_materials = "SELECT class.*,materials.* FROM class_material INNER JOIN class ON class.class_ID = class_material.class_ID INNER JOIN materials ON materials.material_ID = class_material.material_ID  WHERE materials.material_ID = '".$loc2."' ";
    $query_materials = mysqli_query($dbconn, $sql_materials);
    $data_materials = mysqli_fetch_assoc($query_materials);

    $date = date('F j, Y', strtotime($data_materials['material_startDate']));

    $sql_chapter = "SELECT * FROM chapter WHERE chapter_ID = '".$data_materials['chapter_ID']."' ";
    $query_chapter = mysqli_query($dbconn, $sql_chapter);
    $data_chapter = mysqli_fetch_assoc($query_chapter);

    $sql_teacher = "
    SELECT * FROM teacher WHERE teacher_ID = '".$_SESSION["teacher_ID"]."'";
    $query_teacher = mysqli_query($dbconn, $sql_teacher);
    $data_teacher = mysqli_fetch_assoc($query_teacher);

    $sql_chapter = "
    SELECT * FROM chapter ORDER BY chapter_no";
    $query_chapter = mysqli_query($dbconn, $sql_chapter);
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ScienceLab || Educational Portal</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../vendors/chosen/chosen.min.css">


    <link rel="stylesheet" href="../assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script> 
    
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    
    <!-- Multiple Select Choice -->
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js'></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css'>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<style>
    
    .details-post h1{
        color:<?php echo $data_class['theme_codeColor'] ?>;
        background:<?php echo $data_class['theme_codeColor'] ?>1c;
    }
    
    .details-post .ti-view-grid{
        color: <?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .details-post .ti-bookmark-alt{
        background: <?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .details-post .comment-btn{
        color: <?php echo $data_class['theme_codeColor'] ?>;
        border:1px solid <?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .details-post .comment-btn:hover {
        background:<?php echo $data_class['theme_codeColor'] ?>;
        color:white;
    }
    
</style>
<body>


    <!-- Left Panel START -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="../images/logo.svg" alt="Logo"><span>&nbsp;ScienceLab</span></a>
                <a class="navbar-brand hidden" href="./"><img src="../images/logo.svg" alt="Logo"></a>
            </div>
            <div class="navbar-user" ><br>
                <img src="../images/user.jpg" />
                <h2><?php echo $data_teacher["teacher_name"] ?></h2><br>
            </div>
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li >
                        <a href="../"> <i class="menu-icon ti-layout-grid2"></i>Dashboard </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i  class="menu-icon ti-book" ></i>Classwork</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-book"></i><a href="notes/form-4/">Form 4</a></li>
                            <li><i class="menu-icon fa fa-book"></i><a href="notes/form-5/">Form 5</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i  class="menu-icon ti-user" ></i>Student</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-play-circle"></i><a href="video/form-4/">Form 4</a></li>
                            <li><i class="menu-icon fa fa-play-circle"></i><a href="video/form-5/">Form 5</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i  class="menu-icon ti-stats-up" ></i>Marks</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fas fa-gamepad"></i><a href="games/form-4/">Form 4</a></li>
                            <li><i class="menu-icon fa fas fa-gamepad"></i><a href="games/form-5/">Form 5</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="index.html"> <i class="menu-icon ti-settings"></i>Setting</a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>
    <!-- Left Panel END -->

    <!-- Right Panel START -->
    <div id="right-panel" class="right-panel">
        <!-- Header START -->
        <header id="header" class="header">
            <div class="header-menu">
                <!-- left header menu START -->
                <div class="col-sm-7">
                    <button class="todolist-button" ><i class="fa fa-edit"></i> To Do List</button>
                    <button class="workreview-button" ><i class="fa fa-list-alt"></i> Work Review</button>
                </div>
                <!-- left header menu END -->
                
                <!-- right header menu START -->
                <div class="col-sm-5">
                    <div class="header-left" style="text-align: right;" >
                        
                        <div class="dropdown for-notification" style="width:19%">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <table>
                                    <td>
                                        <img src="../images/alert.png"/>
                                    </td>
                                    <td>
                                        <span>10</span>
                                    </td>
                                </table>
                            </button>
                            
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                            <a class="dropdown-item media bg-flat-color-1" href="#">
                                <i class="fa fa-check"></i>
                                <p>Server #1 overloaded.</p>
                            </a>
                            <a class="dropdown-item media bg-flat-color-4" href="#">
                                <i class="fa fa-info"></i>
                                <p>Server #2 overloaded.</p>
                            </a>
                            </div>
                        </div>

                        <div class="dropdown for-message" style="width:21%">
                            <button class="btn btn-secondary dropdown-toggle" type="button"id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <table>
                                    <td>
                                        <img src="../images/message.png"/>
                                    </td>
                                    <td>
                                        <span>&nbsp;10</span>
                                    </td>
                                </table>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have 4 Mails</p>
                            <a class="dropdown-item media bg-flat-color-1" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Jonathan Smith</span>
                                    <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                </span>
                            </a>
                            <a class="dropdown-item media bg-flat-color-4" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Jack Sanders</span>
                                    <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                </span>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- right header menu START -->
            </div>
        </header>
        <!-- Header END-->
        
        <!-- Hi area START-->
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <table>
                            <td width="20%" >
                                <img style="width:85%" src="../images/user.jpg" />
                            </td>
                            <td>
                                <h1>Hi <?php echo $data_teacher["teacher_Nickname"] ?>!</h1>
                            </td>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active" >Chapter <?php echo $data_chapter['chapter_no'] ?> - <?php echo ucwords($data_chapter['chapter_name']) ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hi area END-->
        <div class="details-post">
            <i class="ti-bookmark-alt float-left"></i>
            <h1> <span style="text-transform: uppercase;"><?php echo $data_materials['material_title'] ?></span> <br> <span class="date" ><?php echo $date ?></span>
            <div>
                <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="ti-view-grid"></i>
                </a>
                <div class="dropdown-menu dropdown-menus">
                    <a class="dropdown-item edit_data" type="button" name="edit"  data-toggle="modal" data-target="#editModal" value="edit" id="<?php echo $data_materials['material_ID'] ?>" style="font-size: 14px;" >Edit</a>
                    <a class="dropdown-item" href="#" style="font-size: 14px;" >Copy Link</a>
                    <a class="dropdown-item" href="#" style="font-size: 14px;" >Delete</a>
                    <a class="dropdown-item view_data" type="button" name="view"  data-toggle="modal" data-target="#propertiesModal" value="view" id="<?php echo $data_materials['material_ID'] ?>" style="font-size: 14px;" >Properties</a>
                </div>
            </div>
            </h1>
            
            <div class="col-lg-8">
                <div class="description" >
                    <?php echo $data_materials['material_description'] ?>
                </div>
                <hr>
            </div>
            <div class="col-lg-4">
                <div class="comment-section" >
                    <span class="pr-comment" ><i class="ti-comments icon"></i> Private Comments</span>
                    <button class="comment-btn" type="button" id="btn-comment" >
                        <div class="text">Add Comment... </div>
                    </button>
                    <div style="display:none;" id="text-comment">
                        <input type="text" placeholder="Add private comment.." class="form-control">
                        <i class="fa fa-send-o"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Right Panel END -->

    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/editor.js"></script>
    <script src="../assets/js/fileupload2.js"></script>
    <script src="../assets/js/select_checkbox.js"></script>
    <script src="../vendors/chosen/chosen.jquery.min.js"></script>
    
    <!-- Jquery -->   
    
    <script>
    $(document).ready(function(){ 
          $('#btn-comment').click(function(){
              $('#btn-comment').hide();
              $('#text-comment').show();
          });
    });
    </script>
    
    
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
                processData: false, 
                contentType: false,
                dataType:"json",
                data:{form_data,class_name:class_name,class_folder:class_folder,descriptionText:descriptionText,title_form:title_form,total_checked:total_checked,chapter_forms:chapter_forms,chapter_no:chapter_no,myFormData},
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

                }
               });
           }

          }); 

     });  
     </script>
    
   

</body>

</html>
