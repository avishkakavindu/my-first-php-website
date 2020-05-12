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

$edit_id = $edit_name = $edit_year = $edit_genre = $edit_rating = '';
?>


<style>
	.error {
		color: #FF0000;
	}
	#webform {
		margin: 50px 0px 0px 50px;
	}
</style>	

<?php
	//Get selected record's id
	if(isset($_POST['id'])){
		$edit_id = $_POST['id'];
	}
	
	$result=mysqli_query($con, "SELECT name,year,genre,rating,image_name,path FROM movies WHERE id='$edit_id'");
	while($row = mysqli_fetch_assoc($result)){
		$edit_name = $row['name'];
		$edit_year = $row['year'];
		$edit_genre = $row['genre'];
		$edit_rating = $row['rating'];
	}
$nameErr = $yearErr = $genreErr = $ratingErr = $imageErr = '';
$mid = $name = $year = $genre = $rating = $id = $image_name = $imagetmp = $imagename = '';
$path = "Image stored in DB";
$errors = false;
$insert = false;
$count = 0;

$enteredName = '';
$enteredGenre = '';
$enteredRating = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["mname"])){
		if($count != 0){
			$nameErr = "Name is required";
			$errors  = true;
		}
	}
	else {
		$enteredName = $name = $_POST["mname"];
		$mid = $_POST['mid'];
	}
	//----------------------------------
	if (empty($_POST["myear"])){
		if($count != 0){
			$yearErr = "Year is required";
			$errors  = true;
		}
	}
	else {
		$year = $_POST["myear"];
	}
	//----------------------------------
	if (empty($_POST["mgenre"])){
		if($count != 0){
			$genreErr = "Genre is required";
			$errors  = true;
		}
	}
	else {
		$enteredGenre = $genre = $_POST["mgenre"];
	}
	//----------------------------------
	if (isset($_POST["mrating"])){
		$rating = $_POST["mrating"];
	}
	//Check if user upload image?
	if(!isset($_FILES['myimage']) || $_FILES['myimage']['error'] == UPLOAD_ERR_NO_FILE) {
		if($count != 0){
			$imageErr = "Please upload image";
			$errors = true;
		}
	}
	else{
		//Get the content of the image and then add slashes to it 
		$imagename = $_FILES["myimage"]["name"];
		//uploaded image
		$imagetmp = addslashes (file_get_contents($_FILES['myimage']['tmp_name']));
	}
}
if(isset($_POST['submit'])){
	if(!$error){
		$sql = "UPDATE movies SET name='$name', year='$year', genre='$genre', rating='$rating',  image_name='$imagename', image='$imagetmp', path='$path' WHERE id='$mid'";
		echo ' <script> alert("Record('.$mid.') updated Successfully! "); 
									window.location.href = "movie_archive.php";
							</script>';
		if (!mysqli_query($con, $sql)){
			die('Error: ' . mysqli_error($con));
		}
	}
}
?>
	<form name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
		<table style = "line-height: 30px;" id = "webform">
			<input type = "hidden" id = "mid" name = "mid" value="<?php echo $edit_id; ?>">
			<tr><td>Name:	</td><td>	<input type = "text" id = "prename" name = "mname" value="<?php echo $edit_name; ?>">	<span class="error"> <?php echo $nameErr;?> </span>	</td></tr> 
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
										</select>	<span class="error">  <?php echo $yearErr;?> </span>	</td></tr>
			<tr><td>Genre:	</td><td>
									<select name = "mgenre" id = "genre" >
										<option> <?php echo $edit_genre ?> </option>
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
											<span><input type = "hidden" id = "rated" name = "mrating" value = "<?php echo $edit_rating ?>">	</span>
	
										</div>
								</td></tr>
			<tr><td>Image   </td><td>	<input type="file" name="myimage" id="fileToUpload">	</td><td>Please upload image with 201x298<br /><span class="error"> <?php echo $imageErr;?> </span></td></tr>
			<tr><td><input type="submit" name="submit" id="submit" value="Submit"></td><td><input type="reset" name="button2" id="button2" value="Reset"></td></tr>
		</table>
		
	</form>
	<br />
	
	
	
	
	
<!-- -------------Java script--------------- -->
	
<script>
	//Show ratings for selected item
	var rated = document.getElementById('rated').value;
	var images = document.getElementById('stars').getElementsByTagName('img');
	if(rated >0){
		for (var i = 0; i < rated; i++) {
			images[i].src = "./images/star02.png"; 
			
		}
	}
	//-------------------------
	
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

	//Set year dropdown value to selected year
    select = document.getElementById('year');
	select.value = <?php echo $edit_year ?>;
	//-------------------------
			
</script>
	
<?php
	include("footer.php");
?>