 <?php   

session_start();
include("dbconn.php");

if(isset($_POST["createPassword"]) )
 {  
      $Password = mysqli_real_escape_string($dbconn, $_POST["Password"]);
      $hashed_password = password_hash($Password, PASSWORD_DEFAULT);
    
      $sql_update = "UPDATE teacher SET teacher_password = '".$hashed_password."' WHERE teacher_ID = '".$_SESSION["teacher_ID"]."' ";  
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
     
      $teacher_ID = uuid();
    
      $sql_select = "SELECT * FROM teacher WHERE teacher_IC = '".$icno."' ";  
      $query_select = mysqli_query($dbconn, $sql_select);
      $numRow = mysqli_num_rows($query_select);
      
      if($numRow > 0){
          $dataTeacher = mysqli_fetch_assoc($query_select);
          if($dataTeacher['teacher_password'] == ''){
              $output = 'ExistPass';
          }
          else{
              $output = 'Exist';
          }
      }
      else{
          $sql_insert = "
          INSERT INTO teacher (teacher_ID,teacher_IC,teacher_name) 
          VALUES ('".$teacher_ID."','".$icno."','".$name."')";  
          $query_insert = mysqli_query($dbconn, $sql_insert);
          if($query_insert){
                $output = 'Success';
                $_SESSION["teacher_ID"] = $teacher_ID;
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