<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
	public function luuHoso(Request $request) {
		echo $request->hoten."<br>";
		echo $request->gioitinh."<br>";
		echo $request->ntns."<br>";
		echo $request->noisinh."<br>";
		echo $request->dantoc."<br>";
		echo $request->cmnd."<br>";
		echo $request->ngaycap."<br>";
		echo $request->noicap."<br>";
		//echo $request->hoten."<br>";
		//echo $request->hoten."<br>";
		// xu lý upload anh
		$this->validate($request, [
			'photos'=>'required',]
		);
        // kiểm tra có files sẽ xử lý
		if($request->hasFile('photos')) {
			$allowedfileExtension=['jpg','png','jpeg','pdf'];
			$files = $request->file('photos');
            // flag xem có thực hiện lưu DB không. Mặc định là có
			$exe_flg = true;
			// kiểm tra tất cả các files xem có đuôi mở rộng đúng không
			foreach($files as $file) {
				$extension = $file->getClientOriginalExtension();
				$check=in_array($extension,$allowedfileExtension);

				if(!$check) {
                    // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
					$exe_flg = false;
					break;
				}
			} 
			// nếu không có file nào vi phạm validate thì tiến hành lưu DB
			if($exe_flg) {
				foreach ($request->photos as $photo) {
					$filename = $photo->store('photos');
				//chuyển file vào mục images
					$photo->move(public_path('images'),$filename);
				//Lưu db
					////////////////
					////////////////
				}
				echo "Upload successfully";
			} else {
				echo "Falied to upload. Only accept jpg, png, jpeg, pdf photos.";
			}
		}
		
		
	}













    public function uploadForm()
	{
		return view('image');
	}

	public function uploadSubmit(Request $request)
	{
		$this->validate($request, [
			'photos'=>'required',]
		);
        // kiểm tra có files sẽ xử lý
		if($request->hasFile('photos')) {
			$allowedfileExtension=['jpg','png','jpeg'];
			$files = $request->file('photos');
            // flag xem có thực hiện lưu DB không. Mặc định là có
			$exe_flg = true;
			// kiểm tra tất cả các files xem có đuôi mở rộng đúng không
			foreach($files as $file) {
				$extension = $file->getClientOriginalExtension();
				$check=in_array($extension,$allowedfileExtension);

				if(!$check) {
                    // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
					$exe_flg = false;
					break;
				}
			} 
			// nếu không có file nào vi phạm validate thì tiến hành lưu DB
			if($exe_flg) {
				foreach ($request->photos as $photo) {
					$filename = $photo->store('photos');
				//chuyển file vào mục images
					$photo->move(public_path('images'),$filename);
				//Lưu db
					////////////////
					////////////////
				}
				echo "Upload successfully";
			} else {
				echo "Falied to upload. Only accept jpg, png, jpeg photos.";
			}
		}
	}
}
