<?php
/**
 * Created by PhpStorm.
 * User: archl
 * Date: 7/28/2020
 * Time: 4:19 PM
 */

return [
    'name' => [
        'required' => 'Tên không được để trống',
        'max' => 'Tối đa 255 ký tự',
        'string' => 'Dữ liệu không hợp lệ',
    ],

    'email' => [
        'required' => 'Email không được để trống',
        'unique' => 'Email đã tồn tại',
        'email' => 'Dữ liệu nhập không hợp lệ',
    ],

    'password' => [
        'max' => 'Tối đa 255 ký tự',
        'min' => 'Tối thiểu 8 ký tự',
        'required' => 'Password không được để trống',
    ],

    'role' => [
        'max' => 'Tối đa 2 ký tự',
        'required' => 'Role không được để trống',
        'numeric' => 'Dữ liệu nhập không hợp lệ',
        'bool' => 'Dữ liệu nhập không hợp lệ',
    ],

    'controller' => [
        'store' => 'Thêm mới :name thành công !',
        'update' => 'Sửa :name thành công !',
        'softDelete' => ':name đã được chuyền vào thùng rác !',
        'restore' => 'Khôi phục :name thành công !',
        'delete' => 'Xóa :name thành công !',
    ],
];
