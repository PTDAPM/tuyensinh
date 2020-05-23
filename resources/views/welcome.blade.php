<?php
$data = file_get_contents("http://xettuyen.utc.edu.vn/api/enrollment");
$data = json_decode($data);
{{-- foreach ($data->provinces as $value) {
    echo $value->code;
} --}}
?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hồ sơ online</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"         integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"       integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <base href="{{asset('')}}">
    <!-- Styles -->
    <style>
        .container {
            margin-top:2%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="col-md-12"><h2>Nộp Hồ Sơ Trực Tuyến</h2></div>
        <hr><hr><hr>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
        <form action="./hoso" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="col-md-9">
                    <label>Họ Tên</label>
                    <input type="text" class="form-control" name="hoten">
                </div>
                <div class="col-md-3">
                    <label>Giới tính</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="gioitinh">
                      <option value="0">Nam</option>
                      <option value="1">Nữ</option>
                    </select>
                </div>
            </div>
          <div class="form-group">
            <div class="col-md-4">
                <label>Ngày tháng năm sinh</label>
                <input type="date" class="form-control" name="ntns">
            </div>
            <div class="col-md-4">
                <label>Nơi sinh</label>
                <input type="text" class="form-control" name="noisinh">
            </div>
            <div class="col-md-4">
                <label>Dân tộc</label>
                <input type="text" class="form-control" name="dantoc">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4">
                <label>CMND</label>
                <input type="text" class="form-control" name="cmnd">
            </div>
            <div class="col-md-4">
                <label>Ngày cấp</label>
                <input type="date" class="form-control" name="ngaycap">
            </div>
            <div class="col-md-4">
                <label>Nơi cấp</label>
                <input type="text" class="form-control" name="noicap">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
                <label>Hộ Khẩu</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Mã tỉnh</label>
                <select class="form-control" id="matinh">
                    <option value="">---------</option>
                    @foreach ($data->provinces as $value)
                      <option value="{{ $value->code }}">{{ $value->code }} - {{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Mã huyện (quận)</label>
                <select class="form-control" id="mahuyen" readonly="readonly">
                  
                </select>
            </div>
            <div class="col-md-4">
                <label>Mã xã (phường) (nếu có)</label>
                <input type="text" class="form-control">
            </div>
          </div>
          <div class="col-md-12">
              Nơi học THPT (Ghi tên trường và nơi trường đóng: huyện (quận), tỉnh (thành phố) và ghi mã tỉnh, mã trường)
              <hr>
          </div>
          <div class="form-group">
            <div class="col-md-12">Lớp 10</div>
            <div class="col-md-4">
                <label>Tên trường</label>
                <select class="form-control" id="lop10ten">
                  <option value="">---------</option>
                    @foreach ($data->highSchools as $value)
                      <option value="{{ $value->id }}">{{ $value->code }} - {{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Địa chỉ</label>
                <select class="form-control" id="lop10diachi" readonly="readonly">
                  <option value="">---------</option>
                   
                </select>
            </div>
            <div class="col-md-2">
                <label>Mã tỉnh</label>
                <select class="form-control" id="lop10tinh" readonly="readonly">
                  <option value=""
                  readonly="readonly">---------</option>
                
                </select>
            </div>
            <div class="col-md-2">
                <label>Mã trường</label>
                <select class="form-control" id="lop10truong" readonly="readonly">
                  <option value="" readonly="readonly">---------</option>
                </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">Lớp 11</div>
            <div class="col-md-4">
                <label>Tên trường</label>
                <select class="form-control" id="lop11ten">
                  <option value="">---------</option>
                    @foreach ($data->highSchools as $value)
                      <option value="{{ $value->id }}">{{ $value->code }} - {{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Địa chỉ</label>
                <select class="form-control" id="lop11diachi" readonly="readonly">
                  <option value="">---------</option>
                   
                </select>
            </div>
            <div class="col-md-2">
                <label>Mã tỉnh</label>
                <select class="form-control" id="lop11tinh" readonly="readonly">
                  <option value=""
                  readonly="readonly">---------</option>
                
                </select>
            </div>
            <div class="col-md-2">
                <label>Mã trường</label>
                <select class="form-control" id="lop11truong" readonly="readonly">
                  <option value="" readonly="readonly">---------</option>
                </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">Lớp 12</div>
            <div class="col-md-4">
                <label>Tên trường</label>
                <select class="form-control" id="lop12ten">
                  <option value="">---------</option>
                    @foreach ($data->highSchools as $value)
                      <option value="{{ $value->id }}">{{ $value->code }} - {{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Địa chỉ</label>
                <select class="form-control" id="lop12diachi" readonly="readonly">
                  <option value="">---------</option>
                   
                </select>
            </div>
            <div class="col-md-2">
                <label>Mã tỉnh</label>
                <select class="form-control" id="lop12tinh" readonly="readonly">
                  <option value=""
                  readonly="readonly">---------</option>
                
                </select>
            </div>
            <div class="col-md-2">
                <label>Mã trường</label>
                <select class="form-control" id="lop12truong" readonly="readonly">
                  <option value="" readonly="readonly">---------</option>
                </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6">
                <label>Điện thoại</label>
                <input type="number" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Email</label>
                <input type="email" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
                <label>Địa chỉ liên hệ</label>
                <input type="text" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4">
                <label>Năm tốt nghệp</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Kv ưu tiên</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Đối tượng ưu tiên</label>
                <input type="text" class="form-control">
            </div>
          </div>
          <div class="col-md-12">
              <h2>Thông tin đkxt</h2>
          </div>
          <div class="form-group">
            <div class="col-md-3">
                <label>NV1</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Ngành</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Mã</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Tổ hợp</label>
                <input type="text" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-3">
                <label>NV2</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Ngành</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Mã</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Tổ hợp</label>
                <input type="text" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-3">
                <label>NV3</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Ngành</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Mã</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Tổ hợp</label>
                <input type="text" class="form-control">
            </div>
          </div>
          <div class="col-md-12">
              Điểm tb3 năm thpt
              <hr>
          </div>
          <div class="form-group">
              <div class="col-md-12">Lớp 10</div>
              <div class="col-md-4">
                <label>Điểm tb môn 1</label>
                <input type="text" class="form-control">
              </div>
              <div class="col-md-4">
                <label>Điểm tb môn 2</label>
                <input type="text" class="form-control">
              </div>
              <div class="col-md-4">
                <label>Điểm tb môn 3</label>
                <input type="text" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">Lớp 11</div>
              <div class="col-md-4">
                <label>Điểm tb môn 1</label>
                <input type="text" class="form-control">
              </div>
              <div class="col-md-4">
                <label>Điểm tb môn 2</label>
                <input type="text" class="form-control">
              </div>
              <div class="col-md-4">
                <label>Điểm tb môn 3</label>
                <input type="text" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">Lớp 12</div>
              <div class="col-md-4">
                <label>Điểm tb môn 1</label>
                <input type="text" class="form-control">
              </div>
              <div class="col-md-4">
                <label>Điểm tb môn 2</label>
                <input type="text" class="form-control">
              </div>
              <div class="col-md-4">
                <label>Điểm tb môn 3</label>
                <input type="text" class="form-control">
              </div>
            </div>

          <div class="form-group">
            <label for="exampleFormControlFile1">Nộp kèm file minh chứng (ảnh chụp/scan: Phiếu ĐKXT, Học bạ hoặc Đơn xác nhận KQ học tập, Giấy xác nhận hưởng chế độ ưu tiên nếu có).
            Lưu ý: Chỉ chấp nhận file pdf, jpg, jpeg, png. Có thể đính kèm nhiều file</label>
            <input type="file" class="form-control" name="photos[]" multiple />
          </div>
          <div class="clo-md-12">
            <div class="col-md-1">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-md-1">
              <button onClick="window.location.reload();" class="btn btn-danger">Refresh Page</button>
            </div>
        </div>
        </form>
    </div>  
    @yield('script')
    <script>
         $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $( document ).ready(function() {
            $('#matinh').change(function(){
                $.ajax({
                    url : "./api/test",
                    type : "get", 
                    dateType:"text", 
                    data : { 
                         maTinh : $('#matinh').val()
                    },
                    success : function (result){
                        
                        $('#mahuyen').html(result);
                    }
                    });
                //http://xettuyen.utc.edu.vn/api/districts?province=52
            });
            $('#lop10ten').change(function(){
                $.ajax({
                    url : "./api/test1",
                    type : "get", 
                    dateType:"text", 
                    data : { 
                      ten : $('#lop10ten').val()
                    },
                    success : function (result){
                        var result = result.split("|");
                        console.log(result);
                        $('#lop10diachi').html(result[0]);
                        $('#lop10tinh').html(result[1]);
                        $('#lop10truong').html(result[2]);
                    }
                    });
            })
            $('#lop11ten').change(function(){
                $.ajax({
                    url : "./api/test1",
                    type : "get", 
                    dateType:"text", 
                    data : { 
                      ten : $('#lop11ten').val()
                    },
                    success : function (result){
                        var result = result.split("|");
                        console.log(result);
                        $('#lop11diachi').html(result[0]);
                        $('#lop11tinh').html(result[1]);
                        $('#lop11truong').html(result[2]);
                    }
                    });
            })
            $('#lop12ten').change(function(){
                $.ajax({
                    url : "./api/test1",
                    type : "get", 
                    dateType:"text", 
                    data : { 
                      ten : $('#lop12ten').val()
                    },
                    success : function (result){
                        var result = result.split("|");
                        console.log(result);
                        $('#lop12diachi').html(result[0]);
                        $('#lop12tinh').html(result[1]);
                        $('#lop12truong').html(result[2]);
                    }
                    });
            })
        });

    </script>
    
</body>
</html>