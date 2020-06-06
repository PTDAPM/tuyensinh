<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\HoSo;
use App\Nganh;
use App\HosoNganh;
use App\Lop10;
use App\Lop11;
use App\Lop12;
use App\Tohop;
use App\NganhTohop;
use App\NguyenVong;
use App\Diem;
use Mail;

class PageController extends Controller
{
    //
    public function index() {
    	echo "<h1>Hello World</h1>";
    }
	public function luuHoso(Request $request) {	
		$nganh = array();
		$link = array();
		$lop10 = array();
		$lop11 = array();
		$lop12 = array();
		$ma_tinh = explode("|",$request->infoStudent['province'])[0];
		$ten_tinh = explode("|",$request->infoStudent['province'])[1];
		$ma_xa = isset($request->infoStudent['town']) ? $request->infoStudent['town'] : NULL;
		$flag = false;
		// foreach($request->infoRecords['idMajors'] as $ng) {
		// 	array_push($nganh, $ng);
		// }
		
			for($i = 0; $i < count($request->infoRecords); $i++) {
				array_push($nganh, $request->infoRecords[$i]['idMajors']);
			}
			//fotmat date
			$ngay_sinh = strtotime($request->infoStudent['dateOfBirth']);
			$ngay_sinh_format = date('Y-m-d',$ngay_sinh);
			$ngay_cap = strtotime($request->infoStudent['dateForCMND']);
			$ngay_cap_format = date('Y-m-d',$ngay_cap);
			foreach($request->linkImage as $lk) {
				array_push($link, $lk);
			}
			$hoso = new HoSo;
			$hoso->ho_ten 				= $request->infoStudent['fullNameStudent'];
			$hoso->gioi_tinh 			= $request->infoStudent['sex'];
			$hoso->ngay_thang_nam_sinh	= $ngay_sinh_format;
			$hoso->noi_sinh 			= $request->infoStudent['placeOfBirth'];
			$hoso->dan_toc 				= $request->infoStudent['nation'];
			$hoso->cmnd 				= $request->infoStudent['numberCMND'];
			$hoso->ngay_cap   			= $ngay_cap_format;
			$hoso->noi_cap 				= $request->infoStudent['locationForCMDN'];
			$hoso->ho_khau 				= $request->infoStudent['location'];
			$hoso->ma_tinh 				= $ma_tinh;
			$hoso->ma_huyen 			= $request->infoStudent['district']; 
			$hoso->ma_xa 				= $ma_xa;
			$hoso->sdt 					= $request->infoStudent['phoneNumber'];
			$hoso->email 				= $request->infoStudent['email'];
			$hoso->dia_chi 				= $request->infoStudent['contactAddress'];
			$hoso->nam_tot_nghiep 		= $request->infoStudent['graduationYear'];
			$hoso->kv_uu_tien 			= $request->infoStudent['khuVucUuTien'];
			$hoso->doi_tuong_uu_tien 	= $request->infoStudent['doiTuongUuTien'];
			$hoso->ten_tinh 			= $ten_tinh;
			$hoso->trang_thai = 0;
			$hoso->anh_hoc_ba = json_encode($link);

			$hoso->save();
			for($i = 0; $i < count($nganh); $i ++) {
			$hoso_nganh = new HosoNganh;
			$hoso_nganh->ma_ho_so = $hoso->id;
			$hoso_nganh->ma_nganh = $nganh[$i];
			$hoso_nganh->save();
			$nguyenvong = new NguyenVong;
			$nguyenvong->ma_to_hop 	= $request->infoRecords[$i]['tohop'];
			$nguyenvong->ma_ho_so 	= $hoso->id;
			$nguyenvong->ma_nganh   = $nganh[$i];
			$nguyenvong->save();
			$diem = new Diem;
			$diem->ma_nguyen_vong = $nguyenvong->id;
			$diem->lop10_m1 = $request->infoRecords[$i]['lop10_mon1'];
			$diem->lop10_m2 = $request->infoRecords[$i]['lop10_mon2'];
			$diem->lop10_m3 = $request->infoRecords[$i]['lop10_mon3'];
			$diem->lop11_m1 = $request->infoRecords[$i]['lop11_mon1'];
			$diem->lop11_m2 = $request->infoRecords[$i]['lop11_mon2'];
			$diem->lop11_m3 = $request->infoRecords[$i]['lop11_mon3'];
			$diem->lop12_m1 = $request->infoRecords[$i]['lop12_mon1'];
			$diem->lop12_m2 = $request->infoRecords[$i]['lop12_mon2'];
			$diem->lop12_m3 = $request->infoRecords[$i]['lop12_mon3'];
			$diem->save();
			}
			$lop10 = new Lop10;
			$lop10->ma_ho_so 	= $hoso->id;
			$lop10->ten_truong 	= $request->infoStudent['class10']['nameSchool'];
			$lop10->dia_chi 	= $request->infoStudent['class10']['location'];
			$lop10->ma_tinh 	= $request->infoStudent['class10']['idProvince'];
			$lop10->ma_truong 	= $request->infoStudent['class10']['idSchool'];
			$lop10->save();
			$lop11 = new Lop11;
			$lop11->ma_ho_so 	= $hoso->id;
			$lop11->ten_truong 	= $request->infoStudent['class11']['nameSchool'];
			$lop11->dia_chi 	= $request->infoStudent['class11']['location'];
			$lop11->ma_tinh 	= $request->infoStudent['class11']['idProvince'];
			$lop11->ma_truong 	= $request->infoStudent['class11']['idSchool'];
			$lop11->save();
			$lop12 = new Lop12;
			$lop12->ma_ho_so 	= $hoso->id;
			$lop12->ten_truong 	= $request->infoStudent['class12']['nameSchool'];
			$lop12->dia_chi 	= $request->infoStudent['class12']['location'];
			$lop12->ma_tinh 	= $request->infoStudent['class12']['idProvince'];
			$lop12->ma_truong 	= $request->infoStudent['class12']['idSchool'];
			$lop12->save();
			$email = $request->infoStudent['email'];
			Mail::send('email', array('name'=>$request->hoten, 'link' => 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http://ttts.local/public/thongtin/'.$hoso->id.'&choe=UTF-8'), function($message) use ($email){
		        $message->to($email)->subject('Đăng Ký Xét Tuyển Online');
		    });
	        Session::flash('flash_message', 'Send message successfully!');
			$flag = true;
					
		if($flag === true) {
			return response()->json(['message' => 'mission complete !!!']);
		}
		else return response()->json(['message' => 'mission false !!!']);
	}
	
