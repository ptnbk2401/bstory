<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConnectDBUtil.php' ?>

<?php 
    function kiemtraUser($string){
       $re1 = "/^[\w]{4,100}$/";  // Chuỗi hợp lệ 4-100 ktu; \w = [a-zA-Z0-9]
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
   $username = $_POST['aUser'];
   if(kiemtraUser($username)==1){
  	 $sql = "SELECT * FROM users WHERE username = '{$username}'";
	  $query = $conn->query($sql);
	  if($query->num_rows > 0){
	    echo "Username đã tồn tại";
	  }
 	 else   echo 1;
  }

  else {
  	echo "4-100 ký tự và không chứa ký tự đặc biệt";
	}	 


?>