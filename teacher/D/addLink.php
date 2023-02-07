<?php   

 session_start();  
 $connect = mysqli_connect("localhost", "root", "", "sciencelab"); 

 $rand_num = mt_rand(1,99);

 if(isset($_POST["add"]))  
 {  
      if(isset($_SESSION["link"]))  
      {  
           $item_array_id = array_column($_SESSION["link"], "link_id");  
           if(!in_array($rand_num, $item_array_id))  
           {  
                $count = count($_SESSION["link"]);  
                $item_array = array(  
                     'item_id'               =>     $rand_num, 
                     'links'          =>     $_POST["links"]  
                );  
                $_SESSION["link"][$count] = $item_array; 
               
               $output = '';
                foreach($_SESSION["link"] as $keys => $values)  
                {     
                 $output .= '
                  <div class="file-block"><span><span class="file-delete2" ><i class="ti-link"></i></span></span>http://'.$values["links"].'
                  <form>
                    <input type="hidden" value="delete" name="delete2" id="delete2" >
                    <button type="button" name="submitBtn2" class="btn submitBtn2" style="background: none;border: none;color: black;position: relative;right: -345px;top: -6px;" ><i class="ti-close"></i></button>
                  </form>
                  </div>
                 ';
                }
                echo $output;
           }
      }  
      else  
      {   
           $item_array = array(  
                'link_id'               =>     $rand_num, 
                'links'          =>     $_POST["links"]  
           );  
           $_SESSION["link"][0] = $item_array; 
          
            $output = '';
            foreach($_SESSION["link"] as $keys => $values)  
            {     
             $output .= '
              <div class="file-block"><span><span class="file-delete2" ><i class="ti-link"></i></span></span>http://'.$values["links"].'
              <form>
                <input type="hidden" value="delete" name="delete2" id="delete2" >
                <button type="button" name="submitBtn2" class="btn submitBtn2" style="background: none;border: none;color: black;position: relative;right:-340px;top: -6px;" ><i class="ti-close"></i></button>
              </form>
              </div>
             ';
            }
            echo $output;
      }  
 } 

 if(isset($_POST["deletes"]))    
  {  
       foreach($_SESSION["link"] as $keys => $values)  
       {  
            if($values["link_id"] == $rand_num)  
            {  
                 unset($_SESSION["link"][$keys]);  
            }  
       }  
  }  
 ?> 
