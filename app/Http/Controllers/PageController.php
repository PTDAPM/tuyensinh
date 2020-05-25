<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HoSo;
use App\Nganh;
use App\HosoNganh;

class PageController extends Controller
{
    //
	public function luuHoso(Request $request) {	
		$hs_nganh = array($request->nganh1, $request->nganh2, $request->nganh3);
		//echo $request->hoten."<br>";
		//echo $request->gioitinh."<br>";
		//echo $request->ntns."<br>";
		//echo $request->noisinh."<br>";
		//echo $request->dantoc."<br>";
		//echo $request->cmnd."<br>";
		//echo $request->ngaycap."<br>";
		//echo $request->noicap."<br>";
		//echo $request->hokhau."<br>";
		//echo $request->matinh."<br>";
		//echo $request->mahuyen."<br>";
		//echo $request->maxa."<br>";
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
		//echo $request->sdt."<br>";
		//echo $request->email."<br>";
		//echo $request->diachi."<br>";
		//echo $request->namtotnghiep."<br>";
		//echo $request->kvuutien."<br>";
		//echo $request->dtuutien."<br>";
		//echo $request->nganh1."<br>";
		//echo $request->maxettuyen1."<br>";
		//echo $request->tohopxettuyen1."<br>";
		//echo $request->nganh2."<br>";
		//echo $request->maxettuyen2."<br>";
		//echo $request->tohopxettuyen2."<br>";
		//echo $request->nganh3."<br>";
		echo $request->maxettuyen3."<br>";
		echo $request->tohopxettuyen3."<br>";
		echo $request->lop10diemtb1."<br>";
		echo $request->lop10diemtb2."<br>";
		echo $request->lop10diemtb3."<br>";
		echo $request->lop11diemtb1."<br>";
		echo $request->lop11diemtb2."<br>";
		echo $request->lop11diemtb3."<br>";
		echo $request->lop12diemtb1."<br>";
		echo $request->lop12diemtb2."<br>";
		echo $request->lop12diemtb3."<br>";
		$hoso = new HoSo;
		$hoso->ho_ten 				= $request->hoten;
		$hoso->gioi_tinh 			= $request->gioitinh;
		$hoso->ngay_thang_nam_sinh 	= $request->ntns;
		$hoso->noi_sinh				= $request->noisinh;
		$hoso->dan_toc				= $request->dantoc;
		$hoso->cmnd 				= $request->cmnd;
		$hoso->ngay_cap 			= $request->ngaycap;
		$hoso->noi_cap				= $request->noicap;
		$hoso->ho_khau				= $request->hokhau;
		$hoso->ma_tinh				= $request->matinh;
		$hoso->ma_huyen				= $request->mahuyen;
		$hoso->ma_xa 				= $request->maxa;
		$hoso->sdt  				= $request->sdt;
		$hoso->email 				= $request->email;
		$hoso->dia_chi 				= $request->diachi;
		$hoso->nam_tot_nghiep		= $request->namtotnghiep;
		$hoso->kv_uu_tien 			= $request->kvuutien;
		$hoso->doi_tuong_uu_tien	= $request->dtuutien;
		$hoso->trang_thai			= 0;
		//xu lý upload anh
		$this->validate($request, [
			'photos'=>'required', 'cmnd' => 'required|unique:ho_sos,cmnd' ],[
			'photos.required' => 'Bạn chưa chọn file học bạ !',
			'cmnd.required' => 'Bạn chưa nhập cmnd',
			'cmnd.unique' => 'cmnd đã có người sử dụng'
			]
		);
        // kiểm tra có files sẽ xử lý
		if($request->hasFile('photos')) {
			$arr_link = array();
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
					$photo->move(public_path('photos'),$filename);
				//Lưu db
					array_push($arr_link,$filename);
					////////////////
					////////////////
				}
				$hoso->anh_hoc_ba = json_encode($arr_link);
			} else {
				echo "Falied to upload. Only accept jpg, png, jpeg, pdf photos.";
			}
		}
		$hoso->save();	

		for($i = 0; $i < count($hs_nganh); $i ++) {
		$hoso_nganh = new HosoNganh;
		$hoso_nganh->ma_ho_so = $hoso->id;
		$hoso_nganh->ma_nganh = $hs_nganh[$i];
		$hoso_nganh->save();
		}
		






		return redirect()->route('formdk')->with('success','nộp hồ sơ thành công, vui lòng kiểm tra email để xem lại thông tin');
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
	public function ajaxGetMa(Request $request) {
		$nganhs = Nganh::where("id", $request->id_nganh)->get();
		//dd($nganhs);
		foreach($nganhs as $nganh) {
			echo $nganh->ma_xet_tuyen."|";
			foreach ($nganh->Tohop as $tohop) {
				echo "<option value=".$tohop->id.">".$tohop->ten."</option>";
			}
		}
	}

	
}
