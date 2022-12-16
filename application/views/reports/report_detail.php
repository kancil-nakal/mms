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
					<h3 class="card-title">DETAIL REPORT</h3>
					<a href="<?= base_url('report'); ?>" class="btn btn-sm btn-default"><i class="bi bi-arrow-left-short"></i> Back</a>

					<table class="table table-bordered">
						<tr>
							<td>Kode Proyek</td>
							<td>: <?= $project->kd_project; ?></td>
						</tr>
						<tr>
							<td>Nama Proyek</td>
							<td>: <?= $project->project_name; ?></td>
						</tr>
						<tr>
							<td>Area Proyek</td>
							<td>: <?= $project->area; ?></td>
						</tr>
						<tr>
							<td>Manager</td>
							<td>: </td>
						</tr>
						<tr>
							<td>Waspang</td>
							<td>: </td>
						</tr>
						<tr>
							<td>WH</td>
							<td>: </td>
						</tr>
					</table>


					<h4 class="card-title ">Stok Material</h4>
					<table class="table table-bordered">
						<tr>
							<th scope="col" class="text-center">#</th>
							<th scope="col" class="text-center">Kode Material</th>
							<th scope="col" class="text-center">Nama Material </th>
							<th scope="col" class="text-center">Volume</th>
							<th scope="col" class="text-center">Satuan</th>
						</tr>
						<?php $no = 1;
						foreach ($material_stock as $key => $data) : ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $data->kd_material; ?></td>
								<td><?= $data->material_name; ?></td>
								<td><?= $data->volume; ?></td>
								<td><?= $data->unit; ?></td>
							</tr>
						<?php endforeach ?>
					</table>

					<h4 class="card-title ">Material In</h4>
					<table class="table table-bordered">
						<tr>
							<th scope="col" class="text-center">#</th>
							<th scope="col" class="text-center">Kode Material</th>
							<th scope="col" class="text-center">Nama Material </th>
							<th scope="col" class="text-center">Volume</th>
							<th scope="col" class="text-center">Satuan</th>
						</tr>
						<?php $no = 1;
						foreach ($material_in as $key => $data) : ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $data->kd_material; ?></td>
								<td><?= $data->material_name; ?></td>
								<td><?= $data->volume; ?></td>
								<td><?= $data->unit; ?></td>
							</tr>
						<?php endforeach ?>
					</table>

					<h4 class="card-title ">Material Out</h4>
					<table class="table table-bordered">
						<tr>
							<th scope="col" class="text-center">#</th>
							<th scope="col" class="text-center">Kode Material</th>
							<th scope="col" class="text-center">Nama Material </th>
							<th scope="col" class="text-center">Volume</th>
							<th scope="col" class="text-center">Satuan</th>
						</tr>
						<?php $no = 1;
						foreach ($material_out as $key => $data) :
							if ($data->volume != 0) : ?>
								<tr>
									<td><?= $no++; ?></td>
									<td><?= $data->kd_material; ?></td>
									<td><?= $data->material_name; ?></td>
									<td><?= $data->volume; ?></td>
									<td><?= $data->unit; ?></td>
								</tr>
						<?php
							endif;
						endforeach ?>
					</table>

					<br>
					<h6>Request History</h6>
					<table class="table table-bordered">
						<tr>
							<td><small>Request In</small></td>
							<td style="font-style:italic">
								<?php foreach ($request_in as $key => $data) : ?>
									<a href="<?= base_url('request/' . $data->id_request . '/detail/in')  ?>"><small><?= $data->id_request; ?>,</small></a>
								<?php endforeach ?>
							</td>
						</tr>
						<tr>
							<td><small>Request out</small></td>
							<td style="font-style:italic">
								<?php foreach ($request_out as $key => $data) : ?>
									<a href="<?= base_url('request/' . $data->id_request . '/detail/out')  ?>"><small> <?= $data->id_request; ?>,</small></a>
								<?php endforeach ?>
							</td>
						</tr>

					</table>

					<div class="d-flex flex-row-reverse mb-3">
						<a href="<?= base_url('report/material_export/') . $project->kd_project  ?>" target="_blank" id="request_material" class="btn btn-sm btn-light mx-1"><i class="fas fa-file-pdf"></i> Export</a>
						<!-- <a href="<?= base_url('request'); ?>" class="btn btn-sm btn-secondary mx-1"><i class="bi bi-arrow-left-short"></i> Back</a> -->
					</div>
					<!-- </form> -->

				</div>
			</div>
		</div>
	</div>
</section>


</script>
