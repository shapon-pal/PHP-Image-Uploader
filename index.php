<?php 
  // Function of this page
  include 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP Image uploader</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="body">
    <div>
    	<h2>PHP and Mysqli Image Uploader</h2>
    	<br><hr><br>
    </div>
	<section class="image_uploader">
		<form action="" method="post" name="image_uploader" enctype="multipart/form-data">
			<table>
				<tr>
					<td>Select Your Image</td>
					<td><input type="file" name="image"></td>
				</tr>
				<tr>
					<td> </td>
					<td><input type="submit" name="upload" value="Upload"></td>
				</tr>
				<center><img src="<?php echo $show_img['image']; ?>" width="150px"></center>
			</table>
		</form>
	</section>
	<br><hr><br>
	<?php // For Delete Image
	      $id=null;
          if (isset($_GET['del'])) 
		  {
		  	$id = $_GET['del'];
		  }
		  $del_query = "DELETE FROM $DB->table WHERE id = '$id'";
		  $del_image = $DB->delete($del_query);
		  if ($del_image) {
		  	echo "Image Deleted!!";
		  }
		?>
	<section class="show_data">
		<table>
			<tr>
				<th>NO.</th>
				<th>Image Iink</th>
				<th>View Image</th>
				<th>Action</th>
			</tr>

        <?php 
        $all_query = "SELECT * FROM $DB->table";
		$result  = $DB->select($all_query);
		if ($result) {
			$i=0;
			while ( $results = $result->fetch_assoc()){
			$i++; 
		?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $results['image']; ?></td>

				<td><img src="<?php echo $results['image']; ?>" width="150px"></td>
				<td><a href="?del=<?php echo $results['id']; ?>">Delete</a></td>
			</tr>
	    <?php } }?>
		</table>
		
	</section>
</div>
	
</body>
</html>