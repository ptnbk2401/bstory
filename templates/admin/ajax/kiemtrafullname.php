<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConnectDBUtil.php' ?>

<?php 
    function ktfullname($string){
       $re1 = "/^([\w]+\s*)+$/u";  // Chuỗi hợp lệ 4-100 ktu;
       // $re2 = "/^[a-zA-Z0-9]{,4}$/"; 	 //  Chuỗi dưới 4 ký tự
       // $re3 = "/^[a-zA-Z0-9]{101,}$/";  //  Chuỗi trên 100 ký tự
       if(preg_match($re1,$string,$result)){
            return 1;
       }
       // else if(preg_match($re2,$string,$result)){
       //      return 2;
       // }
       // else if(preg_match($re3,$string,$result)){
       //      return 3;
       // }
       else return false;
    }

?>

<?php 
   $fullname = $_POST['aFullname'];
   if(ktfullname($fullname)==1){
      echo 1;
   }
  else {
  	echo "4-100 ký tự và không chứa ký tự đặc biệt";
	}	 


?>