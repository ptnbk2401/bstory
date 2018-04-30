<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConnectDBUtil.php'; ?>
<?php session_start() ;?>
<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<title>Login</title>
	<link href="/templates/admin/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="/templates/admin/js/bootstrap.min.js"></script>
	<link rel="SHORTCUT ICON" href="/files/icon-n.jpg" type="image/x-icon" />
	
	<style type="text/css">
		.vertical-offset-100{
		    padding-top:100px;
		}
		.background {
			width: 100%;
			height: 100%;
			position: fixed;
			z-index: -1;
		}
</style>
</head>
<body>
	<?php 
		$x = rand(1,5);
		$img = "/templates/admin/img/login/lg".$x.".jpg"; 
	?>
	<?php if(isset($_GET['logout'])) {
		unset($_SESSION['user']);
	} 



	?>
	<?php 
		if(isset($_POST['submit'])){
			if(empty($_POST['username']) || empty($_POST['password']) ){
				$tb = "Nhập vào username, password!";
			}
			else {
				$name = $_POST['username'];
				$pass = md5($_POST['password']);
				$sql = "SELECT * FROM users WHERE username='{$name}' && password = '$pass' ";
				$query = $conn->query($sql);
				if($query->num_rows > 0){
					$aruser = mysqli_fetch_assoc($query) ;
					$_SESSION['user'] = $aruser;
					header('location: /admin/');
				}
				else $tb = "Sai Username hoặc Password";

			}



		}

	?>

	<img class="background" src="<?php echo $img ;?>" width="100%" height="100%" />
	<div class="container">
    <div class="row vertical-offset-100">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Đăng nhập hệ thống</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form acction="javascipt:void(0)" accept-charset="UTF-8" role="form" method="post">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Username" name="username" type="text">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Password" name="password" type="password" value="">
			    		</div>
			    		<div class="checkbox">
			    	    	<label>
			    	    		<input name="remember" type="checkbox" value="Remember Me"> Remember Me
			    	    	</label>
			    	    </div>
			    		<input class="btn btn-lg btn-success btn-block" type="submit" name="submit" value="Login"><br/>
			    		<span style="margin-left: 75px; color: #0DC0E6; text-align: center"> <?php if(isset($tb)){ echo $tb;}  ?> </span>
			    	</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>
</body>
</html>

