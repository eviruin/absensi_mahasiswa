<?php 
$del = mysqli_query($con,"DELETE FROM tb_mahasiswa WHERE id_mahasiswa=$_GET[id]");
if ($del) {
		echo " <script>
		alert('Data telah dihapus !');
		window.location='?page=mahasiswa';
		</script>";	
}

 ?>