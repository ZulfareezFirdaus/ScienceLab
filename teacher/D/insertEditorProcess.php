 <?php  

 session_start();
 include("../../dbconn.php");

 if(isset($_POST["class_name"]))  
 {      
     
      $class_folder = mysqli_real_escape_string($dbconn, $_POST["class_folder"]); 
      $chapter_name = mysqli_real_escape_string($dbconn, $_POST["chapter_forms"]);
      $chapter_no = mysqli_real_escape_string($dbconn, $_POST["chapter_no"]); 
      $class_name = mysqli_real_escape_string($dbconn, $_POST["class_name"]);
      $descriptionText = mysqli_real_escape_string($dbconn, $_POST["descriptionText"]);
      $title = mysqli_real_escape_string($dbconn, $_POST["title_form"]);
      $date = date('Y-m-d H:i:s');

     
      $result =  $class_name;
      $array = explode(',', $result);
     
     
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
     
      $material_ID = uuid();
      $chapter_ID = uuid();
     
       if($class_folder != ""){
           
           $sql_chapter = "INSERT INTO chapter(chapter_ID,chapter_no,chapter_name) VALUES ('".$chapter_ID."','".$chapter_no."','".$chapter_name."')";
           
           if(mysqli_query($dbconn, $sql_chapter)){
               
               for ($i=0; $i<count($class_name);$i++){
                    $sql_class_chapter = "INSERT INTO class_chapter(chapter_ID,class_ID) VALUES ('".$chapter_ID."','".$array[$i]."')";
                    $query_class_chapter = mysqli_query($dbconn, $sql_class_chapter);
               }
               
               if($query_class_chapter){
                    $sql_material = "INSERT INTO materials (material_ID,material_title,material_description,material_startDate,folder_ID,chapter_ID) VALUES ('".$material_ID."','".$title."','".$descriptionText."','".$date."','".$class_folder."','".$chapter_ID."')"; 
               }
           }
       }  
       else{
           $sql_material = "INSERT INTO materials (material_ID,material_title,material_description,material_startDate,folder_ID) VALUES ('".$material_ID."','".$title."','".$descriptionText."','".$date."','".$class_folder."')"; 
      }
      
     if(mysqli_query($dbconn, $sql_material)){
         
        for ($i=0; $i<count($class_name);$i++){
            $sql_class_material = "INSERT INTO class_material (class_ID,material_ID) VALUES ('".$array[$i]."','".$material_ID."')";  
            $query_class_material = mysqli_query($dbconn, $sql_class_material);
        }

         if($query_class_material){
            $output = 'Success';
         }
        else{
            $output = 'Failed_classMaterial';
        }  
     }
     else{
         $output = 'Failed_Material';
     }

 }
else{
    $output = 'problem';
}

 echo json_encode($output);
 ?> 