<?php 

class Task extends DB{
	
	// Mengambil data
	function getTask(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do";

		// Mengeksekusi query
		return $this->execute($query);
	}

	//method add data
	function add()
	{
		$name = $_POST['tname'];
		$deadline = $_POST['tdeadline'];
		$detail = $_POST['tdetails'];
		$subject = $_POST['tsubject'];
		$priority = $_POST['tpriority'];

		$query = "INSERT INTO tb_to_do (name_td, details_td, subject_td, priority_td,
			deadline_td, status_td)
			values ('$name', '$detail', '$subject', '$priority', '$deadline', 'Belum')";

		return $this->execute($query);

	}

	//method delete data
	function delete()
	{
		$id = $_GET['id_hapus'];

		$query = "DELETE FROM tb_to_do WHERE id = $id";

		return $this->execute($query);
	}

	//method update status data
	function status()
	{
		$id = $_GET['id_status'];

		$query = "UPDATE tb_to_do SET status_td = 'Sudah' WHERE id = $id";

		return $this->execute($query);
	}

	// Sort by subject secara ASC
	function sortbysubject(){
		
		$query = "SELECT * FROM tb_to_do ORDER BY subject_td ASC";

		return $this->execute($query);
	}

	// Sort by priority secara ASC
	function sortbyprio(){
		
		$query = "SELECT * FROM tb_to_do ORDER BY priority_td ASC";

		return $this->execute($query);
	}

	// Sort by deadline secara ASC
	function sortbyDL(){
		
		$query = "SELECT * FROM tb_to_do ORDER BY deadline_td ASC";

		return $this->execute($query);
	}

	// Sort by status secara ASC
	function sortbystatus(){
		
		$query = "SELECT * FROM tb_to_do ORDER BY status_td ASC";

		return $this->execute($query);
	}

	
}

?>