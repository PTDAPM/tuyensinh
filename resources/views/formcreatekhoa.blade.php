<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Thêm Khoa</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<h1>Thêm Khoa</h1>
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>Vui lòng nhập đầy đủ thông tin</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		@if (session('status'))
		    <div class="alert alert-success">
		        {{ session('status') }}
		    </div>
		@endif
		<form method="post" action="{{ route('savek') }}" enctype="multipart/form-data">
			@csrf
		  <div class="form-group">
		    <label>Tên Khoa</label>
		    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nhập tên" name="ten">
		  </div>
		  <div class="form-group">
		    <label for="">Chọn Ảnh</label>
		    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="anh">
		  </div>
		  <div class="form-group">
  			<label for="comment">Giới Thiệu</label>
  			<textarea class="form-control ckeditor" rows="5" id="comment" placeholder="Nhập nội dung" name="noidung"></textarea>
			</div>
			<div class="form-group">
		    <label>Số SV</label>
		    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Nhập Số SV" name="sosv">
		  </div>
		  
		  <button type="submit" class="btn btn-primary">Submit</button>
		  <button type="button" class="btn btn-danger" onclick="window.location='./'">Quay Lại</button>
		</form>
	</div>
	<script type="text/javascript" language="javascript" src="/public/ckeditor/ckeditor.js" ></script>
</body>
</html>