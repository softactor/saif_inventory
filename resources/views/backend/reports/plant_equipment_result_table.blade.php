<div class="table-responsive data-table-wrapper">
    <table id="blogs-table" class="table table-condensed table-hover table-bordered">
        <thead>
            <tr>
                <th>{{ trans('labels.backend.plantequipments.table.title') }}</th>
                <th>{{ trans('labels.backend.plantequipments.table.eel_code') }}</th>
                <th>{{ trans('labels.backend.plantequipments.table.country_of_origin') }}</th>
                <th>{{ trans('labels.backend.plantequipments.table.capacity') }}</th>
                <th>Make By</th>
                <th>Model</th>
                <th>{{ trans('labels.backend.plantequipments.table.createdby') }}</th>
                <th>{{ trans('labels.backend.plantequipments.table.createdat') }}</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($plantEquipments) && !empty($plantEquipments)) {
                foreach ($plantEquipments as $equipments) {
                    ?>
                    <tr>
                        <td><?php echo $equipments->name; ?></td>
                        <td><?php echo $equipments->eel_code; ?></td>
                        <td><?php echo getTableRawDetails('country', $equipments->country_of_origin)->nicename; ?></td>
                        <td><?php echo $equipments->capacity; ?></td>
                        <td><?php echo $equipments->make_by; ?></td>
                        <td><?php echo $equipments->model; ?></td>
                        <td>
                            <?php
                                $userDetails    =    get_user_details_by_user_id($equipments->created_by);
                                echo $userDetails->first_name.' '.$userDetails->last_name;
                            ?>
                        </td>
                        <td><?php echo date("F jS, Y", strtotime($equipments->created_at)); ?></td>
                        <td><?php echo $equipments->created_at; ?></td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</div><!--table-responsive-->