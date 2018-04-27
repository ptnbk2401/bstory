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
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Liên hệ</h2>
	            	</div>

	            	
                    <div class="panel-body">
                         <h3><span class="glyphicon glyphicon-inbox"></span> Form liên hệ</h3>
                         <div class="break"></div><br>
                           <?php 
                           if(isset($_POST['submit'])){
                              if(empty($_POST['name']) || empty($_POST['email'])){
                                 $thongbao = "Nhập đầy đủ Họ tên - Email !"; 
                              }
                              else {
                                $name    = strip_tags($_POST['name']);
                                $email   = strip_tags($_POST['email']);
                                $website = strip_tags($_POST['website']);
                                $message = strip_tags($_POST['message']);     
                                $bienregex = "/[\"'`]/" ;
                                $bienthaythe = '&quot;' ;
                                $name = preg_replace($bienregex, $bienthaythe, $name);
                                //$email = preg_replace($bienregex, $bienthaythe, $email);
                                $message = preg_replace($bienregex, $bienthaythe, $message);

                                $sql = "INSERT INTO contact(name,email,website,content) VALUES ('{$name}','{$email}','{$website}','{$message}') ";
                               
                                $query = $conn->query($sql);
                                if($query){
                                   $thongbao = "Gửi Thành công";
                                }
                                else $thongbao = "Gửi Thất bại";
                              }

                           }

                           ?>
                           <form  method="post">
                                  <div class="form-group">
                                    <label for="name">Họ tên (<span class="text-danger">*</span>) : </label>
                                    <input id="name" name="name" type="text" placeholder="Họ tên" class="form-control"  />
                                  </div>
                                  <div class="form-group">
                                    <label for="email">Email (<span class="text-danger">*</span>) :</label>
                                    <input id="email" type="email" name="email" class="form-control" placeholder="Email" />
                                  </div>
                                   <div class="form-group">
                                    <label for="website">Website:</label>
                                    <input type="text" id="website" name="website" class="form-control" placeholder="Website"  />
                                  </div>
                                  <div class="form-group">
                                    <label for="message">Nội dung:</label>
                                    <textarea id="message" name="message" rows="3" cols="100" class="form-control"></textarea>
                                  </div>
                                  
                                  <button type="submit" name="submit" class="btn btn-primary">Gửi Liên Hệ</button>
                                  <span style="color: #08C22B;"><?php if(isset($thongbao)) echo $thongbao ;?></span>
                            </form>

                        
                    </div>    
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->

    <!-- Footer -->
    <hr>
<?php include_once  $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/footer.php'; ?>