<?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/header.php'; ?>

	<!-- slider -->
	<?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/slider.php'; ?>
    <!-- end slide -->
        <div class="space20"></div>

        <div class="row main-left">
            <div class="col-md-3 ">
               <?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/leftbar.php'; ?>
            </div>

            <div class="col-md-9">
	            <div class="panel panel-default">
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;"> Danh sách truyện</h2>
	            	</div>
		<?php
	        $hienthi = 5; //Số truyện hiển thị trên một trang.
	        $sql = "SELECT * FROM story WHERE public = 1 ";
	        $query = $conn->query($sql);
	        $sohang = mysqli_num_rows($query);
	       	$sotrang = ceil($sohang/$hienthi);
	     
	       if(isset($_GET['page'])){
	              $page = $_GET['page'];
	        }
	        else $page = 1;
	        if($page > $sotrang) $page = $sotrang; 
	        if($page < 1 ) $page = 1; 
	        $sql = "SELECT *,s.name as sname, c.name as cname FROM story as s INNER JOIN cat as c ON s.cat_id = c.cat_id WHERE public = 1  ORDER BY story_id DESC LIMIT ". $hienthi*($page - 1).",{$hienthi}";
	        $query = $conn->query($sql);
	        $link = mysqli_num_rows($query);
?>	       
	            	<div class="panel-body">
	            		<!-- item -->
	            		<?php 
						 if($link > 0){
				            while($arStory = mysqli_fetch_assoc($query)) {      
				                  $idtruyen 	= $arStory['story_id'];
				                  $tentruyen	= $arStory['sname'];
				                  $danhmuc		= $arStory['cname'];
				                  $cat_id		= $arStory['cat_id'];
				                  // $ngaydang = $arStory['created_at'];
				                  $ngaydang 	= date("d/m/Y", strtotime($arStory['created_at']));
				                  $luotdoc 		= $arStory['counter'];
				                  $mota 		= $arStory['preview_text']; 
								  $hinhanh 		= $arStory['picture'];
								  $tendanhmuc = utf8ToLatin($danhmuc);
								  $urlcat = "/cat/".$tendanhmuc."-".$cat_id;   
								  $truyen = utf8ToLatin($tentruyen);
                        		  $urltruyen = "/baiviet/".$truyen."-".$idtruyen.".html";   
								  

     					?>
	            		
					    <div class="row-item row">
		                	<div class="h3 col-md-12" >
		                		<div class="col-md-12 ">
			                		<a href="<?php echo  $urltruyen ; ?>" class="text-warning"><?php echo $tentruyen; ?></a> <br>
			                	</div>
		                	</div>
		                		
		                	<div class="col-md-12 border-right">
		                		<div class="col-md-3">
			                        <a href="<?php echo  $urltruyen ; ?>">
			                            <img class="img-rounded" src="/files/images/<?php echo  $hinhanh; ?>" alt="" width="157px" height="157px" >
			                        </a>
			                    </div>

			                    <div class="col-md-9">
			                        <h4>Thể loại: <a href="<?php echo  $urlcat ; ?>"><?php echo $danhmuc; ?></a></h4>
			                        <small class="text-success"><i>Ngày đăng: <?php echo $ngaydang; ?> - Lượt đọc: <?php echo $luotdoc; ?></i></small>
			                        <p><?php echo $mota; ?></p>
			                        <a class="btn btn-primary" href="<?php echo  $urltruyen ; ?>">Xem chi tiết <span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>

		                	</div>

							<div class="break"></div>
		                </div>
		                <!-- end item -->
		                <?php } } ?>
		                

					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
         <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li>
        <?php if($page > 1) { ?><a href="/trang-chu/Trang-<?php echo $page - 1 ;?>">&laquo;</a><?php } ?>
                    </li>
		<?php    
			for($i=1; $i<=$sotrang;$i++){
				if($page == $i){
		?> 
				
					<li class="active">
						<a href="/trang-chu/Trang-<?php echo $i ;?>"><?php echo $i ;?></a> 
					</li>

		<?php 
				}
				else {
		?>
					<li>
			            <a href="/trang-chu/Trang-<?php echo $i ;?>"><?php echo $i ;?></a>
			        </li>
		<?php
				}
			}
		?>
                    <li>
          <?php if($page < $sotrang) { ?><a href="/trang-chu/Trang-<?php echo $page + 1 ;?>">&raquo;</a><?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end Page Content -->

    <!-- Footer -->
    <hr>
<?php include_once  $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/footer.php'; ?>