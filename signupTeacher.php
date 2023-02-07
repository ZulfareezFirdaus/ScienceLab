<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>ScienceLab || Educational Portal</title>

        <!--Favicon -->
        <link href="images/logo/lg-03.svg" rel="icon" type="image/svg" sizes="32x32">
        <link href="images/logo/lg-03.svg" sizes="32x32" rel="apple-touch-icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

        <!--Google Icon -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!--Default Style Css -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <link rel="stylesheet" href="css/aos.css">
        <link rel="stylesheet" href="css/bootstrap-datepicker.css">
        <link rel="stylesheet" href="css/jquery.timepicker.css">
        <link rel="stylesheet" href="css/fancybox.min.css">
        <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">

        <!-- Main Style Css -->
        <link rel="stylesheet" href="css/style.css">
        
        <!-- Jquery Script -->
        <script src="http://code.jquery.com/jquery-2.1.1.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
        
        
    </head>
    <body>
    
    <!-- START header section -->
    <header>
        <section class="topnav">
            <a href="#home" style="padding-left: 50px; "><i class="material-icons">phonelink</i> Phone Device</a>
            <div class="topnav-centered">
                <a href="#home" >ScienceLab Educational Portal Website</a>
            </div>
            <a href="#home" style="float:right;padding-right: 70px;"><i class="material-icons">help_outline</i> Help</a>
        </section>
        <section class="site-header js-site-header container-fluid">
            <div class="row align-items-center">
              <div class="col-6 col-lg-4 site-logo" data-aos="fade"><a href="index.html"><img width="10%;" src="images/logo/lg-03.svg" /> ScienceLab</a></div>
               <div class="col-6 col-lg-8 right-side" data-aos="fade">
                   <a href="index.html"><i class="material-icons">assignment</i> Assignment</a>
                   <a href="index.html"><i class="material-icons">work</i> Materials</a>
                   <a href="index.html"><i class="material-icons">notifications_active</i> Notification</a>
                   <a href="login.php" style="padding-right:1px;"> Login |</a>
                   <a href="signup.php" style="padding-right:1px;"> Sign Up</a>
               </div>
            </div>
        </section>
    </header>
    <!-- END header section -->

    <section class="section testimonial-section bg-light login-form" style="padding-top: 200px;" >
      <div class="container">
        <div class="row">
          <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
            
            <img src="images/banner/bn-19.png" width="85%" style="float:right"/>

          </div>
            
          <div class="col-md-5" data-aos="fade-up" data-aos-delay="200" >
            <div class="row">
              <form id="form_id" class="bg-white p-md-5 p-4 mb-5 border">
                  <h2>Sign Up (Teacher)</h2>
                  <ul class="progressbar">
                    <li class="active">Personal <br> Data</li>
                    <li>Create <br> Password</li>
                    <li>Done <br> &nbsp;</li>
                  </ul>
                  <div id="alertExist" class="alert-notification"><span class="material-icons">highlight_off</span> Ic Number is exist, Please Login </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <input type="text" id="name" placeholder="Name" class="form-control ">
                  <input type="hidden" id="personalData" name="personalData" value="personalData" class="form-control ">
                  <span class="alerts" id="alertName"></span>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <input type="text" id="icno" placeholder="Ic Number" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="12" class="form-control ">
                  <span class="alerts" id="alertICno"></span>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                    <center>
                      <button type="button" id="submitBtn" class="custom-btn btn-12"><span>Lets Go! <i class="fa fa-rocket"></i></span><span> Next </span></button>
                    </center><br>
                </div>
              </div>
                  
                  <hr>
                  <h3>Have an account? <a href="login.php">Log In</a></h3>
            </form>
            </div>
          </div>
            
        </div>
      </div>
    </section>

    <footer class="footer-section">
      <div class="container">
        <div class="row pt-5">
          <p class="col-md-6 text-left">
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved 
          </p>
        </div>
      </div>
    </footer>
    
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/bootstrap-datepicker.js"></script> 
    <script src="js/jquery.timepicker.min.js"></script> 

    <script src="js/main.js"></script>
      
    <!-- Change logo Script -->
    <script>
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 10) {
            $('.site-header .site-logo img').attr('src', 'images/logo/lg-02.svg');
        }else{
            $('.site-header .site-logo img').attr('src', 'images/logo/lg-03.svg');
        }
    });
    </script>
        
    <script>
        $(window).scroll(function() {    
            var scroll = $(window).scrollTop();

            if (scroll >= 50) {
                $(".site-header").addClass("scrolled");
            }
        });  
    </script>
        
    <!-- Jquery -->        
    <script>  
        
        $(document).ready(function(){ 
            
              $('#submitBtn').click(function(){
                  
                   var name = $('#name').val();  
                   var icno = $('#icno').val();
                   var personalData = $('#personalData').val();
                  
                   if(name == '' || icno == '')  
                   {  
                        $('#alertName').html('<span class="text-danger alerts">This field are required!</span>').show();   
                        $('#alertICno').html('<span class="text-danger alerts">This field are required!</span>').show(); 
                   }
                   if(name != '')  
                   {  
                        $('#alertName').hide(); 
                   }
                   if($.trim(icno).length < 12)  
                   {  
                        $('#alertICno').html('<span class="text-danger alerts">IC number must be 12 number!</span>').show();
                   }
                   if($.trim(icno).length >= 12)  
                   {  
                        $('#alertICno').hide();
                   }
                   if($.trim(name).length > 0 && $.trim(icno).length >= 12) 
                   {
                       $.ajax({
                        url:"signupTeacher-process.php",
                        method:"POST",
                        dataType:"json",
                        data:{name:name,icno:icno,personalData:personalData},
                        success:function(data)
                        {
                            if(data == 'ExistPass')  {  
                                $('#alertExist').hide();
                                location.href = "passwordSetTeacher.php";
                                $('#form_id').trigger("reset");
                            }
                            else if(data == 'Success')  {  
                                location.href = "passwordSetTeacher.php";
                                $('#form_id').trigger("reset");
                            }
                            else if(data == 'Exist')  {  
                                $('#alertExist').show();
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