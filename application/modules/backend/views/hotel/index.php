<?php
if (!empty($success))
    show_mesg_success($success);
?>

<?php
if (!empty($error))
    show_mesg_error($error);
?>

<?php echo form_open(site_url('backend/' . $controller), array('autocomplete' => 'off', 'method' => 'get', 'id' => 'frm')); ?>
<div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3>
                    <i class="icon-table"></i>
                    Danh sách
                </h3>
            </div>
            <div class="dataTables_filter" id="DataTables_Table_4_filter">
                
                <input value="<?php echo ($this->input->get('keyword_search')) ? $this->input->get('keyword_search') : '';?>" type="text" name="keyword_search" placeholder="Khách sạn, đối tác, địa chỉ...">
                
                <select name="type_search">
                    <option value="">Loại khách sạn</option>
                    <?php foreach($hotel_type as $v) :?>
                    <option <?php echo ($v->id == $this->input->get('type_search')) ? 'selected="selected"' : '';?> value="<?php echo $v->id;?>"><?php echo $v->name;?></option>
                    <?php endforeach;?>
                </select>
           
                <select name="star_search">
                    <option value="">Hạng sao</option>
                    <?php for($i_star = 1; $i_star <= 5; $i_star ++) :?>
                    <option <?php echo ($i_star == $this->input->get('star_search')) ? 'selected="selected"' : '';?> value="<?php echo $i_star;?>"><?php echo $i_star;?></option>
                    <?php endfor;?>
                </select>
                &nbsp;
                <input type="submit" class="btn btn-primary ui-wizard-content ui-formwizard-button" value="Tìm kiếm" style="float: right;">
            </div>
            <div class="box-content nopadding">
                <table class="table table-nomargin">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="checkbox-all" /></th>
                            <th>Khách sạn</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Loại phòng</th>
                            <th>Đối tác</th>
                            <th>Khuyến mãi</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($records)) : ?>
                            <?php foreach ($records as $v) : ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkbox-item" name="check_item[]" value="<?php echo $v->id; ?>" />
                                    </td>
                                    <td>
                                        <a href="<?php echo site_url() . '/backend/' . $controller . '/edit/' . $v->id; ?>"><?php echo html_escape($v->name); ?></a>
                                    </td>
                                    <td><?php echo $v->create_time; ?> bởi <strong><?php echo $v->admin_username;?></strong></td>
                                    <td><?php echo $v->update_time; ?> bởi <strong><?php echo $v->update_by; ?></strong></td>
                                    <td>
                                        <a href="<?php echo site_url(); ?>/backend/room_type?hotel_id=<?php echo $v->id; ?>">
                                            <?php if (check_wait_verify_room($v->id) == NULL):?>
                                                    Loại phòng
                                            <?php else:?>
                                                    <?php echo '<span class="label label-important">' . check_wait_verify_room($v->id) . '</span>';?>
                                            <?php endif;?>        
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php echo site_url(); ?>/backend/partner/edit/<?php echo $v->partner_id; ?>"><?php echo ($v->partner_name != '') ? 'Đối tác' : '<span class="label label-important">Không</span>'; ?></a>
                                    </td>
                                    <td>
                                        <a href="<?php echo site_url(); ?>/backend/promotion/?hotel_id=<?php echo $v->id; ?>">
                                            <?php if (check_wait_verify_promotion($v->id) == NULL):?>
                                                    Khuyến mãi
                                            <?php else:?>
                                                    <?php echo '<span class="label label-important">' . check_wait_verify_promotion($v->id) . '</span>';?>
                                            <?php endif;?>
                                        </a>
                                    </td>
                                    <!--
                                    <td class="text-center">
                                        <?php
                                        if ($v->status == 1)
                                            $img = 'tick-circle.png';
                                        else
                                            $img = 'disabled.png';
                                        ?>
                                        <img 
                                            class="img_status" 
                                            params='{"id":"<?php echo $v->id; ?>"}' 
                                            src="<?php echo base_url() . 'public/backend/img/' . $img; ?>" />
                                    </td>
                                    -->
                                    <td>
                                        <?php
                                        if ($v->status == 1)
                                        {
                                            echo '<span style="color: #468847; font-weight: bold">' . $status[$v->status] . '</span>';
                                        }
                                        else
                                        {
                                            echo '<span style="color: #b94a48; font-weight: bold">' . $status[$v->status] . '</span>';
                                        }
                                
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="dataTables_info" id="DataTables_Table_0_info">Tổng số: <strong><?php echo $total_rows;?></strong> khách sạn</div>
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</div>

<div class="form-actions" style="margin-top: 0;">
    <select id="list_action" style="float: left; margin-right: 10px;" class="input-small valid">
        <option value="">Thao tác</option>
        <option value="delete">Xóa</option>
    </select>
    <input onclick="return confirm_action()" type="submit" class="btn btn-primary ui-wizard-content ui-formwizard-button" value="Thực hiện" style="float: left;">
    <input onclick="location.href = '<?php echo site_url() . '/backend/' . $controller . '/add'; ?>'" type="button" class="btn btn-primary ui-wizard-content ui-formwizard-button" value="Tạo mới" style="float: right;">
</div>
<?php echo form_close(); ?>