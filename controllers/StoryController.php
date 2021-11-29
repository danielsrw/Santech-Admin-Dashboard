<?php

	include('DbController.php');

	class Story
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

		// Create story
		public function create() {
			$title = $this->db->real_escape_string($_POST['title']);
			$category = $this->db->real_escape_string($_POST['category']);
			$image = time() .  '-' . $_FILES['image']['name'];
			$target_dir = 'assets/stories/';
			$target_file = $target_dir . basename($image);
			move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
			$description = $this->db->real_escape_string($_POST['description']);
			$status = $this->db->real_escape_string($_POST['status']);

			$create = "INSERT INTO stories(title, category, image, description, status) VALUES('$title', '$category', '$image', '$description', '$status')";
			$result = $this->db->query($create);

			if ($result == true) {
				echo "<script>alert('Story created successfully')</script>";
				header('location: story.php');
			} else {
				echo "<script>alert('An error occured try again')</script>";
				header('location: storyAdd.php');
			}
		}

		public function showCategories() {
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

		// Show stories
		public function show() {
			$show = "SELECT * FROM stories";
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

		// Turn on story
		public function enable($postDate) {
			$status = $this->db->real_escape_string($_POST['status']);
			$id = $this->db->real_escape_string($_POST['id']);

			if (!empty($id) && !empty($postDate)) {
				$enable = "UPDATE stories SET status = 0 WHERE id = '$id'";
				$result = $this->db->query($enable);
				if ($result == true) {
					echo "<script>alert('Story disabled successfully');</script>";
				} else {
					echo "<script>alert('Failed to disabled story')</script>";
				}
			}
		}

		// Turn off story
		public function disable($postDate) {
			$status = $this->db->real_escape_string($_POST['status']);
			$id = $this->db->real_escape_string($_POST['id']);

			if (!empty($id) && !empty($postDate)) {
				$disable = "UPDATE stories SET status = 1 WHERE id = '$id'";
				$result = $this->db->query($disable);
				if ($result == true) {
					echo "<script>alert('Story enabled successfully');</script>";
				} else {
					echo "<script>alert('Failed to enable story')</script>";
				}
			}
		}

		// edit story
		public function edit($id) {
			$query = "SELECT * FROM stories WHERE id = '$id'";
			$result = $this->db->query($query);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				return $row;
			}else{
				echo "Record not found";
			}
		}

		// Update story
		public function update($postDate) {
			$title = $this->db->real_escape_string($_POST['title']);
			$category = $this->db->real_escape_string($_POST['category']);
			$image = time() .  '-' . $_FILES['image']['name'];
			$target_dir = 'assets/stories/';
			$target_file = $target_dir . basename($image);
			move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
			$description = $this->db->real_escape_string($_POST['description']);
			$id = $this->db->real_escape_string($_POST['id']);

			if (!empty($id) && !empty($postDate)) {
				$update = "UPDATE stories SET title = '$title', category = '$category', image = '$image', description = '$description', status = '0' WHERE id = '$id'";
				$result = $this->db->query($update);
				if ($result == true) {
					echo "<script>alert('Story updated successfully');</script>";
					header('location: story.php');
				} else {
					echo "<script>alert('Failed to update story')</script>";
				}
			}
		}

		public function delete($id) {
			$delete = "DELETE FROM stories WHERE id = '$id'";
			$result = $this->db->query($delete);
			if ($result == true) {
				echo "<script>alert('Story deleted successfully');</script>";
				header('location: story.php.php');
			} else {
				echo "<script>alert('Failed to delete story')</script>";
			}
		}
	}

?>