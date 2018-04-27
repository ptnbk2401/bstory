<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner"> 
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa User</h2>
            </div> 
        </div>
        <!-- /. ROW  -->
<?php 
    
    if(isset($_GET['idUser'])){
       $idUser = $_GET['idUser'];
       $sql = "SELECT * FROM users WHERE id= {$idUser}";
       $query = $conn->query($sql);
       $arUser = mysqli_fetch_assoc($query);
       $un = $arUser['username'];
       $pw = $arUser['password'];
       $fn = $arUser['fullname'];
       $ad = $arUser['admin'];
    }

    if(isset($_POST['submit'])){
        if(isset($_POST['checkbox'])){
            $admin = $_POST['checkbox'];
        }
        else  $admin = 0;
        if($un == 'admin') $admin = 1;
        // Kiểm tra thay đổi password không!
        if(empty($_POST['password'])){
            if(empty($_POST['fullname'])){
                $tb="Nhập vào Fullname!";
            }
            else {
                $fullname = $_POST['fullname'];
                    $sql="UPDATE users SET fullname='{$fullname}',admin = {$admin} WHERE id= {$idUser}";
                    $query = $conn->query($sql);
                    if($query){
                        header('location: /admin/user/?p=user&tb=Sửa thành công');
                    } 
                    else $tb = "Lỗi Sửa thất bại";
            }
        }
        else {
             if(empty($_POST['fullname'])){
                $tb="Nhập vào Fullname!";
            } 
            else {
                $password = $_POST['password'];
                $repassword = $_POST['repassword'];
                $fullname = $_POST['fullname'];

                if($password == $repassword){
                    $password = md5($_POST['password']);
                    $sql="UPDATE users SET password='{$password}' , fullname='{$fullname}' , admin = {$admin} WHERE id= {$idUser}";
                    $query = $conn->query($sql);
                    if($query){
                       header('location: /admin/user/?p=user&tb=Sửa thành công');
                    } 
                    else $tb = "Lỗi Sửa thất bại";
                }
          

            }
        }   
    }
        

?>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-11">
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" value="<?php echo  $un; ?>" readonly style="width: 500px"/>
                                    </div>
                                    
                                    <div class="form-group" id="form-password">
                                        <label>Mật Khẩu</label>
                                        <span id="span-password"><input type="password" readonly name="password" id="password" class="form-control" value=""  style="width: 500px"/></span>&nbsp; 
                                        <span id="hidden-a" ><a  hidden="" href="javascript:void(0)" onclick="return hienpass()" title="Hiện mật khẩu" id="apass"><img id="hienpass" width="40px" src="/templates/admin/img/hien.png" ></a></span>
                                    </div>
                                    <div class="form-group" id="form-repassword" >
                                        <label><a href="javascript:void(0)" onclick="return changepass()">Đổi Mật khẩu</a></label>
                                        <input type="hidden" name="repassword" id="repassword" class="form-control"  onchange="return checkpass()" value=""  style="width: 500px" />&nbsp; <span id="check" style="color: #A720ED ; font-weight: bold;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Fullname (4-100 ký tự khác ký tự đặc biệt)</label>
                                        <input type="text" name="fullname" id="fullname"  class="form-control" onchange="return kiemtrafullname()" value="<?php echo  $fn; ?>"  style="width: 500px" />&nbsp;<span id="span-fullname"  style="color: #A720ED ; font-weight: bold;"></span>
                                        
                                    </div>
                                    <?php if($un !='admin') { ?>
                                        <div class="form-group">
                                            <label>Cấp quyền Admin</label>
                                            <input type="checkbox" name="checkbox" id="checkbox"  value="1" <?php if($ad==1) echo 'checked'; ?> >
                                        </div>
                                  <?php  } ?>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Lưu</button>
                                    <span style="color: green"><?php if(isset($tb)) echo $tb; ?></span>
                                </form>
                            </div>

                            <!-- Vùng javascript -->
                            <script ype="text/javascript" >
                                function checkpass(){
                                    
                                    if($("#password").val() == $("#repassword").val()){
                                         //alert("ok");
                                         $("#check").html("&nbsp; <img src='/templates/admin/img/ok.png' width='20px;'/>");
                                    }
                                    else { 
                                         //alert("Chưa OK");
                                          $("#check").text("Mật khẩu chưa khớp");
                                    }

                                }

                                function hienpass(){
                                    if($("#password").attr('type')=='password'){
                                        $("#password").attr('type','text');
                                        $("#repassword").attr('type','text');
                                        $("#hienpass").attr('src','/templates/admin/img/an.png' );
                                        $("#apass").attr('title','Ẩn mật khẩu');
                                    } else {
                                        $("#password").attr('type','password');
                                        $("#repassword").attr('type','password');
                                        $("#hienpass").attr('src','/templates/admin/img/hien.png' );
                                        $("#apass").attr('title','Hiện mật khẩu');
                                    }                                  

                                }
                                function changepass(){
                                    $("#span-password").html('<input type="password" name="password" id="password" class="form-control" style="width: 500px"/>');        
                                    $("#form-repassword label").text('Nhập Lại Mật Khẩu');   
                                    $("#repassword").attr('type','password');  
                                    $("#hidden-a").html('<a href="javascript:void(0)" onclick="return hienpass()" title="Hiện mật khẩu" id="apass"><img id="hienpass" width="40px" src="/templates/admin/img/hien.png" ></a>');      

                                }
                                function kiemtrafullname(){
                                    var fullname = $("#fullname").val();
                                    $.ajax({
                                        url: '/templates/admin/ajax/kiemtrafullname.php',
                                        type: 'POST',
                                        cache: false,
                                        data: {aFullname: fullname },
                                        success: function(data){
                                         // alert(data);
                                         $('#span-fullname').html(data);
                                         if(data == 1){
                                             $('#span-fullname').html("<img src='/templates/admin/img/ok.png' width='20px;'/>");
                                         }
                                         else {
                                             $('#fullname').val("");
                                         }
                                        
                                        },
                                        error: function(){
                                          alert('Có lỗi xảy ra');
                                        }
                                        });
                                        return false;
                                }

                                


                            </script>

                        </div>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>
        </div>
        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/footer.php'; ?>