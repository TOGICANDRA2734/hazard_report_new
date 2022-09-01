<footer class="">
		<!-- Bottom Navbar -->
		<nav class="navbar navbar-dark bg-black navbar-expand fixed-bottom">
			<ul class="navbar-nav nav-justified w-100">
				<li class="nav-item">
					<a href="<?= base_url(); ?>" class="nav-link">
						<svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
							<path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
						</svg>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('landing/masuk'); ?>" class="nav-link">
						<svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
							<path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
						</svg>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('pelaporPengaduan/addPelaporPengaduan'); ?>" class="nav-link">
						<svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
							<path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
						</svg>
					</a>
				</li>
				<li class="nav-item">
					<?php 
						$nomor_telepon = $this->db->get_where('hazard_safety_officer', ['kodesite' => $_SESSION['kodesite']])->row_array();
					?>
					<a href="<?= 'https://wa.me/'.$nomor_telepon['no_hp'].'?text=Halo Pak '.$nomor_telepon['nama'].', ada Emergency' ?>" class="nav-link">
						<svg width="1.5em" height="1.5em" fill="currentColor"  class="bi bi-heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
							<path d="M80.3 44C69.8 69.9 64 98.2 64 128s5.8 58.1 16.3 84c6.6 16.4-1.3 35-17.7 41.7s-35-1.3-41.7-17.7C7.4 202.6 0 166.1 0 128S7.4 53.4 20.9 20C27.6 3.6 46.2-4.3 62.6 2.3S86.9 27.6 80.3 44zM555.1 20C568.6 53.4 576 89.9 576 128s-7.4 74.6-20.9 108c-6.6 16.4-25.3 24.3-41.7 17.7S489.1 228.4 495.7 212c10.5-25.9 16.3-54.2 16.3-84s-5.8-58.1-16.3-84C489.1 27.6 497 9 513.4 2.3s35 1.3 41.7 17.7zM352 128c0 23.7-12.9 44.4-32 55.4V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V183.4c-19.1-11.1-32-31.7-32-55.4c0-35.3 28.7-64 64-64s64 28.7 64 64zM170.6 76.8C163.8 92.4 160 109.7 160 128s3.8 35.6 10.6 51.2c7.1 16.2-.3 35.1-16.5 42.1s-35.1-.3-42.1-16.5c-10.3-23.6-16-49.6-16-76.8s5.7-53.2 16-76.8c7.1-16.2 25.9-23.6 42.1-16.5s23.6 25.9 16.5 42.1zM464 51.2c10.3 23.6 16 49.6 16 76.8s-5.7 53.2-16 76.8c-7.1 16.2-25.9 23.6-42.1 16.5s-23.6-25.9-16.5-42.1c6.8-15.6 10.6-32.9 10.6-51.2s-3.8-35.6-10.6-51.2c-7.1-16.2 .3-35.1 16.5-42.1s35.1 .3 42.1 16.5z"/>
						</svg>	
					</a>
				</li>
				
			</ul>
		</nav>

		<!-- <div class="navigation">
			<ul>
				<li class="list active">
					<a href="<?= base_url(); ?>">
						<span class="icon">
							<ion-icon name="home-outline"></ion-icon>
						</span>
						<span class="text">Beranda</span>
					</a>
				</li>
				<li class="list">
					<a href="#">
						Ambulance Icon
						<span class="icon">
							<ion-icon name="radio-outline"></ion-icon>
						</span>
						<span class="text">Emergency</span>
					</a>
				</li>
				<li class="list">
					<a href="#">
						<span class="icon">
							<ion-icon name="menu-outline"></ion-icon>
						</span>
						<span class="text">Menu</span>
					</a>
				</li>
				<li class="list">
					<a href="#">
						<span class="icon">
							<ion-icon name="settings-outline"></ion-icon>
						</span>
						<span class="text">Setting</span>
					</a>
				</li>
				<li class="list">
					<a href="<?= base_url('landing/masuk'); ?>">
						<span class="icon">
							<ion-icon name="log-in-outline"></ion-icon>
						</span>
						<span class="text">Login</span>
					</a>
				</li>
				<div class="indicator"></div>
			</ul>
		</div> -->
		<!-- <div class="container">
			<div class="row my-4">
				<div class="col-lg footer-copyright my-auto">
					<h5 class="text-dark text-center">PT RPP Contractors Indonesia</h5>
				</div>
			</div>
		</div> -->
	</footer>

	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>
	<div class="flashdata" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
	<div class="flashdata-success" data-flashdata="<?= $this->session->flashdata('message-success'); ?>"></div>
	<div class="flashdata-failed" data-flashdata="<?= $this->session->flashdata('message-failed'); ?>"></div>
	<!-- ./Sweet Alert 2 -->

	<script>
		const list = document.querySelectorAll('.list');

		function activeLink() {
			list.forEach((item) =>
				item.classList.remove('active'));
			this.classList.add('active');
		}
		list.forEach((item) =>
			item.addEventListener('click', activeLink));
	</script>

	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	</body>


	</html>