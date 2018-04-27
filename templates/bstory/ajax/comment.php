<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConnectDBUtil.php' ?>
<?php session_start(); ?>
  <?php

      $idStory = $_POST['aid'];
      $name = $_POST['aname'];
      $email = $_POST['aemail'];
      $message = $_POST['amessage'];
      $img = rand(1,30).'.jpg';
      $sql = "INSERT INTO comment(fullname,email,noidung,story_id,avt) VALUES('{$name}','{$email}','{$message}',{$idStory},'{$img}') ";
      $query = $conn->query($sql);
      if($query){
        $sql = "SELECT * FROM comment WHERE story_id = {$idStory} ";
        $query = $conn->query($sql);
        $socmt = $query->num_rows ;
        $sql = "UPDATE story SET  so_comment = {$socmt} WHERE story_id = {$idStory} ";
        $query = $conn->query($sql); 



?>
      
        <?php 
          $sql = "SELECT * FROM comment WHERE story_id = {$idStory} ORDER BY id DESC LIMIT 5";
          $query = $conn->query($sql);
        ?>
         <div class="well" >
          <h4>Bình luận: (<?php echo  $socmt ;?>) </h4>
        </div>
      <?php
         while($arCmt = mysqli_fetch_assoc($query)){
            $idcmt = $arCmt['id'];
            $fullname = $arCmt['fullname'];
            $noidung = $arCmt['noidung'];
            $img = "/files/avt/".$arCmt['avt'];
            $ngaybl   = date("l, d-m-Y  | h:m A", strtotime($arCmt['thoigian']));
      ?>
    <div class="media">
              <a class="pull-left" href="#">
                  <img class="media-object" src="<?php echo  $img ;?>" width="64px" height="64px" >
              </a>
              <div class="media-body">
                  <h4 class="media-heading"><?php echo $fullname; ?>
                      <small><?php echo $ngaybl; ?></small>
                  </h4>
                  <p><?php echo $noidung; ?></p>
              </div>
    </div>
        <?php }  ?>
<?php  } 

     
 ?>