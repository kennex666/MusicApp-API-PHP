<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors', 0); // Tắt hiển thị lỗi
ini_set('display_startup_errors', 0); // Tắt hiển thị lỗi khởi động
error_reporting(0); // Tắt toàn bộ thông báo lỗi

echo json_encode(array(
	'errorCode' => 200,
	'message' => 'API',
	'data' => array(
		array(
			"id"=> "1",
			  "name"=> "Dữ Liệu Quý (EP)",
			  "artists"=> [
				[
				  "name"=> "Dương Domic",
				  "link"=> "/nghe-si/Duong-Domic"
				]
			  ],
			  "image"=> "https://photo-resize-zmp3.zmdcdn.me/w165_r1x1_jpeg/cover/8/c/1/6/8c166e2b9a0e45ca9a6c7bef40a81f74.jpg",
			  "type"=> "album",
			  "url"=> "https://dtbao.io.vn/audio/imhiding.mp3",
			  "duration"=> "03:27"
		)
	)
),true);
?>
	