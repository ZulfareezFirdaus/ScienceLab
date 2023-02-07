<?php
    session_start();
    include("../dbconn.php");

    $sql = "
    SELECT class.*,theme.*,teacher.* FROM class INNER JOIN theme ON class.theme_ID = theme.theme_ID INNER JOIN teacher ON class.teacher_ID = teacher.teacher_ID WHERE teacher.teacher_ID = '".$_SESSION["teacher_ID"]."'";

    $sql_form5 = $sql." AND class.class_form = '5' ORDER BY class_displayOrder ASC";
    $query_form5 = mysqli_query($dbconn, $sql_form5);
    $data_form5 = mysqli_fetch_assoc($query_form5);

    $sql_form4 = $sql." AND class.class_form = '4' ORDER BY class_displayOrder ASC";
    $query_form4 = mysqli_query($dbconn, $sql_form4);
    $data_form4 = mysqli_fetch_assoc($query_form4);

    $sql_teacher = "SELECT * FROM teacher WHERE teacher_ID = '".$_SESSION["teacher_ID"]."'";
    $query_teacher = mysqli_query($dbconn, $sql_teacher);
    $data_teacher = mysqli_fetch_assoc($query_teacher);
    
    $name = $data_teacher['teacher_name'];
    list($firstName, $lastName) = explode(' ', $name);

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

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>

