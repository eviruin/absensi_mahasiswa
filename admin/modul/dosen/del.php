<?php 
$del = mysqli_query($con,"DELETE FROM tb_dosen WHERE id_dosen=$_GET[id]");
if ($del) {
		echo " <script>
		alert('Data telah dihapus !');
		window.location='?page=dosen';
		</script>";	
}

 ?>