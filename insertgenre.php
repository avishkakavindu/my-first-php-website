<?php
include("header.php");
//Establissh connection with servername
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment_moviesdb";
//create mysql link
$con = mysqli_connect($servername,$username,$password);
// Check connection
if (!$con) {
    die("Connection failed: ". mysqli_connect_error());
}
//connect to db
mysqli_select_db($con, $dbname);

$genreErr = '';
$mgenre = '';
$abc = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["mgenre"])) {
    $genreErr = "Genre is required";
  }
  else {
	$mgenre = $_POST["mgenre"];
	//if genre submit button is pressed
	if(isset($_POST['submitgenre'])){
		$duplicate = mysqli_num_rows(mysqli_query($con,"SELECT * FROM genre WHERE genre='$mgenre' limit 1"));
		//if it's a duplicate entry
		if($duplicate>0){//if $duplicate==true then show alert box and redirect page
			echo ' <script> 
						alert("Duplicate Entry! The Genre catagory '. $mgenre .' you entered already Exist. " );
						window.location.href = "insertgenre.php";	
					</script>';
		}
		else{
			$sql="INSERT INTO genre (genre)
							VALUES ('$mgenre')";
							
			if (!mysqli_query($con, $sql)){
				die('Error: ' . mysqli_error($con));
			}
			else
			{   //Show alert box and redirect page 
				echo "<script>
							alert('Record inserted Successfully!');
							window.location.href = 'insertgenre.php'; 
					</script>";
				
			}
		}
	}

  }
}
if(isset($_POST['delete_gen'])){
	$id=$_POST['id'];
	$result=mysqli_query($con, "DELETE FROM genre WHERE id='$id'");
	echo ' <script> alert("Record('.$id.') deleted Successfully! "); 
				window.location.href = "insertgenre.php";
			</script>';
}
	
?>
<style>
	.error {
		color: #FF0000;
	}
	#genre_main {
		margin: 0px 0px 0px 20px;
		position: relative;
		top: -30px;
	}
	#insert_genre {
		float: right;
		position: relative;
		right: 50px;
		top: 20px;
		background-color: #D8D8D8;
		box-shadow: 1px 1px 2px #A0A0A0 , 0 0 25px #A0A0A0 , 0 0 5px #A0A0A0 ;
	}
	#genre_main h4 {
		color: #666666;
		font: 18px Arial,sans-serif;
		position: relative;
		left: 325px;
		bottom: -35px;
	}
		.ig {
			margin: 20px;
		}
	#genre_table {
		margin: 10px 0px 0px 10px;
		position: relative;
		bottom: 10px;
	}
	#genre_table {
		position: relative;
		right: 0px;
		border-collapse: collapse;
		width: 650px;
	}
	#genre_table table {
		margin-top: 5px;
	}
	
	#genre_table th {
		padding: 8px;
		text-align: left;
		border-bottom: 1px solid #ddd;
		background-color: #4CAF50;
		color: white;
		font: 15px Arial,sans-serif;
		font-size: 15px;
	}
	#genre_table tr:nth-child(even){
		background-color: #f2f2f2;
		}
	#genre_table td{
		padding: 8px 0px 8px 8px;
		text-align: left;
		border-bottom: 1px solid #ddd;
		font: 12px Arial,sans-serif;
	}
	#insert_genre {
		z-index: 1;
	}
	#genre_table tr:hover{background-color: #d8bfd8}
	
</style>
<div id = "genre_main">
	<h4> Add Genre to the DB</h4>
	<div id = "insert_genre">
		<div class = "ig">
			<form name="form2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<table style = "line-height: 30px;">
						<tr><td>Genre:	</td><td>	<input type = "text" name = "mgenre">	<br /> <span class="error"> <?php echo $genreErr;?></span> 	</td></tr>
						<tr><td><input type="submit" name="submitgenre" id="submit" value="Submit"></td><td><input type="reset" name="button2" id="button2" value="Reset"> </td></tr>
					</table>
			</form>
		</div>
	</div>
	<div id = "genre_table">
		<table id ="g_table">
			 <tr id = "g_row">
				<th>Genre ID</th>
				<th>Genre</th>
				<th></th>
			</tr>
		  
			<?php
				$result = mysqli_query($con,"SELECT * FROM genre");
				while($row = mysqli_fetch_assoc($result)){
					echo '<tr>';
					echo '<td>'.$row['id'].'</td>';
					echo '<td>'.$row['genre'].'</td>';
					?>
						<td>
							<form name ="delete" method="post" action ="">
								<input type="hidden" name="id"
								value="<?php echo $row['id']?>"/>
								<input type="submit" name ="delete_gen"
								id="button" value="Delete">
							</form>
						</td>
					<?php
					
					echo"</tr>";

				}
					
			?>
		</table>

	</div>
</div>
<?php
	include("footer.php");
?>
