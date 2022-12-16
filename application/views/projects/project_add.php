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
                    <h5 class="card-title">Add project</h5>

                    <!-- General Form Elements -->
                    <form action="" method="post">
                        <div class="row mb-3">
                            <label for="kd_project" class="col-sm-2 col-form-label">Kode Project</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= form_error('kd_project') ? 'is-invalid' : ''; ?>" id="kd_project" name="kd_project" value="<?= $kd_project; ?>" readonly>
                                <div class="invalid-feedback">
                                    <?= form_error('kd_project') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="project_name" class="col-sm-2 col-form-label">Project</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= form_error('project_name') ? 'is-invalid' : ''; ?>" id="project_name" name="project_name" value="<?= set_value('project_name'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('project_name') ?>
                                </div>
                            </div>

                        </div>
                        <!-- <div class="row mb-3">
                            <label for="" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-4">
                                <label for="start_date" class="col-sm-1 col-form-label">Start</label>
                                <input type="date" class="form-control <?= form_error('start_date') ? 'is-invalid' : ''; ?>" id="start_date" name="start_date" value="<?= set_value('start_date'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('start_date') ?>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <label for="end_date" class="col-sm-1 col-form-label">End</label>
                                <input type="date" class="form-control <?= form_error('end_date') ? 'is-invalid' : ''; ?>" id="end_date" name="end_date" value="<?= set_value('end_date'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('end_date') ?>
                                </div>
                            </div>
                        </div> -->
                        <div class="row mb-3">
                            <label for="area" class="col-sm-2 col-form-label">Area</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control <?= form_error('area') ? 'is-invalid' : ''; ?>" id="area" name="area"><?= set_value('area'); ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('area') ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <a href="<?= base_url('project'); ?>" class="btn btn-warning text-white"><i class="fas fa-angle-left"></i></i> Back</a>
                                <button type="submit" class="btn btn-success" name="submit"><i class="fas fa-save"></i> Save</button>
                            </div>
                        </div>

                    </form><!-- End General Form Elements -->

                </div>
            </div>



        </div>
    </div>
</section>