<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/logo.svg" alt="Logo"><span>&nbsp;ScienceLab</span></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo.svg" alt="Logo"></a>
            </div>
            <div class="navbar-user" ><br>
                <img src="images/user.jpg" />
                <h2><?php echo $data_teacher["teacher_name"] ?></h2><br>
            </div>
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="./"> <i style="color:#ffffff!important" class="menu-icon ti-layout-grid2"></i>Dashboard </a>
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
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->
    
     <!-- Alert Success Copied code -->
    <div class="alert alert-success alert-success-popup" id="copied-success" role="alert" >
        Class code copied!
    </div>
    
    <!-- Alert Success Copied code -->
    <div class="alert alert-success alert-success-popup" id="addClass-success" role="alert" >
        New class added successfully
    </div>
    
    

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">
                <div class="col-sm-7">
                    <button class="todolist-button" ><i class="fa fa-edit"></i> To Do List</button>
                    <button class="workreview-button" ><i class="fa fa-list-alt"></i> Work Review</button>
                </div>

                <div class="col-sm-5">
                    <div class="header-left" style="text-align: right;" >
                        
                        <div class="dropdown for-notification" style="width:19%">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <table>
                                    <td>
                                        <img src="images/alert.png"/>
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
                                        <img src="images/message.png"/>
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
                        <span class="tooltips">
                             <button type="button" data-toggle="modal" data-target="#classNew" class="create-class-button" ><i class="fa fa-plus"></i> &nbsp;Create</button>
                            <span class="tooltiptexts tooltips-create-class">Create Class</span>
                        </span>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <table>
                            <td width="20%" >
                                <img style="width:85%" src="images/user.jpg" />
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
                            <li class="active">Home</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    
        
        <div class="custom-tab">
            <div class="col-md-12 col-lg-12">
                <nav>
                    <div class="nav section-form" id="nav-tab" role="tablist" style="text-align: center;">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#custom-nav-home" role="tab" aria-controls="custom-nav-home" aria-selected="true" style="padding: 10px 45px;" >Form 5</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#custom-nav-profile" role="tab" aria-controls="custom-nav-profile" aria-selected="false" style="padding: 10px 45px;" >Form 4</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            
            <div class="tab-content pl-3 pt-2 class-code-name" id="nav-tabContent">
                <!-- Class Code Form 5 -->
                    <div class="tab-pane fade show active" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                        <div class="content mt-3">
                           <ul id="page_list" >
                            <?php 

                                if(mysqli_num_rows($query_form5) > 0){
                                do { 
                            
                            ?>
                                <div class="col-md-6 col-lg-4">
                                    <li id="<?php echo $data_form5["class_ID"] ?>" >
                                        
                                            <div class="card text-light backgrounds-fixed backgrounds-shadow" style="background:url(images/class-bg/cb-<?php echo $data_form5['theme_ID'] ?>.jpg);">
                                                <a href="D?C=<?php echo urlencode(base64_encode($data_form5["class_ID"])) ?>" >
                                                    <div class="card-body">
                                                        <div class="h4 m-0 class-name"><?php echo $data_form5['class_form'] ?> <?php echo $data_form5['class_name'] ?></div>
                                                        <div class="title total-student" >80 Student</div>
                                                        <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 2px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                        <div class="title total-student" >Class code : <?php echo $data_form5['class_code'] ?></div>
                                                    </div>
                                                </a>
                                                <span class="bg-button">
                                                    <span class="tooltips">
                                                        <button name="class_code" value="view" data-toggle="modal" data-target="#classCodeForm5" id="<?php echo $data_form5["class_ID"]; ?>" class="class_codeForm5" ><i class="ti-new-window icon-ti"></i></button>
                                                        <span class="tooltiptexts tooltips-code-class">Display class code</span>
                                                    </span>
                                                
                                                    <span class="tooltips">
                                                        <button style="position: relative;left: 16px;" name="class_code" class="class_codeForm5" ><i class="ti-stats-up icon-ti"></i></button>
                                                        <span class="tooltiptexts tooltips-mark-class">Open student marks</span>
                                                    </span>
                                                </span>
                                            </div>
                                        
                                    </li>
                                </div>
                               
                               <?php }while($data_form5 = mysqli_fetch_array($query_form5));

                                }

                                else{
                                ?>
                                    <center><img src="images/icon/classroom.png" width="25%">
                                        <br><span style="font-size: 18px;color: #808080;font-weight: 600;">No class register yet!</span>
                                    </center>
                                <?Php }?>
                               
                               </ul>
                                <input type="hidden" name="page_order_list" id="page_order_list" />
                            
                            <!-- Modal Class Code Form 5 -->
                            <div id="classCodeForm5" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mediumModalLabel">Class code : 5 Setia</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="class_code_form5" style="text-align: center;">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" onclick="myFunction()" class="btn btn-primary"><i class="fa fa-copy"></i> Copy class code</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                        </div> 
                    </div>

                    <!-- Class Code Form 4 -->
                    <div class="tab-pane fade" id="custom-nav-profile" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                        <div class="content mt-3">
                            <ul id="page_list2" >
                            <?php 

                                if(mysqli_num_rows($query_form4) > 0){
                                do { 
                            
                            ?>
                                <div class="col-md-6 col-lg-4">
                                    <li id="<?php echo $data_form4["class_ID"] ?>" >
                                        
                                            <div class="card text-light backgrounds-fixed backgrounds-shadow" style="background:url(images/class-bg/cb-<?php echo $data_form4['theme_ID'] ?>.jpg);">
                                                <a href="D?C=<?php echo urlencode(base64_encode($data_form4["class_ID"])) ?>" >
                                                    <div class="card-body">
                                                        <div class="h4 m-0 class-name"><?php echo $data_form4['class_form'] ?> <?php echo $data_form4['class_name'] ?></div>
                                                        <div class="title total-student" >80 Student</div>
                                                        <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 2px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                        <div class="title total-student" >Class code : <?php echo $data_form4['class_code'] ?></div>
                                                    </div>
                                                </a>
                                                <span class="bg-button">
                                                    <span class="tooltips">
                                                        <button name="class_code" value="view" data-toggle="modal" data-target="#classCodeForm4" id="<?php echo $data_form4["class_ID"]; ?>" class="class_codeForm4" ><i class="ti-new-window icon-ti"></i></button>
                                                        <span class="tooltiptexts tooltips-code-class">Display class code</span>
                                                    </span>
                                                
                                                    <span class="tooltips">
                                                        <button style="position: relative;left: 16px;" name="class_code" class="class_codeForm5" ><i class="ti-stats-up icon-ti"></i></button>
                                                        <span class="tooltiptexts tooltips-mark-class">Open student marks</span>
                                                    </span>
                                                </span>
                                            </div>
                                        
                                    </li>
                                </div>
                               
                               <?php }while($data_form4 = mysqli_fetch_array($query_form4));

                                }

                                else{
                                ?>
                                    <center><img src="images/icon/classroom.png" width="25%">
                                        <br><span style="font-size: 18px;color: #808080;font-weight: 600;">No class register yet!</span>
                                    </center>
                                <?Php }?>
                               
                               </ul>

                            <!-- Modal Class Code Form 4 -->
                            <div id="classCodeForm4" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mediumModalLabel">Class code : 5 Setia</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="class_code_form4" style="text-align: center;">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" onclick="myFunction()" class="btn btn-primary"><i class="fa fa-copy"></i> Copy class code</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
    <?php if($data_teacher['teacher_Nickname'] == ''){ ?>
    <div id="open-modal" class="modal-window">
      <div>
        <div class="modal-name"><?php echo $firstName;?> <?php echo $lastName; ?></div>
        <form id="form_id" >
            <input type="Text" name="nickname" id="nickname" placeholder="Enter your nickname" onkeypress="return AvoidSpace(event)">
            <span class="alerts" id="alertNickname" style="position: absolute;top: 373px;left: 165px;font-weight:600;"></span>
            <button type="button" id="submitBtnNickname" name="submitBtnNickname">Submit</button>
        </form>
      </div>
    </div>
    <?php }?>
    
    <!-- Modal Add New Class -->
    <div class="modal fade" id="classNew" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form id="addNew_form" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Create Classroom</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                            <div class="form-group">
                                <label for="class_name" class=" form-control-label">Class Name</label>
                                <input type="text" id="class_name" name="class_name" placeholder="Class Name" class="form-control">
                                <span class="help-block" id="class_name_alert" >Please enter your class name</span>
                            </div>
                            <div class="form-group">
                                <label for="class_form" class=" form-control-label">Form</label>
                                <select id="class_form" name="class_form" class="form-control">
                                    <option value="" >Please Choose</option>
                                    <option value="4" >Form 4</option>
                                    <option value="5" >Form 5</option>
                                </select>
                                <span class="help-block" id="class_form_alert" >Please choose your class form</span>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" name="submitBtn" id="submitBtn"  class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    
    
    <!-- Button copy function Javascript --> 
    <script>
        function myFunction() {
         
          var copyText = document.getElementById("myInputCopy");

          copyText.select();
          copyText.setSelectionRange(0, 99999); 

          navigator.clipboard.writeText(copyText.value);

          document.getElementById("copied-success").style.display = "block";
            
          setTimeout(function () {
                document.getElementById("copied-success").style.display="none";
          }, 8000);
        }
    </script>
    
    <!-- Display class code Form 5 Jquery --> 
    <script>
        $(document).on('click', '.class_codeForm5', function(){
            var class_ID = $(this).attr("id");
            $.ajax({
                url:"modal_classCode.php",
                method:"POST",
                data:{class_ID:class_ID},
                success:function(data){
                    $('#class_code_form5').html(data);
                    $("#classCodeForm5").modal("show");
                }
            });
        }); 
    </script>
    
    <!-- Display class code Form 4 Jquery --> 
    <script>
        $(document).on('click', '.class_codeForm4', function(){
            var class_ID = $(this).attr("id");
            $.ajax({
                url:"modal_classCode.php",
                method:"POST",
                data:{class_ID:class_ID},
                success:function(data){
                    $('#class_code_form4').html(data);
                    $("#classCodeForm4").modal("show");
                }
            });
        }); 
    </script>
    
    <!-- Add new class Jquery -->        
    <script>  
        $(document).ready(function(){  
              $('#submitBtn').click(function(){  
                   var class_name = $('#class_name').val();  
                   var class_form = $('#class_form').val();  
                  
                   if(class_name == '' && class_form == '')  
                   {  
                        $('#class_name_alert').show();   
                        $('#class_form_alert').show();  
                   }
                   if(class_name == '' && class_form != '' )  
                   {  
                        $('#class_name_alert').show();   
                        $('#class_form_alert').hide();  
                        
                   } 
                   if(class_name != '' && class_form == '' ) 
                   {  
                        $('#class_name_alert').hide();   
                        $('#class_form_alert').show(); 
                   }  
                   if($.trim(class_name).length > 0 && $.trim(class_form).length > 0) 
                   {  
                        
                       $.ajax({
                        url:"addClassProcess.php",
                        method:"POST",
                        dataType:"json",
                        data:{class_name:class_name,class_form:class_form},
                        success:function(data)
                        {
                            if(data == 'Success')  {  
                                document.getElementById("addClass-success").style.display = "block";
            
                                  setTimeout(function () {
                                        location.reload();
                                  }, 900);
                            }
                            else if(data == 'Failed')  {  
                                alert('Data not inserted, please try again later');
                            }
                            else {
                                alert('Problem');
                            }
                            
                        }
                       });  
                   }  
              });  
         });  
     </script>
    
    <script>
        $(document).ready(function(){
            $( "#page_list" ).sortable({
                update  : function(event, ui)
                {
                    var page_id_array = new Array();
                    $('#page_list li').each(function(){
                        page_id_array.push($(this).attr("id"));
                    });
                    $.ajax({
                        url:"updateDisplayOrder.php",
                        method:"POST",
                        data:{page_id_array:page_id_array},
                        success:function(data)
                        {
                            
                        }
                    });
                }
            });
        });
    </script>
    
    <script>
        $(document).ready(function(){
            $( "#page_list2" ).sortable({
                update  : function(event, ui)
                {
                    var page_id_array = new Array();
                    $('#page_list2 li').each(function(){
                        page_id_array.push($(this).attr("id"));
                    });
                    $.ajax({
                        url:"updateDisplayOrder.php",
                        method:"POST",
                        data:{page_id_array:page_id_array},
                        success:function(data)
                        {
                            
                        }
                    });
                }
            });
        });
    </script>
    
    <!-- Jquery -->        
    <script>  
    $(document).ready(function(){ 

          $('#submitBtnNickname').click(function(){

               var nickname = $('#nickname').val(); 

               if(nickname == '')  
               {  
                    $('#alertNickname').html('<span class="text-danger alerts">This field are required!</span>').show(); 
               }
               if($.trim(nickname).length > 0) 
               {
                   $.ajax({
                    url:"nicknameProcess.php",
                    method:"POST",
                    dataType:"json",
                    data:{nickname:nickname},
                    success:function(data)
                    {
                        if(data == 'Success')  {  
                            $("#open-modal").hide("slow");
                            $('#form_id').trigger("reset");
                             setTimeout(function () {
                                    location.reload();
                              }, 1000);
                        }
                        else if(data == 'Failed')  {  
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
    
    <!-- Prevent Space in Input --> 
    <script>
    function AvoidSpace(event) {
        var k = event ? event.which : window.event.keyCode;
        if (k == 32) return false;
    }
    </script>
    


</body>

</html>
