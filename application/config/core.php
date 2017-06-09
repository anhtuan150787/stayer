<?php



/*

 *  Config Path, Url of picture upload

 */

$config['pic_path'] = './public/pictures/';

$config['pic_url'] = 'http://stayer/public/pictures/';



/*

 * Config captcha

 */

$config['captcha']['word'] = substr(str_shuffle('zxcvbnmasdfghjklqwertyuiop1234567890'), 0, 4);

$config['captcha']['img_path'] = './public/captcha/';

$config['captcha']['img_url'] = 'http://stayer/public/captcha/';

$config['captcha']['font_path'] = './public/captcha/fonts/gadugi.ttf';

$config['captcha']['img_width'] = 100;

$config['captcha']['img_height'] = 30;

$config['captcha']['expiration'] = 60;



/*

 * Config pagination

 */

$config['pagination']['base_url'] = '';

$config['pagination']['total_rows'] = '';

$config['pagination']['per_page'] = '';

$config['pagination']['full_tag_open'] = '<div class="pagination"><ul>';

$config['pagination']['full_tag_close'] = '</ul></div>';



$config['pagination']['cur_tag_open'] = '<li class="active"><a href="#">';

$config['pagination']['cur_tag_close'] = '</a></li>';

$config['pagination']['num_tag_open'] = '<li>';

$config['pagination']['num_tag_close'] = '</li>';

$config['pagination']['first_tag_open'] = '<li>';

$config['pagination']['first_tag_close'] = '</li>';

$config['pagination']['first_link'] = '<<';

$config['pagination']['last_tag_open'] = '<li>';

$config['pagination']['last_tag_close'] = '</li>';

$config['pagination']['last_link'] = '>>';



$config['pagination']['next_tag_open'] = '<li>';

$config['pagination']['next_link'] = 'Next';

$config['pagination']['next_tag_close'] = '</li>';



$config['pagination']['prev_tag_open'] = '<li>';

$config['pagination']['prev_link'] = 'Prev';

$config['pagination']['prev_tag_close'] = '</li>';



$config['pagination']['page_query_string'] = TRUE;



/*

 * Config pagination frontend

 */

$config['pagination_fr']['base_url'] = '';

$config['pagination_fr']['total_rows'] = '';

$config['pagination_fr']['per_page'] = '';

$config['pagination_fr']['full_tag_open'] = '<ul class="pagination">';

$config['pagination_fr']['full_tag_close'] = '</ul>';



$config['pagination_fr']['cur_tag_open'] = '<li class="active"><a href="#">';

$config['pagination_fr']['cur_tag_close'] = '</a></li>';

$config['pagination_fr']['num_tag_open'] = '<li>';

$config['pagination_fr']['num_tag_close'] = '</li>';

$config['pagination_fr']['first_tag_open'] = '<li>';

$config['pagination_fr']['first_tag_close'] = '</li>';

$config['pagination_fr']['first_link'] = 'Đầu';

$config['pagination_fr']['last_tag_open'] = '<li>';

$config['pagination_fr']['last_tag_close'] = '</li>';

$config['pagination_fr']['last_link'] = 'Cuối';



$config['pagination_fr']['next_tag_open'] = '<li>';

$config['pagination_fr']['next_link'] = '&raquo;';

$config['pagination_fr']['next_tag_close'] = '</li>';



$config['pagination_fr']['prev_tag_open'] = '<li>';

$config['pagination_fr']['prev_link'] = '&laquo;';

$config['pagination_fr']['prev_tag_close'] = '</li>';



$config['pagination_fr']['page_query_string'] = TRUE;



/*

 * Config pagination partner

 */

$config['pagination_partner']['base_url'] = '';

$config['pagination_partner']['total_rows'] = '';

$config['pagination_partner']['per_page'] = '';

$config['pagination_partner']['full_tag_open'] = '<ul class="pagination" style="float: right">';

$config['pagination_partner']['full_tag_close'] = '</ul>';



$config['pagination_partner']['cur_tag_open'] = '<li class="active"><a href="#">';

$config['pagination_partner']['cur_tag_close'] = '</a></li>';

$config['pagination_partner']['num_tag_open'] = '<li>';

$config['pagination_partner']['num_tag_close'] = '</li>';

$config['pagination_partner']['first_tag_open'] = '<li>';

$config['pagination_partner']['first_tag_close'] = '</li>';

$config['pagination_partner']['first_link'] = 'Đầu';

$config['pagination_partner']['last_tag_open'] = '<li>';

$config['pagination_partner']['last_tag_close'] = '</li>';

$config['pagination_partner']['last_link'] = 'Cuối';



$config['pagination_partner']['next_tag_open'] = '<li>';

$config['pagination_partner']['next_link'] = '&raquo;';

$config['pagination_partner']['next_tag_close'] = '</li>';



$config['pagination_partner']['prev_tag_open'] = '<li>';

$config['pagination_partner']['prev_link'] = '&laquo;';

$config['pagination_partner']['prev_tag_close'] = '</li>';



$config['pagination_partner']['page_query_string'] = TRUE;



/*

 *  Config upload image

 */

$config['upload_img']['allowed_types'] = 'gif|jpg|png';

$config['upload_img']['max_size'] = 1000;  //kilobytes

$config['upload_img']['max_width']  = 0;

$config['upload_img']['max_height']  = 0; 



/*

 *  Config Tinymce

 */

$config['tinymce']['upload_dir'] = '/public/pictures/';

$config['tinymce']['current_path'] = '../../../../pictures/';

$config['tinymce']['thumbs_base_path'] = '../../../../pictures/';

$config['tinymce']['filemanager_path'] = '/public/backend/js/tinymce/filemanager/';



/*

 *  Config send mail

 */

$config['sendmail']['protocol']  = 'smtp';

$config['sendmail']['smtp_host'] = 'ssl://smtp.googlemail.com';

$config['sendmail']['smtp_port'] = 465;

$config['sendmail']['smtp_user'] = 'azywebmail@gmail.com';

$config['sendmail']['smtp_pass'] = 'konokoshino2002';

$config['sendmail']['from_name'] = 'Azy.vn';

$config['sendmail']['mailtype']  = 'html';

$config['sendmail']['charset']   = 'utf-8';

$config['sendmail']['wordwrap']  = TRUE;