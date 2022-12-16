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
					<h5 class="card-title">Request Out</h5>
					<a href="<?= base_url('project'); ?>" class="btn btn-sm btn-default"><i class="bi bi-arrow-left-short"></i> Back</a>
					<!-- General Form Elements -->
					<form action="<?= base_url('request/process'); ?>" method="post">
						<div class="row my-3">
							<label for="kd_project" class="col-sm-2 col-form-label"><b>Kode Proyek</b></label>
							<div class="col-sm-10">
								<label for="kd_project" class=" col-form-label"><b><?= $request['kd_project']; ?></b></label>
								<!-- <input type="hidden" id="id_request" name="id_request" value="<?= $id_request; ?>"> -->
								<input type="hidden" id="kd_project" name="kd_project" value="<?= $request['kd_project']; ?>">
								<!-- <input type="hidden" id="id_request" name="id_request" value="<?= $request['id_request']; ?>"> -->
							</div>
						</div>


						<?= $this->session->flashdata('message'); ?>
						<table class="table mt-5">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Kode Material</th>
									<th scope="col">Nama Material </th>
									<th scope="col">Volume</th>
									<th scope="col"></th>
									<th scope="col">Jumlah</th>
									<th scope="col" class=""></th>
								</tr>
							</thead>
							<tbody id="">
								<?php
								$no = 1;
								$i = 1;
								foreach ($materials as $key => $data) : ?>
									<tr>
										<td><?= $no++; ?></td>
										<td>
											<?= $data->kd_material; ?>
											<input type="hidden" value="<?= $data->kd_material; ?>" name="kode[]">
										</td>
										<td><?= $data->material_name; ?></td>
										<td class="text-right"><?= $data->volume; ?></td>
										<td class="text-right ">:</td>
										<td class="text-right " width="100px">
											<input type="number" class="form-control " id="jumlah" min="0" placeholder="0" name="jumlah[]" autofocus>
										</td>
										<td class=""><?= $data->unit; ?></td>
									</tr>
								<?php endforeach ?>

							</tbody>

						</table>
						<div class="d-flex flex-row-reverse">
							<!-- <button id="request_material_in" class="btn btn-success"><i class="fas fa-paper-plane"></i> Request Material</button> -->
							<button type="submit" name="request_material_out" id="request_material_out" class="btn btn-success" onclick="return confirm('Yakin?')"><i class="fas fa-paper-plane"></i> Request Material</button>
							<button id="reset_material_out" class="btn btn-secondary mx-1" data-kd_project="<?= $request['kd_project']; ?>"><i class="fas fa-undo"></i> Reset</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</section>


