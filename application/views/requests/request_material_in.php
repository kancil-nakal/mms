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
					<h5 class="card-title">Request In</h5>
					<a href="<?= base_url('project'); ?>" class="btn btn-sm btn-default"><i class="bi bi-arrow-left-short"></i> Back</a>
					<!-- General Form Elements -->
					<!-- <form action="<?= base_url('request/process'); ?>" method="post"> -->
					<div class="row my-3">
						<label for="kd_project" class="col-sm-2 col-form-label"><b>ID Proyek</b></label>
						<div class="col-sm-10">
							<label for="kd_project" class=" col-form-label"><b><?= $request['kd_project']; ?></b></label>
							<!-- <input type="hidden" id="id_request" name="id_request" value="<?= $id_request; ?>"> -->
							<input type="hidden" id="kd_project" name="kd_project" value="<?= $request['kd_project']; ?>">
						</div>
					</div>
					<!-- <div class="row mb-3">
                            <label class="col-sm-2 col-form-label"><b>Material</b></label>
                            <div class="col-sm-5">
                                <select class="form-select <?= form_error('kd_material') ? 'is-invalid' : ''; ?>" id="kd_material" name="kd_material" aria-label="Default select example">
                                    <option value="">--Select material--</option>
                                    <?php foreach ($materials as $key => $data) : ?>
                                        <option value="<?= $data->kd_material; ?>" <?= set_value('kd_material') == $data->kd_material ? 'selected' : ''; ?>><?= $data->kd_material . " | " . ucwords($data->material_name); ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('kd_material') ?>
                                </div>
                            </div>
                        </div> -->

					<div class="row mb-3">
						<label for="kd_material" class="col-sm-2 col-form-label"><b>Material</b></label>
						<div class="col-sm-3">
							<div class="input-group mb-3">
								<input type="text" class="form-control <?= form_error('kd_material') ? 'is-invalid' : ''; ?>" id="kd_material" name="kd_material" required autofocus>
								<span>
									<a class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#materialModal"><i class="fas fa-search"></i></a>
								</span>
								<div class="invalid-feedback">
									<?= form_error('kd_material') ?>
								</div>
							</div>

						</div>
					</div>

					<div class="row mb-3">
						<label for="volume" class="col-sm-2 col-form-label "><b>Volume</b></label>
						<div class="col-sm-3">
							<input type="number" class="form-control <?= form_error('volume') ? 'is-invalid' : ''; ?>" id="volume" name="volume" value="1" min="1" autocomplete="off">
							<div class="invalid-feedback">
								<?= form_error('volume') ?>
							</div>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-sm-2"></div>
						<div class="col-sm-10">
							<button type="submit" class="btn btn-primary" name="add_material" id="add_material"><i class="fas fa-"></i>Add Material</button>
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
								<th scope="col">Unit</th>
								<th scope="col">Opsi</th>
							</tr>
						</thead>
						<tbody id="whilst_material">
							<?php $this->view('requests/whilst_material') ?>
						</tbody>

					</table>
					<div class=" d-flex">
						<p>Total Material : </p>
						<p class="mx-1"><b><span id="total_material2">0</span></b></p>
						<input type="hidden" class="mx-1" id="total_material" name="total_material">
					</div>
					<div class="d-flex flex-row-reverse">
						<button id="request_material_in" class="btn btn-success"><i class="fas fa-paper-plane"></i> Request Material</button>
						<button id="reset_material" class="btn btn-secondary mx-1" data-kd_project="<?= $request['kd_project']; ?>"><i class="fas fa-undo"></i> Reset</button>
					</div>
					<!-- </form> -->

				</div>
			</div>
		</div>
	</div>
</section>


<div class="modal fade" id="materialModal" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Select Material</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-bordered table-striped datatable" id="example1">
					<thead>
						<tr>
							<th>Kode Material</th>
							<th>Material Name</th>
							<th>Unit</th>
							<th>Desc</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($materials as $key => $data) : ?>
							<tr>
								<td><?= $data->kd_material; ?></td>
								<td><?= $data->material_name; ?></td>
								<td><?= $data->unit; ?></td>
								<td><?= $data->desc; ?></td>
								<td class="text-center">
									<button class="btn btn-sm btn-info text-white" id="select" data-id="<?= $data->kd_material; ?>" data-name="<?= $data->material_name; ?>" data-unit="<?= $data->unit; ?>"><i class="fa fa-check"></i> Select</button>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="materialModal_update">
	<div class="modal-dialog modal-sm modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Update Volume</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<input type="hidden" id="kdproject_whilst">
				<input type="hidden" id="kdmaterial_whilst">
				<div class="form-group">
					<input type="number" id="volume_whilst" min="0" class="form-control">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="edit_whilst" class="btn btn-warning text-white">Update</button>
			</div>
		</div>
	</div>
</div>

<script>
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

	$(document).on('click', '#request_material_in', function() {
		var total_material = $('#total_material').val()
		// var id_request = $('#id_request').val()
		var kd_project = $('#kd_project').val()
		if (total_material < 1) {
			alert('Silahkan pilih material terlebih dahulu!')
		} else {
			if (confirm("Yakin ?")) {
				$.ajax({
					type: 'POST',
					url: '<?= site_url('request/request_material') ?>',
					data: {
						'request_material_in': true,
						// 'id_request': id_request,
						'kd_project': kd_project,
					},
					dataType: 'json',
					success: function(result) {
						if (result.success == true) {
							alert('Request berhasil dibuat')
						} else {
							alert('Request gagal')
						}
						location.href = '<?= site_url(`request/in`) ?>';
					}
				})
			}
		}
	})
</script>
