<div class="container">
	<div class="row py-3">
		<div class="col-lg">
			<h3><i class="fas fa-fw fa-file-alt"></i> Laporan</h3>
		</div>
	</div>
	<div class="row py-3">
		<div class="col-lg-10">
			<form method="post">
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="dari_tgl">Dari Tanggal</label>
							<?php if (isset($_POST['dari_tgl'])): ?>
								<input type="date" id="dari_tgl" class="form-control" name="dari_tgl" value="<?= $_POST['dari_tgl']; ?>" required>
							<?php else: ?>
								<input type="date" id="dari_tgl" class="form-control" name="dari_tgl" value="<?= date('Y-m-01'); ?>" required>
							<?php endif ?>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="sampai_tgl">Sampai Tanggal</label>
							<?php if (isset($_POST['sampai_tgl'])): ?>
								<input type="date" id="sampai_tgl" class="form-control" name="sampai_tgl" value="<?= $_POST['sampai_tgl']; ?>" required>
							<?php else: ?>
								<input type="date" id="sampai_tgl" class="form-control" name="sampai_tgl" value="<?= date('Y-m-d'); ?>" required>
							<?php endif ?>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="status_pengaduan">Status</label>
							<select name="status_pengaduan" id="status_pengaduan" class="custom-select">
								<?php if (isset($_POST['status_pengaduan'])): ?>
									<?php 
										$status_pengaduan = explode('_', $_POST['status_pengaduan']);
										$status_pengaduan = implode(' ', $status_pengaduan);
										$status_pengaduan = ucwords($status_pengaduan);
									?>
									<option value="<?= strtolower($_POST['status_pengaduan']); ?>"><?= $status_pengaduan; ?></option>
									<option disabled>---------</option>
								<?php endif ?>
								<option value="semua">Semua</option>
								<option value="belum_ditanggapi">Belum ditanggapi</option>
								<option value="proses">Proses</option>
								<option value="valid">Valid</option>
								<option value="pengerjaan">Pengerjaan</option>
								<option value="selesai">Selesai</option>
								<option value="tidak_valid">Tidak Valid</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn mr-1 btn-primary" name="btnFilter"><i class="fas fa-fw fa-filter"></i> Filter</button>
					<a href="<?= base_url('pelaporLaporan'); ?>" class="btn mx-1 btn-danger"><i class="fas fa-fw fa-times"></i> Reset</a>
					<?php if (isset($_POST['btnFilter'])): ?>
						<?php 
							$filter = implode('/', $_POST);
						?>
						<a target="_blank" href="<?= base_url('pelaporLaporan/printLaporan/' . $filter); ?>" class="btn ml-1 btn-success"><i class="fas fa-fw fa-print"></i> Cetak</a>
					<?php else: ?>
						<a target="_blank" href="<?= base_url('pelaporLaporan/printLaporan/'); ?>" class="btn ml-1 btn-success"><i class="fas fa-fw fa-print"></i> Cetak</a>
					<?php endif ?>
				</div>
			</form>
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
							<th class="align-middle">Tanggapan</th>
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
									<a href="<?= base_url('tanggapan/index/' . $dp['id_pengaduan']); ?>" class="btn btn-sm btn-info m-1"><i class="fas fa-fw fa-reply"></i></a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>