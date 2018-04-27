<?php session_start(); ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConnectDBUtil.php' ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/Utf8ToLatinUtil.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> Đọc truyện cùng Bstory</title>
    <!-- Bootstrap Core CSS -->
    <link href="/templates/bstory/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/templates/bstory/css/shop-homepage.css" rel="stylesheet">
    <link href="/templates/bstory/css/my.css" rel="stylesheet">
    <style>
        body{
            background-color: #e0e0e0;
        }
        .row {
            background-color: #fff;
        }
      
    </style>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/trang-chu">BSTORY</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/gioi-thieu">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="/lien-he">Liên hệ</a>
                    </li>
                </ul>

                <form class="navbar-form navbar-left" role="search">
			        <div class="form-group">
			          <input type="text" class="form-control" placeholder="Search">
			        </div>
			        <button type="submit" class="btn btn-default">Submit</button>
			    </form>

			    <ul class="nav navbar-nav pull-right">
                    <li>
                        <a href="">Đăng ký</a>
                    </li>
                    <li>
                        <a href="">Đăng nhập</a>
                    </li>
                    <li>
                    	<a>
                    		<span class ="glyphicon glyphicon-user"></span>
                    		Nguyên
                    	</a>
                    </li>

                    <li>
                    	<a href="#">Đăng xuất</a>
                    </li>

                </ul>
            </div>



            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container noidung">
