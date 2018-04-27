<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner"> 
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm User</h2>
            </div> 
        </div>
        <!-- /. ROW  -->
<?php 
    

    if(isset($_POST['submit'])){
        if( empty($_POST['username']) || empty($_POST['password']) || empty($_POST['repassword']) || empty($_POST['fullname']) ){
            $tb="Nhập vào đầy đủ các trường!";
        }
        
        else {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $repassword = $_POST['repassword'];
            $fullname = $_POST['fullname'];
            if(isset($_POST['checkbox'])){
                $admin = $_POST['checkbox'];
            }
            else  $admin = 0;
            
            if($password == $repassword){
                $password = md5($_POST['password']);
                $sql="INSERT INTO users(username,password,fullname,admin) VALUES('{$username}','{$password}','{$fullname}',{$admin})";
                $query = $conn->query($sql);
                if($query){
                    header('location: /admin/user/?p=user&tb=Thêm thành công');
                } 
                else $tb = "Lỗi Thêm thất bại";
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
                                <form role="form" method="post" >
                                    <div class="form-group">
                                        <label>Fullname ( 4-100 ký tự khác ký tự đặc biệt)</label>
                                        <input type="text" name="fullname" id="fullname"  class="form-control" onchange="return kiemtrafullname()" value="<?php  if(isset($fullname)) echo  $fullname; ?>"  style="width: 500px" />&nbsp;<span id="span-fullname"  style="color: #A720ED ; font-weight: bold;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Username </label>
                                        <input type="text" name="username" id="username" class="form-control" value="<?php if(isset($username)) echo  $username; ?>"  style="width: 500px" onchange="return kiemtrauser()"/>&nbsp;<span id="span-username"  style="color: #A720ED ; font-weight: bold;"></span>
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" id="password" class="form-control" value="<?php  if(isset($password)) echo  $password; ?>"  style="width: 500px"/>&nbsp; <a href="javascript:void(0)" onclick="return hienpass()" title="Hiện mật khẩu" id="apass"><img id="hienpass" width="40px" src="/templates/admin/img/hien.png" ></a>
                                    </div>
                                    <div class="form-group">
                                        <label>Nhập lại Password</label>
                                        <input type="password" name="repassword" id="repassword" class="form-control" onchange="return checkpass()" value="<?php  if(isset($repassword)) echo  $repassword; ?>"  style="width: 500px" />&nbsp; <span id="check" style="color: #A720ED ; font-weight: bold;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Cấp quyền Admin</label>
                                        <input type="checkbox" name="checkbox" id="checkbox"  value="1" >
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
                                    <span style="color: green"><?php if(isset($tb)) echo $tb; ?></span>
                                </form>
                            </div>

                            <!-- Vùng javascript -->
                            <script type="text/javascript" >
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
                                function kiemtrauser(){
                                    var username = $("#username").val();
                                    $.ajax({
                                        url: '/templates/admin/ajax/kiemtrauser.php',
                                        type: 'POST',
                                        cache: false,
                                        data: {aUser: username },
                                        success: function(data){
                                         // alert(data);
                                         $('#span-username').html(data);
                                         if(data == 1){
                                             $('#span-username').html("<img src='/templates/admin/img/ok.png' width='20px;'/>");
                                         }
                                         else {
                                             $('#username').val("");
                                         }
                                        
                                          
                                        },
                                        error: function(){
                                          alert('Có lỗi xảy ra');
                                        }
                                        });
                                        return false;
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