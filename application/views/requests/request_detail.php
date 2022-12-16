<div class="pagetitle">
	<!-- <h1><?= $title; ?></h1> -->
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Home</a></li>
			<li class="breadcrumb-item ">Project</li>
			<li class="breadcrumb-item active"><?= $title; ?></li>
		</ol>
	</nav>
</div>

<section class="section">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title">REQUEST LIST</h3>
					<h6><?= $request['id_request']; ?></h6>
					<a href="<?= base_url('request'); ?>" class="btn btn-sm btn-default"><i class="bi bi-arrow-left-short"></i> Back</a>
					<table class="table table-bordered">
						<tr>
							<td>Kode Proyek</td>
							<td>: <?= $request['kd_project']; ?></td>
							<input type="hidden" id="kd_project" name="kd_project" value="<?= $request['kd_project']; ?>">
							<input type="hidden" id="id_request" name="id_request" value="<?= $request['id_request']; ?>">
							<input type="hidden" id="in_out" name="in_out" value="<?= $request['in_out']; ?>">
							<input type="hidden" id="status" name="status" value="<?= $request['status']; ?>">
						</tr>
						<tr>
							<td>Diajukan pada</td>
							<td>: <?= indo_date($request['created_at']); ?></td>
						</tr>
						<tr>
							<td>Diajukan oleh</td>
							<td>: <?= $request['user_request']; ?></td>
						</tr>
						<tr>
							<td>Diterima oleh</td>
							<td>: <?= $request['user_apply']; ?></td>
						</tr>
						<tr>
							<td>Status</td>
							<td>
								<?php if ($request['status'] == 1) {
									echo   ': Request';
								} else if ($request['status'] == 2) {
									echo   ': Proses';
								} else if ($request['status'] == 3) {
									echo   ': Selesai';
								}

								?>
							</td>
						</tr>
						<?php if ($request['status'] == 3) : ?>
							<tr>
								<td>Diselesaikan pada</td>
								<td>: <?= indo_date($request['updated_at']) ?></td>
							</tr>
						<?php endif ?>
					</table>
					<div class="d-flex flex-row mb-3">
						<?php if ($request['status'] == 1) : ?>
							<?php if ($request['in_out'] == 'in') : ?>
								<a href="<?= base_url('request/apply_request_in/') . $request['id_request']; ?>" class="btn btn-success "><i class="fas fa-"></i><b>Proses</b></a>
							<?php else : ?>
								<a href="<?= base_url('request/apply_request_out/') . $request['id_request']; ?>" class="btn btn-success "><i class="fas fa-"></i><b>Proses</b></a>
							<?php endif ?>
						<?php elseif ($request['status'] == 2) : ?>
							<?php if ($request['in_out'] == 'in') : ?>
								<button id="selesaikan_in" class="btn btn-primary "><i class="fas fa-"></i><b>Selesaikan</b></button>
							<?php else : ?>
								<button id="selesaikan_out" class="btn btn-primary "><i class="fas fa-"></i><b>Selesaikan</b></button>
							<?php endif ?>
						<?php else : ?>
						<?php endif ?>
					</div>
					<h6>Detail Material</h6>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th scope="col" class="text-center">#</th>
								<th scope="col" class="text-center">Kode Material</th>
								<th scope="col" class="text-center">Nama Material </th>
								<th scope="col" class="text-center">Volume</th>
								<th scope="col" class="text-center">Satuan</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($materials as $key => $data) :
								if ($data->volume != 0) : ?>
									<tr>
										<td class="text-center"><?= $no++; ?></td>
										<td id="kd_material"><?= $data->kd_material; ?></td>
										<td><?= $data->material_name; ?></td>
										<td class="text-center"><?= $data->volume; ?></td>
										<td class="text-center"><?= $data->unit; ?></td>
									</tr>
							<?php
								endif;
							endforeach ?>
						</tbody>
					</table>

					<div class="d-flex flex-row-reverse mb-3">
						<?php if ($request['in_out'] == 'in') : ?>
							<a href="<?= base_url('report/request/in/export/') . $request['id_request'] ?>" target="_blank" id="request_material" class="btn btn-sm btn-light mx-1"><i class="fas fa-file-pdf"></i> Export</a>
						<?php else : ?>
							<a href="<?= base_url('report/request/out/export/') . $request['id_request'] ?>" target="_blank" id="request_material" class="btn btn-sm btn-light mx-1"><i class="fas fa-file-pdf"></i> Export</a>
						<?php endif ?>
						<!-- <a href="<?= base_url('request'); ?>" class="btn btn-sm btn-secondary mx-1"><i class="bi bi-arrow-left-short"></i> Back</a> -->
					</div>
					<!-- </form> -->

				</div>
			</div>
		</div>
	</div>
</section>


