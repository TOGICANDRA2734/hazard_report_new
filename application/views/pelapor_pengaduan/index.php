<div class="container">
	<div class="row justify-content-center py-3">
		<div class="col-lg header-title">
			<?php if ($this->uri->segment(3) == 'proses'): ?>
				<h3><i class="fas fa-fw fa-exclamation"></i> Pengaduan Proses</h3>
			<?php elseif ($this->uri->segment(3) == 'valid'): ?>
				<h3><i class="fas fa-fw fa-exclamation"></i> Pengaduan Valid</h3>
			<?php elseif ($this->uri->segment(3) == 'pengerjaan'): ?>
				<h3><i class="fas fa-fw fa-exclamation"></i> Pengaduan Pengerjaan</h3>
			<?php elseif ($this->uri->segment(3) == 'selesai'): ?>
				<h3><i class="fas fa-fw fa-exclamation"></i> Pengaduan Selesai</h3>
			<?php elseif ($this->uri->segment(3) == 'tidak_valid'): ?>
				<h3><i class="fas fa-fw fa-exclamation"></i> Pengaduan Tidak Valid</h3>
			<?php elseif ($this->uri->segment(3) == 'belum_ditanggapi'): ?>
				<h3><i class="fas fa-fw fa-exclamation"></i> Pengaduan Belum ditanggapi</h3>
			<?php else: ?>
				<h3><i class="fas fa-fw fa-exclamation"></i> Semua Pengaduan</h3>
			<?php endif ?>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col text-center m-1">
			<a href="<?= base_url('pelaporPengaduan/index'); ?>" class="btn btn-info"><i class="fas fa-fw fa-clipboard-list"></i> All</a>
		</div>
		<div class="col text-center m-1">
			<a href="<?= base_url('pelaporPengaduan/index/belum_ditanggapi'); ?>" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-times"></i> Belum ditanggapi</a>
		</div>
		<div class="col text-center m-1">
			<a href="<?= base_url('pelaporPengaduan/index/proses'); ?>" class="btn btn-danger"><i class="fas fa-fw fa-sync"></i> Proses</a>
		</div>
		<div class="col text-center m-1">
			<a href="<?= base_url('pelaporPengaduan/index/valid'); ?>" class="btn btn-success"><i class="fas fa-fw fa-check"></i> Valid</a>
		</div>
		<div class="col text-center m-1">
			<a href="<?= base_url('pelaporPengaduan/index/pengerjaan'); ?>" class="btn btn-warning"><i class="fas fa-fw fa-hammer"></i> Pengerjaan</a>
		</div>
		<div class="col text-center m-1">
			<a href="<?= base_url('pelaporPengaduan/index/selesai'); ?>" class="btn btn-primary"><i class="fas fa-fw fa-check-double"></i> Selesai</a>
		</div>
		<div class="col text-center m-1">
			<a href="<?= base_url('pelaporPengaduan/index/tidak_valid'); ?>" class="btn btn-secondary"><i class="fas fa-fw fa-times"></i> Tidak Valid</a>
		</div>
	</div>
	<div class="row py-3">
		<div class="col-lg">
			<div class="table-responsive">
				<table class="table table-bordered" id="table_id">
					<thead class="thead-dark">
						<tr>
							<th class="align-middle">No.</th>
							<th class="align-middle">Pelapor</th>
							<th class="align-middle">Tanggal Pengaduan</th>
							<th class="align-middle">Isi Laporan</th>
							<th class="align-middle">Lokasi</th>
							<th class="align-middle">Foto</th>
							<th class="align-middle">Status</th>
							<th class="align-middle">Tangapan</th>
							<th class="align-middle">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($pengaduan as $dp): ?>
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
								<td class="align-middle"><?= $dp['ket']; ?></td>
								<td class="align-middle text-center">
									<a href="<?= base_url('assets/img/img_pengaduan/') . $dp['foto']; ?>" class="enlarge">
										<img src="<?= base_url('assets/img/img_pengaduan/') . $dp['foto']; ?>" class="img-fluid img-w-75-hm-100" alt="<?= $dp['foto']; ?>">
									</a>
								</td>
								<td class="align-middle">
									<?php if ($dp['status_pengaduan'] == 'proses'): ?>
										<button type="button" class="btn btn-sm text-center btn-danger"><i class="fas fa-fw fa-sync"></i> <?= $status; ?></button>
									<?php elseif ($dp['status_pengaduan'] == 'valid'): ?>
										<button type="button" class="btn btn-sm text-center btn-success"><i class="fas fa-fw fa-check"></i> <?= $status; ?></button>
									<?php elseif ($dp['status_pengaduan'] == 'pengerjaan'): ?>
										<button type="button" class="btn btn-sm text-center btn-warning"><i class="fas fa-fw fa-hammer"></i> <?= $status; ?></button>
									<?php elseif ($dp['status_pengaduan'] == 'selesai'): ?>
										<button type="button" class="btn btn-sm text-center btn-primary"><i class="fas fa-fw fa-check-double"></i> <?= $status; ?></button>
									<?php elseif ($dp['status_pengaduan'] == 'tidak_valid'): ?>
										<button type="button" class="btn btn-sm text-center btn-secondary"><i class="fas fa-fw fa-times"></i> <?= $status; ?></button>
									<?php else: ?>
										<button type="button" class="btn btn-sm text-center btn-secondary"><i class="fas fa-fw fa-times"></i> <?= $status; ?></button>
									<?php endif ?>
								</td>
								<td class="align-middle">
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
								<td class="align-middle text-center">
									<?php if ($dp['status_pengaduan'] == 'belum_ditanggapi'): ?>
										<a href="<?= base_url('pelaporPengaduan/editPelaporPengaduan/' . $dp['id_pengaduan']); ?>" class="btn btn-sm btn-success m-1"><i class="fas fa-fw fa-edit"></i></a>
									<?php endif ?>
									<a href="<?= base_url('pelaporTanggapan/index/' . $dp['id_pengaduan']); ?>" class="btn btn-sm btn-info m-1"><i class="fas fa-fw fa-reply"></i></a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>