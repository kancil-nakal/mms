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
                    <a href="<?= base_url('user/add'); ?>" class=" btn btn-primary mb-3"><i class="fas fa-user-plus"></i> Add Users</a>

                    <?= $this->session->flashdata('message'); ?>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Level</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($users as $key => $data) : ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $data->name; ?></td>
                                    <td><?= $data->email; ?></td>
                                    <td>
                                        <?php if ($data->id_role == 1) : ?>
                                            <span class="badge rounded-pill bg-light text-dark">administrator</span>
                                        <?php elseif ($data->id_role == 2) : ?>
                                            <span class="badge rounded-pill bg-primary">project manager</span>
                                        <?php elseif ($data->id_role == 3) : ?>
                                            <span class="badge rounded-pill bg-info">pengawas lapangan</span>
                                        <?php elseif ($data->id_role == 4) : ?>
                                            <span class="badge rounded-pill bg-success">warehouse</span>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('user/edit/') . $data->id; ?>" class="badge bg-warning"><i class="bi bi-pen"></i></a>

                                        <?php if ($this->session->userdata('id_user') != $data->id_role) : ?>
                                            <a href="<?= base_url('user/delete/') . $data->id; ?>" class="badge bg-danger" onclick="return confirm(' Apakah anda yakin?')"><i class="bi bi-trash
                                            "></i></a>
                                        <?php else : ?>
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