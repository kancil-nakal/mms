<?php
$no = 1;
if ($whilst->num_rows() > 0) :
    foreach ($whilst->result() as $key => $data) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data->kd_material; ?></td>
            <td><?= $data->material_name; ?></td>
            <td class="text-right"><?= $data->volume_request; ?></td>
            <td class="text-right"><?= $data->unit; ?></td>
            <td class="text-right" width="160px">
                <button id="update_whilst_material" data-bs-toggle="modal" data-bs-target="#materialModal_update" data-kd_material="<?= $data->kd_material; ?>" data-kd_project="<?= $data->kd_project; ?>" data-volume="<?= $data->volume; ?>" class="btn btn-sm btn-warning text-white">
                    <i class="fa fa-pencil"></i>
                </button>
                <button id="del_whilst_material" data-kd_material="<?= $data->kd_material; ?>" data-kd_project="<?= $data->kd_project; ?>" class="btn btn-sm btn-danger"> <i class="fa fa-trash"> </i></button>
            </td>
        </tr>
    <?php endforeach ?>

<?php endif   ?>