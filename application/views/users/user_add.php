<div class="pagetitle">
    <!-- <h1><?= $title; ?></h1> -->
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Home</a></li>
            <li class="breadcrumb-item ">User</li>
            <li class="breadcrumb-item active"><?= $title; ?></li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add user</h5>

                    <!-- General Form Elements -->
                    <form action="" method="post">
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= form_error('name') ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?= set_value('name'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('name') ?>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control <?= form_error('email') ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= set_value('email'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('email') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password1" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control <?= form_error('password1') ? 'is-invalid' : ''; ?>" id="password1" name="password1">
                                <div class="invalid-feedback">
                                    <?= form_error('password1') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password2" class="col-sm-2 col-form-label">Confirm Password </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control <?= form_error('password2') ? 'is-invalid' : ''; ?>" id="password2" name="password2">
                                <div class="invalid-feedback">
                                    <?= form_error('password2') ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select class="form-select <?= form_error('role') ? 'is-invalid' : ''; ?>" id="role" name="role" aria-label="Default select example">
                                    <option value="">--Select role--</option>
                                    <?php foreach ($roles as $key => $data) : ?>
                                        <option value="<?= $data->id_role; ?>" <?= set_value('role') == $data->id_role ? 'selected' : ''; ?>><?= ucwords($data->role); ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('role') ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <a href="<?= base_url('user'); ?>" type="submit" class="btn btn-warning text-white"><i class="fas fa-angle-left"></i></i> Back</a>
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                            </div>
                        </div>

                    </form><!-- End General Form Elements -->

                </div>
            </div>



        </div>
    </div>
</section>