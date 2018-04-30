<?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/header.php'; ?>
<!-- slider -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/slider.php'; ?>
<!-- end slide -->
        <div class="space20"></div>

        <div class="row main-left">
            <div class="col-md-3 ">
               <?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/leftbar.php'; ?>
            </div>
            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <?php 
                    if(isset($_GET['id'])){
                        $hienthi = 3; //Số truyện hiển thị trên một trang.
                        $cat_id = $_GET['id'];
                        $sql = "SELECT * FROM cat  WHERE cat_id =  {$cat_id} ";
                        $query = $conn->query($sql);
                        $arcat = mysqli_fetch_assoc($query);
                        $cat_name = $arcat['name']; 
                        $count = "SELECT COUNT(story_id) as sohang FROM story WHERE cat_id =  {$cat_id}";
                        $query = $conn->query($count);
                        $arCount = mysqli_fetch_assoc($query); 
                        $sohang = $arCount['sohang'];
                        $sotrang = ceil($sohang/$hienthi);
                     
                       if(isset($_GET['page'])){
                              $page = $_GET['page'];
                        }
                        else $page = 1;
                        if($page > $sotrang) $page = $sotrang; 
                        if($page < 1 ) $page = 1; 
                        $arCat = mysqli_fetch_assoc($query);

                    }
                    else {
                        header('location: index.php');
                    }

                    ?>
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b><?php echo $cat_name; ?></b></h4>
                    </div>
                    <?php 
                            $sql = "SELECT * FROM story  WHERE cat_id =  {$cat_id} LIMIT ". $hienthi*($page - 1).",{$hienthi}";
                            $query = $conn->query($sql);
                            while ( $arStory = mysqli_fetch_assoc($query) ) {
                                $story_id = $arStory['story_id'];
                                $story_name = $arStory['name']; 
                                $mota = $arStory['preview_text']; 
                                $hinhanh = $arStory['picture']; 
                                $ngaydang = date("d-m-Y h:m A ", strtotime($arStory['created_at']));
                                $luotdoc = $arStory['counter']; 
                                $tentruyen = utf8ToLatin($story_name);
                                $urltruyen = "/baiviet/".$tentruyen."-".$story_id.".html";  
                                              

                    ?>
                    <div class="row-item row">
                        <div class="col-md-3">
                            <a href="<?php echo $urltruyen; ?>">
                                <br>
                                <img width="180px" height="180px" class="img-rounded" src="/files/images/<?php echo $hinhanh; ?>" alt="">
                            </a>
                        </div>
                        <div class="col-md-9" style="padding-top: 10px;">
                            <h4 class="h4 text-success"><mark><?php echo $story_name; ?></mark></h4>
                            <small class="text-success bg-success" >
                                <i>Ngày đăng: <?php echo $ngaydang; ?> - Lượt đọc: <?php echo $luotdoc; ?></i>
                            </small>
                            <p class="text-muted"><?php echo $mota; ?></p>
                            <a class="btn btn-primary" href="<?php echo $urltruyen; ?>">Xem chi tiết <span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        <div class="break"></div>
                    </div>

<?php    
    }

?>
    
                    <!-- Pagination -->
                   <div class="row text-center">
                        <div class="col-lg-12">
                            <ul class="pagination">
                                <li>
                                <?php if($page > 1) { ?><a href="/cat.php?page=<?php echo $page - 1 ;?>&p=cat&id=<?php echo $cat_id ?>">&laquo;</a><?php } ?>
                                </li>
                                <?php    
                                    for($i=1; $i<=$sotrang;$i++){
                                        if($page == $i){
                                ?> 
                                        
                                <li class="active">
                                    <a href="/cat.php?page=<?php echo $i ;?>&p=cat&id=<?php echo $cat_id ?>"><?php echo $i ;?></a> 
                                </li>

                                <?php 
                                        }
                                        else {
                                ?>
                                <li>
                                    <a href="/cat.php?page=<?php echo $i ;?>&p=cat&id=<?php echo $cat_id ?>"><?php echo $i ;?></a>
                                </li>
                                <?php
                                        }
                                    }
                                ?>
                                <li>
                                <?php if($page < $sotrang) { ?><a href="/cat.php?page=<?php echo $page + 1 ;?>&p=cat&id=<?php echo $cat_id ?>">&raquo;</a><?php } ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                            <!-- /.row -->

                </div>
            </div> 

        </div>

    </div>
    <!-- end Page Content -->

    <!-- Footer -->
    <hr> 
<?php include_once  $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/footer.php'; ?>