	public function getThongTin(Request $request) {
		$nganh_arr = array();
		$id 	= $request->id;
		$hoso 	= HoSo::where('id', $id)->first();
		$lop10 	= Lop10::where('ma_ho_so', $id)->first();
		$lop11 	= Lop11::where('ma_ho_so', $id)->first();
		$lop12 	= Lop12::where('ma_ho_so', $id)->first();
		$nguyenvong = NguyenVong::where('ma_ho_so', $id)->get();
		foreach ($nguyenvong as $key => $nv) {
			$tohop 		= ToHop::find($nv->ma_to_hop);
			$diem 		= Diem::where('ma_nguyen_vong', $nv->id)->first();
			$nganh 		= Nganh::find($nv->ma_nganh);
			if(isset($diem) && $diem != '') {
				$lop10_m1 = $diem->lop10_m1;
				$lop10_m2 = $diem->lop10_m2;
				$lop10_m3 = $diem->lop10_m3;
				$lop11_m1 = $diem->lop11_m1;
				$lop11_m2 = $diem->lop11_m2;
				$lop11_m3 = $diem->lop11_m3;
				$lop12_m1 = $diem->lop12_m1;
				$lop12_m2 = $diem->lop12_m2;
				$lop12_m3 = $diem->lop12_m3;
			}
			else {
				$lop10_m1 = '';$lop10_m2 =''; $lop10_m3 ='';
				$lop11_m1 =''; $lop11_m2 =''; $lop11_m3 ='';
				$lop12_m1 =''; $lop12_m2 =''; $lop12_m3 ='';
			}
			$data[$key] = array('nganh' => array('manganh' => $nganh->id, 'tennganh' => $nganh->ten, 'maxettuyen' => $nganh->ma_xet_tuyen,'makhoa' => $nganh->ma_khoa), 'matohop' => $tohop->id, 'tentohop' => $tohop->ten, 'diem' => array('lop10_m1' => $lop10_m1,'lop10_m2' => $lop10_m2,'lop10_m3' => $lop10_m3,'lop11_m1' => $lop11_m1,'lop11_m2' => $lop11_m2,'lop11_m3' => $lop11_m3,'lop12_m1' => $lop12_m1,'lop12_m2' => $lop12_m2,'lop12_m3' => $lop12_m3,));

		}
		return response()->json(['hoso' => $hoso, 'lop10' => $lop10, 'lop11' => $lop11, 'lop12' => $lop12, 'nguyenvong' => $data]);
		//return view('thongtin', ['hoso' => $hoso, 'lop10' => $lop10, 'lop11' => $lop11, 'lop12' => $lop12]);
	}
	public function getApiNganh() {
		$nganh = Nganh::all();
		$tohop = Tohop::all();
		$temp = NganhTohop::all();
		return response()->json(['nganh' => $nganh, 'tohop' => $tohop, 'nganh_tohop' => $temp]);
	}

	
}
