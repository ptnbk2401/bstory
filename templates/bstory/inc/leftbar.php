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
        	 <a href="/index.php?p=home"><span>Trang chủ</span></a>
        </li>

        <li class="list-group-item menu1 <?php if($p=='cat') echo'active' ?>">
        	Danh mục truyện
        </li>
            <ul>
                <?php 
                    while ($arCat = mysqli_fetch_assoc($queryCat)) {
                        $name   = $arCat['name'];
                        $id     = $arCat['cat_id'];
                ?>
                <li class="list-group-item">
                    <a href="/cat.php/?p=cat&id=<?php echo $id ;?>"><?php echo $name; ?></a>
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
                ?> 
        		<li class="list-group-item">
                         <div class="row">
                            <div class="col-md-5">
                                <a href="/detail.php?id=<?php echo  $idSHot ; ?>">
                                    <img class="img-circle" src="/files/images/<?php echo $hinhanhSHot; ?>" width="50px" height="50px">
                                </a>
                            </div>
                            <div class="col-md-7">
                                  <a href="/detail.php?id=<?php echo  $idSHot ; ?>" class="text-warning h6" ><?php echo $tenSHot; ?></a>
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
                    while ($arSHot = mysqli_fetch_assoc($query)) {
                        $idSHot  = $arSHot['story_id'];
                        $tenSHot  = $arSHot['name'];
                        $hinhanhSHot    = $arSHot['picture'];                       
                ?> 
                <li class="list-group-item">
                         <div class="row">
                            <div class="col-md-5">
                                <a href="/detail.php?id=<?php echo  $idSHot ; ?>">
                                    <img class="img-circle" src="/files/images/<?php echo $hinhanhSHot; ?>" width="50px" height="50px">
                                    
                                </a>
                            </div>
                            <div class="col-md-7">
                                  <a href="/detail.php?id=<?php echo  $idSHot ; ?>" class="text-warning h6" ><?php echo $tenSHot; ?></a>
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