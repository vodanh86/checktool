<?php

namespace App\Admin\Controllers;

abstract class Constant
{
    const DEVICE_TYPE = array("iPhone" => "iPhone", "Android" => "Android");
    const STATUS = array("1" => "Hỗ trợ", "0" => "Không hỗ trợ");
    const PHONE_STATUS = array("0" => "Mới tạo", "1" => "Chờ lấy hàng", "2" => "Đang vận chuyển", "3" => "Đã tới kho", "4" => "Kiểm tra máy", "5" => "Chờ thanh toán", "6" => "Thanh toán", "7" => "Kết thúc");
    const BATTERY_STATUS = array("1" => "Tốt", "2" => "Bình thường", "3"=>"Không tốt");
    const SCREEN_STATUS = array("1" => "Tốt", "2" => "Bình thường", "3"=>"Không tốt");
    const CASE_STATUS = array("1" => "Tốt", "2" => "Bình thường", "3"=>"Không tốt");
    const KEYBOARD_STATUS = array("1" => "Tốt", "2" => "Bình thường", "3"=>"Không tốt");
    const DIAPHRAGM_STATUS = array("1" => "Tốt", "2" => "Bình thường", "3"=>"Không tốt");
}
