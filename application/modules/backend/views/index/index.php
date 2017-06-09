<style>
	.stats>li .details {
		margin-left: 50px;
	}

	.stats>li {
		margin-top: 10px !important;
	}
</style>

<div class="row-fluid">
    <div class="span12" style="padding-top: 20px">
		<ul class="stats">
			<li class="blue">
				<i class="icon-home"></i>
				<div class="details">
					<span class="big"><?php echo $hotel_count_all;?></span>
					<span>Khách sạn</span>
				</div>
			</li>
			<li class="green">
				<i class="icon-user"></i>
				<div class="details">
					<span class="big"><?php echo $user_count_all;?></span>
					<span>Thành viên</span>
				</div>
			</li>
			<li class="orange">
				<i class="icon-shopping-cart"></i>
				<div class="details">
					<span class="big"><?php echo $order_count_all;?></span>
					<span>Đặt phòng</span>
				</div>
			</li>
			<li class="teal">
				<i class="icon-comment-alt"></i>
				<div class="details">
					<span class="big"><?php echo $comment_count_all;?></span>
					<span>Bình luận</span>
				</div>
			</li>
			<li class="pink">
				<i class="icon-file-alt"></i>
				<div class="details">
					<span class="big"><?php echo $handbook_count_all;?></span>
					<span>Cẩm nang</span>
				</div>
			</li>
		</ul>
		
	</div>
</div>