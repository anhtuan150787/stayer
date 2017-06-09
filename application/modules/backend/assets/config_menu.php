<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return array(
    //Group
    'Admin' => array(
        'name' => 'Admin',
        //Item
        'item' => array(
            //Nhom admin
            'admin_group' => array(
                'name' => 'Nhóm',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                ),
                'menu' => 1,
            ),
            //admin
            'admin' => array(
                'name' => 'Admin',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
        ),
    ),

    //Hotel
    'Hotel' => array(
        'name' => 'Khách sạn',
        //Item
        'item' => array(
            //Quan ly khach san
            'hotel' => array(
                'name' => 'Quản lý khách sạn',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
            //Quan ly loai phong khach san
            'Room_type' => array(
                'name' => 'Quản lý loại phòng',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 0,
            ),
            //Quan ly doi tac
            'partner' => array(
                'name' => 'Quản lý đối tác',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 0,
            ),
            //Quan ly thong tin chung khach san
            'hotel_info' => array(
                'name' => 'Thông tin chung khách sạn',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 0,
            ),
            //Quan ly khuyen mai
            'promotion' => array(
                'name' => 'Quản lý khuyến mãi',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 0,
            ),
            //Loai khach san
            'hotel_type' => array(
                'name' => 'Loại khách sạn',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
            //Tien nghi khach san
            'hotel_facilities' => array(
                'name' => 'Tiện nghi khách sạn',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
            //Tien nghi loai phong
            'room_type_facilities' => array(
                'name' => 'Tiện nghi loại phòng',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
            //Binh luan khach sạn
            'hotel_comment' => array(
                'name' => 'Bình luận',
                'permission' => array(
                    'index' => 'Quản lý',
                    'delete' => 'Xóa',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
            'hotel_order' => array(
                'name' => 'Quản lý đơn hàng',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Lấy đơn hàng',
                    'edit' => 'Cập nhật',
                    'change_user_process' => 'Chuyển đơn hàng'
                ),
                'menu' => 1,
            ),
            //Nhom doi tac
            'partner_group' => array(
                'name' => 'Nhóm đối tác',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                ),
                'menu' => 1,
            ),
            //doi tac
            'partner_list' => array(
                'name' => 'Đối tác',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
            //Nhóm ma giam gia
            'coupon_group' => array(
                'name' => 'Nhóm mã giảm giá',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
            //M giam gia
            'coupon' => array(
                'name' => 'Mã giảm giá',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
        ),
    ),

    //Tour
    'Tour' => array(
        'name' => 'Tour',
        //Item
        'item' => array(
            //Quan ly tour
            'tour' => array(
                'name' => 'Quản lý Tour',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
            //Dich vu
            'tour_service' => array(
                'name' => 'Dịch vụ',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),

            //Chu de
            'tour_topic' => array(
                'name' => 'Chủ đề',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
            //Tour comment
            'tour_comment' => array(
                'name' => 'Bình luận Tour',
                'permission' => array(
                    'index' => 'Quản lý',
                    'delete' => 'Xóa',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),

            //doi tac
            'partner_tour' => array(
                'name' => 'Nhà cung cấp',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),

            'tour_order' => array(
                'name' => 'Quản lý đơn hàng',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Lấy đơn hàng',
                    'edit' => 'Cập nhật',
                    'change_user_process' => 'Chuyển đơn hàng'
                ),
                'menu' => 1,
            ),
        ),
    ),
  
    //Group
    'Location' => array(
        'name' => 'Địa lý',
        //Item
        'item' => array(
            //Quoc gia
            'national' => array(
                'name' => 'Quốc gia',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
            //Vung/Mien
            'area' => array(
                'name' => 'Vùng miền',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
            //Tinh thanh
            'province' => array(
                'name' => 'Tỉnh thành',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                    'change_status_common' => 'Cập nhật phổ biến',
                ),
                'menu' => 1,
            ),
            //Quan huyen
            'district' => array(
                'name' => 'Quận/Huyện',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
            //Phuong xa
            'ward' => array(
                'name' => 'Phường/Xã',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
            //Khu vuc
            'geonear' => array(
                'name' => 'Khu vực',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
            //Địa danh
            'sight' => array(
                'name' => 'Địa danh',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
            //Bãi biển
            'beach' => array(
                'name' => 'Bãi biển',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
        ),
    ),
    //Group
    'Handbook' => array(
        'name' => 'Cẩm nang',
        //Item
        'item' => array(
            //Quan ly cam nang
            'handbook' => array(
                'name' => 'Bài viết',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
            //Chuyen muc
            'handbook_category' => array(
                'name' => 'Chuyên mục',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
        ),
    ),
    //Post
    'Post' => array(
        'name' => 'Nội dung',
        //Item
        'item' => array(
            //Danh muc tin tuc
            'post_category' => array(
                'name' => 'Danh mục bài viết',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
            //Quan ly tin tuc
            'post' => array(
                'name' => 'Bài viết',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
            //Quan ly trang noi dung
            'page' => array(
                'name' => 'Trang nội dung',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
        ),
    ),
    
    //Thanh vien
    'User' => array(
        'name' => 'Thành viên',
        //Item
        'item' => array(
            //Thanh vien
            'user' => array(
                'name' => 'Thành viên',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 1,
            ),
        ),
    ),

    //Giao dien
    'Display' => array(
        'name' => 'Giao diện',
        //Item
        'item' => array(
            //Loai giao dien
            'display_type' => array(
                'name' => 'Loại Giao diện',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                ),
                'menu' => 1,
            ),

            //Giao dien
            'display' => array(
                'name' => 'Giao diện',
                'permission' => array(
                    'index' => 'Quản lý',
                    'add' => 'Tạo',
                    'delete' => 'Xóa',
                    'edit' => 'Cập nhật',
                    'change_status' => 'Cập nhật trạng thái',
                ),
                'menu' => 0,
            ),
        ),
    ),
    
    //Thanh vien
    'Setting' => array(
        'name' => 'Cấu hình',
        //Item
        'item' => array(
            //Thanh vien
            'foreign_currency' => array(
                'name' => 'Tỷ giá USD',
                'permission' => array(
                    'index' => 'Quản lý',
                ),
                'menu' => 1,
            ),
        ),
    ),
);
