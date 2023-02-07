<?php
    session_start();
    include("../../dbconn.php");

    foreach($_GET as $loc=>$C)
    $_GET[$loc] = base64_decode(urldecode($C));

    $sql_select = "
    SELECT class.*,theme.* FROM class INNER JOIN theme ON class.theme_ID = theme.theme_ID WHERE class.class_ID = '".$_GET[$loc]."' ";
    $query_select = mysqli_query($dbconn, $sql_select);
    $data_class = mysqli_fetch_assoc($query_select);

    

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
    <link rel="stylesheet" href="../vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href="../assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</head>
<style>
    
    .card-hover{
        cursor:pointer;
    }   

    .card-hover:hover{
        background:<?php echo $data_class['theme_codeColor'] ?>33;
        border-bottom: 4px solid <?php echo $data_class['theme_codeColor'] ?>;
    }    

    .icon{
        color:<?php echo $data_class['theme_codeColor'] ?>;
    }

    .text-color{
        font-size: 17px;
        color:<?php echo $data_class['theme_codeColor'] ?>
    }
    
</style>
<body>


    <!-- Left Panel -->

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
                <h2>Zulfareez Firdaus</h2><br>
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
                    <button class="todolist-button" ><i class="fa fa-edit"></i> To Do List</button>
                    <button class="workreview-button" ><i class="fa fa-list-alt"></i> Work Review</button>
                </div>

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
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <table>
                            <td width="20%" >
                                <img style="width:85%" src="../images/user.jpg" />
                            </td>
                            <td>
                                <h1>Hi Fareez!</h1>
                            </td>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active" >Class Stream</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="col-xl-12 col-lg-12">
                <div class="card title-page">
                    <div class="card text-light bg-notes-form4" style="background: url(../images/stream-bg/sb-<?php echo $data_class['theme_codeName'] ?>.jpg);">
                        <div class="card-body">
                            <div class="title" ><?php echo $data_class['class_name'] ?> <span>Form <?php echo $data_class['class_form'] ?></span></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-12 mb-4 custom-tab">
                <nav>
                <div class="card-group" id="nav-tab" role="tablist">
                    <div class="card col-md-6 no-padding card-hover ">
                        <a class="active" id="custom-nav-home-tab" data-toggle="tab" href="#custom-nav-home" role="tab" aria-controls="custom-nav-home" aria-selected="true">
                            <div class="card-body">
                                <div class="h4 mb-0 text-right">
                                    <span class="count">87500</span>
                                </div>
                                <div class="text-uppercase font-weight-bold text-right text-color" >All</div>
                                <div class="h1 text-muted mb-4 padding-adjust">
                                    <i class="ti-view-list-alt icon" ></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="card col-md-6 no-padding card-hover">
                        <a id="custom-nav-profile-tab" data-toggle="tab" href="#custom-nav-profile" role="tab" aria-controls="custom-nav-profile" aria-selected="false">
                            <div class="card-body">
                                <div class="h4 mb-0 text-right">
                                    <span class="count">385</span>
                                </div>
                                <div class="text-uppercase font-weight-bold text-right text-color" >Notes</div>
                                <div class="h1 text-muted text-right mb-4 padding-adjust">
                                    <i class="ti-agenda icon" ></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="card col-md-6 no-padding card-hover">
                        <a id="custom-nav-contact-tab" data-toggle="tab" href="#custom-nav-contact" role="tab" aria-controls="custom-nav-contact" aria-selected="false">
                            <div class="card-body">
                                <div class="h4 mb-0 text-right">
                                    <span class="count">28</span>
                                </div>
                                <div class="text-uppercase font-weight-bold text-right text-color" >Quiz</div>
                                <div class="h1 text-muted text-right mb-4 padding-adjust">
                                    <i class="ti-write icon" ></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="card col-md-6 no-padding card-hover">
                        <div class="card-body">
                            <div class="h4 mb-0 text-right">
                                <span class="count">1238</span>
                            </div>
                            <div class="text-uppercase font-weight-bold text-right text-color" >Exercise</div>
                            <div class="h1 text-muted text-right mb-4 padding-adjust">
                                <i class="ti-ruler-pencil icon" ></i>
                            </div>
                        </div>
                    </div>
                    <div class="card col-md-6 no-padding card-hover">
                        <div class="card-body">
                            <div class="h4 mb-0 text-right">
                                <span class="count">28</span>
                            </div>
                            <div class="text-uppercase font-weight-bold text-right text-color" >Games</div>
                            <div class="h1 text-muted text-right mb-4 padding-adjust">
                                <i class="ti-game icon" ></i>
                            </div>
                        </div>
                    </div>
                </div>
                </nav>
                
                <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                        <p>A</p>
                    </div>
                    <div class="tab-pane fade" id="custom-nav-profile" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                        <p>B</p>
                    </div>
                    <div class="tab-pane fade" id="custom-nav-contact" role="tabpanel" aria-labelledby="custom-nav-contact-tab">
                        <p>C</p>
                    </div>
                </div>
                
            </div>
        </div> <!-- .content -->
    </div>

    <!-- Right Panel -->

    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/widgets.js"></script>

</body>

</html>
