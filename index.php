<?php
include("header.php");
//Establish server connection 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment_moviesdb";
//create mysql link
$con = mysqli_connect($servername,$username,$password);
// Check connection
if (!$con) {
    die("Connection failed: " 
	. mysqli_connect_error());
}
mysqli_select_db($con, $dbname);
$index_page = true;

?>

<div id = "current">
					<div id = "images">
						<div id ="img1">
							<a href ="#"><img src = "./images/current1.jpg"></a>
							<a href ="#"><img src = "./images/play1.png" class = "play1"></a>
						</div>
						<div id ="img2">
							<a href ="#"><img src = "./images/current2.jpg"></a>
							<a href ="#"><img src ="./images/play1.png" class = "play2"></a>
						</div>
						<div id ="img3">
							<a href ="#"><img src = "./images/current3.jpg"></a>
							<a href ="#"><img src ="./images/play1.png" class = "play3"></a>
						</div>
					</div>
					
				</div>
				
				
				<div id = "articles">
					<div id= "article1">
						<div id = "sub1">
							<a href = "#">
								<h3>'Pirates' Stars Reveal Favorite Johnny Depp Moments</h3>
							</a>
							<p class="blurb"><a href=#">Javier Bardem</a>, <a href=#">Geoffrey Rush</a>, directors <a href=#">Joachim Ronning</a> and <a href=#">Espen Sandberg</a>, and producer <a href=#">Jerry Bruckheimer</a> share tales of <a href=#">the Pirates of the Caribbean</a> star <a href=#">Johnny Depp</a>.</p>
							<a href = "#" >
								<img src = "./images/jonny1.jpg" >
								<a href ="#"><img src = "./images/play1.png" class = "playjonny"></a>
								<img src = "./images/jonny2.jpg" id = "jonny2"> <br />
							</a>
							<p class = "seemore" id = "more"><a href = "#">Watch the interview</a></p>
						</div>
						<hr>
						<div id = "sub2">
							<a href = "#">
								<h3>Poll: Best 'Pirates of the Caribbean' Villain</h3>
							</a>
							<h4>| <a href = "#">More Polls</a></h4>
								<div id = "vote">
									<table>
										<tr>
											<td>	<a href = "#" ><img title="Bill Nighy in Pirates of the Caribbean: Dead Man's Chest (2006)"  src = "./images/vote1.jpg" /></a>	</td>
											<td>	<a href = "#" ><img title="Geoffrey Rush in Pirates of the Caribbean: At World's End (2007)" src = "./images/vote2.jpg" /></a>	</td>
											<td>	<a href = "#" ><img title="Javier Bardem in Pirates of the Caribbean: Dead Men Tell No Tales (2017)" src = "./images/vote3.jpg" /></a>	</td>
											<td>	<a href = "#" ><img title="Yun-Fat Chow in Pirates of the Caribbean: At World's End (2007)" src = "./images/vote4.jpg" /></a>	</td>
											<td>	<a href = "#" ><img title="Ian McShane in Pirates of the Caribbean: On Stranger Tides (2011)" src = "./images/vote5.jpg" /></a>	</td>
										</tr>
									</table>
								</div>
							<p class="blurb" style = "margin-top: -60px;">Which <i>Pirates of the Caribbean</i> villain is your favorite? Discuss <a href = "#">here</a> after voting.</p>
							<p class = "seemore" ><a href = "#">Vote now</a></p>
							<br />
						</div>
						<hr>
						
							<div id = "dbmovies">
								<a href = "#">
									<h3>Movies From Our Database</h3>
								</a>
								<style>
								
									.nonvisitedimg {
										text-decoration: none;
									}
									.playdb0 {
										position: absolute;
										left: 85px;
										align: center;
									}
										.playdb0:hover {
											background-image: url('./images/play2.png');
										}
									.playdb1 {
										position: absolute;
										left: 293px;
										
									}
										.playdb1:hover {
											background-image: url('./images/play2.png');
										}
									.playdb2 {
										position: absolute;
										left: 498px;
										
									}
										.playdb2:hover {
											background-image: url('./images/play2.png');
										}
									#rowl a:link {
										color: #fff;
									}
									.ratingimg {
										position: relative; 
										left: 55px; 
										z-index: -1; 
										height: 40px; 
										bottom: 40px; 
										height: 40px; 
									}
								</style>
								<?php
									$result = mysqli_query($con,"SELECT name,image,year,rating FROM movies ORDER BY name");
									$c =0;
									$d=1;
									$e=0;
									$ratings = 0;
									while ($row=mysqli_fetch_assoc($result))
									{
									if($c<3){
										if($c==0 and $d==1){
											echo'<div class ="mrow" id = "rowl" >';
										}
										echo '<span><div class = "img">';
										echo '<img src ="data:image/jpeg;base64,'.base64_encode($row['image']).'">';
										echo '<a href ="#" class = "nonvisitedimg"><img id = "playrow'.$e.'" src = "./images/play1.png" class = "playdb'.$c.'"></a>';
										echo '<div class = "mdetails'.$c.'">';
											//show rating stars
											$ratings = $row['rating'];
											switch($ratings){
												case "0":
													echo '<img class = "ratingimg" src = "./images/0stars.png" >';
													break;
												case "1":
													echo '<img class = "ratingimg" src = "./images/1stars.png" >';
													break;
												case "2":
													echo '<img class = "ratingimg" src = "./images/2stars.png">';
													break;
												case "3":
													echo '<img class = "ratingimg" src = "./images/3stars.png" >';
													break;
												case "4":
													echo '<img class = "ratingimg" src = "./images/4stars.png" >';
													break;
												case "5":
													echo '<img class = "ratingimg" src = "./images/5stars.png" >';
													break;
											}
												
												echo '<br />';
												echo '<a href = "#">'.$row['name'].' ('.$row['year'].')</a>';
										echo '</div>';
										echo'</div></span>';
										$c+=1;
									}	
									else if($c=3){
										echo '</div>';
										echo '<div class ="mrow" id = "rowl">';
										echo '<span><div class = "img">';
										echo '<img src ="data:image/jpeg;base64,'.base64_encode($row['image']).'">';
										echo '<a href ="#" class = "nonvisitedimg"><img id = "playrow'.($e+1).'" src = "./images/play1.png" class = "playdb'.($c-3).'"></a>';
										echo '<div class = "mdetails'.($c-3).'">';
											//show rating stars
											$ratings = $row['rating'];
											switch($ratings){
												case "0":
													echo '<img class = "ratingimg" src = "./images/0stars.png" >';
													break;
												case "1":
													echo '<img class = "ratingimg" src = "./images/1stars.png" >';
													break;
												case "2":
													echo '<img class = "ratingimg" src = "./images/2stars.png" >';
													break;
												case "3":
													echo '<img class = "ratingimg" src = "./images/3stars.png" >';
													break;
												case "4":
													echo '<img class = "ratingimg" src = "./images/4stars.png" >';
													break;
												case "5":
													echo '<img class = "ratingimg" src = "./images/5stars.png" >';
													break;
											}
												
												echo '<br />';
												echo '<a href = "#">'.$row['name'].' ('.$row['year'].')</a>';
										echo '</div>';
										echo'</div></span>';
										$c=1;
										$d+=1;
										$e+=1;
										}

									}
									?>
									<style>
									<?php
									//positionning play buttons
									$row_count = 0;
									$default = 180;
									while($row_count<=$e){
										if($row_count==0){
											echo '#playrow0 {
												position: absolute;
												top: 180px;
											}';
										}
										else {
											$default+=305;
											echo '#playrow'.$row_count.' {
													top: '.$default.'px;
												}';
										}
										$row_count+=1;
									}
								
								?>
								</style>	
													
							
							</div>
						
					</div>
				</div>
				
<?php
  include("footer.php");
  ?>
 