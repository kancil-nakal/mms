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

                    <?= $this->session->flashdata('message'); ?>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode Proyek</th>
                                <th scope="col">Nama Proyek</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($reports as $key => $data) : ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= strtoupper($data->kd_project); ?></td>
                                    <td><?= strtoupper($data->project_name); ?></td>
                                    <td>
                                        <a href="<?= base_url('report/detail_report/') . $data->kd_project; ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Detail</a>
                                        <a href="<?= base_url('report/') . $data->kd_project; ?>" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Download Report </a>
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