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
                                <th scope="col">Kode Proyek</th>
                                <th scope="col">Nama Proyek</th>
                                <th scope="col">Kode Material</th>
                                <th scope="col">Nama Material</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($materials as $key => $data) : ?>
                                <tr>
                                    <td><?= $data->kd_project; ?></td>
                                    <td><?= strtoupper($data->project_name); ?></td>
                                    <td><?= strtoupper($data->kd_material); ?></td>
                                    <td><?= $data->material_name; ?></td>
                                    <td><?= $data->volume; ?></td>
                                    <td><?= $data->unit; ?></td>
                                    <td>
                                        <a id="set_detail" data-bs-target="#stockDetail" data-bs-toggle="modal" class="btn btn-sm btn-info" data-kd_material="<?= ($data->kd_material); ?>" data-material_name="<?= ($data->material_name); ?>" data-volume="<?= ($data->volume); ?>" data-unit="<?= ($data->unit); ?>" data-kd_project="<?= ($data->kd_project); ?>" data-project_name="<?= ($data->project_name); ?>" data-area="<?= ($data->area); ?>" data-created="<?= indo_date($data->created); ?>"><i class="fas fa-eye"></i> detail</a>
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

<div class="modal fade" id="stockDetail" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered no-margin">
                    <tbody>
                        <tr>
                            <th>Kode Material</th>
                            <td><span id="kd_material"></span></td>
                        </tr>
                        <tr>
                            <th>Nama Material</th>
                            <td><span id="material_name"></span></td>
                        </tr>
                        <tr>
                            <th>Stock</th>
                            <td><span id="volume"></span> <span id="unit"></span></td>
                        </tr>
                        <tr>
                            <th>Proyek</th>
                            <td><span id="project_name"></span></td>
                        </tr>
                        <tr>
                            <th>Area</th>
                            <td><span id="area"></span></td>
                        </tr>
                        <tr>
                            <th>Ditambahkan pada</th>
                            <td><span id="created"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '#set_detail', function() {
            var kd_material = $(this).data('kd_material');
            var material_name = $(this).data('material_name');
            var volume = $(this).data('volume');
            var unit = $(this).data('unit');
            var kd_project = $(this).data('kd_project');
            var project_name = $(this).data('project_name');
            var area = $(this).data('area');
            var created = $(this).data('created');
            $('#kd_material').text(kd_material);
            $('#material_name').text(material_name);
            $('#volume').text(volume);
            $('#unit').text(unit);
            $('#kd_project').text(kd_project);
            $('#project_name').text(project_name);
            $('#area').text(area);
            $('#created').text(created);
        })
    })
</script>