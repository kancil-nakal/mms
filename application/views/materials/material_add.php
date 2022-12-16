<div class="pagetitle">
    <!-- <h1><?= $title; ?></h1> -->
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Home</a></li>
            <li class="breadcrumb-item ">Material</li>
            <li class="breadcrumb-item active"><?= $title; ?></li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add material</h5>

                    <!-- General Form Elements -->
                    <form action="" method="post">
                        <div class="row mb-3">
                            <label for="kd_material" class="col-sm-2 col-form-label">Kode Material</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= form_error('kd_material') ? 'is-invalid' : ''; ?>" id="kd_material" name="kd_material" value="<?= set_value('kd_material'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('kd_material') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="material_name" class="col-sm-2 col-form-label">Material Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= form_error('material_name') ? 'is-invalid' : ''; ?>" id="material_name" name="material_name" value="<?= set_value('material_name'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('material_name') ?>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <label for="volume" class="col-sm-2 col-form-label">Satuan</label>
                            <div class="col-sm-5">
                                <select class="form-select <?= form_error('unit') ? 'is-invalid' : ''; ?>" id="unit" name="unit" aria-label="Default select example">
                                    <option value="">--Pilih satuan--</option>
                                    <option value="meter" <?= set_value('unit') == 'meter' ? 'selected' : ''; ?>>Meter</option>
                                    <option value="sak" <?= set_value('unit') == 'sak' ? 'selected' : ''; ?>>Sak</option>
                                    <option value="carry" <?= set_value('unit') == 'carry' ? 'selected' : ''; ?>>carry</option>
                                    <option value="unit" <?= set_value('unit') == 'unit' ? 'selected' : ''; ?>>unit</option>
                                    <option value="pcs" <?= set_value('unit') == 'pcs' ? 'selected' : ''; ?>>pcs</option>
                                    <option value="batang" <?= set_value('unit') == 'batang' ? 'selected' : ''; ?>>batang</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('unit') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="desc" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control <?= form_error('desc') ? 'is-invalid' : ''; ?>" id="desc" name="desc"><?= set_value('desc'); ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('desc') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-select <?= form_error('is_active') ? 'is-invalid' : ''; ?>" id="is_active" name="is_active" aria-label="Default select example">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('is_active') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <a href="<?= base_url('material'); ?>" type="submit" class="btn btn-warning text-white"><i class="fas fa-angle-left"></i></i> Back</a>
                                <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                            </div>
                        </div>

                    </form><!-- End General Form Elements -->

                </div>
            </div>



        </div>
    </div>
</section>