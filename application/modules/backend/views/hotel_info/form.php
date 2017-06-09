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
            <div class="box-content nopadding">
                <?php echo form_open('', array('class' => 'form-horizontal form-column', 'autocomplete' => 'off', 'method' => 'post', 'id' => 'frm')); ?>
                <div class="span6">
                    <div class="control-group">
                        <label for="textfield" class="control-label"><strong>Thông tin khách sạn</strong></label>
                        <div class="controls">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Tên tài khoản ngân hàng</label>
                        <div class="controls">
                            <input type="text" name="bank_account" id="bank_account" class="input-xlarge" value="<?php echo (isset($record->bank_account)) ? html_escape($record->bank_account) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Tên ngân hàng</label>
                        <div class="controls">
                            <input type="text" name="bank_name" id="bank_name" class="input-xlarge" value="<?php echo (isset($record->bank_name)) ? html_escape($record->bank_name) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Chi nhánh ngân hàng</label>
                        <div class="controls">
                            <input type="text" name="bank_branch" id="bank_branch" class="input-xlarge" value="<?php echo (isset($record->bank_branch)) ? html_escape($record->bank_branch) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Số tài khoản</label>
                        <div class="controls">
                            <input type="text" name="account_number" id="account_number" class="input-xlarge" value="<?php echo (isset($record->account_number)) ? html_escape($record->account_number) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Mã số thuế</label>
                        <div class="controls">
                            <input type="text" name="mst" id="mst" class="input-xlarge" value="<?php echo (isset($record->mst)) ? html_escape($record->mst) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Điện thoại</label>
                        <div class="controls">
                            <input type="text" name="phone" id="phone" class="input-xlarge" value="<?php echo (isset($record->phone)) ? html_escape($record->phone) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Email</label>
                        <div class="controls">
                            <input type="text" name="email" id="email" class="input-xlarge" value="<?php echo (isset($record->email)) ? html_escape($record->email) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Website</label>
                        <div class="controls">
                            <input type="text" name="website" id="website" class="input-xlarge" value="<?php echo (isset($record->website)) ? html_escape($record->website) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Fax</label>
                        <div class="controls">
                            <input type="text" name="fax" id="fax" class="input-xlarge" value="<?php echo (isset($record->fax)) ? html_escape($record->fax) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label"><strong>Thông tin sale</strong></label>
                        <div class="controls">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Tên</label>
                        <div class="controls">
                            <?php echo $user_hotel->name;?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Email</label>
                        <div class="controls">
                            <?php echo $user_hotel->email;?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Điện thoại</label>
                        <div class="controls">
                            <?php echo $user_hotel->phone;?>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="control-group">
                        <label for="textfield" class="control-label"><strong>Bộ phận quản lý</strong></label>
                        <div class="controls">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Tên</label>
                        <div class="controls">
                            <input type="text" name="manager_name" id="manager_name" class="input-xlarge" value="<?php echo (isset($record->manager_name)) ? html_escape($record->manager_name) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Email</label>
                        <div class="controls">
                            <input type="text" name="manager_email" id="manager_email" class="input-xlarge" value="<?php echo (isset($record->manager_email)) ? html_escape($record->manager_email) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Điện thoại</label>
                        <div class="controls">
                            <input type="text" name="manager_phone" id="manager_phone" class="input-xlarge" value="<?php echo (isset($record->manager_phone)) ? html_escape($record->manager_phone) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label"><strong>Bộ phận kinh doanh</strong></label>
                        <div class="controls">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Tên</label>
                        <div class="controls">
                            <input type="text" name="business_name" id="business_name" class="input-xlarge" value="<?php echo (isset($record->business_name)) ? html_escape($record->business_name) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Email</label>
                        <div class="controls">
                            <input type="text" name="business_email" id="business_email" class="input-xlarge" value="<?php echo (isset($record->business_email)) ? html_escape($record->business_email) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Điện thoại</label>
                        <div class="controls">
                            <input type="text" name="business_phone" id="business_phone" class="input-xlarge" value="<?php echo (isset($record->business_phone)) ? html_escape($record->business_phone) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label"><strong>Bộ phận đặt phòng</strong></label>
                        <div class="controls">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Tên</label>
                        <div class="controls">
                            <input type="text" name="booking_name" id="booking_name" class="input-xlarge" value="<?php echo (isset($record->booking_name)) ? html_escape($record->booking_name) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Email</label>
                        <div class="controls">
                            <input type="text" name="booking_email" id="booking_email" class="input-xlarge" value="<?php echo (isset($record->booking_email)) ? html_escape($record->booking_email) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Điện thoại</label>
                        <div class="controls">
                            <input type="text" name="booking_phone" id="booking_phone" class="input-xlarge" value="<?php echo (isset($record->booking_phone)) ? html_escape($record->booking_phone) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label"><strong>Bộ phận kế toán</strong></label>
                        <div class="controls">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Tên</label>
                        <div class="controls">
                            <input type="text" name="accountant_name" id="accountant_name" class="input-xlarge" value="<?php echo (isset($record->accountant_name)) ? html_escape($record->accountant_name) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Email</label>
                        <div class="controls">
                            <input type="text" name="accountant_email" id="accountant_email" class="input-xlarge" value="<?php echo (isset($record->accountant_email)) ? html_escape($record->accountant_email) : ""; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Điện thoại</label>
                        <div class="controls">
                            <input type="text" name="accountant_phone" id="accountant_phone" class="input-xlarge" value="<?php echo (isset($record->accountant_phone)) ? html_escape($record->accountant_phone) : ""; ?>">
                        </div>
                    </div>
                </div>
                <div class="span12">
                    <div class="form-actions">
                        <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>" />
                        <button type="submit" class="btn btn-primary"><?php echo $action_name; ?></button>
                    </div>
                </div>    
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>