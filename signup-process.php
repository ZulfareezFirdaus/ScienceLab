 <?php   

session_start();
include("dbconn.php");

if(isset($_POST["createPassword"]) )
 {  
      $Password = mysqli_real_escape_string($dbconn, $_POST["Password"]);
      $hashed_password = password_hash($Password, PASSWORD_DEFAULT);
    
      $sql_update = "UPDATE student SET student_password = '".$hashed_password."' WHERE student_ID = '".$_SESSION["student_ID"]."' ";  
      $query_update = mysqli_query($dbconn, $sql_update);
      if($query_update){
          $output = 'Success';
      }
      else{
          $output = 'Failed';
      }
      
 }
 else if(isset($_POST["personalData"]) )
 {  
      $name = mysqli_real_escape_string($dbconn, $_POST["name"]);
      $icno = mysqli_real_escape_string($dbconn, $_POST["icno"]);
      $form = mysqli_real_escape_string($dbconn, $_POST["form"]);
      $classes = mysqli_real_escape_string($dbconn, $_POST["classes"]);
    
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
     
      $student_ID = uuid();
    
      $sql_select = "SELECT * FROM student WHERE student_IC = '".$icno."' ";  
      $query_select = mysqli_query($dbconn, $sql_select);
      $numRow = mysqli_num_rows($query_select);
      
      if($numRow > 0){
          $dataStudent = mysqli_fetch_assoc($query_select);
          if($dataStudent['student_password'] == ''){
              $output = 'ExistPass';
          }
          else{
              $output = 'Exist';
          }
      }
      else{
          $sql_insert = "
          INSERT INTO student (student_ID,student_IC,student_form,student_name,student_className) 
          VALUES ('".$student_ID."','".$icno."','".$form."','".$name."','".$classes."')";  
          $query_insert = mysqli_query($dbconn, $sql_insert);
          if($query_insert){
                $output = 'Success';
                $_SESSION["student_ID"] = $student_ID;
          }
          else{
                $output = 'Problem';
          }
      }
     
      
 }
 else{
    $output = 'Problem';
 }
 
 echo json_encode($output);
 ?>  