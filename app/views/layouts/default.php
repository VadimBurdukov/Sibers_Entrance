<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/public/css/bootstrap.min.css">
	<link rel="stylesheet" href="/public/css/style.css">
	<script src="/public/js/jquery-3.5.1.js"></script>
    <script src="/public/js/script.js"></script>
	<title><? echo $title; ?></title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
	    <div class="container">
	    	
	        <div class="collapse navbar-collapse" id="navbarResponsive">
	            <?if (isset($adminFlag)):?>
		            <ul class="navbar-nav ml-auto">
		            	<li class="nav-item">
		                    <a href="/admin/add" class="nav-link">Add new user</a>	
		                </li>
	                
						<li class="nav-item">
							<a href="/admin/logout" class="nav-link">Logout</a>
						</li>					       
		            </ul>
	            <?endif?>  
	        </div>
	    </div>
	</nav>
	<header class="masthead" style="background-image: url('/public/images/home-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div >       	
                    <h1>Nice to see you <?if (isset($adminFlag)):?> again	, <?=$adminName?><?endif?></h1>             
                </div>
            </div>
        </div>
    </div>
</header>
	<? echo $content; ?>
</body>
</html>