<?php  

session_start();
include("../dbconn.php");

if(isset($_POST["class_ID"]))
{
    $output = '';

    $query = "SELECT * FROM class WHERE class_ID = '".$_POST["class_ID"]."'";
    $result = mysqli_query($dbconn, $query);

    while($row = mysqli_fetch_array($result))
    {
        $output .= '
            <span class="class-code" style="font-size:100px;font-weight:600;color:#007bff">'.$row["class_code"].'</span>
            <input type="text" value="'.$row["class_code"].'" id="myInputCopy" style="display:none;">
        ';
    }
    echo $output;
}
?>