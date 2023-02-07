 <?php   

session_start();
include("../dbconn.php");

if(isset($_POST["nickname"]) )
 {  
      $nickname = mysqli_real_escape_string($dbconn, $_POST["nickname"]);
    
      $sql_update = "UPDATE teacher SET teacher_nickname = '".$nickname."' WHERE teacher_ID = '".$_SESSION["teacher_ID"]."' ";  
      $query_update = mysqli_query($dbconn, $sql_update);
      if($query_update){
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