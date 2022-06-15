<?php
include('../setting/koneksi.php');
$produk = mysqli_query($conn,"SELECT * FROM tb_newdeaths");
while($row = mysqli_fetch_array($produk)){
	$nama_produk[] = $row['negara'];
	
	$query = mysqli_query($conn,"SELECT sum(new_deaths) as jumlah FROM tb_newdeaths WHERE new_deaths='".$row['new_deaths']."'");
	$row = $query->fetch_array();
	$jumlah_produk[] = $row['jumlah'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bar Chart</title>
	<script type="text/javascript" src="../setting/Chart.js"></script>
</head>
<body>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>

	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($nama_produk); ?>,
				datasets: [{
					label: 'Negara dengan Grafik Covidnya ',
					data: <?php echo json_encode($jumlah_produk); ?>,
					backgroundColor: 'rgb(67, 213, 218)',
					borderColor: 'rgb(113, 112, 110)',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>