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
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    {{-- <script src="/resources/js/validation.js"></script> --}}
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <base href="{{asset('')}}">
    <!-- Styles -->
    <style>
        .container {
            margin-top:2%;
        }
        label.error {
        display: inline-block;
        color:red;
        font-style: italic;
        width: 200px;
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
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
    </div>
        <form action="./hoso" method="post" enctype="multipart/form-data" id="info">
            @csrf
            <div class="form-group">
                <div class="col-md-9">
                    <label>Họ Tên</label>
                    <input type="text" class="form-control" name="hoten" id="hoten" autocomplete="on">
                </div>
                <div class="col-md-3">
                    <label>Giới tính</label>
                    <select class="form-control" id="gioitinh" name="gioitinh">
                      <option value="0">Nam</option>
                      <option value="1">Nữ</option>
                    </select>
                </div>
            </div>
          <div class="form-group">
            <div class="col-md-4">
                <label>Ngày tháng năm sinh</label>
                <input type="date" class="form-control" name="ntns" id="ntns" autocomplete="on">
            </div>
            <div class="col-md-4">
                <label>Nơi sinh</label>
                <input type="text" class="form-control" name="noisinh" id="noisinh" autocomplete="on">
            </div>
            <div class="col-md-4">
                <label>Dân tộc</label>
                <input type="text" class="form-control" name="dantoc" id="dantoc" autocomplete="on">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4">
                <label>CMND</label>
                <input type="number" class="form-control" name="cmnd" id="cmnd" autocomplete="on">
            </div>
            <div class="col-md-4">
                <label>Ngày cấp</label>
                <input type="date" class="form-control" name="ngaycap" id="ngaycap">
            </div>
            <div class="col-md-4">
                <label>Nơi cấp</label>
                <input type="text" class="form-control" name="noicap" id="noicap" autocomplete="on">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
                <label>Hộ Khẩu</label>
                <input type="text" class="form-control" name="hokhau" id="hokhau" autocomplete="on">
            </div>
            <div class="col-md-4">
                <label>Mã tỉnh</label>
                <select class="form-control" id="matinh" name="matinh">
                    <option value="">---------</option>
                    @foreach ($data->provinces as $value)
                      <option value="{{ $value->code }}">{{ $value->code }} - {{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Mã huyện (quận)</label>
                <select class="form-control" id="mahuyen" readonly="readonly" name="mahuyen">
                  
                </select>
            </div>
            <div class="col-md-4">
                <label>Mã xã (phường) (nếu có)</label>
                <input type="text" class="form-control" name="maxa" id="maxa">
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
                <select class="form-control" id="lop10ten" name="lop10ten">
                  <option value="">---------</option>
                    @foreach ($data->highSchools as $value)
                      <option value="{{ $value->id }}|{{ $value->name }}">{{ $value->code }} - {{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Địa chỉ</label>
                <select class="form-control" id="lop10diachi" readonly="readonly" name="lop10diachi">
                  <option value="">---------</option>
                   
                </select>
            </div>
            <div class="col-md-2">
                <label>Mã tỉnh</label>
                <select class="form-control" id="lop10tinh" readonly="readonly" name="lop10tinh">
                  <option value=""
                  readonly="readonly">---------</option>
                
                </select>
            </div>
            <div class="col-md-2">
                <label>Mã trường</label>
                <select class="form-control" id="lop10truong" readonly="readonly" name="lop10truong">
                  <option value="" readonly="readonly">---------</option>
                </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">Lớp 11</div>
            <div class="col-md-4">
                <label>Tên trường</label>
                <select class="form-control" id="lop11ten" name="lop11ten">
                  <option value="">---------</option>
                    @foreach ($data->highSchools as $value)
                      <option value="{{ $value->id }}|{{ $value->name }}">{{ $value->code }} - {{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Địa chỉ</label>
                <select class="form-control" id="lop11diachi" readonly="readonly" name="lop11diachi">
                  <option value="">---------</option>
                   
                </select>
            </div>
            <div class="col-md-2">
                <label>Mã tỉnh</label>
                <select class="form-control" id="lop11tinh" readonly="readonly" name="lop11tinh">
                  <option value=""
                  readonly="readonly">---------</option>
                
                </select>
            </div>
            <div class="col-md-2">
                <label>Mã trường</label>
                <select class="form-control" id="lop11truong" readonly="readonly" name="lop11truong">
                  <option value="" readonly="readonly">---------</option>
                </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">Lớp 12</div>
            <div class="col-md-4">
                <label>Tên trường</label>
                <select class="form-control" id="lop12ten" name="lop12ten">
                  <option value="">---------</option>
                    @foreach ($data->highSchools as $value)
                      <option value="{{ $value->id }}|{{ $value->name }}">{{ $value->code }} - {{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Địa chỉ</label>
                <select class="form-control" id="lop12diachi" readonly="readonly" name="lop12diachi">
                  <option value="">---------</option>
                   
                </select>
            </div>
            <div class="col-md-2">
                <label>Mã tỉnh</label>
                <select class="form-control" id="lop12tinh" readonly="readonly" name="lop12tinh">
                  <option value=""
                  readonly="readonly">---------</option>
                
                </select>
            </div>
            <div class="col-md-2">
                <label>Mã trường</label>
                <select class="form-control" id="lop12truong" readonly="readonly" name="lop12truong">
                  <option value="" readonly="readonly">---------</option>
                </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6">
                <label>Điện thoại</label>
                <input type="number" class="form-control" name="sdt" id="sdt" autocomplete="on">
            </div>
            <div class="col-md-6">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email" autocomplete="on">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
                <label>Địa chỉ liên hệ</label>
                <input type="text" class="form-control" name="diachi" id="diachi" autocomplete="on">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4">
                <label>Năm tốt nghệp</label>
                <input type="number" class="form-control" name="namtotnghiep" id="namtotnghiep" autocomplete="on">
            </div>
            <div class="col-md-4">
                <label>Kv ưu tiên</label>
                <select class="form-control" id="kvuutien"  name="kvuutien" id="kvuutien">
                  <option value="KV1">KV1</option>
                  <option value="KV2">KV2</option>
                  <option value="KV2-NT">KV2-NT</option>
                  <option value="KV3">KV3</option>
                
                </select>
            </div>
            <div class="col-md-4">
                <label>Đối tượng ưu tiên (nếu có)</label>
                <select class="form-control" id="dtuutien"  name="dtuutien">
                  @for($i = 0; $i < 7; $i++)
                  <option value="{{ $i+1 }}">0{{ $i+1 }}</option>
                  @endfor
                
                </select>
            </div>
          </div>
          <div class="col-md-12">
              <h2>Thông tin đkxt</h2>
          </div>
          <div class="form-group">
              <div class="col-md-12"><b>Nguyện vọng 1</b></div>
              <div class="col-md-4">
                <label>Ngành/nhóm ngành/chuyên ngành</label>
                <select class="form-control" id="nganh1"  name="nganh1">
                  <option value="">---------</option>
                  @foreach ($nganhs as $nganh)
                      <option value="{{ $nganh->id }}">{{ $nganh->ten }}</option>
                  @endforeach
                
                </select>
              </div>
              <div class="col-md-4">
                <label>Mã xét tuyển</label>
                <input type="text" class="form-control" id="maxettuyen1" name="maxettuyen1" value="" readonly="readonly">
              </div>
              <div class="col-md-4">
                <label>Tổ hợp xét tuyển</label>
                <select class="form-control" id="tohopxettuyen1"  name="tohopxettuyen1" >
                      <option value="">---------</option>
                </select>
              </div>
            </div>
            <div class="col-md-12"><hr></div>
         <div class="form-group">
              <div class="col-md-12"><b>Nguyện vọng 2</b></div>
              <div class="col-md-4">
                <label>Ngành/nhóm ngành/chuyên ngành</label>
                <select class="form-control" id="nganh2"  name="nganh2">
                  <option value="">---------</option>
                  @foreach ($nganhs as $nganh)
                      <option value="{{ $nganh->id }}">{{ $nganh->ten }}</option>
                  @endforeach
                
                </select>
              </div>
              <div class="col-md-4">
                <label>Mã xét tuyển</label>
                <input type="text" class="form-control" id="maxettuyen2" name="maxettuyen2" value="" readonly="readonly">
              </div>
              <div class="col-md-4">
                <label>Tổ hợp xét tuyển</label>
                <select class="form-control" id="tohopxettuyen2"  name="tohopxettuyen2">
                  <option value="">---------</option>
                
                </select>
              </div>
            </div>
            <div class="col-md-12"><hr></div>
          <div class="form-group">
              <div class="col-md-12"><b>Nguyện vọng 3</b></div>
              <div class="col-md-4">
                <label>Ngành/nhóm ngành/chuyên ngành</label>
                <select class="form-control" id="nganh3"  name="nganh3">
                  <option value="">---------</option>
                  @foreach ($nganhs as $nganh)
                      <option value="{{ $nganh->id }}">{{ $nganh->ten }}</option>
                  @endforeach
                
                </select>
              </div>
              <div class="col-md-4">
                <label>Mã xét tuyển</label>
                <input type="text" class="form-control" id="maxettuyen3" name="maxettuyen3" value="" readonly="readonly">
              </div>
              <div class="col-md-4">
                <label>Tổ hợp xét tuyển</label>
                <select class="form-control" id="tohopxettuyen3"  name="tohopxettuyen3">
                  <option value="">---------</option>
                
                </select>
              </div>
            </div>
            <div class="col-md-12"><hr></div>
          <div class="col-md-12">
              </b>Điểm tb3 năm thpt</b>
          </div>
          <div class="form-group">
              <div class="col-md-12">Lớp 10</div>
              <div class="col-md-4">
                <label>Điểm tb môn 1</label>
                <input type="number" class="form-control" name="lop10diemtb1" id="lop10diemtb1">
              </div>
              <div class="col-md-4">
                <label>Điểm tb môn 2</label>
                <input type="number" class="form-control" name="lop10diemtb2" id="lop10diemtb2">
              </div>
              <div class="col-md-4">
                <label>Điểm tb môn 3</label>
                <input type="number" class="form-control" name="lop10diemtb3" id="lop10diemtb3">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">Lớp 11</div>
              <div class="col-md-4">
                <label>Điểm tb môn 1</label>
                <input type="number" class="form-control" name="lop11diemtb1" id="lop11diemtb1">
              </div>
              <div class="col-md-4">
                <label>Điểm tb môn 2</label>
                <input type="number" class="form-control" name="lop11diemtb2" id="lop11diemtb2">
              </div>
              <div class="col-md-4">
                <label>Điểm tb môn 3</label>
                <input type="number" class="form-control" name="lop11diemtb3" id="lop11diemtb3">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">Lớp 12</div>
              <div class="col-md-4">
                <label>Điểm tb môn 1</label>
                <input type="number" class="form-control" name="lop12diemtb1" id="lop12diemtb1">
              </div>
              <div class="col-md-4">
                <label>Điểm tb môn 2</label>
                <input type="number" class="form-control" name="lop12diemtb2" id="lop12diemtb2">
              </div>
              <div class="col-md-4">
                <label>Điểm tb môn 3</label>
                <input type="number" class="form-control" name="lop12diemtb3" id="lop12diemtb3">
              </div>
            </div>
          <div class="col-md-12"><hr></div>
          <div class="form-group">
            <label for="exampleFormControlFile1">Nộp kèm file minh chứng (ảnh chụp/scan: Phiếu ĐKXT, Học bạ hoặc Đơn xác nhận KQ học tập, Giấy xác nhận hưởng chế độ ưu tiên nếu có).
            Lưu ý: Chỉ chấp nhận file pdf, jpg, jpeg, png. Có thể đính kèm nhiều file</label>
            <input type="file" class="form-control" name="photos[]" multiple />
          </div>
          <div class="clo-md-12">
            <div class="col-md-1" style="margin-top:5px">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-md-2" style="margin-top:5px">
              <button onClick="window.location.reload();" class="btn btn-danger">Refresh Page</button>
            </div>
        </div>
        </form>
        <div class="col-md-12">
          <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
            <div class="container text-center">
              <small>Copyright &copy; Your Website</small>
            </div>
          </footer>
        </div>
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
           
              //console.log($('#lop10ten').val().split("|")[0]);
                $.ajax({
                    url : "./api/test1",
                    type : "get", 
                    dateType:"text", 
                    data : { 
                      ten : $('#lop10ten').val().split("|")[0]
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
                      ten : $('#lop11ten').val().split("|")[0]
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
                      ten : $('#lop12ten').val().split("|")[0]
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
            $('#nganh1').change(function(){
                $.ajax({
                    url : "./ajax/maxettuyen",
                    type : "get", 
                    dateType:"text", 
                    data : { 
                      id_nganh : $('#nganh1').val()
                    },
                    success : function (result){
                        console.log(result);
                        var result = result.split("|");
                        $('#maxettuyen1').val(result[0]);
                        $('#tohopxettuyen1').html(result[1]);
                    }
                    });
            })
            $('#nganh2').change(function(){
                $.ajax({
                    url : "./ajax/maxettuyen",
                    type : "get", 
                    dateType:"text", 
                    data : { 
                      id_nganh : $('#nganh2').val()
                    },
                    success : function (result){
                        console.log(result);
                        var result = result.split("|");
                        $('#maxettuyen2').val(result[0]);
                        $('#tohopxettuyen2').html(result[1]);
                    }
                    });
            })
            $('#nganh3').change(function(){
                $.ajax({
                    url : "./ajax/maxettuyen",
                    type : "get", 
                    dateType:"text", 
                    data : { 
                      id_nganh : $('#nganh3').val()
                    },
                    success : function (result){
                        console.log(result);
                        var result = result.split("|");
                        $('#maxettuyen3').val(result[0]);
                        $('#tohopxettuyen3').html(result[1]);
                    }
                    });
            })
        });

    </script>
    
</body>
</html>