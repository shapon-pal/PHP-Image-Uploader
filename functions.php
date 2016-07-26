<?php

include 'database.php';   
$DB = new database();


// Catch Image and Insert to database
if ($_SERVER["REQUEST_METHOD"]== "POST") 
{
	$permition = array('jpg', 'jpeg', 'png');
	$file_name = $_FILES['image']['name'];
	$file_size = $_FILES['image']['size'];
	$file_type = $_FILES['image']['type'];
	$file_tmp  = $_FILES['image']['tmp_name'];

	// Make unique name of data
	$folder    = "uploads/";
	$file_exp  = explode('.', $file_name);
	$take_last = strtolower(end($file_exp));
	$uni_name  = substr(md5(time()), 0,10);
    $full_path = $folder.$uni_name.'.'.$take_last;

    // Validation check for Image
    if (empty($file_name)) 
    {
    	echo "Please Select a Image !";
    }
    elseif ($file_size > 10055555) 
    {
    	echo "Image size should be less 2MB";
    }
    elseif (in_array($take_last, $permition)===false) {
    	echo "Image should be - ".implode(', ', $permition);
    }
    else
    {

	// Upload file in a folder
	move_uploaded_file($file_tmp,  $full_path);
	// query for insert into database
	$query     = "INSERT INTO $DB->table(image) VALUES(' $full_path')";
	$insert_row= $DB->insert($query);

	if ($insert_row) 
	{
		echo "Image Inserted Successfully";
	}else
	{
		echo "Image not Inserted!";
	}


    }
}

// Show Image from database

$sql      = "SELECT * FROM $DB->table order by id desc limit 1";
$get_img  = $DB->select($sql);
if ($get_img) 
{
	while ( $show_img = $get_img->fetch_assoc()) 
	{
		
		return $show_img;
	}
}

// Show all Image from database

// $all_query      = "SELECT * FROM $DB->table";
// $result  = $DB->select($all_query);
// if ($result) 
// {
// 	while ( $results = $result->fetch_assoc()) 
// 	{
		
// 		return $results;
// 	}
// }

// Delete Image
 // if (isset($_GET['del'])) 
 //  {
 //  	$id = $_GET['del'];
 //  }
 //  $del_query = "DELETE FROM $DB->table WHERE id = '$id'";
 //  $del_image = $DB->delete($del_query);
 //  if ($del_image) {
 //  	echo "Image Deleted!!";
 //  }