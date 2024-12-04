<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors', 0); // Tắt hiển thị lỗi
ini_set('display_startup_errors', 0); // Tắt hiển thị lỗi khởi động
error_reporting(0); // Tắt toàn bộ thông báo lỗi
// URL cần crawl
$url = "https://674fc7b5bb559617b27011d2.mockapi.io/api/musicapp/saved/". $_GET['id'];

// Khởi tạo cURL
$ch = curl_init();

// Cấu hình cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Tắt kiểm tra chứng chỉ SSL

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Theo dõi chuyển hướng
curl_setopt($ch, CURLOPT_MAXREDIRS, 5); // Giới hạn số lần chuyển hướng
curl_setopt($ch, CURLOPT_ENCODING, ''); // Hỗ trợ tất cả các kiểu nén dữ liệu


// Thực thi cURL
$response = curl_exec($ch);

// Kiểm tra lỗi
if (curl_errno($ch)) {
    echo "Lỗi cURL: " . curl_error($ch);
    curl_close($ch);
    exit();
}

// Đóng kết nối cURL
curl_close($ch);
// Chuyển đổi JSON về mảng PHP
$data = json_decode($response, true, 512, JSON_UNESCAPED_UNICODE);


// Kiểm tra nếu dữ liệu hợp lệ

if (isset($data['data'])) {
    $song = $data['data'];
	 echo json_encode(array(
		'errorCode' => 200,
		'message' => 'Thành công',
		'data' => $song
	),true);
} else {
    echo json_encode(array(
		'errorCode' => 404,
		'message' => 'API không phản hồi'
	),true);
}
?>
