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
      .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 1500px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption {
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
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
              <td>{{ $lop10->ten_truong }}</td>
              <th scope="row">Địa Chỉ:</th>
              <td>{{ $lop10->dia_chi }}</td>
              <th scope="row">Mã Trường:</th>
              <td>{{ $lop10->ma_truong  }}</td>
            </tr>
            <tr>
              <th scope="row">Điểm TB Môn 1:</th>
              <td>{{ $lop10->diem_mon1 }}</td>
              <th scope="row">Điểm TB Môn 2:</th>
              <td>{{ $lop10->diem_mon2 }}</td>
              <th scope="row">Điểm TB Môn 3:</th>
              <td>{{ $lop10->diem_mon3 }}</td>
            </tr>
            <tr>
              <th scope="row">Lớp 11</th>
            </tr>
            <tr>
              <th scope="row">Tên Trường:</th>
              <td>{{ $lop11->ten_truong }}</td>
              <th scope="row">Địa Chỉ:</th>
              <td>{{ $lop11->dia_chi }}</td>
              <th scope="row">Mã Trường:</th>
              <td>{{ $lop11->ma_truong }}</td>
            </tr>
            <tr>
              <th scope="row">Điểm TB Môn 1:</th>
              <td>{{ $lop11->diem_mon1 }}</td>
              <th scope="row">Điểm TB Môn 2:</th>
              <td>{{ $lop11->diem_mon2 }}</td>
              <th scope="row">Điểm TB Môn 3:</th>
              <td>{{ $lop11->diem_mon3 }}</td>
            </tr>
            <tr>
              <th scope="row">Lớp 12</th>
            </tr>
            <tr>
              <th scope="row">Tên Trường:</th>
              <td>{{ $lop12->ten_truong }}</td>
              <th scope="row">Địa Chỉ:</th>
              <td>{{ $lop12->dia_chi }}</td>
              <th scope="row">Mã Trường:</th>
              <td>{{ $lop12->ma_truong }}</td>
            </tr>
            <tr>
              <th scope="row">Điểm TB Môn 1:</th>
              <td>{{ $lop12->diem_mon1 }}</td>
              <th scope="row">Điểm TB Môn 2:</th>
              <td>{{ $lop12->diem_mon2 }}</td>
              <th scope="row">Điểm TB Môn 3:</th>
              <td>{{ $lop12->diem_mon3 }}</td>
            </tr>
            <?php $i = 0;  ?>
            @foreach($hoso->nganh as $nganh)
            <tr>
              <th scope="row">Nguyện Vọng 1</th>
            </tr>
            <tr>
              <th scope="row">Tên Ngành:</th>
              <td>{{ $nganh->ten }}</td>
              <th scope="row">Mã Ngành:</th>
              <td>{{ $nganh->ma_xet_tuyen }}</td>
              <th scope="row">Tổ Hợp:</th>  
              @if($hoso->to_hop != null)           
              <td>{{ explode("|",$hoso->to_hop)[$i] }}</td>
              @else
              <td>NULL</td>
              @endif
              </tr>
            <?php $i++ ?>
            @endforeach
            <tr>
              <th scope="row">Ảnh Học Bạ:</th>
            </tr>    
             <tr>                    
              @foreach($anhs = json_decode($hoso->anh_hoc_ba) as $anh)
             
              <td><img src="../photos/{{ $anh }}" width="100" class="myImg">
              </td>
              
              @endforeach   
              </tr>         
          </tbody>
        </table>
        <div class="col-md-12">Trạng thái hồ sơ:</div>
        @if($hoso->trang_thai === 0)
        <div class="alert alert-danger">
          <strong>Đang Chờ Duyệt</strong>
        </div>
        @elseif($hoso->trang_thai === 1)
        <div class="alert alert-success">
          <strong>Đã Duyệt</strong>
        </div>
        @endif
        
        <div class="btn btn-success"><a href="{{ route('formdk') }}" style="color: #fff">Về Trang Chủ>></a></div>
        <!-- The Modal -->
<div id="myModal" class="modal">

  <!-- The Close Button -->
  <span class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
    </div>
    <script>
      var modal = document.getElementById("myModal");
var i;

var img = document.getElementsByClassName("myImg");
var modalImg = document.getElementById("img01");

 for(i=0;i< img.length;i++)
   {    
    img[i].onclick = function(){

    modal.style.display = "block";
       modalImg.src = this.src;

 }
}

var span = document.getElementsByClassName("close")[0];


span.onclick = function() { 
   modal.style.display = "none";
}
    </script>
</body>
</html>