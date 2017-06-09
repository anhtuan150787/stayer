<!-- Content -->
<div class="container content">
    <div class="row page">
    	<!-- Breadcrumbs -->
        <div class="col-lg-12 breadcrumbs">
            <ol class="breadcrumb">
            	<?php foreach($breadcrumbs as $k => $v):?>
                <li><a href="<?php echo $v;?>"><?php echo $k;?></a></li>
                <?php endforeach;?>
            </ol>
        </div>
        <!-- End Breadcrumbs -->

		<!-- Left -->
		<div class="col-lg-3 left">
		    <div class="left-col-wrap">
		        <ul>
					<?php if (checkShowPage(8)){?><li><a <?php echo ($this->input->get('id') == 8) ? 'class="active"' : '';?> href="<?php echo show_link(8, 'Giới thiệu', 'page');?>">Giới thiệu</a></li><?php }?>
					<?php if (checkShowPage(10)){?><li><a <?php echo ($this->input->get('id') == 10) ? 'class="active"' : '';?> href="<?php echo show_link(10, 'Điều kiện & điều khoản', 'page');?>" class="">Điều kiện &amp; điều khoản</a></li><?php }?>
					<?php if (checkShowPage(11)){?><li><a <?php echo ($this->input->get('id') == 11) ? 'class="active"' : '';?> href="<?php echo show_link(11, 'Chính sách riêng tư', 'page');?>" class="">Chính sách riêng tư</a></li><?php }?>
					<?php if (checkShowPage(12)){?><li><a <?php echo ($this->input->get('id') == 12) ? 'class="active"' : '';?> href="<?php echo show_link(12, 'Chính sách bảo mật', 'page');?>" class="">Chính sách bảo mật</a></li><?php }?>
					<?php if (checkShowPage(9)){?><li><a <?php echo ($this->input->get('id') == 9) ? 'class="active"' : '';?> href="<?php echo show_link(9, 'Tuyển dụng', 'page');?>" class="">Tuyển dụng</a></li><?php }?>
					<?php if (checkShowPage(13)){?><li><a <?php echo ($this->input->get('id') == 13) ? 'class="active"' : '';?> href="<?php echo show_link(13, 'Hỗ trợ', 'page');?>" class="">Hỗ trợ</a></li><?php }?>
					<?php if (checkShowPage(14)){?><li><a <?php echo ($this->input->get('id') == 14) ? 'class="active"' : '';?> href="<?php echo show_link(14, 'Liên hệ', 'page');?>" class="">Liên hệ</a></li><?php }?>
		        </ul>
		    </div>
		</div>
		<!-- End Left -->

		<div class="col-lg-9 right">
		    <div class="right-col-wrap"> 
				<div class="title"><?php echo html_escape($record->name);?></div>
				<div class="content">
					<?php echo $record->content;?> 
				</div>
		    </div>
		</div>
    </div>
</div>