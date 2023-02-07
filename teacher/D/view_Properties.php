<?php  
 session_start();

if(isset($_POST["material_ID"]))
{
 $output = '';
 $connect = mysqli_connect("localhost", "root", "", "sciencelab");
 $query = "SELECT class.*,materials.* FROM class_material INNER JOIN class ON class.class_ID = class_material.class_ID INNER JOIN materials ON materials.material_ID = class_material.material_ID  WHERE materials.material_ID = '".$_POST['material_ID']."' ";
 $result = mysqli_query($connect, $query);
 $data_materials=mysqli_fetch_assoc($result);
 $num_of_row = mysqli_num_rows($result);
    
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    
     $sql_chapter = "SELECT * FROM chapter WHERE chapter_ID = '".$data_materials['chapter_ID']."' ";
     $query_chapter = mysqli_query($connect,$sql_chapter);
     $data_chapter = mysqli_fetch_assoc($query_chapter);
        
     $date = date('F j, Y', strtotime($data_materials['material_startDate']));
     $time = date('h:i a', strtotime($data_materials['material_startDate']));
     $output .= '
     <tr>  
            <td width="30%"><label>Title</label></td>  
            <td width="70%">'.$data_materials["material_title"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Date/Time Created</label></td>  
            <td width="70%">'.$date.' &nbsp;||&nbsp; '.ucwords($time).'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Folder</label></td>  
            <td width="70%">'.$data_materials["folder_ID"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Chapter</label></td>  
            <td width="70%">'.$data_chapter["chapter_no"].' - '.ucwords($data_chapter["chapter_name"]).'</td>  
        </tr>
        <tr>  
            <td width="30%" ><label>Class</label></td>
            <td width="70%"">
            ';
        do
        {
        $output .= '
            '.$data_materials["class_form"].' '.$data_materials["class_name"].',';
        }while($data_materials = mysqli_fetch_assoc($result));
    
    $output .= '
    </td> 
        </tr>
     ';
    $output .= '</table></div>';
    echo $output;
}
?>