<?php
header('Content-type: text/html; charset=utf-8');

function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

session_start();

if (!isset($_SESSION['id_user'])) {
    echo "<p>Bạn chưa đăng nhập!</p>";
    return;
}

if (!isset($_GET['dh_id'])) {
    echo "<p>Thiếu mã đơn hàng!</p>";
    return;
}

$id_user = $_SESSION['id_user'];
$id_donhang = intval($_GET['dh_id']);

$conn = new mysqli("localhost", "root", "Shatou5114", "baitaplon");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
$query = "SELECT dh_tongtien, dh_trangthai FROM donhang WHERE user_id = '$id_user' AND dh_id = '$id_donhang'";
$result = $conn->query($query);

$totalAmount = 0;

if ($result && $row = $result->fetch_assoc()) {
    if ($row['dh_trangthai'] == 'Da_thanh_toan') {
        header('Location: ../PHP/Camon.php');
        exit();
    }
    $totalAmount = $row['dh_tongtien'];
} else {
    echo "<p>Không tìm thấy đơn hàng!</p>";
    return;
}

$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
$orderInfo = "Thanh toán qua QR MoMo";
$amount = $totalAmount;
$orderId = time() . "";
$requestId = time() . "";
$redirectUrl = "http://localhost/BAO%20CAO%20BAI%20TAP%20LON%20NHOM%2028/PHP/User_dsdonhang.php";
$ipnUrl = $redirectUrl;
$extraData = strval($id_donhang);
//loai thanh toan
$requestType = "captureWallet";

$rawHash = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";
$signature = hash_hmac("sha256", $rawHash, $secretKey);

$data = array(
    'partnerCode' => $partnerCode,
    'partnerName' => "Test",
    "storeId" => "MomoTestStore",
    'requestId' => $requestId,
    'amount' => $amount,
    'orderId' => $orderId,
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'lang' => 'vi',
    'extraData' => $extraData,
    'requestType' => $requestType,
    'signature' => $signature
);

$result = execPostRequest($endpoint, json_encode($data));
$jsonResult = json_decode($result, true);
if (!empty($jsonResult['payUrl'])) {
    header('Location: ' . $jsonResult['payUrl']);
    exit();
} else {
    echo "<p>Không lấy được liên kết thanh toán từ MoMo.</p>";
    echo "<pre>";
    print_r($jsonResult);
    echo "</pre>";
}
?>
