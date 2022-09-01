<?php 
	$proses = $this->db->get_where('hazard_pengaduan', ['status_pengaduan' => 'proses'])->num_rows();
	$valid = $this->db->get_where('hazard_pengaduan', ['status_pengaduan' => 'valid'])->num_rows();
	$pengerjaan = $this->db->get_where('hazard_pengaduan', ['status_pengaduan' => 'pengerjaan'])->num_rows();
	$selesai = $this->db->get_where('hazard_pengaduan', ['status_pengaduan' => 'selesai'])->num_rows();
	$tidak_valid = $this->db->get_where('hazard_pengaduan', ['status_pengaduan' => 'tidak_valid'])->num_rows();
	$belum_ditanggapi = $this->db->get_where('hazard_pengaduan', ['status_pengaduan' => 'belum_ditanggapi'])->num_rows();
?>

<div id="carouselInterval" class="carousel slide " data-ride="carousel">
	<div class="carousel-inner">
		<div class="carousel-item active" data-interval="3000">
			<img src="<?= base_url('assets/img/img_properties/img_carousel/carousel-1.jpg'); ?>" class="d-block h-500 w-100">
		</div>
		<div class="carousel-item" data-interval="3000">
			<img src="<?= base_url('assets/img/img_properties/img_carousel/carousel-2.jpg'); ?>" class="d-block h-500 w-100">
		</div>
		<div class="carousel-item">
			<img src="<?= base_url('assets/img/img_properties/img_carousel/carousel-3.jpg'); ?>" class="d-block h-500 w-100">
		</div>
	</div>
	<a class="carousel-control-prev" href="#carouselInterval" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselInterval" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>


<main class="flex-shrink-0">
	<div class="container pb-5">
		<div class="row" id="daftar_laporan" style="padding: 1.5rem 0 3rem;">
			<div class="col-lg">
				<h4>Laporan Hazard Report</h4>
				<div class="table-responsive">
					<table class="table table-bordered" id="table_id">
						<thead class="thead-dark">
							<tr>
								<th class="align-middle">No.</th>
								<th class="align-middle">Pelapor</th>
								<th class="align-middle">Tanggal</th>
								<th class="align-middle">Laporan</th>
								<th class="align-middle">Lokasi</th>
								<th class="align-middle">Foto</th>
								<th class="align-middle">Status</th>
								<th class="align-middle">Tangapan</th>
								<th class="align-middle">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; ?>
							<?php foreach ($pengaduan as $dp) : ?>
								<?php
								$getTanggapan = $this->db->order_by('hazard_tanggapan.id', 'desc')->get_where('hazard_tanggapan', ['id_pengaduan' => $dp['id_pengaduan']])->row_array();
								$status = explode('_', $dp['status_pengaduan']);
								$status = implode(' ', $status);
								$status = ucwords($status);
								?>
								<tr>
									<td class="align-middle"><?= $i++; ?></td>
									<td class="align-middle"><?= $dp['username']; ?></td>
									<td class="align-middle"><?= $dp['tgl']; ?></td>
									<td class="align-middle"><?= $dp['isi']; ?></td>
									<td class="align-middle"><?= $dp['kodepit']; ?></td>
									<td class="align-middle text-center">
										<a href="<?= base_url('assets/img/img_pengaduan/') . $dp['foto']; ?>" class="enlarge">
											<img src="<?= base_url('assets/img/img_pengaduan/') . $dp['foto']; ?>" class="img-fluid img-w-75-hm-100" alt="<?= $dp['foto']; ?>">
										</a>
									</td>
									<td class="align-middle">
										<?php if ($dp['status_pengaduan'] == 'proses') : ?>
											<button type="button" class="btn btn-sm text-center btn-danger"><i class="fas fa-fw fa-sync"></i> <?= $status; ?></button>
										<?php elseif ($dp['status_pengaduan'] == 'valid') : ?>
											<button type="button" class="btn btn-sm text-center btn-success"><i class="fas fa-fw fa-check"></i> <?= $status; ?></button>
										<?php elseif ($dp['status_pengaduan'] == 'pengerjaan') : ?>
											<button type="button" class="btn btn-sm text-center btn-warning"><i class="fas fa-fw fa-hammer"></i> <?= $status; ?></button>
										<?php elseif ($dp['status_pengaduan'] == 'selesai') : ?>
											<button type="button" class="btn btn-sm text-center btn-primary"><i class="fas fa-fw fa-check-double"></i> <?= $status; ?></button>
										<?php elseif ($dp['status_pengaduan'] == 'tidak_valid') : ?>
											<button type="button" class="btn btn-sm text-center btn-secondary"><i class="fas fa-fw fa-times"></i> <?= $status; ?></button>
										<?php else : ?>
											<button type="button" class="btn btn-sm text-center btn-secondary"><i class="fas fa-fw fa-times"></i> <?= $status; ?></button>
										<?php endif ?>
									</td>
									<td class="align-middle">
										<?php if ($getTanggapan) : ?>
											<?php if ($getTanggapan['status'] == 'proses') : ?>
												<p><?= $getTanggapan['isi']; ?></p>
											<?php elseif ($getTanggapan['status'] == 'valid') : ?>
												<p><?= $getTanggapan['isi']; ?></p>
											<?php elseif ($getTanggapan['status'] == 'pengerjaan') : ?>
												<p><?= $getTanggapan['isi']; ?></p>
											<?php elseif ($getTanggapan['status'] == 'selesai') : ?>
												<p><?= $getTanggapan['isi']; ?></p>
											<?php elseif ($getTanggapan['status'] == 'tidak_valid') : ?>
												<p><?= $getTanggapan['isi']; ?></p>
											<?php endif ?>
										<?php else : ?>
											<p>-</p>
										<?php endif ?>
									</td>
									<td class="align-middle text-center">
										<a href="<?= base_url('landing/detailPengaduan/' . $dp['id_pengaduan']); ?>" class="btn btn-sm btn-info m-1"><i class="fas fa-fw fa-align-justify"></i> Detail</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</main>


