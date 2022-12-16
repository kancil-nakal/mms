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
                    <?php if ($this->session->userdata('role') == 1 ||  $this->session->userdata('role') == 2) : ?>
                        <a href="<?= base_url('project/add'); ?>" class=" btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Proyek</a>
                    <?php endif ?>

                    <?= $this->session->flashdata('message'); ?>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode Proyek</th>
                                <th scope="col">Nama Proyek</th>
                                <th scope="col">Area</th>
                                <th scope="col">Opsi</th>
                                <th scope="col">Material</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($projects as $key => $data) : ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= strtoupper($data->kd_project); ?></td>
                                    <td><?= strtoupper($data->project_name); ?></td>
                                    <td><?= $data->area; ?></td>
                                    <td>
                                        <a href="<?= base_url('project/delete/') . $data->kd_project; ?>" class="badge bg-warning"><i class="fas fa-"></i>edit</a>
                                        <a href="<?= base_url('project/delete/') . $data->kd_project; ?>" class="badge bg-info"><i class="fas fa-"></i>detail </a>
                                    </td>
                                    <td>
                                        <?php if ($this->fungsi->user_login()->id_role == 1) : ?>
                                            <a href="<?= base_url('project/' . $data->kd_project . '/request/in') ?>" class="badge bg-success"><i class="fas fa-"></i>Request In</a>
                                            <a href="<?= base_url('project/' . $data->kd_project . '/request/out') ?>" class="badge bg-primary"><i class="fas fa-"></i>Request Out</a>
                                        <?php elseif ($this->fungsi->user_login()->id_role == 2) : ?>
                                            <a href="<?= base_url('project/' . $data->kd_project . '/request/in') ?>" class="badge bg-success"><i class="fas fa-"></i>Request In</a>
                                        <?php elseif ($this->fungsi->user_login()->id_role == 3) : ?>
                                            <a href="<?= base_url('project/' . $data->kd_project . '/request/out') ?>" class="badge bg-primary"><i class="fas fa-"></i>Request Out</a>
                                        <?php endif ?>
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