<?php

    $connect = mysqli_connect("localhost", "root", "", "sciencelab");

    for($i=0; $i<count($_POST["page_id_array"]); $i++)
    {
         $sql = "UPDATE class SET class_displayOrder = '".$i."' WHERE class_ID = '".$_POST["page_id_array"][$i]."'";
         $query = mysqli_query($connect, $sql);
    }
    if($query){
        echo 'Page Order has been updated'; 
    }
    else{
         echo 'Sucks';
    }

?>