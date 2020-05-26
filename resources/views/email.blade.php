<!DOCTYPE html>
<html>
<head>
 <title>Laravel Send Email Example</title>
</head>
<body>
 
 <h1>Xác nhận đăng ký online</h1>
 <p>Xin chào <b>{{ $name }}<b></p>
 <p>Chúng tôi đã nhận được hồ sơ đăng ký xét tuyển trực tiếp của bạn vào trường Đại Học Thuỷ Lợi</p>
 <p>vui lòng quét mã QR sau để kiểm tra thông tin cũng như trạng thái hồ sơ của bạn. Xin cảm ơn</p>
 <p><img src="{{ $link }}" alt="ma qr link"></p>
 
</body>
</html> 