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
                    <label for="textfield" class="control-label">Tên</label>
                    <div class="controls">
                        <input type="text" <?php echo (isset($record->name)) ? 'disabled="disabled"' : '';?> name="name" id="name" class="input-xlarge" value="<?php echo (isset($record->name)) ? html_escape($record->name) : ""; ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label for="textfield" class="control-label">Số điện thoại</label>
                    <div class="controls">
                        <input type="text" <?php echo (isset($record->phone)) ? 'disabled="disabled"' : '';?> name="phone" id="phone" class="input-xlarge" value="<?php echo (isset($record->phone)) ? html_escape($record->phone) : ""; ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label for="textfield" class="control-label">Email</label>
                    <div class="controls">
                        <input type="text" <?php echo (isset($record->email)) ? 'disabled="disabled"' : '';?> name="email" id="email" class="input-xlarge" value="<?php echo (isset($record->email)) ? html_escape($record->email) : ""; ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label for="textfield" class="control-label">Mật khẩu</label>
                    <div class="controls">
                        <input type="password" name="password" id="password" class="input-xlarge" value="">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Trạng thái</label>
                    <div class="controls">
                        <label class='radio'>
                            <input <?php echo (isset($record->status) && $record->status == 1) ? 'checked="checked"' : ''; ?> type="radio" name="status" value="1" checked="checked"> Hiển thị
                        </label>
                        <label class='radio'>
                            <input <?php echo (isset($record->status) && $record->status == 0) ? 'checked="checked"' : ''; ?> type="radio" name="status" value="0"> Ẩn
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
            email: {
                        required : true,
                        email : true,
                    },
    <?php if (!isset($record->password)) : ?>
            password: 'required',
    <?php endif; ?>
        
        },
        messages: {
            name: 'Vui lòng nhập thông tin Tên',
            email: {
                required: 'Vui lòng nhập thông tin Email',
                email: 'Email không hợp lệ'
            },
<?php if (!isset($record->password)) : ?>
            password: 'Vui lòng nhập thông tin Mật khẩu',
<?php endif; ?>
        }
    });
    });

</script>