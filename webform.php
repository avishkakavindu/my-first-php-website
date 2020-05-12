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
//connect to db
mysqli_select_db($con, $dbname);
//Declaring Variables to hold data
$nameErr = $yearErr = $genreErr = $ratingErr = $imageErr = '';
$name = $year = $genre = $rating = '';
$path = "Image stored in DB";
$errors = false;
$insert = false;

$enteredName = '';
$enteredGenre = '';
$enteredRating = 0;
   

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["mname"])){
		$nameErr = "Name is required";
		$errors  = true;
	}
	else {
		$enteredName = $name = $_POST["mname"];
	}
	//----------------------------------
	if (empty($_POST["myear"])){
		$yearErr = "Year is required";
		$errors  = true;
	}
	else {
		$year = $_POST["myear"];
	}
	//----------------------------------
	if (empty($_POST["mgenre"])){
		$genreErr = "Genre is required";
		$errors  = true;
	}
	else {
		$enteredGenre = $genre = $_POST["mgenre"];
	}
	//----------------------------------
	$rating = $_POST["mrating"];
	//Check if user upload image?
	if(!isset($_FILES['myimage']) || $_FILES['myimage']['error'] == UPLOAD_ERR_NO_FILE) {
		$imageErr = "Please upload image";
		$errors = true;		
	}
	else{
		//Get the content of the image and then add slashes to it 
		$imagename = $_FILES["myimage"]["name"];
		//uploaded image
		$imagetmp = addslashes (file_get_contents($_FILES['myimage']['tmp_name']));
	}
}
	//If there's no null fields>>GOOD TO GO MATE!
	if(!$errors){
				
		$duplicate_name = mysqli_query($con,"SELECT * FROM movies WHERE name='$name' limit 1");
		$duplicate_year = mysqli_query($con,"SELECT * FROM movies WHERE year='$year' limit 1");
		
		//If there's a duplicate entry by movie name and year
		if(mysqli_num_rows($duplicate_name)>0){
			if(mysqli_num_rows($duplicate_year)>0){
				echo ' <script> alert("Duplicate Entry! The movie '. $name . $year.' you entered already Exist. " );
								window.location.href = "webform.php"; 
						</script>';
			}
			else {
				if(isset($_POST['submit'])){
					$sql="INSERT INTO movies (name, year, genre, rating, image_name, image, path)
									VALUES ('$name', '$year', '$genre', '$rating',  '$imagename', '$imagetmp', '$path')";
									
					if (!mysqli_query($con, $sql)){
						die('Error: ' . mysqli_error($con));
					}
					else
					{   
						echo ' <script> alert("Record inserted Successfully!");
									window.location.href = "webform.php";
								</script>';
					}
				}
			}
		}
		else {
			if(isset($_POST['submit'])){
				$sql="INSERT INTO movies (name, year, genre, rating, image_name, image, path)
								VALUES ('$name', '$year', '$genre', '$rating',  '$imagename', '$imagetmp', '$path')";
									
				if (!mysqli_query($con, $sql)){
					die('Error: ' . mysqli_error($con));
				}
				else
				{   
					echo ' <script> alert("Record inserted Successfully!"); 
									window.location.href = "webform.php";
							</script>';
					
				}
			}
		}
	}
?>


<style>
	.error {
		color: #FF0000;
	}
	#webform {
		margin: 50px 0px 0px 50px;
	}
	#subm {
		float: right;
		width: 630px;
		position: relative;
		right: 25px;
		top: 20px;
		background-color: #D8D8D8;
		box-shadow: 1px 1px 2px #A0A0A0 , 0 0 25px #A0A0A0 , 0 0 5px #A0A0A0 ;
	}
	#subm h3 {
		color: #333;
		margin: 0 200 16px;
		font: 20px Arial,sans-serif;
		font-weight: bold;
		padding-left: 20px;
		padding-top: 20px;
</style>	

<div id = "add_form">
	<div id = "subm">
		<h3> Please Fill this form to add new record of a movie to database</h3>
		<form name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
			<table style = "line-height: 30px;" id = "webform">
				<tr><td>Name:	</td><td>	<input type = "text" id = "prename" name = "mname" value="<?php echo $enteredName;?>">	<span class="error"> <?php echo $nameErr;?></span>	</td></tr> 
				<tr><td>Year: 	</td><td>	<select name  = "myear" id = "year">
											<!-- create year dropdown -->
												<?php
													$min = 1950;
													$max = 2100;
													while( $min <= $max){
												?>
												<option>
													<?php echo $min; 
														$min += 1;
													?>
												</option>
												<?php
												}
												?>
											<!-- ------------------------- -->	
											</select>	<span class="error"> <?php echo $yearErr;?></span>	</td></tr>
				<tr><td>Genre:	</td><td>
										<select name = "mgenre" id = "pregenre" >
											<option> <?php echo $enteredGenre; ?> </option>
										<!-- fetch genre from DB and create genre dropdown -->
											<?php
												$all = mysqli_query($con, 'SELECT * FROM genre ORDER BY genre ');
												while($row = mysqli_fetch_array($all)){
											?>
												<option>	<?php echo $row['genre']; ?>		</option>
											<?php
											}
											?>
										<!-- ------------------------- -->		
										</select>	<span class="error"> <?php echo $genreErr;?> </span>
								</td></tr>
				<tr><td>Rating:	</td><td>	<div id= "stars">
												<span><img src = "./images/star01.png" id = "1" onclick ="lighton(this)" class = "select_this"></span>
												<span><img src = "./images/star01.png" id = "2" onclick ="lighton(this)" class = "select_this"></span>
												<span><img src = "./images/star01.png" id = "3" onclick ="lighton(this)" class = "select_this"></span>
												<span><img src = "./images/star01.png" id = "4" onclick ="lighton(this)" class = "select_this"></span>
												<span><img src = "./images/star01.png" id = "5" onclick ="lighton(this)" class = "select_this"></span>
												<span><input type = "hidden" id = "rated" name = "mrating" value = "0">	</span>
		
											</div>
									</td></tr>
				<tr><td>Image   </td><td>	<input type="file" name="myimage" id="fileToUpload"> </td><td>Please upload image with 201x298 <span class="error"> <br /><?php echo $imageErr;?> </span></td>
				</tr>
				<tr><td><input type="submit" name="submit" id="submit" value="Submit"></td><td><input type="reset" name="button2" id="button2" value="Reset"></td></tr>
			</table>
			
		</form>
		<br />
	</div>
</div>
	
	
	
	
	
	
	
	
<!-- -------------Java script--------------- -->
	
<script>
	//Rating star system
	function lighton(obj) {
		var x = obj.id;
		var images = document.getElementById('stars').getElementsByTagName('img');
		var rating = document.getElementById('rated');
		rating.value = x;
		//clear shining stars 
		for (var i = 0; i < 5; i++) {
			images[i].src = "./images/star01.png"; 
			
		}
		//Shine stars
		for (var i = 0; i < x; i++) {
			images[i].src = "./images/star02.png"; 
			
		}
	}

	//Set year dropdown value to current year
    select = document.getElementById('year');
	select.value = new Date().getFullYear();
	//-------------------------
	
</script>
	
<?php
	include("footer.php");
?>