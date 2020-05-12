<!DOCTYPE html>
<?php
//Upadate button has clicked
session_start();
$_SESSION["update"] = "";

?>
<html>
<head>
	<title>MovieDB</title>
	<style>
	body {
		background: -webkit-linear-gradient(top, #b3b3b0 0%, #e3e2dd 500px);
		
	}
	#main {
		background-color: rgb(248,248,248);
		width: 1000px;
		margin: auto;
		box-shadow: 0px 0px 8px rgba(0,0,0,0.7);
	}
	.up {
		width: 100%;
		margin: auto;
		padding-top: 20px;
		background-color: #575757;
		
	}
	<!-- /* -----------Header------------*/ -->
	
	#header {
		
		color:white;
		height: 90px;
		margin-top: 0px;
		background: -webkit-linear-gradient(top, #646464 0%, #0e0e0e 100%);
		background: linear-gradient(to bottom, #646464 0%,#0e0e0e 100%);
		border-top: 1px solid #444;
	}
	#mlogo {
		height: 40px;
	}
	.logo {
		height: 49px;
		left: 20px;
		top: 37px;
		width: 101px;
		z-index: 10000;
		margin: 20px 0px 0px 40px;
	}
		
	#navbar input {
		border: none;
		border-radius: 3px 0 0 3px;
		box-shadow: 1px 1px 1px rgba(0,0,0,0.4) inset;
		font: 14px Verdana, Arial, sans-serif;
		height: 19px;
		padding: 5px 8px;
		vertical-align: middle;
		width: 419px;
	}
	#searchbtn {
		background-color: #F8F8F8  ;
		border-radius: 0 3px 3px 0;
		margin: 0 0 0 270px;
		height: 29px;
		margin: 0;
		vertical-align: middle;
	}
	#searchbar {
		margin: -60px 0 0 170px;
	}
	#menubar {
		margin: 0px 0 0 170px;
		}
	#menubar li {
		float: left;
	}
	
	#menubar a {
		display: inline-block;
		color: white;
		padding: 14px 40px;
		text-decoration: none;
		font: 14px Verdana, Arial, sans-serif;
	}
	#menubar li a:hover{
		background: linear-gradient(to bottom, #333333 15%,#727272 50%,#232323 85%);
		padding-bottom:20px;
	}
	#mainnav {
		list-style-type: none;
		margin: 0;
		width: 1000px;
		padding: 0;
		overflow: hidden;
	}
	
	<!-- /* -------Right Nav-----*/ -->
	
	.leftnav {
		position: relative;
		width: 330px;
		float: right;
		background-color:#F5F5F4;
		padding-bottom: auto;
		height: 100%;
	}
	.leftnav a:hover{
		text-decoration: underline;
	}
	.leftnav a:visited{
		color: #70579D;
		text-decoration: none;
	}	
	
	#nav {
		position: relative;
		background: -webkit-linear-gradient(bottom, #e8e8e8 0%, #f2f2f1 50%);
		height:100%;
		width:100%;
		float:right;
		padding:5px;
		border-left: solid 3px #999;	
	}
	#nav h3 {
		color: #333;
		margin: 0 200 16px;
		font: 18px Arial,sans-serif;
		font-weight: normal;
		padding-left: 20px;
		padding-top: 20px;
	}
	#nav h4 {
		color: #666666;
		font: 12px Arial,sans-serif;
		margin: 0.35em 0 0.25em;
		margin: -37px 0 0 195px;
	}
	
	#nav p {
		padding: 0px 0px 25px 20px;
	}
	.borderb {
		border-bottom: 1px solid #ccc;
		margin: -35px 20px -20px 20px;
	}
	.bordert {
		border-top: 1px solid #ccc;
		margin: 0px 20px 15px 20px;
	}
	
	.seemore::after {
    content: "\0000a0\0000bb";
	}
	
	.watchlist { 
		background: url('./images/watchlist1.png') center top no-repeat);
	}
	.watchlist:hover { 
		background: url('./images/watchlist2.png') center top no-repeat);
		}	
	#nav table {
		padding-bottom: 0px;
		padding-left: 15px;
		
	}
	#watch {
		margin-bottom: 5px;
		margin-right: 20px;
	}
	.secondary-text {
		color: #999;
		display: block;
		font-size: 11px;
	}
	.watchlink {
		line-height: 0px;
		font: 15px Arial,sans-serif;
		color: #136CB2;
		text-decoration: none;
	}
	.navimage {
		position: ;
		margin: 0 30px 0 10px;
	}
	.navimage img {
		width: 290px;
		height: auto;
	}
	.watchlist:hover {
		background-image: url('./images/watchlist2.png');
	}
	.grid {
		margin: 20px;
		float: left;
		width: 290px;
		overflow: hidden;
		border: 1px solid #fff;
		background: #f6f6f5;
		padding-bottom: 1px;
		
	}
	.grid img {
		width: 86px;
		height: 86px;
		float: left;
		margin-right: 10px;
	}
	.around {
		float: left;
		width: 100%;
		overflow: hidden;
		border: 1px solid #fff;
		background: #f6f6f5;
		padding-bottom: 1px;
	}
	.around div {
		    width: calc(100% - 101px);
			padding-right: 10px;
			padding-top: 4px;
			box-sizing: border-box;
			float: left;
			text-align: left;
			line-height: 18px;
	}
	.around a {
		font-size: 13px;
		font-weight: bold;
		text-decoration: none;
		font-family: Verdana, Arial, sans-serif;
		color: #136CB2;
	}
	.looper {
		    color: #999;
			font: 12px Arial,sans-serif;
			font-weight: normal;
			padding: 0px 0px 0px 0px;
			text-align: left;
	}
	.desc {
		font-family: Verdana, Arial, sans-serif;
		color: #333;
		font-size: 13px;
	}
	.desc a{
		color: #136CB2;
		text-decoration: none;
		font-family: Verdana, Arial, sans-serif;
	}
	.desc a:hover{
		text-decoration: underline;	
	}
	.spc {
		padding-top: 20px;
	}
	.may {
		width: 300px;
		height: auto;
		float: left;
		margin: 20px 10px 0 20px;
	}
	<!-- ------Article/Content----- -->
	
	#section {
		width:350px;
		float:left;
		padding:10px;	 	 
	}
	#current {
					padding: 20px 276.5px 0px 20px;
					background-color: #333;
					height:350px;
				}
				
				#img1 {
					margin:0 0 0 0;
				}
							
				#img2 {
					margin:-302px 0 0 210px;
				}
				#img3 {
					margin:-302px 0 0 420px;
					padding-bottom: -100px;
				}
				.play1{
					z-index: 1;
					position: relative;
					left: -142px;
					bottom: 110px;
				}
				.play1:hover{
					background-image: url('./images/play2.png');
				}
				.play2{
					z-index: 1;
					position: relative;
					left: -145px;
					bottom: 110px;
				}
				.play2:hover{
					background-image: url('./images/play2.png');
				}
				.play3{
					z-index: 1;
					position: relative;
					left: 60px;
					bottom: 194px;
				}
				.play3:hover{
					background-image: url('./images/play2.png');
				}
				#articles {
						position: relative;
						font: 14px Arial,sans-serif;
						color: #333;
						line-height: 140%;
						width: 100px;
						height: 100%;;
					}
					#article1 {
						width: 650px;
						margin-left: 20px;
						margin-right: 20px; 
						height: 100%;
					}
					#articles h3 {
						color: #424242;
						font: 24px Arial,sans-serif;
						font-weight: normal;
					}
					#articles h3:hover {
						color: #136CB2;
					}
					#articles a:link {
						color: #136CB2;
						text-decoration: none;
					}
					#articles a:hover {
						    text-decoration: underline;
					}
					#sub1 {
						padding-right: 15px;
					}
					#sub1 p {
						margin-right: 50px;
					}
					#jonny2 {
						position: relative;
						left: 180px;
						bottom: 255px;
					}
					#more {
						float: left;
						position: relative;
						bottom: 270px;
					}
					#more p {
						font: 14px Verdana,Arial,sans-serif;
						color: #136CB2;
					}
					hr {
						border-top: 1px solid #ccc;
						position : relative;
						left: -20px;
						bottom: 250px;
						width: 655px;
						z-index: 0;
					}
					#sub2 {
						position: relative;
						bottom: 250px;
					}
					#sub2 h4 {
						position: relative;
						float:right;
						right: 110px;
						bottom: 65px;
					}
					
					#vote {
						position: relative;
						overflow: hidden;
						width: 600px;
						bottom: 60px;
					}
					#vote table {
						width: 570px;
					}
					#vote img {
						margin: auto;
						width: 115px;
						height: auto;
					}
					.playjonny {
						position: relative;
						z-index: 1;
						left: 185px;
						bottom: 85px;
					}
					.playjonny:hover {
						background-image: url('./images/play2.png');
					}

					#dbmovies {
						display: table-cell;
						bottom: 258px;
						position: relative;
						right: 20px;
						width: 100%;
						z-index: 1;
						
					}
						#dbmovies h3 {
							margin-left: 15px;
						}
						.mrow {
							margin-left: 15px;
							margin-right: px;
						}
						.mrow div{
							display: inline;
							margin: 4px;
							margin-top:243px;
						}
						.mdetails0 {
							max-width: 180px;
							min-width: 181px;
							height: 45px;
							background-color: rgba(0,0,0,0.7);
							position: absolute;
							z-index: 1;
							padding: 5px 10px;
							color: #fff;
							left: 15px;
							text-align: left;
						}
							.mdetails0 a {
								position: relative;
								bottom: 40px;
								color: #fff;
								word-wrap: break-word;
								text-overflow: auto; 
							}
						.mdetails1 {
							max-width: 180px;
							min-width: 181px;
							height: 45px;
							background-color: rgba(0,0,0,0.7);
							position: absolute;
							z-index: 2;
							padding: 5px 10px;
							color: #fff;
							left: 224px;
							text-align: left;
						}
							.mdetails1 a {
								position: relative;
								bottom: 40px;
								color: #fff;
								word-wrap: break-word;
								text-overflow: auto; 
								
							}
						.mdetails2 {
							max-width: 201px;
							min-width: 180px;
							height: 45px;
							background-color: rgba(0,0,0,0.7);
							position: absolute;
							z-index: 2;
							padding: 5px 10px;
							color: #fff;
							left: 433px;
							text-align: left;
						}
							.mdetails2 a {
								position: relative;
								bottom: 40px;
								color: #fff;
								word-wrap: break-word;
								text-overflow: auto; 
							}
				
	
	<!-- /* ---------Footer------*/ -->
	#footer {
		background-color:#F5F5F4;
		background: -webkit-linear-gradient(bottom, #e8e8e8 0%, #f2f2f1 50%);
		clear:both;
		padding:15px;
		border-top: 2px solid #CCC;		
	}
	#footer a {
		text-decoration: none;
	}
	.copyright {
		font-family: Verdana, Geneva, sans-serif;
		font-size: 11px;
		float: right;
		position: relative;
		margin: 0 40px 0 0;
		padding: 10px;
		top: -15px;
	}
		
	</style>

	
