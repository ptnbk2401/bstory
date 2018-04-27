

<ul class="sb_menu">
<?php 
        $conn = mysqli_connect('localhost','root','','bstory'); 
        $conn->set_charset('utf8');
        $sql = "SELECT * FROM cat  LIMIT 6";
        $query = $conn->query($sql);
        $link = mysqli_num_rows($query);
        if($link > 0){
            while ($arCat = mysqli_fetch_assoc($query)) {
              $tenCat = $arCat['name'];
              $idCat = $arCat['cat_id'];
      ?>

      <li><a href="/cat.php?idCat=<?php echo $idCat ; ?>"><?php echo  $tenCat; ?></a></li>
       
      <?php        
            }
        }

      ?>

    </ul>   
    <a href="javascript:void(0)" onclick="return xemthem()"><i class="fas fa-angle-double-right"></i> Xem thêm</a>