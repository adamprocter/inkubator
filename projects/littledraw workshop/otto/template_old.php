<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Social Otter</title>
	<link href='http://fonts.googleapis.com/css?family=Quicksand:400,700,300' rel='stylesheet' type='text/css'>
	<style type="text/css">
	
		body {
			background: #fff;
			color: #000;
			width: 384px;
			margin: 0px;
			padding: 20px 0px;
			word-wrap: break-word;
			font-family: 'Quicksand', sans-serif;
			
		}
		
		h1 {
		
		}
		
		p{
			
		 	font-size: 22px;
			
		}
		
	</style>
</head>
<body>


  <div class="container">
  		<h1 class="title">
  		<?php echo $greeting; ?>
  		</h1>
  
  <p class="description"><?php echo $description ?></p>
  
  		<p class="edition">
  			<?php echo ($edition_number+1); ?> of <?php echo count($EDITIONS); ?>
  		</p>
  		
  <p>#openbrackets</p>
  	</div>


</body>
</html>
