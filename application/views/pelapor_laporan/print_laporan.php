<?php 
	$filter = explode('/', $filter);
	$dari_tgl = $filter[0];
	$sampai_tgl = $filter[1];
	$status_pengaduan = $filter[2];
	
	$dari_tgl = date("Y-m-d\T00:00:01", strtotime($dari_tgl));
	$sampai_tgl = date("Y-m-d\T23:59:59", strtotime($sampai_tgl));
	$this->db->join('user', 'hazard_pengaduan.id_user=user.id');
	$this->db->join('pma_dailyprod_pit', 'hazard_pengaduan.id_pit=pma_dailyprod_pit.id');
	$this->db->order_by('id_pengaduan', 'desc');
	if ($status_pengaduan == 'semua')
	{
		$pengaduan = $this->db->get_where('hazard_pengaduan', ['tgl >=' => $dari_tgl, 'tgl <=' => $sampai_tgl])->result_array();
	}
	else
	{
		$pengaduan = $this->db->get_where('hazard_pengaduan', ['tgl >=' => $dari_tgl, 'tgl <=' => $sampai_tgl, 'status_pengaduan' => $status_pengaduan])->result_array();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title; ?></title>
	<style>
		.btn {
		  display: inline-block;
		  font-weight: 400;
		  color: #212529;
		  text-align: center;
		  vertical-align: middle;
		  -webkit-user-select: none;
		  -moz-user-select: none;
		  -ms-user-select: none;
		  user-select: none;
		  background-color: transparent;
		  border: 2px solid transparent;
		  padding: 0.375rem 0.75rem;
		  font-size: 1rem;
		  line-height: 1.5;
		  border-radius: 0.25rem;
		  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
		  text-decoration: none;
		}

		.btn-success {
		  color: #fff;
		  background-color: #28a745;
		  border-color: #28a745;
		}

		@media print {
			.not-printed {
				display: none;
			}
		}
	</style>
</head>
<body>
	<a class="btn btn-success not-printed" href="<?= base_url('pelaporLaporan/printLaporan/') . $filter[0] . '/' . $filter[1] . '/' . $filter[2]; ?>">Cetak</a>
	<?php 
		$status_pengaduan = explode('_', $status_pengaduan);
		$status_pengaduan = implode(' ', $status_pengaduan);
		$status_pengaduan = ucwords($status_pengaduan);
	?>
	<h4>Laporan - <?= date('Y-M-d', strtotime($dari_tgl)); ?> s/d <?= date('Y-M-d', strtotime($sampai_tgl)); ?>, status: <?= $status_pengaduan; ?></h4>
	<table cellpadding="10" cellspacing="0" border="1">
		<thead>
			<tr>
				<th>No.</th>
				<th>Pelapor</th>
				<th>Tanggal Pengaduan</th>
				<th>Isi Laporan</th>
				<th>Lokasi</th>
				<th>Foto</th>
				<th>Status</th>
				<th>Tanggapan</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1; ?>
			<?php foreach ($pengaduan as $dp): ?>
				<?php 
					$getTanggapan = $this->db->order_by('hazard_tanggapan.id', 'desc')->get_where('hazard_tanggapan', ['id_pengaduan' => $dp['id_pengaduan']])->row_array();
					$status_pengaduan = explode('_', $dp['status_pengaduan']);
					$status_pengaduan = implode(' ', $status_pengaduan);
					$status_pengaduan = ucwords($status_pengaduan);
				?>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= $dp['username']; ?></td>
					<td><?= date('Y-m-d, \P\u\k\u\l H:i', strtotime($dp['tgl'])); ?></td>
					<td><?= $dp['isi']; ?></td>
					<td><?= $dp['ket']; ?></td>
					<td>
						<img height="75" src="<?= base_url('assets/img/img_pengaduan/') . $dp['foto']; ?>" alt="<?= $dp['foto']; ?>">
					</td>
					<td><?= $status_pengaduan; ?></td>
					<td>
						<?php if ($getTanggapan): ?>
							<?php if ($getTanggapan['status'] == 'proses'): ?>
								<p><?= $getTanggapan['isi']; ?></p>
							<?php elseif ($getTanggapan['status'] == 'valid'): ?>
								<p><?= $getTanggapan['isi']; ?></p>
							<?php elseif ($getTanggapan['status'] == 'pengerjaan'): ?>
								<p><?= $getTanggapan['isi']; ?></p>
							<?php elseif ($getTanggapan['status'] == 'selesai'): ?>
								<p><?= $getTanggapan['isi']; ?></p>
							<?php elseif ($getTanggapan['status'] == 'tidak_valid'): ?>
								<p><?= $getTanggapan['isi']; ?></p>
							<?php endif ?>
						<?php else: ?>
							<p>-</p>
						<?php endif ?>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

<script>
	window.print();
</script>
</body>
</html>

