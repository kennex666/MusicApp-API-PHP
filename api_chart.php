<?php
header('Content-Type: text/html; charset=utf-8');

// URL cần crawl
$url = "http://mp3.zing.vn/xhr/chart-realtime?songId=0&videoId=0&albumId=0&chart=song&time=-1";

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
$songData = array();

if ($data['err'] === 0 && isset($data['data']['song'])) {
    $songs = $data['data']['song'];
    foreach ($songs as $song) {
		$songData[] = array(
			'id' => $song['id'],
			'name' => $song['name'],
			'artist' => $song['artists_names'],
			'duration' => gmdate("i:s", $song['duration']),
			'image' => $song['thumbnail']
		);
       
    }
	 echo json_encode(array(
		'errorCode' => 200,
		'message' => 'Thành công',
		'data' => $songData
	),true);
} else {
    echo json_encode(array(
		'errorCode' => 404,
		'message' => 'API không phản hồi'
	),true);
}
?>
