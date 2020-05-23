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
			$exe_flg = true;
			foreach($files as $file) {
				$extension = $file->getClientOriginalExtension();
				$check=in_array($extension,$allowedfileExtension);

				if(!$check) {
					$exe_flg = false;
					break;
				}
			} 
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
	public function getHuyen(Request $request) {
		$data = file_get_contents('http://xettuyen.utc.edu.vn/api/districts?province='.$request->maTinh);
		$data = json_decode($data);
		foreach ($data as $value) {
			echo "<option value='".$value->code."'>".$value->name."</option>";
		}
	}
	public function getTruong(Request $request) {
		$arr_dt = array();
		$data = file_get_contents('http://xettuyen.utc.edu.vn/api/enrollment');
		$data = json_decode($data);
		foreach ($data->highSchools as $value) {
			array_push($arr_dt, array('id' => $value->id, 'districtCode' => $value->districtCode,'address' =>$value->address, 'provinceCode' => $value->provinceCode,  'code' => $value->code));
		}

		// echo $request->ten;
		// echo "<pre>";
		// print_r($arr_dt);
		// echo "</pre>";
		foreach ($arr_dt as $value) {
			if($value['id'] == $request->ten)
			{
				print_r($value);
				echo "<option value=".$value['districtCode'].">".$value['address']."</option>|<option value=".$value['provinceCode'].">".$value['provinceCode']."</option>|<option value=".$value['code'].">".$value['code']."</option>";
				break;
			}
			// echo "<pre>";
			// print_r($value['id']);
			// echo "</pre>";
		}
		
	}













    
	
}
