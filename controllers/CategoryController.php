<?php

	include('DbController.php');

	class Category
	{
		private $server = 'localhost';
		private $user = 'root';
		private $pass = '';
		private $dbname = 'santech';
		public $db;

		public function __construct()
		{
			$this->db = new mysqli($this->server, $this->user, $this->pass, $this->dbname);

			if (mysqli_connect_error()) {
				trigger_error("Failed to connect " . mysqli_connect_error());
			} else {
				return $this->db;
			}
		}

		// Create category
		public function create() {
			$name = $this->db->real_escape_string($_POST['name']);

			$create = "INSERT INTO categories(name) VALUES('$name')";
			$result = $this->db->query($create);

			if ($result == true) {
				echo "<script>alert('Category created successfully')</script>";
				header('location: category.php');
			} else {
				echo "<script>alert('An error occured try again')</script>";
				header('location: categoryAdd.php');
			}
		}

		// Show categories
		public function show() {
			$show = "SELECT * FROM categories";
			$result = $this->db->query($show);

			if ($result->num_rows > 0) {
				$data = array();
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				return $data;
			} else {
				echo "No posts yet!!!";
			}
		}

		// edit category
		public function edit($id) {
			$query = "SELECT * FROM categories WHERE id = '$id'";
			$result = $this->db->query($query);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				return $row;
			}else{
				echo "Record not found";
			}
		}

		// Update category
		public function update($postDate) {
			$name = $this->db->real_escape_string($_POST['name']);
			$id = $this->db->real_escape_string($_POST['id']);

			if (!empty($id) && !empty($postDate)) {
				$update = "UPDATE categories SET name = '$name' WHERE id = '$id'";
				$result = $this->db->query($update);
				if ($result == true) {
					echo "<script>alert('Category updated successfully');</script>";
					header('location: category.php');
				} else {
					echo "<script>alert('Failed to update category')</script>";
				}
			}
		}

		public function delete($id) {
			$delete = "DELETE FROM categories WHERE id = '$id'";
			$result = $this->db->query($delete);
			if ($result == true) {
				echo "<script>alert('Category deleted successfully');</script>";
				header('location: category.php.php');
			} else {
				echo "<script>alert('Failed to delete category')</script>";
			}
		}
	}

?>