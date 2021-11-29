<?php

	include('DbController.php');

	class Testimony
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

		// Create testimony
		public function create() {
			$title = $this->db->real_escape_string($_POST['title']);
			$image = time() .  '-' . $_FILES['image']['name'];
			$target_dir = 'assets/testimonials/';
			$target_file = $target_dir . basename($image);
			move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
			$description = $this->db->real_escape_string($_POST['description']);
			$status = $this->db->real_escape_string($_POST['status']);

			$create = "INSERT INTO testimonials(title, image, description, status) VALUES('$title', '$image', '$description', '$status')";
			$result = $this->db->query($create);

			if ($result == true) {
				echo "<script>alert('Testimony created successfully')</script>";
				header('location: testimony.php');
			} else {
				echo "<script>alert('An error occured try again')</script>";
				header('location: testimonyAdd.php');
			}
		}

		// Show testimonials
		public function show() {
			$show = "SELECT * FROM testimonials";
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

		// Turn on testimony
		public function enableTestimony($postDate) {
			$status = $this->db->real_escape_string($_POST['status']);
			$id = $this->db->real_escape_string($_POST['id']);

			if (!empty($id) && !empty($postDate)) {
				$enableTestimony = "UPDATE testimonials SET status = 0 WHERE id = '$id'";
				$result = $this->db->query($enableTestimony);
				if ($result == true) {
					echo "<script>alert('Testimony disabled successfully');</script>";
				} else {
					echo "<script>alert('Failed to disabled testimony')</script>";
				}
			}
		}

		// Turn off testimony
		public function disableTestimony($postDate) {
			$status = $this->db->real_escape_string($_POST['status']);
			$id = $this->db->real_escape_string($_POST['id']);

			if (!empty($id) && !empty($postDate)) {
				$disableTestimony = "UPDATE testimonials SET status = 1 WHERE id = '$id'";
				$result = $this->db->query($disableTestimony);
				if ($result == true) {
					echo "<script>alert('Testimony enabled successfully');</script>";
				} else {
					echo "<script>alert('Failed to enable testimony')</script>";
				}
			}
		}

		// edit testimony
		public function editTestimony($id) {
			$query = "SELECT * FROM testimonials WHERE id = '$id'";
			$result = $this->db->query($query);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				return $row;
			}else{
				echo "Record not found";
			}
		}

		// Update testimony
		public function updateTestimony($postDate) {
			$title = $this->db->real_escape_string($_POST['title']);
			$image = time() .  '-' . $_FILES['image']['name'];
			$target_dir = 'assets/testimonials/';
			$target_file = $target_dir . basename($image);
			move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
			$description = $this->db->real_escape_string($_POST['description']);
			$id = $this->db->real_escape_string($_POST['id']);

			if (!empty($id) && !empty($postDate)) {
				$updatePost = "UPDATE testimonials SET title = '$title', image = '$image', description = '$description', status = '0' WHERE id = '$id'";
				$result = $this->db->query($updatePost);
				if ($result == true) {
					echo "<script>alert('Testimony updated successfully');</script>";
					header('location: testimony.php');
				} else {
					echo "<script>alert('Failed to update testimony')</script>";
				}
			}
		}

		public function deleteTestimony($id) {
			$deleteTestimony = "DELETE FROM testimonials WHERE id = '$id'";
			$result = $this->db->query($deleteTestimony);
			if ($result == true) {
				echo "<script>alert('Testimony deleted successfully');</script>";
				header('location: testimony.php.php');
			} else {
				echo "<script>alert('Failed to delete testimony')</script>";
			}
		}
	}

?>