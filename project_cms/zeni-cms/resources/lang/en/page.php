<?php
/**
 * Created by PhpStorm.
 * User: archl
 * Date: 7/28/2020
 * Time: 4:19 PM
 */

return [
    'title' => [
        'required' => 'Tiêu đề không được để trống',
        'max' => 'Tối đa 255 ký tự',
        'string' => 'Dữ liệu không hợp lệ',
        'unique' => 'Pages đã tồn tại',
    ],

    'content' => [
        'required' => 'Mô tả không được để trống',
    ],

];