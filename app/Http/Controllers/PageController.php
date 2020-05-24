<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nganh;

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
		echo $request->hokhau."<br>";
		echo $request->matinh."<br>";
		echo $request->mahuyen."<br>";
		echo $request->maxa."<br>";
		echo $request->lop10ten."<br>";
		echo $request->lop10diachi."<br>";
		echo $request->lop10tinh."<br>";
		echo $request->lop10truong."<br>";
		echo $request->lop11ten."<br>";
		echo $request->lop11diachi."<br>";
		echo $request->lop11tinh."<br>";
		echo $request->lop11truong."<br>";
		echo $request->lop12ten."<br>";
		echo $request->lop12diachi."<br>";
		echo $request->lop12tinh."<br>";
		echo $request->lop12truong."<br>";
		echo $request->sdt."<br>";
		echo $request->email."<br>";
		echo $request->diachi."<br>";
		echo $request->namtotnghiep."<br>";
		//echo $request->hoten."<br>";
		//xu lý upload anh
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
				//print_r($value);
				echo "<option value=".str_replace(' ','_',$value['address']).">".$value['address']."</option>|<option value=".$value['provinceCode'].">".$value['provinceCode']."</option>|<option value=".$value['code'].">".$value['code']."</option>";
				break;
			}
			// echo "<pre>";
			// print_r($value['id']);
			// echo "</pre>";
		}
		
	}
	public function getNganh() {
		$nganh = Nganh::all();
		return view('welcome',['nganhs' => $nganh]);
	}

	
}
