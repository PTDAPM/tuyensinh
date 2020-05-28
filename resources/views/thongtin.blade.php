<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Thông tin hồ sơ</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
      th {
        width:200px!important;
      }
    </style>
</head>
<body>
    <div class="cod-md-12" style="margin: 20px 10px">
        <h1>Thông Tin Hồ Sơ</h1>
    </div>
    <div class="content">
        <table class="table">
          <thead>
            <tr>
              <th scope="row">Họ Tên:</th>
              <td>{{ $hoso->ho_ten }}</td>
              <th scope="row">Giới Tính:</th>
              @if($hoso->gioi_tinh === 0)
              <td>Nam</td>
              @elseif($hoso->gioi_tinh === 1)
              <td>Nữ</td>
              @endif
              <th scope="row">Ngày Tháng Năm Sinh:</th>
              <td>{{ $hoso->ngay_thang_nam_sinh }}</td>
              <th scope="row">Nơi Sinh:</th>
              <td>{{ $hoso->noi_sinh }}</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Dân Tộc:</th>
              <td>{{ $hoso->dan_toc }}</td>
              <th scope="row">CMND:</th>
              <td>{{ $hoso->cmnd }}</td>
              <th scope="row">Ngày Cấp:</th>
              <td>{{ $hoso->ngay_cap }}</td>
              <th scope="row">Nơi Cấp:</th>
              <td>{{ $hoso->noi_cap }}</td>
            </tr>
            <tr>
              <th scope="row">Hộ Khẩu:</th>
              <td>{{ $hoso->ho_khau }}</td>
              <th scope="row">Mã Tỉnh:</th>
              <td>{{ $hoso->ma_tinh }}</td>
              <th scope="row">Mã Huyện:</th>
              <td>{{ $hoso->ma_huyen }}</td>
              <th scope="row">Mã Xã:</th>
              <td>{{ $hoso->ma_xa }}</td>
           </tr>
            <tr>
              <th scope="row">SĐT:</th>
              <td>{{ $hoso->sdt }}</td>
              <th scope="row">Email:</th>
              <td>{{ $hoso->email }}</td>
              <th scope="row">Địa Chỉ:</th>
              <td>{{ $hoso->dia_chi }}</td>
              <th scope="row">Năm Tốt Nghiệp:</th>
              <td>{{ $hoso->doi_tuong_uu_tien }}</td>
            </tr>
            <tr>
              <th scope="row">KV Ưu Tiên:</th>
              <td>{{ $hoso->kv_uu_tien }}</td>
              <th scope="row">Đối Tượng Ưu Tiên:</th>
              <td>{{ $hoso->nam_tot_nghiep }}</td>
            </tr>
            <tr>
              <th scope="row">Lớp 10</th>
            </tr>
            <tr>
              <th scope="row">Tên Trường:</th>
              <td>Larry</td>
              <th scope="row">Địa Chỉ:</th>
              <td>Larry</td>
              <th scope="row">Mã Trường:</th>
              <td>Larry</td>
            </tr>
            <tr>
              <th scope="row">Điểm TB Môn 1:</th>
              <td>Larry</td>
              <th scope="row">Điểm TB Môn 2:</th>
              <td>Larry</td>
              <th scope="row">Điểm TB Môn 3:</th>
              <td>Larry</td>
            </tr>
            <tr>
              <th scope="row">Lớp 11</th>
            </tr>
            <tr>
              <th scope="row">Tên Trường:</th>
              <td>Larry</td>
              <th scope="row">Địa Chỉ:</th>
              <td>Larry</td>
              <th scope="row">Mã Trường:</th>
              <td>Larry</td>
            </tr>
            <tr>
              <th scope="row">Điểm TB Môn 1:</th>
              <td>Larry</td>
              <th scope="row">Điểm TB Môn 2:</th>
              <td>Larry</td>
              <th scope="row">Điểm TB Môn 3:</th>
              <td>Larry</td>
            </tr>
            <tr>
              <th scope="row">Lớp 12</th>
            </tr>
            <tr>
              <th scope="row">Tên Trường:</th>
              <td>Larry</td>
              <th scope="row">Địa Chỉ:</th>
              <td>Larry</td>
              <th scope="row">Mã Trường:</th>
              <td>Larry</td>
            </tr>
            <tr>
              <th scope="row">Điểm TB Môn 1:</th>
              <td>Larry</td>
              <th scope="row">Điểm TB Môn 2:</th>
              <td>Larry</td>
              <th scope="row">Điểm TB Môn 3:</th>
              <td>Larry</td>
            </tr>
            <tr>
              <th scope="row">Nguyện Vọng 1</th>
            </tr>
            <tr>
              <th scope="row">Tên Ngành:</th>
              <td>Larry</td>
              <th scope="row">Mã Ngành:</th>
              <td>Larry</td>
              <th scope="row">Tổ Hợp:</th>
              <td>Larry</td>
            </tr>
            <tr>
              <th scope="row">Nguyện Vọng 2</th>
            </tr>
            <tr>
              <th scope="row">Tên Ngành:</th>
              <td>Larry</td>
              <th scope="row">Mã Ngành:</th>
              <td>Larry</td>
              <th scope="row">Tổ Hợp:</th>
              <td>Larry</td>
            </tr>
            <tr>
              <th scope="row">Nguyện Vọng 3</th>
            </tr>
            <tr>
              <th scope="row">Tên Ngành:</th>
              <td>Larry</td>
              <th scope="row">Mã Ngành:</th>
              <td>Larry</td>
              <th scope="row">Tổ Hợp:</th>
              <td>Larry</td>
            </tr>
            <tr>
              <th scope="row">Ảnh Học Bạ:</th>
            </tr>                        
              @foreach($anhs = json_decode($hoso->anh_hoc_ba) as $anh)
              <tr>
              <td colspan="4"><img src="../photos/{{ $anh }}" width="1200px"></td>
              </tr>
              @endforeach            
          </tbody>
        </table>
        <div class="col-md-12">Trạng thái hồ sơ:</div>
        <div class="alert alert-success">
          <strong>Đã Duyệt</strong>
        </div>
        <div class="alert alert-danger">
          <strong>Đang Chờ Duyệt</strong>
        </div>
        <div class="btn btn-success">Về Trang Chủ>></div>
    </div>
</body>
</html>