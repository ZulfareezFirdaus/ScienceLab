<?php

    session_start();
    include("../dbconn.php");

    $sql_select = "SELECT * FROM student WHERE student_ID = '".$_SESSION['student_ID']."' ";
    $query_select = mysqli_query($dbconn, $sql_select);
    $date_student = mysqli_fetch_assoc($query_select);

    $name = $date_student['student_name'];

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
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
    
    <!-- Jquery Script -->
    <script src="http://code.jquery.com/jquery-2.1.1.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>

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
                <h2><?php echo ucwords($date_student['student_name']) ?></h2>
                <h3><?php echo $date_student['student_form'] ?> <?php echo $date_student['student_className'] ?></h3><br>
            </div>
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="./"> <i style="color:#ffffff!important" class="menu-icon fa fa-home"></i>Dashboard </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i  class="menu-icon fa fa-book" ></i>Notes</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-book"></i><a href="notes/form-4/">Form 4</a></li>
                            <li><i class="menu-icon fa fa-book"></i><a href="notes/form-5/">Form 5</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i  class="menu-icon fa fa-play-circle" ></i>Video</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-play-circle"></i><a href="video/form-4/">Form 4</a></li>
                            <li><i class="menu-icon fa fa-play-circle"></i><a href="video/form-5/">Form 5</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i  class="menu-icon fa fas fa-pencil-alt" ></i>Exercise</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fas fa-pencil-alt"></i><a href="exercise/form-4/">Form 4</a></li>
                            <li><i class="menu-icon fa fas fa-pencil-alt"></i><a href="exercise/form-5/">Form 5</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i  class="menu-icon fa fas fa-puzzle-piece" ></i>Quiz</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fas fa-puzzle-piece"></i><a href="quiz/form-4/">Form 4</a></li>
                            <li><i class="menu-icon fa fas fa-puzzle-piece"></i><a href="quiz/form-5/">Form 5</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i  class="menu-icon fa fas fa-gamepad" ></i>Games</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fas fa-gamepad"></i><a href="games/form-4/">Form 4</a></li>
                            <li><i class="menu-icon fa fas fa-gamepad"></i><a href="games/form-5/">Form 5</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i  class="menu-icon fa fa-cog" ></i>Setting</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-cog"></i><a href="games/form-4/">Profile</a></li>
                            <li><i class="menu-icon fas fa-sign-out-alt"></i><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    
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
                                <h1>Hi <?php echo ucwords($date_student['student_nickname']) ?>!</h1>
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

        <div class="content mt-3">
            
            <div class="col-md-6 col-lg-3">
                <div class="card bg-flat-color-1 text-light">
                    <div class="card-body">
                        <div class="h4 m-0">89.9%</div>
                        <div class="title" >Video</div>
                        <img class="video" src="images/bg-01.png" />
                        <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-md-6 col-lg-3">
                <div class="card bg-flat-color-4 text-light">
                    <div class="card-body">
                        <div class="h4 m-0">89.9%</div>
                        <div class="title" >Exercise</div>
                         <img class="exercise" src="images/bg-03.png" />
                        <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <!--/.col-->
            
            <div class="col-md-6 col-lg-3">
                <div class="card bg-flat-color-3 text-light">
                    <div class="card-body">
                        <div class="h4 m-0">89.9%</div>
                        <div class="title" >Quiz</div>
                        <img class="video" src="images/bg-02.png" />
                        <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-md-6 col-lg-3">
                <div class="card bg-flat-color-2 text-light">
                    <div class="card-body">
                        <div class="h4 m-0">89.9%</div>
                        <div class="title" >Games</div>
                        <img class="game" src="images/bg-04.png" />
                        <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-xl-6 col-lg-6">
                <div class="card upcoming" style="border:none;margin-bottom: 0px !important;">
                    <div class="card bg-flat-color-8 text-light">
                        <div class="card-body">
                            <div class="title" >Upcoming</div>
                            <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 3px;"></div>
                            <span>Woohoo, no work due in soon!</span>
                            <img class="upcoming-pic" src="images/bg-07.png" />
                            <br><br>
                            <button>View All</button>
                        </div>
                    </div>
                </div>
				
				<div class="col-xl-12 col-lg-12" style="padding: 0;">
                    <div class="card diss-forum">
                        <div class="card-body" style="padding: 15px 22px;">
                            <div class="stat-widget-one">
                                <div class="stat-icon "><img style="width:10%" src="https://cdn3.iconfinder.com/data/icons/flat-round-1/50/73-512.png" />
                                    <span class="stat-text" style="color:white;font-size:20px;position:relative;top:2px;font-weight:600;left:10px;"> Discussion Forum</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6" style="padding: 0px;padding-right: 10px;">
                    <div class="card classwork bg-flat-color-6 text-light">
                        <div class="card-body">
                            <div class="title" >Classwork</div>
                            <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 3px;"></div>
                            <span>View your work</span>
                            <img class="classwork-pic" src="images/bg-06.png" />
                            <br><br>
                            <button>View All</button>
                        </div>
                    </div>
                </div>
                <!--/.col-->
                
                <div class="col-lg-6" style="padding: 0;padding-left: 10px;">
                    <div class="card people bg-flat-color-7 text-light">
                        <div class="card-body">
                            <div class="title" >People</div>
                            <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 3px;"></div>
                            <span>33 Classmates</span>
                            <img class="people-pic" src="images/bg-09.png" />
                            <br><br>
                            <button>View All</button>
                        </div>
                    </div>
                </div>
                <!--/.col-->
            </div>
            
            <div class="col-xl-6 col-lg-6">
                <section class="card" style="border:none;">
                    <div class="card main" style="border:none;margin-bottom: 0px !important;">
                        <div class="card bg-flat-color-9 text-light" style="margin-bottom: 0;" >
                            <div class="card-body" style="height:186px">
                                <div class="title" >SAINS 5 SETIA 2020</div>
                                <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 3px;"></div>
                                <span>DR NOR SHAHIDA </span>
                                <img class="main-pic" src="images/bg-13.png" />
                            </div>
                        </div>
                    </div>
                </section>
                
                <div class="col-xl-12 col-lg-12" style="padding: 0;">
                    <div class="card new-post">
                        <div class="card-body" style="padding: 15px 22px;">
                            <div class="stat-widget-one">
                                <div class="stat-icon "><img style="width:10%" src="images/user.jpg" />
                                    <span class="stat-text"> Share something with your classmates...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.col-->
                
                <div class="col-xl-12 col-lg-12" style="padding: 0;">
                    <div class="card new-material">
                        <div class="card-body" style="padding: 17px 20px 19px;">
                            <div class="stat-widget-one">
                                <table>
                                    <td>
                                        <span class="quiz" >Q</span>
                                    </td>
                                    <td>
                                        <div class="stat-icon ">
                                            <span class="stat-text"> Posted a New Quiz: ITS670 FINAL ASSESSMENT</span><br>
                                            <span class="stat-text stat-date"> 5 Aug 2021</span>
                                        </div>
                                    </td>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.col-->
                
                <div class="col-xl-12 col-lg-12" style="padding: 0;">
                    <div class="card new-material">
                        <div class="card-body" style="padding: 17px 20px 19px;">
                            <div class="stat-widget-one">
                                <table>
                                    <td>
                                        <span class="exercises" >E</span>
                                    </td>
                                    <td>
                                        <div class="stat-icon ">
                                            <span class="stat-text"> Posted a New Exercise: ITS670 FINAL ASSESSMENT</span><br>
                                            <span class="stat-text stat-date"> 5 Aug 2021</span>
                                        </div>
                                    </td>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.col-->
                
                <div class="col-xl-12 col-lg-12" style="padding: 0;">
                    <div class="card new-material">
                        <div class="card-body" style="padding: 17px 20px 19px;">
                            <div class="stat-widget-one">
                                <table>
                                    <td>
                                        <span class="games" >G</span>
                                    </td>
                                    <td>
                                        <div class="stat-icon ">
                                            <span class="stat-text"> Posted a New Games: ITS670 FINAL ASSESSMENT</span><br>
                                            <span class="stat-text stat-date"> 5 Aug 2021</span>
                                        </div>
                                    </td>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.col-->
                
                <div class="col-xl-12 col-lg-12" style="padding: 0;">
                    <div class="card new-material">
                        <div class="card-body" style="padding: 17px 20px 19px;">
                            <div class="stat-widget-one">
                                <table>
                                    <td>
                                        <span class="videos" >V</span>
                                    </td>
                                    <td>
                                        <div class="stat-icon ">
                                            <span class="stat-text"> Posted a New Video: ITS670 FINAL ASSESSMENT</span><br>
                                            <span class="stat-text stat-date"> 5 Aug 2021</span>
                                        </div>
                                    </td>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.col-->
                
                <div class="col-xl-12 col-lg-12" style="padding: 0;">
                    <div class="card new-material">
                        <div class="card-body" style="padding: 17px 20px 19px;">
                            <div class="stat-widget-one">
                                <table>
                                    <td>
                                        <span class="notes" >N</span>
                                    </td>
                                    <td>
                                        <div class="stat-icon ">
                                            <span class="stat-text"> Posted a New Notes: ITS670 FINAL ASSESSMENT</span><br>
                                            <span class="stat-text stat-date"> 5 Aug 2021</span>
                                        </div>
                                    </td>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.col-->
            </div>
        </div> <!-- .content -->
        
        <?php if($date_student['student_nickname'] == ''){ ?>
        <div id="open-modal" class="modal-window">
          <div>
            <div class="modal-name"><?php echo $firstName;?> <?php echo $lastName; ?></div>
            <form id="form_id" >
                <input type="Text" name="nickname" id="nickname" placeholder="Enter your nickname" onkeypress="return AvoidSpace(event)">
                <span class="alerts" id="alertNickname" style="position: absolute;top: 373px;left: 165px;font-weight:600;"></span>
                <button type="button" id="submitBtn" name="submitBtn">Submit</button>
            </form>
          </div>
        </div>
        <?php }?>
        
    </div>

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    
    <!-- Jquery -->        
    <script>  
        $(document).ready(function(){ 
            
              $('#submitBtn').click(function(){
                  
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
