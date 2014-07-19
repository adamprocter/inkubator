<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Social Otter</title>
	<link href='http://fonts.googleapis.com/css?family=Quicksand:400,700,300' rel='stylesheet' type='text/css'>
	<style type="text/css">
body{
font-family: 'Quicksand', sans-serif;
margin-top:10px;
}

h1{
text-align:center;
padding-top:40px;
font-size:45px;
border-top:black 3px solid;
}


#icon{
width:55px;
height:55px;
margin-left:auto;
margin-right:auto;
display:block;
border-radius:300px;
border:3px solid black;
}

#countdown{
background-color:#000;
color:white;
height:40px;
width:40px;
border-radius:300px;
text-align:center;
margin-left:auto;
margin-right:auto;
display:block;
}
h2{
margin-top:-20px;
text-align:center;
}
h3{
padding-top:12px;
}

h4{
font-size:18px;
text-align:center;

}

h5{
font-size:18px;
color:black;
text-align:center;
}
.bubble p{
font-family: 'Quicksand', sans-serif;
font-weight:600;
font-size:40px;
text-align:center;
padding:10px;
word-wrap: break-word;
}

.bubble 
{
position: relative;
width: 95%;
height: auto;
min-height:100px;
margin-bottom:40px;
padding: 0px;
background: #FFFFFF;
-webkit-border-radius: 15px;
-moz-border-radius: 15px;
border-radius: 15px;
border: #000 solid 5px;
}

p{
margin-top:-15px;
padding-bottom:40px;
}

.bubble:after 
{
content: '';
position: absolute;
border-style: solid;
border-width: 15px 15px 0;
border-color: #FFFFFF transparent;
display: block;
width: 0;
z-index: 1;
bottom: -15px;
left: 162px;
}

.bubble:before 
{
content: '';
position: absolute;
border-style: solid;
border-width: 19px 19px 0;
border-color: #000 transparent;
display: block;
width: 0;
z-index: 0;
bottom: -24px;
left: 158px;
}

#challengeno{
position:absolute;
float:right;
right:0;
font-weight:600;
padding:10px;
font-size:30px;
}

</style>

<body>
<h1>[ Social Otter ]</h1>
<div class="bubble">
<div id="challengeno"><?php echo $edition_number; ?></div>
<h4><?php echo $greeting; ?></h4>
<p><?php echo $description ?></p>
</div>
<img id="icon" src="<?php echo $ROOT_DIRECTORY; ?>icon.png">
<h5>share your challenge</h5>
<h2>#openbrackets</h2>
<div id="countdown"><h3><?php echo $days_left; ?></h3></div>
</body>