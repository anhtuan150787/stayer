<?php
if (!empty($success))
    show_mesg_success($success);
?>

<?php
if (!empty($error))
    show_mesg_error($error);
?>

<div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3><i class="icon-edit"></i> <?php echo $action_name; ?></h3>
            </div>
            <div class="box-content">
                <?php echo form_open('', array('class' => 'form-horizontal', 'autocomplete' => 'off', 'method' => 'post', 'id' => 'frm')); ?>

                <div class="control-group">
                    <label for="textfield" class="control-label">Khách sạn</label>

                    <div class="controls" style="padding-top: 5px;">
                        <strong><?php echo $hotel->name; ?></strong>
                    </div>
                </div>

                <div class="control-group">
                    <label for="textfield" class="control-label">Tên</label>

                    <div class="controls">
                        <input type="text" name="name" id="name" class="input-xlarge"
                               value="<?php echo (isset($record->name)) ? html_escape($record->name) : ""; ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label for="textfield" class="control-label">Số điện thoại</label>

                    <div class="controls">
                        <input type="text" name="phone" id="phone" class="input-xlarge"
                               value="<?php echo (isset($record->phone)) ? html_escape($record->phone) : ""; ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label for="textfield" class="control-label">Email</label>

                    <div class="controls">
                        <input type="text" name="email" id="email" class="input-xlarge"
                               value="<?php echo (isset($record->email)) ? html_escape($record->email) : ""; ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label for="textfield" class="control-label">Nhóm Tài khoản</label>

                    <div class="controls">
                        <select name="group_id">
                            <option value="">--- Nhóm tài khoản ---</option>
                            <?php if (isset($group_partner) && !empty($group_partner)) : ?>
                                <?php foreach ($group_partner as $v) : ?>
                                    <option <?php echo (isset($record->group_id) && $record->group_id == $v->id) ? 'selected="selected"' : ''; ?>
                                        value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label for="textfield" class="control-label">Tài khoản</label>

                    <div class="controls">
                        <input type="text" name="username" id="username" class="input-xlarge"
                               value="<?php echo (isset($record->username)) ? html_escape($record->username) : ""; ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label for="textfield" class="control-label">Mật khẩu</label>

                    <div class="controls">
                        <input type="password" name="password" id="password" class="input-xlarge" value="">
                    </div>
                </div>

                <div class="control-group">
                    <label for="textfield" class="control-label">Mô tả thêm</label>

                    <div class="controls">
                        <textarea name="description" id="description"
                                  class="input-block-level description"><?php echo (isset($record->description)) ? html_escape($record->description) : ''; ?></textarea>
                    </div>
                </div>

                <div class="control-group">
                    <label for="textfield" class="control-label">Thời gian cập nhật</label>

                    <div class="controls" style="padding-top: 5px;">
                        <?php echo $record->update_time; ?> bởi <strong><?php echo $record->update_by; ?></strong>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Trạng thái</label>

                    <div class="controls">
                        <label class='radio'>
                            <input <?php echo (isset($record->status) && $record->status == 1) ? 'checked="checked"' : ''; ?>
                                type="radio" name="status" value="1" checked="checked"> Kích hoạt
                        </label>
                        <label class='radio'>
                            <input <?php echo (isset($record->status) && $record->status == 0) ? 'checked="checked"' : ''; ?>
                                type="radio" name="status" value="0"> Tạm dừng
                        </label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><?php echo $action_name; ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>

    $(function () {
        $("#frm").validate({
            rules: {
                name: 'required',
                phone: 'required',
                username: 'required',
                group_id: 'required',
                <?php if (!isset($record->password)) : ?>
                password: 'required',
                <?php endif; ?>
                email: 'email',
            },
            messages: {
                name: 'Vui lòng nhập thông tin Tên',
                phone: 'Vui lòng nhập thông tin Số điện thoại',
                username: 'Vui lòng nhập thông tin Tài khoản',
                group_id: 'Vui lòng chọn Nhóm tài khoản',
                <?php if (!isset($record->password)) : ?>
                password: 'Vui lòng nhập thông tin Mật khẩu',
                <?php endif; ?>
            }
        });
    });

</script>