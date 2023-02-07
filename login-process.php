 <?php   

session_start();
include("dbconn.php");

if(isset($_POST["username"]) )
 {  
      $username = mysqli_real_escape_string($dbconn, $_POST["username"]);
      $password = mysqli_real_escape_string($dbconn, $_POST["password"]);
    
      $sql_select = "SELECT * FROM student WHERE student_IC = '".$username."' ";  
      $query_select = mysqli_query($dbconn, $sql_select);
      $numRow = mysqli_num_rows($query_select);
    
      if($numRow > 0)  
      {  
            $data = mysqli_fetch_assoc($query_select);
            
            if(password_verify($password,$data['student_password'])){
                $_SESSION["student_ID"] = $data['student_ID'];
                $output = 'SuccessStudent';
            }
            else{
                $output = 'WrongPassword';
            }
      }
      else{
          $sql_select = "SELECT * FROM teacher WHERE teacher_IC = '".$username."' ";  
          $query_select = mysqli_query($dbconn, $sql_select);
          $numRow = mysqli_num_rows($query_select);
          
          if($numRow > 0)  
          {  
                $data = mysqli_fetch_assoc($query_select);

                if(password_verify($password,$data['teacher_password'])){
                    $_SESSION["teacher_ID"] = $data['teacher_ID'];
                    $output = 'SuccessTeacher';
                }
                else{
                    $output = 'WrongPassword';
                }
          }
          else{
              $output = 'WrongUserId';
          }
      }
      
 }
 else{
    $output = 'Problem';
 }
 
 echo json_encode($output);
 ?>  