<!-- <div class="container">
	<div class="row justify-content-center py-3">
		<div class="col-lg">
			<h3><i class="fas fa-fw fa-tachometer-alt"></i>Dashboard</h3>
		</div>
	</div>

	
	<div class="row my-3">
        <div class="col-lg-3">
            <div class="card shadow">
	            <div class="card-body">
	              <h5><i class="fas fa-fw fa-times"></i> Belum ditanggapi</h5>
	              <h6 class="text-muted mt-3">Jumlah data: <span class="bg-info py-1 px-2 rounded"><?= $belum_ditanggapi; ?></span></h6>
	            </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card shadow">
	            <div class="card-body">
	              <h5><i class="fas fa-fw fa-sync"></i> Proses</h5>
	              <h6 class="text-muted mt-3">Jumlah data: <span class="bg-info py-1 px-2 rounded"><?= $proses; ?></span></h6>
	            </div>
            </div>
        </div>
        <div class="col-lg-3">
        	<div class="card shadow">
	            <div class="card-body">
	              <h5><i class="fas fa-fw fa-check"></i> Valid</h5>
	              <h6 class="text-muted mt-3">Jumlah data: <span class="bg-info py-1 px-2 rounded"><?= $valid; ?></span></h6>
	            </div>
	        </div>
	    </div>
        <div class="col-lg-3">
	        <div class="card shadow">
	            <div class="card-body">
	              <h5><i class="fas fa-fw fa-hammer"></i> Pengerjaan</h5>
	              <h6 class="text-muted mt-3">Jumlah data: <span class="bg-info py-1 px-2 rounded"><?= $pengerjaan; ?></span></h6>
	            </div>
	        </div>
        </div>
        <div class="col-lg-3">
	        <div class="card shadow">
	            <div class="card-body">
	              <h5><i class="fas fa-fw fa-check-double"></i> Selesai</h5>
	              <h6 class="text-muted mt-3">Jumlah data: <span class="bg-info py-1 px-2 rounded"><?= $selesai; ?></span></h6>
	            </div>
	        </div>
        </div>
        <div class="col-lg-3">
	        <div class="card shadow">
	            <div class="card-body">
	              <h5><i class="fas fa-fw fa-times"></i> Tidak Valid</h5>
	              <h6 class="text-muted mt-3">Jumlah data: <span class="bg-info py-1 px-2 rounded"><?= $tidak_valid; ?></span></h6>
	            </div>
	        </div>
        </div>
	</div>
	<hr>
	<div class="row my-3">
		<div class="col-lg">
			<h4><i class="fas fa-fw fa-times"></i> Laporan yang belum ditanggapi</h4>
			<div class="table-responsive">
				<table class="table table-bordered" id="table_id">
					<thead class="thead-dark">
						<tr>
							<th class="align-middle">No.</th>
							<th class="align-middle">Tanggal Pengaduan</th>
							<th class="align-middle">Isi Laporan</th>
							<th class="align-middle">Lokasi</th>
							<th class="align-middle">Foto</th>
							<th class="align-middle">Pelapor</th>
							<th class="align-middle">Status</th>
							<th class="align-middle">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($pengaduan_belum_ditanggapi_pelapor as $dp): ?>
							<tr>
								<td class="align-middle"><?= $i++; ?></td>
								<td class="align-middle"><?= $dp['tgl_pengaduan']; ?></td>
								<td class="align-middle"><?= $dp['isi_laporan']; ?></td>
								<td class="align-middle"><?= $dp['kelurahan']; ?></td>
								<td class="align-middle text-center">
									<a href="<?= base_url('assets/img/img_pengaduan/') . $dp['foto']; ?>" class="enlarge">
										<img src="<?= base_url('assets/img/img_pengaduan/') . $dp['foto']; ?>" class="img-fluid img-w-75-hm-100" alt="<?= $dp['foto']; ?>">
									</a>
								</td>
								<td class="align-middle"><?= $dp['username']; ?></td>
								<td class="align-middle"><button type="button" class="btn text-center btn-sm btn-secondary"><i class="fas fa-fw fa-times"></i> Belum ditanggapi</button></td>
								<td class="align-middle text-center">
									<a href="<?= base_url('tanggapan/index/' . $dp['id_pengaduan']); ?>" class="btn btn-sm btn-info m-1"><i class="fas fa-fw fa-reply"></i></a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div> -->