</head>
<body>
	
	<div id = "main">
		<div class = "up">
		</div>
		<div id="header">
			<div id ="navbar">
				<div class = "logo">
					<img id ="mlogo" src = "./images/imdb.jpg">
				</div>
				<div id = "searchbar">
					<input type = "text" placeholder="Find Movies, TV shows and more..."></input>
					
					<button id = "searchbtn"> Search</button>
				</div>
				
				<div id = "menubar">
					<ul id = "mainnav">
						<li><a href="index.php">Home<span class="downArrow"></span><img sr = "./images/down.jpg"></span></a></li>
						<li><a href="movie_archive.php" name = "movieach">Movie Archive</a></li>
						<li><a href="webform.php" style = "color: #f5de50;">Add Movies To DB</a></li>
						<a href="insertgenre.php" style = "color: #f5de50;">Add Genres To DB</a>
					</ul>
				</div>
			</div>
		</div>

		<div class = "content">
			<div class = "leftnav">
				<div id="nav">
					<h3>Open This Week</h3>
					<div class = "watchrow" id = "watch">
						<table>
							<tr>
								<td><a href = "#" ><img src = "./images/watchlist1.png" class = "watchlist"></a></td>
								<td><a href = "#" class = "watchlink">Pirates of the Caribbean: Dead Men Tell No Tales</a></td>
							</tr>
							<tr>
								<td><a href = "#" ><img src = "./images/watchlist1.png" class = "watchlist"></a></td>
								<td><a href = "#" class = "watchlink">Baywatch</a></td>
							</tr>
							<tr>
								<td><a href = "#" ><img src = "./images/watchlist1.png" class = "watchlist"></a></td>
								<td><a href = "#" class = "watchlink">	Long Strange Trip</a></td>
							</tr>
							<tr>
								<td><a href = "#" ><img src = "./images/watchlist1.png" class = "watchlist"></a></td>
								<td><a href = "#" class = "watchlink">	Buena Vista Social Club: Adios</a></td>
							</tr>
							<tr>
								<td><a href = "#" ><img src = "./images/watchlist1.png" class = "watchlist"></a></td>
								<td><a href = "#" class = "watchlink">	Drones</a></td>
							</tr>
							
						</table>
						<p class = "seemore"><a href = "#" class = "watchlink">	See more opening this week </a></p>
						<p class = "borderb"></p>
								
					</div>
					<h3>Now playing (Box Office)</h3>
					<div class = "watchrow" id = "boxoffice">
						<table>
							<tr>
								<td><a href = "#" ><img src = "./images/watchlist1.png" class = "watchlist"></a></td>
								<td><a href = "#" class = "watchlink">Alien: Covenant</a> <span class="secondary-text">$36.2M</span></td>
							</tr>
							<tr>
								<td><a href = "#" ><img src = "./images/watchlist1.png" class = "watchlist"></a></td>
								<td><a href = "#" class = "watchlink">	Guardians of the Galaxy Vol. 2</a><span class="secondary-text">$34.7M</span></td>
							</tr>
							<tr>
								<td><a href = "#" ><img src = "./images/watchlist1.png" class = "watchlist"></a></td>
								<td><a href = "#" class = "watchlink">	Everything, Everything</a><span class="secondary-text">$11.7M</span></td>
							</tr>
							<tr>
								<td><a href = "#" ><img src = "./images/watchlist1.png" class = "watchlist"></a></td>
								<td><a href = "#" class = "watchlink">	Snatched</a><span class="secondary-text">$7.8M</span></td>
							</tr>
							<tr>
								<td><a href = "#" ><img src = "./images/watchlist1.png" class = "watchlist"></a></td>
								<td><a href = "#" class = "watchlink">	King Arthur: Legend of the Sword</a><span class="secondary-text">$7.2M</span></td>
							</tr>
						</table>
					</div>
					<p class = "seemore"><a href = "#" class = "watchlink">	See more opening this week </a></p>
					<p class = "borderb"></p>
				
					<h3> Around Web</h3>
					<h4 class = "zergnet">Powered by Zergnet</h4>
					<div class = "grid">
						<div class = "around">
							<a href = "#"><img src = "./images/around1.jpg" ></a>
							<div class = "around1">
								<a href = "#">Why Serena Joy from 'The Handmaid's Tale' Looks So Familiar</a><br/>
								<span class="looper">Looper.com</span>
							</div>
						</div>
						<div class = "around">
							<a href = "#"><img src = "./images/around2.jpg" ></a>
							<div class = "around1">
								<a href = "#">15 Movies You Had No Idea Were 20 Years Old Already</a><br />
								<span class="looper">Looper.com</span>
							</div>
						</div>
						<div class = "around">
							<a href = "#"><img src = "./images/around3.jpg" ></a>
							<div class = "around1">
								<a href = "#">Disney's 'Miracle' Star Commits Suicide</a><br />
								<span class="looper">Looper.com</span>
							</div>
						</div>
						<div class = "around">
							<a href = "#"><img src = "./images/around4.jpg" ></a>
							<div class = "around1">
								<a href = "#">How the Cast of 'Game of Thrones' Should Really Look</a><br />
								<span class="looper">Looper.com</span>
							</div>
						</div>
						
					</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
					<p class = "bordert"></p>
					<h3 style="margin-top: -40px;"> May Movie and TV Anniversaries</h3>
					
					<div class = "navimage">
						<div class = "navimage">
							<a href = "#"><img src = "./images/may.jpg"></a>
						</div>
						<div class = "imagedesc">
							<p class = "desc">
								<a href = "#"><i>Star Wars: Episode IV </i></a>- A New Hope turns 40 on May 25. Take a look at some of the movies and TV series that are celebrating milestone anniversaries this month.
							</p>
							</div>
							<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
							<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
							<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
							<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
							<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
							<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
							<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
							<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
							<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
							
						</div>
					</div>
				</div>
			</div>
	
			
		
			<div id="section">
				
			
