<div class="pagetitle">
	<!-- <h1><?= $title; ?></h1> -->
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Home</a></li>
			<li class="breadcrumb-item active"><?= $title; ?></li>
		</ol>
	</nav>
</div>

<section class="section">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title"><?= $title; ?></h5>
					<!-- <a href="<?= base_url('project/add'); ?>" class=" btn btn-primary mb-3"><i class="fas fa-plus"></i> Add Request</a> -->

					<?= $this->session->flashdata('message'); ?>
					<!-- Table with stripped rows -->
					<table class="table datatable">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Tanggal</th>
								<th scope="col">ID Request</th>
								<th scope="col">Kode Proyek</th>
								<th scope="col" class="text-center">Status</th>
								<th scope="col" class="text-center">Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($requests as $key => $data) : ?>
								<tr>
									<th scope="row"><?= $no++; ?></th>
									<td><?= indo_date($data->created_at); ?></td>
									<td><?= strtoupper($data->id_request); ?></td>
									<td><?= strtoupper($data->kd_project); ?></td>
									<td class="text-center">
										<?php if ($data->status == 1) : ?>
											<!-- <span class="badge border-success border-1 text-secondary">request</span> -->
											<span class="badge bg-light text-dark"><i class="fas fa-"></i>belum diproses</span>
										<?php elseif ($data->status == 2) : ?>
											<span class="badge bg-warning"><i>sedang diproses..</i></span>
										<?php elseif ($data->status == 3) : ?>
											<span class="badge bg-dark">selesai</span>
										<?php endif ?>
									</td>
									<td class="text-center">
										<?php if ($data->in_out == 'in') : ?>
											<a href="<?= base_url('request/in/detail/') . $data->id_request  ?>" class="btn btn-sm btn-light text-dark"><i class="fas fa-eye"></i> detail </a>
										<?php elseif ($data->in_out == 'out') : ?>
											<a href="<?= base_url('request/out/detail/') . $data->id_request  ?>" class="btn btn-sm btn-light text-dark"><i class="fas fa-eye"></i> detail </a>
										<?php endif ?>
										<!-- <a href="<?= base_url('project/delete/') . $data->kd_project; ?>" class="badge bg-light text-dark"><i class="fas fa-"></i>print </a> -->
									</td>
								</tr>
							<?php endforeach ?>

						</tbody>
					</table>
					<!-- End Table with stripped rows -->

				</div>
			</div>

		</div>
	</div>
</section>
