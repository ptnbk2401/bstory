 <?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConnectDBUtil.php' ?>
<?php 
    $sqlCat    = "SELECT * FROM cat ORDER BY name ASC";
    $queryCat  = $conn->query($sqlCat);
    if(isset($_GET['p'])){
        $p = $_GET['p'];
    } else {
        $p = 'home';
    }


?>
 <ul class="list-group" id="menu">
        <li class="list-group-item menu1 <?php if($p=='home') echo'active' ?>">
        	 <a href="/trang-chu"><span>Trang chủ</span></a>
        </li>

        <li class="list-group-item menu1 <?php if($p=='cat') echo'active' ?>">
        	Danh mục truyện
        </li>
            <ul>
                <?php 
                    while ($arCat = mysqli_fetch_assoc($queryCat)) {
                        $name   = $arCat['name'];
                        $id     = $arCat['cat_id'];
                        $tendm = utf8ToLatin($name);
                        $url = "/cat/".$tendm."-".$id;
                ?>
                <li class="list-group-item">
                    <a href="<?php echo $url ;?>"><?php echo $name; ?></a>
                </li>
                <?php
                    }
                ?>
        		

            </ul>

        <li href="#" class="list-group-item menu1 <?php if($p=='tophot') echo'active' ?>">
        	Top truyện Hot
        </li>
            <ul>
                <?php 
                    $sql = "SELECT * FROM story ORDER BY counter  DESC ,story_id  DESC LIMIT 4";
                        // echo $sql; die();
                    $query = $conn->query($sql);
                    while ($arSHot = mysqli_fetch_assoc($query)) {
                        $idSHot  = $arSHot['story_id'];
                        $tenSHot  = $arSHot['name'];
                        $hinhanhSHot    = $arSHot['picture'];
                        $tentruyenhot = utf8ToLatin($tenSHot);
                        $urltruyen = "/baiviet/".$tentruyenhot."-".$idSHot.".html";                       
                ?> 
        		<li class="list-group-item">
                         <div class="row">
                            <div class="col-md-5">
                                <a href="<?php echo  $urltruyen ; ?>">
                                    <img class="img-circle" src="/files/images/<?php echo $hinhanhSHot; ?>" width="50px" height="50px">
                                </a>
                            </div>
                            <div class="col-md-7">
                                  <a href="<?php echo  $urltruyen ; ?>" class="text-warning h6" ><?php echo $tenSHot; ?></a>
                            </div>
                          
                            
                        </div>
        		</li>
                <?php  } ?>
            </ul> 


        <li href="#" class="list-group-item menu1 <?php if($p=='new') echo'active' ?>">
        	Truyện Mới Nhất
        </li>

            <ul>
        		  <?php 
                    $sql = "SELECT * FROM story ORDER BY story_id  DESC LIMIT 4";
                        // echo $sql; die();
                    $query = $conn->query($sql);
                    while ($arSMoi = mysqli_fetch_assoc($query)) {
                        $idMoi         = $arSMoi['story_id'];
                        $tenMoi        = $arSMoi['name'];
                        $hinhanhMoi    = $arSMoi['picture'];  
                        $tentruyenmoi   = utf8ToLatin($tenMoi);
                        $urltruyenmoi   = '/baiviet/'.$tentruyenmoi.'-'.$idMoi.".html";                           
                ?> 
                <li class="list-group-item">
                         <div class="row">
                            <div class="col-md-5">
                                <a href="<?php echo  $urltruyenmoi ; ?>">
                                    <img class="img-circle" src="/files/images/<?php echo $hinhanhMoi; ?>" width="50px" height="50px">
                                    
                                </a>
                            </div>
                            <div class="col-md-7">
                                  <a href="<?php echo  $urltruyenmoi ; ?>" class="text-warning h6" ><?php echo $tenMoi; ?></a>
                            </div>
                          
                            
                        </div>
                </li>
                <?php  } ?>
        		
            </ul>


       <!--  <li href="#" class="list-group-item menu1">
        	<a href="#">Level 1</a>
        </li>
        <ul>
    		<li class="list-group-item">
    			<a href="#">Level2</a>
    		</li>
    		<li class="list-group-item">
    			<a href="#">Level2</a>
    		</li>
    		<li class="list-group-item">
    			<a href="#">Level2</a>
    		</li>
    		<li class="list-group-item">
    			<a href="#">Level2</a>
    		</li>
        </ul>

        <li href="#" class="list-group-item menu1">
        	<a href="#">Level 1</a>
        </li>
        <li href="#" class="list-group-item menu1">
        	<a href="#">Level 1</a>
        </li> -->
</ul>