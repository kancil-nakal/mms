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
                    <a href="<?= base_url('material/add'); ?>" class=" btn btn-primary mb-3"><i class="fas fa-plus"></i> Add Material</a>

                    <?= $this->session->flashdata('message'); ?>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode Material</th>
                                <th scope="col">Nama Material</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($materials as $key => $data) : ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= strtoupper($data->kd_material); ?></td>
                                    <td><?= $data->material_name; ?></td>
                                    <td><?= $data->unit; ?></td>
                                    <td><?= $data->is_active == 1 ? '<span class="badge rounded-pill bg-success">aktif</span>' : '<span class="badge rounded-pill bg-secondary">tidak aktif</span>'; ?></td>
                                    <td>
                                        <a href="<?= base_url('material/edit/') . $data->kd_material; ?>" class="badge bg-warning"><i class="bi bi-pen"></i></a>
                                        <!-- <a href="<?= base_url('material/delete/') . $data->kd_material; ?>" class="badge bg-danger" onclick="return confirm(' Apakah anda yakin?')"><i class="bi bi-trash"></i></a> -->
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