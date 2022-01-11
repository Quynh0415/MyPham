<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beauty Mona</title>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers h1 {
            align-items: center;
            color: #82ae46;
        }

        #customers tr td {
            text-align: center;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #82ae46;
            color: white;
        }

        .new {
            color: blue;
        }

        .process {
            color: orange;
        }

        .success {
            color: green;
        }

        .destroy {
            color: red;
        }
    </style>
</head>
<body>
<table id="customers">
    <h1>Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ giao hàng tới bạn trong thời gian sớm nhất.</h1>
    <p>Mã đơn hàng: {{$orderId}} </p>
    <p>Name: {{$name}} </p>
    <p>Email: {{$email}} </p>
    <p>Số điện thoại: {{$phone}} </p>
    <p>Địa chỉ: {{$address}} </p>
    <p>Thanh toán: {{number_format($total)}} VNĐ</p>

</table>
<h1>THÔNG TIN ĐƠN HÀNG</h1>
<table style="width: 100%">
    <thead>
    <tr>
        <th>Tên</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Tổng cộng</th>
    </tr>
    </thead>
    <tbody>
    @foreach($item as $key => $mail)
        <tr>
            <td>{{ $mail->name }}</td>
            <td>{{ number_format($mail->price) }} VNĐ</td>
            <td>{{ $mail->qty }}</td>
            <td>{{ number_format(($mail->price) * $mail->qty) }} VNĐ</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>

