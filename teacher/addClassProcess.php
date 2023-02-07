 <?php   

session_start();
include("../dbconn.php");

 if(isset($_POST["class_name"]) && isset($_POST["class_form"]) )
 {  
    $class_name = mysqli_real_escape_string($dbconn, $_POST["class_name"]);  
    $class_form = mysqli_real_escape_string($dbconn, $_POST["class_form"]); 
     
    $class_code = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGH1JKLMNOPQRSTUVWXYZ", 6)), 0, 6);
     
    function uuid()
      {
            return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0x0fff) | 0x4000,
                mt_rand(0, 0x3fff) | 0x8000,
                mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
            );
      }
     
    $class_ID = uuid();
    $class_theme = rand(1,15);

    $sql_insert = "INSERT INTO class (class_ID,class_name,class_form,class_code,theme_ID,teacher_ID) VALUES ('".$class_ID."','".$class_name."','".$class_form."','".$class_code."','".$class_theme."','".$_SESSION["teacher_ID"]."') ";  

    if(mysqli_query($dbconn,$sql_insert)){
        $output = 'Success';
    }
    else{
        $output = 'Failed';
    }
 }
 else{
    $output = 'Problem';
 }
 
 echo json_encode($output);
 ?>  