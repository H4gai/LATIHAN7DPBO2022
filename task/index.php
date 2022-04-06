<?php

include("conf.php");
include("DB.php");
include("Task.php");
include("Template.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

// Memanggil method add di kelas Task
if(isset($_POST['add']))
{
	$otask->add();
}
// Memanggil method delete di kelas Task
if(isset($_GET['id_hapus']))
{
	$otask->delete();
}
// Memanggil method status di kelas Task
if(isset($_GET['id_status']))
{
	$otask->status();
}

//membuat daftar sort sesuai id yang dipih
// jika sort id subject Memanggil method sort by subject di kelas Task
if(isset($_GET['sort_subject'])){
	$otask->sortbysubject();
}
// jika sort id priority Memanggil method sort by priority di kelas Task
else if(isset($_GET['sort_priority'])){
	$otask->sortbyprio();
}
// jika sort id deadline Memanggil method sort by deadline di kelas Task
else if(isset($_GET['sort_deadline'])){
	$otask->sortbyDL();
}
// jika sort id status Memanggil method sort by status di kelas Task
else if(isset($_GET['sort_status'])){
	$otask->sortbystatus();
}
// Memanggil method getTask di kelas Task
else{
	$otask->getTask();
}

// Proses mengisi tabel dengan data
$data = null;
$no = 1;

while (list($id, $tname, $tdetails, $tsubject, $tpriority, $tdeadline, $tstatus) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	if($tstatus == "Sudah"){
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tdetails . "</td>
		<td>" . $tsubject . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tdeadline . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}

	// Tampilan jika status task nya belum dikerjakan
	else{
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tdetails . "</td>
		<td>" . $tsubject . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tdeadline . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' ><a href='index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
		</td>
		</tr>";
		$no++;
	}
}

// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("templates/skin.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();