<script>
	$(document).on('click', '#selesaikan_in', function() {
		var kd_project = $('#kd_project').val()
		var id_request = $('#id_request').val()
		// var kd_material = $('#kd_material').val()
		var in_out = $('#in_out').val()
		var status = $('#status').val()
		var request = 'request'
		var detail = 'detail/in'

		if (confirm("Yakin ?")) {
			$.ajax({
				type: 'POST',
				url: '<?= site_url('request/request_material') ?>',
				data: {
					'selesaikan_in': true,
					'kd_project': kd_project,
					// 'kd_material': kd_material,
					'id_request': id_request,
					'in_out': in_out,
					'status': status,
				},
				dataType: 'json',
				success: function(result) {
					if (result.success == true) {
						alert('request berhasil di selesaikan')
					} else {
						alert('permintan gagal')
					}
					location.href = `<?= site_url('request/in/detail/') ?>` + id_request;
				}
			})
		}

	})

	$(document).on('click', '#selesaikan_out', function() {
		var kd_project = $('#kd_project').val()
		var id_request = $('#id_request').val()
		var in_out = $('#in_out').val()
		var status = $('#status').val()

		if (confirm("Yakin ?")) {
			$.ajax({
				type: 'POST',
				url: '<?= site_url('request/request_material') ?>',
				data: {
					'selesaikan_out': true,
					'kd_project': kd_project,
					'id_request': id_request,
					'in_out': in_out,
					'status': status,
				},
				dataType: 'json',
				success: function(result) {
					if (result.success == true) {
						alert('request berhasil di selesaikan')
					} else {
						alert('permintan gagal')
					}
					location.href = `<?= site_url('request/out/detail/') ?>` + id_request;
				}
			})
		}

	})
	// $(document).ready(function() {
	//     $(document).on('click', '#select', function() {
	//         var kd_material = $(this).data('id');
	//         $('#kd_material').val(kd_material);
	//         $('#materialModal').modal('hide');
	//     })
	// })
	$(document).on('click', '#select', function() {
		$('#kd_material').val($(this).data('id'));
		$('#materialModal').modal('hide');
	});

	$(document).on('click', '#add_material', function() {
		var kd_project = $('#kd_project').val()
		// var id_request = $('#id_request').val()
		var kd_material = $('#kd_material').val()
		var volume = $('#volume').val()
		if (kd_material == '') {
			alert('Material belum dipilih')
			$('#kd_material').focus()
		} else {
			$.ajax({
				type: "post",
				url: "<?= site_url('request/process') ?>",
				data: {
					'add_material': true,
					'kd_project': kd_project,
					'kd_material': kd_material,
					'volume': volume,
				},
				dataType: 'json',
				success: function(data) {
					if (data.success == true) {
						$('#whilst_material').load(`<?= site_url('request/whilst/')  ?>` + kd_project, function() {
							calculate()
						})
						$('#kd_material').val('')
						$('#volume').val(1)
						$('#kd_material').focus()
					} else {
						alert('Failed to add item to cart')
					}
				}
			})
		}
	})

	$(document).on('click', '#del_whilst_material', function() {
		if (confirm('Apakah anda yakin?')) {
			var kd_material = $(this).data('kd_material')
			var kd_project = $(this).data('kd_project')
			$.ajax({
				type: 'post',
				url: '<?= site_url('request/del_whilst') ?>',
				dataType: 'JSON',
				data: {
					'kd_material': kd_material,
					'kd_project': kd_project
				},
				success: function(result) {
					if (result.success == true) {
						$('#whilst_material').load(`<?= site_url('request/whilst/')  ?>` + kd_project, function() {
							calculate()
						})
					} else {
						alert('Gagal hapus item cart')
					}
				}
			})
		}
	})

	$(document).on('click', '#update_whilst_material', function() {
		$('#kdproject_whilst').val($(this).data('kd_project'));
		$('#kdmaterial_whilst').val($(this).data('kd_material'));
		$('#volume_whilst').val($(this).data('volume'));
	});
	$(document).on('click', '#edit_whilst', function() {
		var kd_project = $('#kdproject_whilst').val()
		var kd_material = $('#kdmaterial_whilst').val()
		var volume = $('#volume_whilst').val()

		if (volume == '' || volume <= 0) {
			alert('volume tidak boleh kosong')
			$('#volume_whilst').focus()
			$('#volume_whilst').val(0)
		} else {
			$.ajax({
				type: "post",
				url: "<?= site_url('request/process') ?>",
				data: {
					'edit_whilst': true,
					'kd_project': kd_project,
					'kd_material': kd_material,
					'volume': volume,
				},
				dataType: 'json',
				success: function(data) {
					if (data.success == true) {
						$('#whilst_material').load(`<?= site_url('request/whilst/')  ?>` + kd_project, function() {
							calculate()
						})
						$('#materialModal_update').modal('hide');
					} else {
						if (volume == volume) {
							$('#materialModal_update').modal('hide');
						} else {
							alert('Gagal update material')
						}
					}
				}
			})
		}
	})

	$(document).on('click', '#reset_material', function() {
		if (confirm('Apakah anda yakin?')) {
			var kd_project = $(this).data('kd_project')
			$.ajax({
				type: 'post',
				url: '<?= site_url('request/process') ?>',
				dataType: 'JSON',
				data: {
					'reset_material': true,
					'kd_project': kd_project
				},
				success: function(result) {
					if (result.success == true) {
						$('#whilst_material').load(`<?= site_url('request/whilst/')  ?>` + kd_project, function() {
							calculate()
						})
					} else {
						alert('Gagal reset material')
					}
				}
			})
		}
	})

	function calculate() {
		var total_material = $('#whilst_material tr').length
		if (isNaN(total_material)) {
			$('#total_material').val(0)
			$('#total_material2').text(0)
		} else {
			$('#total_material').val(total_material)
			$('#total_material2').text(total_material)
		}
	}
	$(document).ready(function() {
		calculate()
	})
</script>
