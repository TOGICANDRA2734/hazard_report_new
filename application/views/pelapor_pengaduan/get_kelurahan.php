<?php 
	$data = $_POST['data'];
	$id = $_POST['id'];
?>

<?php if($data == "kelurahan") : ?>
	<select id="form_kelurahan" name="id_kelurahan">
		<?php 
			$this->db->order_by('id', 'asc');
			$kelurahan = $this->db->get_where('pma_dailyprod_pit', ['pma_dailyprod_pit.kodesite' => $id])->result_array();
		?>
		<?php foreach ($kelurahan as $dataKelurahan): ?>
			<option value="<?= $dataKelurahan['id']; ?>"><?= $dataKelurahan['ket']; ?></option>
		<?php endforeach ?>
	</select>
 
<?php endif ?>