<script>
	// $(document).on('click', '#request_material_out', function() {
	// 	// alert('Silahkan pilih material terlebih dahulu!')

	// 	var jumlah = $('#jumlah').val()
	// 	// var id_request = $('#id_request').val()
	// 	var kd_project = $('#kd_project').val()
	// 	// if (jumlah < 1) {
	// 	// 	alert('Silahkan pilih material terlebih dahulu!')
	// 	// } else {
	// 	if (confirm("Yakin ?")) {
	// 		$.ajax({
	// 			type: 'POST',
	// 			url: '<?= site_url('request/process') ?>',
	// 			data: {
	// 				'request_material_out': true,
	// 				// 'jumlah': jumlah,
	// 				// 'id_request': id_request,
	// 				'kd_project': kd_project,
	// 			},
	// 			dataType: 'json',
	// 			success: function(result) {
	// 				if (result.success == true) {
	// 					alert('Request berhasil')
	// 				} else {
	// 					alert('Request gagal')
	// 				}
	// 				location.href = '<?= site_url('request') ?>';
	// 			}
	// 		})
	// 	}
	// 	// }
	// })



	// $(document).ready(function() {
	//     $(document).on('click', '#select', function() {
	//         var kd_material = $(this).data('id');
	//         $('#kd_material').val(kd_material);
	//         $('#materialModal').modal('hide');
	//     })
	// })
	// $(document).on('click', '#select', function() {
	// 	$('#kd_material').val($(this).data('id'));
	// 	$('#materialModal').modal('hide');
	// });

	// $(document).on('click', '#add_material', function() {
	// 	var kd_project = $('#kd_project').val()
	// 	// var id_request = $('#id_request').val()
	// 	var kd_material = $('#kd_material').val()
	// 	var volume = $('#volume').val()
	// 	if (kd_material == '') {
	// 		alert('Material belum dipilih')
	// 		$('#kd_material').focus()
	// 	} else {
	// 		$.ajax({
	// 			type: "post",
	// 			url: "<?= site_url('request/process') ?>",
	// 			data: {
	// 				'add_material': true,
	// 				'kd_project': kd_project,
	// 				'kd_material': kd_material,
	// 				'volume': volume,
	// 			},
	// 			dataType: 'json',
	// 			success: function(data) {
	// 				if (data.success == true) {
	// 					$('#whilst_material').load(`<?= site_url('request/whilst/')  ?>` + kd_project, function() {
	// 						calculate()
	// 					})
	// 					$('#kd_material').val('')
	// 					$('#volume').val(1)
	// 					$('#kd_material').focus()
	// 				} else {
	// 					alert('Failed to add item to cart')
	// 				}
	// 			}
	// 		})
	// 	}
	// })

	// $(document).on('click', '#del_whilst_material', function() {
	// 	if (confirm('Apakah anda yakin?')) {
	// 		var kd_material = $(this).data('kd_material')
	// 		var kd_project = $(this).data('kd_project')
	// 		$.ajax({
	// 			type: 'post',
	// 			url: '<?= site_url('request/del_whilst') ?>',
	// 			dataType: 'JSON',
	// 			data: {
	// 				'kd_material': kd_material,
	// 				'kd_project': kd_project
	// 			},
	// 			success: function(result) {
	// 				if (result.success == true) {
	// 					$('#whilst_material').load(`<?= site_url('request/whilst/')  ?>` + kd_project, function() {
	// 						calculate()
	// 					})
	// 				} else {
	// 					alert('Gagal hapus item cart')
	// 				}
	// 			}
	// 		})
	// 	}
	// })

	// $(document).on('click', '#update_whilst_material', function() {
	// 	$('#kdproject_whilst').val($(this).data('kd_project'));
	// 	$('#kdmaterial_whilst').val($(this).data('kd_material'));
	// 	$('#volume_whilst').val($(this).data('volume'));
	// });
	// $(document).on('click', '#edit_whilst', function() {
	// 	var kd_project = $('#kdproject_whilst').val()
	// 	var kd_material = $('#kdmaterial_whilst').val()
	// 	var volume = $('#volume_whilst').val()

	// 	if (volume == '' || volume <= 0) {
	// 		alert('volume tidak boleh kosong')
	// 		$('#volume_whilst').focus()
	// 		$('#volume_whilst').val(0)
	// 	} else {
	// 		$.ajax({
	// 			type: "post",
	// 			url: "<?= site_url('request/process') ?>",
	// 			data: {
	// 				'edit_whilst': true,
	// 				'kd_project': kd_project,
	// 				'kd_material': kd_material,
	// 				'volume': volume,
	// 			},
	// 			dataType: 'json',
	// 			success: function(data) {
	// 				if (data.success == true) {
	// 					$('#whilst_material').load(`<?= site_url('request/whilst/')  ?>` + kd_project, function() {
	// 						calculate()
	// 					})
	// 					$('#materialModal_update').modal('hide');
	// 				} else {
	// 					if (volume == volume) {
	// 						$('#materialModal_update').modal('hide');
	// 					} else {
	// 						alert('Gagal update material')
	// 					}
	// 				}
	// 			}
	// 		})
	// 	}
	// })

	$(document).on('click', '#reset_material_out', function() {
		if (confirm('Apakah anda yakin?')) {
			var kd_project = $(this).data('kd_project')
			$.ajax({
				type: 'post',
				url: '<?= site_url('request/process') ?>',
				dataType: 'JSON',
				data: {
					'reset_material_out': true,
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
