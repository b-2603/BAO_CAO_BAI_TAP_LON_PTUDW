<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chạy Đi Shop</title>
    <style>
        body {
            background: linear-gradient(to right, #1f1c2c, #928dab);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 50px 40px;
            max-width: 480px;
            width: 90%;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .icon {
            font-size: 60px;
            color: #2ecc71;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 26px;
            margin-bottom: 15px;
            color: #ffffff;
            font-weight: 600;
        }

        p {
            font-size: 17px;
            line-height: 1.6;
            color: #dddddd;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 28px;
            background: #2ecc71;
            color: #1f1c2c;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #27ae60;
            transform: translateY(-2px);
        }
    </style>
    <link rel="stylesheet" href="../CSS/luxe.css">
</head>
<body>
    <div class="container">
        <div class="icon">✔️</div>
        <h1>Thanh toán thành công</h1>
        <p>Cảm ơn bạn đã tin tưởng lựa chọn dịch vụ của chúng tôi.<br>Thông tin đơn hàng đã được ghi nhận.</p>
        <a href="User_dsdonhang.php" class="btn">Xem đơn hàng</a>
    </div>
</body>
</html>




