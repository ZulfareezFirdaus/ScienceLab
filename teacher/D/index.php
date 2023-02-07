<?php
    session_start();
    include("../../dbconn.php");
    unset($_SESSION["link"]);
    
    //decode $_GET[]
    foreach($_GET as $loc=>$C)
    $_GET[$loc] = base64_decode(urldecode($C));

    $_SESSION['class_ID'] = $_GET[$loc];
    
    $sql = "SELECT class.*,theme.* FROM class INNER JOIN theme ON class.theme_ID = theme.theme_ID";
    
    $sql_class = $sql." WHERE class.class_ID = '".$_GET[$loc]."'";
    $query_class = mysqli_query($dbconn, $sql_class);
    $data_class = mysqli_fetch_assoc($query_class);
    
    $form4 = [];
    $sql_form4 = $sql." WHERE class.class_form = '4' ORDER BY class.class_displayOrder ASC";
    $query_form4 = mysqli_query($dbconn, $sql_form4);
    while($data_form4 = mysqli_fetch_assoc($query_form4)){
        $form4[] = $data_form4;
    }
    
    $form5 = [];
    $sql_form5 = $sql." WHERE class.class_form = '5' ORDER BY class.class_displayOrder ASC";
    $query_form5 = mysqli_query($dbconn, $sql_form5);
    while($data_form5 = mysqli_fetch_assoc($query_form5)){
        $form5[] = $data_form5;
    }

    $sql = $sql;
    $query = mysqli_query($dbconn, $sql);
    $num_rows = mysqli_num_rows($query);
    
    $dataMaterial = [];
    $sql_materials = "SELECT class.*,materials.* FROM class_material INNER JOIN class ON class.class_ID = class_material.class_ID INNER JOIN materials ON materials.material_ID = class_material.material_ID  WHERE class.class_ID = '".$_GET[$loc]."' ";
    $query_materials = mysqli_query($dbconn, $sql_materials);
    $numrowsmaterials = mysqli_num_rows($query_materials);
    while($data_materials = mysqli_fetch_assoc($query_materials)){
        $dataMaterial[] = $data_materials;
    }

    $sql_teacher = "
    SELECT * FROM teacher WHERE teacher_ID = '".$_SESSION["teacher_ID"]."'";
    $query_teacher = mysqli_query($dbconn, $sql_teacher);
    $data_teacher = mysqli_fetch_assoc($query_teacher);

    $sql_chapter = "
    SELECT * FROM chapter ORDER BY chapter_no";
    $query_chapter = mysqli_query($dbconn, $sql_chapter);
    
    //Make color become more fade
    $colour = $data_class['theme_codeColor'];
    $brightness = 0.5; 
    $newColour = colourBrightness($colour, $brightness);
    
    function colourBrightness($hex, $percent)
    {
        
        $hash = '';
        if (stristr($hex, '#')) {
            $hex = str_replace('#', '', $hex);
            $hash = '#';
        }
        
        $rgb = [hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2))];
        
        for ($i = 0; $i < 3; $i++) {
            
            if ($percent > 0) {
                
                $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
            } else {
                
                $positivePercent = $percent - ($percent * 2);
                $rgb[$i] = round($rgb[$i] * (1 - $positivePercent)); 
            }
            
            if ($rgb[$i] > 255) {
                $rgb[$i] = 255;
            }
        }
        
        $hex = '';
        for ($i = 0; $i < 3; $i++) {
            
            $hexDigit = dechex($rgb[$i]);
            
            if (strlen($hexDigit) == 1) {
                $hexDigit = "0" . $hexDigit;
            }
            
            $hex .= $hexDigit;
        }
        return $hash . $hex;
    }
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
    
    .card-hover{
        cursor:pointer;
    }   

    .card-hover:hover{
        background:<?php echo $data_class['theme_codeColor'] ?>24;
        border-bottom: 3px solid <?php echo $data_class['theme_codeColor'] ?>;
    }    

    .icon{
        color:<?php echo $data_class['theme_codeColor'] ?>;
    }

    .text-color{
        font-size: 17px;
        color:<?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .nav .active{
        background:<?php echo $data_class['theme_codeColor'] ?>24;
        border-bottom: 3px solid <?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .post-element .post-logo{
        background:<?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .post-element:hover{
        background:<?php echo $data_class['theme_codeColor'] ?>24;
        border-right:3px solid <?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .post-announce:hover{
        border-right:3px solid <?php echo $data_class['theme_codeColor'] ?>;
        color:<?php echo $data_class['theme_codeColor'] ?>;
        background:none;
    }
    
    .post-announcement{
        background:none !Important;
        border-bottom:1px solid #dadce0;
    }
    
    .post-announcement .icon{
        background:<?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .icon-post{
        color:<?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .btn-post-announcement{
        background: <?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .link-post-announcement:hover{
        color:<?php echo $data_class['theme_codeColor'] ?> !important;
    }
    
    .link-text{
        border-bottom: 2px solid <?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .link-text::placeholder { 
        color: <?php echo $data_class['theme_codeColor'] ?>;
        opacity: 1;
    }

    .link-text:-ms-input-placeholder { 
        color: <?php echo $data_class['theme_codeColor'] ?>;
    }

    .link-text::-ms-input-placeholder { 
        color: <?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .btn-special {
        background-color: <?php echo $data_class['theme_codeColor'] ?>;
        border-color: <?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .btn-special:hover {
        background-color: #ffffff;
        border-color: <?php echo $data_class['theme_codeColor'] ?>;
        color:<?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .title-link{
        background: <?php echo $data_class['theme_codeColor'] ?>;
    }
    .file-delete2 {
        background: <?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .container input:checked ~ .checkmark {
      background-color: <?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .container2 input:checked ~ .checkmark2 {
      background-color: <?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .bg-editor .editor-form{
        border-bottom: 2px solid <?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .modal-body .editor-form{
        border-bottom: 2px solid <?php echo $data_class['theme_codeColor'] ?>;
    }
    
    #editor {
        border-bottom: 2px solid <?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .notes-panel .btn-create:hover{
        box-shadow: 0 2px 3px 0 <?php echo $data_class['theme_codeColor'] ?>24, 0 6px 10px 4px <?php echo $data_class['theme_codeColor'] ?>24 !important;
        opacity:0.9;
    }
    
    .notes-panel .dropdown-item .icon{
        color: <?php echo $data_class['theme_codeColor'] ?>;
        font-weight:700;
    }
    
    .dropdown-item.active, .dropdown-item:active{
        background:<?php echo $data_class['theme_codeColor'] ?>24 !important;
    }
    
    .dropdown-css .btn-post{
        background: <?php echo $data_class['theme_codeColor'] ?>;
    }
    
    .add-comment .post-text:hover{
        color:<?php echo $data_class['theme_codeColor'] ?>;
        background:none;
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
                            <li class="active" >Class Stream</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hi area END-->

        <div class="content mt-3">
            <!-- Picture and class area START-->
            <div class="col-xl-12 col-lg-12">
                <div class="card title-page">
                    <div class="card text-light bg-notes-form4" style="background: url(../images/stream-bg/sb-<?php echo $data_class['theme_ID'] ?>.jpg);">
                        <div class="card-body">
                            <div class="title" ><?php echo $data_class['class_form'] ?> <?php echo $data_class['class_name'] ?> <span>Form <?php echo $data_class['class_form'] ?></span></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Picture and class area END-->
            
            <div class="col-sm-12 mb-4">
                <!-- Multiple folder button START-->
                <div class="card-group nav" id="nav-tab" role="tablist">
                    <div class="card col-md-6 no-padding card-hover active" id="custom-nav-all-tab" data-toggle="tab" href="#custom-nav-all" role="tab" aria-controls="custom-nav-all" aria-selected="true">
                        <div class="card-body">
                            <div class="h4 mb-0 text-right">
                                <span class="count">87500</span>
                            </div>
                            <div class="text-uppercase font-weight-bold text-right text-color" >Stream</div>
                            <div class="h1 text-muted mb-4 padding-adjust">
                                <i class="ti-view-list-alt icon" ></i>
                            </div>
                        </div>
                    </div>
                    <div class="card col-md-6 no-padding card-hover" id="custom-nav-notes-tab" data-toggle="tab" href="#custom-nav-notes" role="tab" aria-controls="custom-nav-notes" aria-selected="false">
                        <div class="card-body">
                            <div class="h4 mb-0 text-right">
                                <span class="count">385</span>
                            </div>
                            <div class="text-uppercase font-weight-bold text-right text-color" >Notes</div>
                            <div class="h1 text-muted text-right mb-4 padding-adjust">
                                <i class="ti-agenda icon" ></i>
                            </div>
                        </div>
                    </div>
                    <div class="card col-md-6 no-padding card-hover" id="custom-nav-quiz-tab" data-toggle="tab" href="#custom-nav-quiz" role="tab" aria-controls="custom-nav-quiz" aria-selected="false">
                        <div class="card-body">
                            <div class="h4 mb-0 text-right">
                                <span class="count">28</span>
                            </div>
                            <div class="text-uppercase font-weight-bold text-right text-color" >Quiz</div>
                            <div class="h1 text-muted text-right mb-4 padding-adjust">
                                <i class="ti-write icon" ></i>
                            </div>
                        </div>
                    </div>
                    <div class="card col-md-6 no-padding card-hover" id="custom-nav-exercise-tab" data-toggle="tab" href="#custom-nav-exercise" role="tab" aria-controls="custom-nav-exercise" aria-selected="false">
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
                    <div class="card col-md-6 no-padding card-hover" id="custom-nav-games-tab" data-toggle="tab" href="#custom-nav-games" role="tab" aria-controls="custom-nav-games" aria-selected="false">
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
                <!-- Multiple folder button END-->
                
                <!-- Popup Display START-->
                <div class="alert alert-success alert-success-popup" id="copied-success" role="alert" >
                    Post successfully created!
                </div>
                <!-- Popup Display END-->
                
                <div class="card-body">
                    <!-- TAB content START-->
                    <div class="tab-content" id="nav-tabContent">
                        
                        <!-- TAB content [STREAM] START-->
                        <div class="tab-pane fade show active" id="custom-nav-all" role="tabpanel" aria-labelledby="custom-nav-all-tab">
                            <div class="col-lg-9" style="margin-top:10px;">
                                <form id="fupForm" enctype="multipart/form-data">
                                    <div class="bg-editor" id="hideDiv" style="display:none;z-index:99;">
                                        <div class="col-lg-12" >
                                            <label for="postal-code" class=" form-control-label" style="font-weight:600;font-size:16px;">Title</label>
                                            <input type="text" id="title_form" name="title_form" class="form-control editor-form">
                                            <div class="alert alert-danger" id="class_editor_alert" role="alert" 
                                            style="display:none;margin-bottom: -8px !Important;margin-top: 12px;font-weight:600;background: none;border: none;padding: 0;color: red;">
                                                This field is required!
                                            </div>
                                            <label for="postal-code" class=" form-control-label" style="margin-top:15px;font-weight:600;font-size:16px;">Instructions (Optional)</label>
                                            <div class="editor-toolbar" style="border-radius:0.5rem 0.5rem 0 0;">
                                              <a href="javascript:void(0)" role="button" class="toolbar-btn unselectable" onclick="runCommand(this, 'bold', null)" unselectable="on"><i class="fa fa-bold"></i></a>
                                              <a href="javascript:void(0)" role="button" class="toolbar-btn" onclick="runCommand(this, 'italic', null)"><i class="fa fa-italic"></i></a>
                                              <a href="javascript:void(0)" role="button" onclick="runCommand(this, 'underline', null)"><i class="fa fa-underline"></i></a> 
                                              <a href="javascript:void(0)" role="button" onclick="runCommand(this, 'indent', null)"><i class="fa fa-indent"></i></a> 
                                              <a href="javascript:void(0)" role="button" onclick="runCommand(this, 'insertUnorderedList', null)"><i class="fa fa-list-ul"></i></a> 
                                              <a href="javascript:void(0)" role="button" onclick="runCommand(this, 'insertOrderedList', null)"><i class="fa fa-list-ol"></i></a>
                                              <a href="javascript:void(0)" role="button" onclick="runCommand(this, 'redo', null)"><i class="fa fa-repeat"></i></a>
                                              <a href="javascript:void(0)" role="button" onclick="runCommand(this, 'undo', null)"><i class="fa fa-undo"></i></a>   
                                            </div>
                                            <div id="editor"  contenteditable="true" style="border-radius:0 0 0.5rem 0.5rem;" ></div>
                                            <textarea name="descriptionText" class="descriptionText" id="descriptionText" style="display:none"></textarea>
                                            <div class="col-lg-5">
                                                <div style="color:#000000;font-weight:500;font-size:15px;padding-bottom: 10px;">Posted For :</div>
                                                <div class="animated fadeIn dropdown-css">
                                                    <select data-placeholder="<?php echo $num_rows ?> Classes" name="class_name" class="js-select2-multi class_name" id="class_name" multiple="multiple">
                                                        <?php 
                                                        foreach($form4 as $data_form4) {
                                                          if($_GET[$loc] == $data_form4["class_ID"]){ ?>
                                                            <option value="<?php echo $data_form4["class_ID"] ?>"  class="class_name" name="class_name" selected><?php echo $data_form4["class_form"] ?> <?php echo $data_form4["class_name"] ?></option>
                                                        <?php 
                                                                }else{?>
                                                            <option value="<?php echo $data_form4["class_ID"] ?>"  class="class_name" name="class_name" ><?php echo $data_form4["class_form"] ?> <?php echo $data_form4["class_name"] ?></option>
                                                        <?php 
                                                            }
                                                        }
                                                        foreach($form5 as $data_form5) {
                                                          if($_GET[$loc] == $data_form5["class_ID"]){ ?>
                                                            <option value="<?php echo $data_form5["class_ID"] ?>"  class="class_name" name="class_name" selected><?php echo $data_form5["class_form"] ?> <?php echo $data_form5["class_name"] ?></option>
                                                        <?php 
                                                                }else{?>
                                                            <option value="<?php echo $data_form5["class_ID"] ?>"  class="class_name" name="class_name" ><?php echo $data_form5["class_form"] ?> <?php echo $data_form5["class_name"] ?></option>
                                                        <?php 
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-1"></div>

                                            <div class="col-lg-5" >
                                                <div class="col-lg-12" style="padding: 0;" >
                                                    <div style="color:#000000;font-weight:500;font-size:15px;padding-bottom: 10px;">Posted In :</div>
                                                    <div class="animated fadeIn dropdown-css">
                                                        <select data-placeholder="Stream" class="select-css class_folder"  name="class_folder" onchange="weg(this)" id="class_folder" >
                                                            <option value="Stream" name="class_folder" class="class_folder" id="class_folder">Stream</option>
                                                            <option value="Notes" name="class_folder" class="class_folder" id="class_folder">Notes</option>
                                                            <option value="Quiz" name="class_folder" class="class_folder" id="class_folder">Quiz</option>
                                                            <option value="Exercise" name="class_folder" class="class_folder" id="class_folder">Exercise</option>
                                                            <option value="Games" name="class_folder" class="class_folder" id="class_folder">Games</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="display_option" style="display:none;">
                                                    <div class="col-lg-12" style="padding: 0;" >
                                                        <br>
                                                        <div style="color:#000000;font-weight:500;font-size:15px;padding-bottom: 10px;">Chapter :</div>
                                                        <div class="animated fadeIn dropdown-css" style="position:relative;z-index:999;">
                                                            <select class="select-css" id="addChapter" style="margin-bottom: 30px;" >
                                                                <option value="">No Chapter</option>
                                                                <option value="secondoption" >Create chapter</option>
                                                                <option value="" disabled="true">----------------</option>
                                                                <?php while($data_chapter = mysqli_fetch_assoc($query_chapter)){ ?>
                                                                    <option value="<?php echo $data_chapter['chapter_ID'] ?>"><?php echo $data_chapter['chapter_no'] ?> - <?php echo $data_chapter['chapter_name'] ?></option>
                                                                <?php }?>
                                                            </select>
                                                            <div class="chapter-form" id="chapter-form" style="display:none;" >
                                                                <input type="text" class="select-css" placeholder="No of chapter" id="chapter_no" />
                                                                <input type="text" style="margin-top: 10px;" class="select-css" placeholder="Chapter Name" id="chapter_forms" />
                                                                <button type="button" id="btn-close-chapter" ><i class="ti-close"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <br><br><br>
                                            <div style="position:relative;z-index:1;">
                                                <p id="files-area">
                                                    <span id="filesList">
                                                        <span id="files-names"></span>
                                                    </span>
                                                </p>
                                                <div style="margin-top:20px" id="link_table"></div>
                                                <div class="col-lg-5">
                                                    <div class="animated fadeIn" style="position:relative;top:17px;">
                                                        <a type="button"  class="notes-body tooltips" data-toggle="modal" data-target="#smallmodal" >
                                                            <i class="fa fa-link icon-post"></i>
                                                            <span class="tooltiptexts" style="top: 60px;left: 33px;">Upload Link</span>
                                                        </a>
                                                        <label for="attachment" class="notes-body tooltips">
                                                            <a class="btn btn-upload text-light" role="button" aria-disabled="false"><i class="fa fa-upload icon-post"></i></a>
                                                            <span class="tooltiptexts" style="top: 60px;left: 87px;">Upload File</span>
                                                        </label>
                                                        <input type="file" id='files' name="files[]" style="opacity: 0; position: absolute;" multiple/>
                                                        <i class="fab fa-youtube icon-post"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7" style="text-align:right;margin: 40px 0px 0px 0px;">
                                                    <a id="show" class="link-post-announcement">Cancel</a>
                                                    <button type="button" name="submitBtnClass" class="btn-post-announcement">Post</button>
                                                    <br><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="col-lg-12" style="margin-top:9px;">
                                    <a id="hide">
                                        <div class="post-element post-announce" >
                                            <div class="post-logo post-announcement" style="border-bottom:none;" >
                                                <center>
                                                    <i  class="ti-announcement icon" ></i>
                                                </center>
                                            </div>
                                            <div class="post-text post" >
                                                <span class="title post" >Announce something to your class</span><br><br>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                
                                <div id="posted_material"></div>
                                
                            </div>
                            <div class="col-lg-3" style="margin-top:30px;"></div>
                        </div>
                        <!-- TAB content [STREAM] END-->
                        
                        <!-- TAB content [NOTES] START-->
                        <div class="tab-pane fade notes-panel" id="custom-nav-notes" role="tabpanel" aria-labelledby="custom-nav-notes-tab">
                            <div class="col-lg-12">
                                <button class="nav-link dropdown-toggle btn-create" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="background:<?php echo $data_class['theme_codeColor'] ?>;box-shadow: 0 1px 2px 0 <?php echo $data_class['theme_codeColor'] ?>24, 0 2px 6px 2px <?php echo $data_class['theme_codeColor'] ?>24" ><i class="ti-plus"></i>&nbsp; Create
                                </button>
                                <div class="dropdown-menu" style="width: 20%;">
                                    <a class="dropdown-item" type="button" data-toggle="modal" data-target="#staticModal"><i class="ti-briefcase icon"></i> &nbsp;Material</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><i class="ti-view-list icon" ></i> &nbsp;Topic</a>
                                    <a class="dropdown-item" href="#"><i class="ti-folder icon"></i> &nbsp;Chapter</a>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8" style="margin-top:20px;">
                                <div class="" style="border: 0.0625rem solid #dadce0;border-radius: 0.5rem;padding:20px 40px;">
                                    <center>
                                        <span style="font-weight:600;font-size:22px;color:<?php echo $data_class['theme_codeColor'] ?>">Start Communicate with your class now</span><br><br>
                                        <img src="../images/icon/ico-05.png" width="25%"><br>
                                        <span style="font-weight:600;position:relative;top:10px;color:#808080">No Posts Yet..</span>
                                    </center><br><br>
                                    <div>
                                        <center>
                                            <div style="background:<?php echo $data_class['theme_codeColor'] ?>24;padding:20px 20px 25px 20px;font-weight:600;font-size:16px">
                                                <i class="far fa-file-alt" style="font-size:20px;color:<?php echo $data_class['theme_codeColor'] ?>" ></i> Create assignments and questions<br>
                                                <span style="position:relative;top:6px;">
                                                    <i class="far fa-folder" style="font-size:21px;color:<?php echo $data_class['theme_codeColor'] ?>" ></i> Use folders to organise classwork into modules
                                                </span>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                          </div>
                        <!-- TAB content [NOTES] END-->
                        
                        <div class="tab-pane fade" id="custom-nav-exercise" role="tabpanel" aria-labelledby="custom-nav-exercise-tab">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8" style="margin-top:20px;">
                                <div class="" style="border: 0.0625rem solid #dadce0;border-radius: 0.5rem;padding:20px 40px;">
                                    <center>
                                        <span style="font-weight:600;font-size:22px;color:<?php echo $data_class['theme_codeColor'] ?>">Start Communicate with your class now</span><br><br>
                                        <img src="../images/icon/ico-05.png" width="25%"><br>
                                        <span style="font-weight:600;position:relative;top:10px;color:#808080">No Posts Yet..</span>
                                    </center><br><br>
                                    <div>
                                        <center>
                                            <div style="background:<?php echo $data_class['theme_codeColor'] ?>24;padding:20px 20px 25px 20px;font-weight:600;font-size:16px">
                                                <i class="far fa-file-alt" style="font-size:20px;color:<?php echo $data_class['theme_codeColor'] ?>" ></i> Create assignments and questions<br>
                                                <span style="position:relative;top:6px;">
                                                    <i class="far fa-folder" style="font-size:21px;color:<?php echo $data_class['theme_codeColor'] ?>" ></i> Use folders to organise classwork into modules
                                                </span>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-nav-quiz" role="tabpanel" aria-labelledby="custom-nav-quiz-tab">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8" style="margin-top:20px;">
                                <div class="" style="border: 0.0625rem solid #dadce0;border-radius: 0.5rem;padding:20px 40px;">
                                    <center>
                                        <span style="font-weight:600;font-size:22px;color:<?php echo $data_class['theme_codeColor'] ?>">Start Communicate with your class now</span><br><br>
                                        <img src="../images/icon/ico-05.png" width="25%"><br>
                                        <span style="font-weight:600;position:relative;top:10px;color:#808080">No Posts Yet..</span>
                                    </center><br><br>
                                    <div>
                                        <center>
                                            <div style="background:<?php echo $data_class['theme_codeColor'] ?>24;padding:20px 20px 25px 20px;font-weight:600;font-size:16px">
                                                <i class="far fa-file-alt" style="font-size:20px;color:<?php echo $data_class['theme_codeColor'] ?>" ></i> Create assignments and questions<br>
                                                <span style="position:relative;top:6px;">
                                                    <i class="far fa-folder" style="font-size:21px;color:<?php echo $data_class['theme_codeColor'] ?>" ></i> Use folders to organise classwork into modules
                                                </span>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-nav-games" role="tabpanel" aria-labelledby="custom-nav-games-tab">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8" style="margin-top:20px;">
                                <div class="" style="border: 0.0625rem solid #dadce0;border-radius: 0.5rem;padding:20px 40px;">
                                    <center>
                                        <span style="font-weight:600;font-size:22px;color:<?php echo $data_class['theme_codeColor'] ?>">Start Communicate with your class now</span><br><br>
                                        <img src="../images/icon/ico-05.png" width="25%"><br>
                                        <span style="font-weight:600;position:relative;top:10px;color:#808080">No Posts Yet..</span>
                                    </center><br><br>
                                    <div>
                                        <center>
                                            <div style="background:<?php echo $data_class['theme_codeColor'] ?>24;padding:20px 20px 25px 20px;font-weight:600;font-size:16px">
                                                <i class="far fa-file-alt" style="font-size:20px;color:<?php echo $data_class['theme_codeColor'] ?>" ></i> Create assignments and questions<br>
                                                <span style="position:relative;top:6px;">
                                                    <i class="far fa-folder" style="font-size:21px;color:<?php echo $data_class['theme_codeColor'] ?>" ></i> Use folders to organise classwork into modules
                                                </span>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- TAB content END-->
                </div>
            </div>
        </div>
    </div>
    
    <!-- Right Panel END -->
    
    <!-- Add Link -->
    <div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" style="margin-top: 185px;" role="document">
            <form id="form_id" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="smallmodalLabel">Add link</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="links" name="links" class="link-text" placeholder="Enter Link">
                        <input type="hidden" value="add" name="add" id="add" >
                        <span class="help-block" id="class_form_alert" style="font-weight:400;top:7px;font-size:16px;" >This field is required!</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" name="submitBtn" id="submitBtn" class="btn btn-special">Add Link</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Add Material -->
    <div class="modal fade dropdown-css" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-sm modal-width" role="document">
            <div class="modal-content modal-height">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel" style="position:relative;left:20px;"><i class="ti-briefcase icon"></i> &nbsp;Materials </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-9" style="padding:20px;">
                        <label for="postal-code" class=" form-control-label" style="font-weight:600;font-size:16px;">Title</label>
                        <input type="text" id="title_form" name="title_form" class="form-control editor-form">
                        <div class="alert alert-danger" id="class_editor_alert" role="alert" 
                        style="display:none;margin-bottom: -8px !Important;margin-top: 12px;font-weight:600;background: none;border: none;padding: 0;color: red;">
                            This field is required!
                        </div>
                        <label for="postal-code" class=" form-control-label" style="margin-top:15px;font-weight:600;font-size:16px;">Instructions (Optional)</label>
                        <div class="editor-toolbar" style="border-radius:0.5rem 0.5rem 0 0;">
                          <a href="javascript:void(0)" role="button" class="toolbar-btn unselectable" onclick="runCommand(this, 'bold', null)" unselectable="on"><i class="fa fa-bold"></i></a>
                          <a href="javascript:void(0)" role="button" class="toolbar-btn" onclick="runCommand(this, 'italic', null)"><i class="fa fa-italic"></i></a>
                          <a href="javascript:void(0)" role="button" onclick="runCommand(this, 'underline', null)"><i class="fa fa-underline"></i></a> 
                          <a href="javascript:void(0)" role="button" onclick="runCommand(this, 'indent', null)"><i class="fa fa-indent"></i></a> 
                          <a href="javascript:void(0)" role="button" onclick="runCommand(this, 'insertUnorderedList', null)"><i class="fa fa-list-ul"></i></a> 
                          <a href="javascript:void(0)" role="button" onclick="runCommand(this, 'insertOrderedList', null)"><i class="fa fa-list-ol"></i></a>
                          <a href="javascript:void(0)" role="button" onclick="runCommand(this, 'redo', null)"><i class="fa fa-repeat"></i></a>
                          <a href="javascript:void(0)" role="button" onclick="runCommand(this, 'undo', null)"><i class="fa fa-undo"></i></a>   
                        </div>
                        <div id="editor"  contenteditable="true" style="border-radius:0 0 0.5rem 0.5rem;" ></div>
                        <textarea name="descriptionText" class="descriptionText" id="descriptionText" style="display:none"></textarea>
                    </div>
                    <div class="col-lg-3 " style="padding:20px;">
                        <div class="col-lg-12" >
                        <div style="color:#000000;font-weight:500;font-size:15px;">Topic :</div>
                            <div class="animated fadeIn" style="position:relative;width:100%;z-index: 99999999;">
                                <select data-placeholder="Choose a Country..." class="select-css" tabindex="1">
                                    <option value=""></option>
                                    <option value="United States">United States</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 radio-btn" >
                        <div style="color:#000000;font-weight:500;font-size:15px;">Chapter :</div>
                            <div class="animated fadeIn" style="position:relative;width:100%;z-index: 999999;">
                                <select data-placeholder="Choose a Country..." class="select-css" tabindex="1">
                                    <option value=""></option>
                                    <option value="United States">United States</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 checkbox-btn">
                        <div style="color:#000000;font-weight:500;font-size:15px;">Posted For :</div>
                            <div class="animated fadeIn" style="position:relative;width:100%;">
                                <select data-placeholder="No topic" multiple class="select-css">
                                    <option value=""></option>
                                    <option value="United States">United States</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="animated fadeIn" style="position:relative;top:-25px;float:right">
                            <a type="button"  class="notes-body tooltips" data-toggle="modal" data-target="#smallmodal" >
                                <i class="fa fa-link icon-post" style="position: relative;top: 10px;"></i>
                                <span class="tooltiptexts" style="top: 60px;left: 33px;">Upload Link</span>
                            </a>
                            <label for="attachment" class="notes-body tooltips">
                                <a class="btn btn-upload text-light" role="button" aria-disabled="false"><i class="fa fa-upload icon-post" style="position: relative;top: 10px;"></i></a>
                                <span class="tooltiptexts" style="top: 55px;left: 87px;">Upload File</span>
                            </label>
                            <input type="file" name="file[]" id="attachment" style="visibility: hidden; position: absolute;" multiple/>
                            <i class="fab fa-youtube icon-post"></i>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-post">Post</button>
                </div>
            </div>
        </div>
    </div>
    
        <div class="modal fade" id="propertiesModal" tabindex="-1" role="dialog" aria-labelledby="propertiesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="propertiesModalLabel"><i class="ti-info-alt"></i> Properties</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="properties_detail">
                    </div>
                </div>
            </div>
        </div>
    
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="margin-top: 80px;" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel"><i class="ti-pencil"></i> Edit Announcement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="edit_detail">
                    </div>
                </div>
            </div>
        </div>

    <!-- Right Panel -->

    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/editor.js"></script>
    <script src="../assets/js/fileupload2.js"></script>
    <script src="../assets/js/select_checkbox.js"></script>
    <script src="../vendors/chosen/chosen.jquery.min.js"></script>
    
    <script>
        function weg(elem) {
            var x = document.getElementById("class_folder").value;

            if(x === "Stream"){
                 document.getElementById("display_option").style.display = "none";
            }
            else{
                 document.getElementById("display_option").style.display = "block";
             }
        }
    </script>
    
    <script>
    $(document).ready(function(){ 
        $('#addChapter').change(function() {
            var opval = $(this).val();
            if(opval=="secondoption"){
                $('#chapter-form').show();
                $('#addChapter').hide();
            }
        });
    });
    </script>
    
    <script>
        $(document).ready(function(){
          $("#btn-close-chapter").click(function(){
            $('#chapter-form').hide();
            $('#addChapter').show();
            $('#chapter-forms').val('');
          });
        });
    </script>
    
    <script>
        $(document).ready(function(){
          $("#hide").click(function(){
            $("#hideDiv").show("slow");
            $("#hide").hide();
          });
        });
    </script>
    
    <script>
        $(document).ready(function(){
          $("#show").click(function(){
            $("#hideDiv").hide();
            $("#hide").show();
          });
        });
    </script>
    
    <script>  
        $(document).ready(function(){  
          $('#submitBtn').click(function(){  
               var links = $('#links').val(); 
               var add = $('#add').val(); 

               if(links == '')  
               {  
                    $('#class_form_alert').show();
                     
               } 
               if($.trim(links).length > 0) 
               {  
                   
                   $('#class_form_alert').hide();
                   
                   $.ajax({
                    url:"addLink.php",
                    method:"POST",
                    data:{links:links,add:add},
                    success:function(data)
                    {
                        $('#link_table').html(data);
                        $("#smallmodal").removeClass("show");
                        $(".modal-backdrop").removeClass("show");
                        $('#form_id').trigger("reset");
                    }
                   });  
               }  
          });  
         });  
     </script>
    
    <script>  
    $(document).ready(function(){  
      $('.submitBtn2').click(function(){
           var deletes = $('#deletes').val(); 

           if($.trim(links).length > 0) 
           {  

               $('#class_form_alert').hide();

               $.ajax({
                url:"addLink.php",
                method:"POST",
                data:{deletes:deletes},
                success:function(data)
                {
                    $('#link_table').html(data);
                }
               });  
           }  
      });  
     });  
 </script>
    
    <script>
    $(document).ready(function() {
      $(".js-select2").select2({
        closeOnSelect: false
      });
      $(".js-select2-multi").select2({
        closeOnSelect: false
      });
    });    
    </script>
    
    <!-- Jquery -->        
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
    
    <script>
     function fetch_post_data()
     {
      $.ajax({
       url:"fetch_posted_material.php",
       method:"POST",
       success:function(data)
       {
        $('#posted_material').html(data);
       }
      })
     }
     fetch_post_data();
    </script> 
    
   

</body>

</html>
