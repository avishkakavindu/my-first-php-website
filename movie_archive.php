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

//Change update session
if(isset($_POST['update'])){
				$_SESSION["update"] = true;
}

if(isset($_POST['addnew'])){
				$_SESSION["update"] = false;
}
//if delete button clicked
if (isset($_POST['delete']) && $_POST['id']!=" "){
					$id=$_POST['id'];
					$result=mysqli_query($con, "DELETE FROM movies WHERE id='$id'");
					echo ' <script> alert("Record('.$id.') deleted Successfully! "); 
									window.location.href = "movie_archive.php";
							</script>';
}
//if edit button clicked
if (isset($_POST['edit']) && $_POST['id']!=" "){
	$id=$_POST['id'];
}


?>
<style>
	#moviearchive {
		padding : 15px;
	}
	
	#movietable {
		position: relative;
		right: 12px;
		border-collapse: collapse;
		width: 650px;
	}
	
	#movietable th {
		padding: 8px;
		text-align: left;
		border-bottom: 1px solid #ddd;
		background-color: #4CAF50;
		color: white;
		font: 15px Arial,sans-serif;
		font-size: 15px;
	}
	#movietable tr:nth-child(even){
		background-color: #f2f2f2;
		}
	#movietable td{
		padding: 8px 0px 8px 8px;
		text-align: left;
		border-bottom: 1px solid #ddd;
		font: 12px Arial,sans-serif;
	}

	#movietable tr:hover{background-color: #d8bfd8}
	.dropdown-content {
		display: none;
		position: absolute;
		background-color: #f9f9f9;
		min-width: 160px;
		height: 298px;
		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	}	
	.dropdown:hover .dropdown-content {
		display: block;
	}
</style>

<div id ="moviearchive">
	<form name ="edit" method="post" action="" style = " position: relative;">
		<span >	<input type ="submit" name="update" id="button_update" value="Update DB">	</span>
		<?php
			if($_SESSION['update'] == true) {
				echo '<span >	<input type ="submit" name="addnew" id="button_add" value="View Updated DB"></span>';
			}
		?>			
	</form>
	<br />
	<table id ="movietable">
		 <tr>
			<th>Movie ID</th>
			<th>Name</th>
			<th>Released Year</th>
			<th>Genre</th>
			<th>Rating</th>
			<th>Path</th>
			<?php
				if($_SESSION["update"] == true){
					echo '<th></th>';
					echo '<th></th>';
				}
			?>
		</tr>
	  
		<?php
			$result = mysqli_query($con,"SELECT * FROM movies");
			while($row = mysqli_fetch_assoc($result)){
				echo '<tr>';
				echo '';
				echo '<td ><div class="dropdown">'.$row['id'].'<div class="dropdown-content">
						<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" ></div></div></td>';
				echo '<td ><div class="dropdown">'.$row['name'].'<div class="dropdown-content"><img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" ></div></div></td>';
				echo '<td>'.$row['year'].'</td>';
				echo '<td>'.$row['genre'].'</td>';
				echo '<td>';
					$i = 0;
					$j = 0;
					while($i < $row['rating']){
						echo '<span><img src = "./images/star02.png" width = "10px" height = "10px"></span>';
						$i+=1;
					}
					while($j < (5-$i)){
						echo '<span><img src = "./images/star01.png" width = "10px" height = "10px"></span>';
						$j+=1;
					}
				echo '</td>';
				echo '<td>'.$row['path'].'</td>';
				
				//Edit Delete buttons
				if($_SESSION["update"] == true){
				?>
				<td>
					<form name ="edit" method="post" action="movie_edit_form.php">
						<input type="hidden" name="id"	value="<?php echo $row['id'] ?>"/>
						<input type ="submit" name="edit"	id="button" value="Edit">
					</form>
				</td>
				<td>
					<form name ="delete" method="post" action ="">
						<input type="hidden" name="id"	value="<?php echo $row['id']?>"/>
						<input type="submit" name ="delete"	id="button" value="Delete">
					</form>
				</td>
				<?php
				}
				echo"</tr>";

			}
				
		?>
	</table>
</div>

<?php
  include("footer.php");
  ?>