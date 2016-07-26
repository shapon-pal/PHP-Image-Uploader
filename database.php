<?php

include 'config.php';
/**
* Database class
*/
class database
{
	private $db_host = DB_HOST;
	private $db_user = DB_USER;
	private $db_pass = DB_PASS;
	private $db_name = DB_NAME;

	public $table = "image";

	public $image_link;
	public $error;
	
	function __construct()
	{
		$this->connection();
	}

	public function connection()
	{
		$this->image_link = new mysqli( $this->db_host, $this->db_user, $this->db_pass, $this->db_name );
		if (!$this->image_link) {
			$this->error = 'Database not Connected..' . $this->error->connect_error;
		}

	}

	// Insert Image
	public function insert($img)
	{
		$insert_img = $this->image_link->query($img) or die($this->image_link->error.__LINE__);
		if ($insert_img) 
		{
			return $insert_img;
		}
		else
		{
			return false;
		}
	}

	// Select Image
	public function select($img)
	{
		$select_img = $this->image_link->query($img) or die($this->image_link->error.__LINE__);
		if ($select_img->num_rows > 0) 
		{
			return $select_img;
		}
		else
		{
			return false;
		}
	}

	// Delete Image
	public function delete($img)
	{
		$all_img = $this->image_link->query($img) or die($this->image_link->error.__LINE__);
		if ($all_img) 
		{
			return $all_img;
		}
		else
		{
			return false;
		}
	}
}