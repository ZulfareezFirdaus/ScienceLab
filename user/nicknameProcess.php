 <?php   

session_start();
include("../dbconn.php");

if(isset($_POST["nickname"]) )
 {  
      $nickname = mysqli_real_escape_string($dbconn, $_POST["nickname"]);
    
      $sql_update = "UPDATE student SET student_nickname = '".$nickname."' WHERE student_ID = '".$_SESSION["student_ID"]."' ";  
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