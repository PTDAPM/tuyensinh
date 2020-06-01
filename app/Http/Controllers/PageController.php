<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\HoSo;
use App\Nganh;
use App\HosoNganh;
use App\Lop10;
use App\Lop11;
use App\Lop12;
use App\Tohop;
use App\NganhTohop;
use Mail;

class PageController extends Controller
{
    //
    public function index() {
    	echo "<h1>Hello World</h1>";
    }
	public function luuHoso(Request $request) {	
		$arr_link = array();
		if($request->hasFile('photos')) {
			$files = $request->file('photos');
			foreach ($request->photos as $photo) {
				$filename = $photo->store('');
				$photo->move(public_path('photos'),$filename);
				array_push($arr_link, $filename);
			}
		}
		return response()->json($request->file('photos')->getClientOriginalName());
		// return response()->json($request->body['infoStudent']['contactAddress']);
		//dd($request);
		//echo "aaaaaaaaaaaaaaaaaaaa";
		// $hs_nganh = array($request->nganh1, $request->nganh2, $request->nganh3);
		// $hoso = new HoSo;
		// $hoso->ho_ten 				= $request->hoten;
		// $hoso->gioi_tinh 			= $request->gioitinh;
		// $hoso->ngay_thang_nam_sinh 	= $request->ntns;
		// $hoso->noi_sinh				= $request->noisinh;
		// $hoso->dan_toc				= $request->dantoc;
		// $hoso->cmnd 				= $request->cmnd;
		// $hoso->ngay_cap 			= $request->ngaycap;
		// $hoso->noi_cap				= $request->noicap;
		// $hoso->ho_khau				= $request->hokhau;
		// $hoso->ma_tinh				= $request->matinh;
		// $hoso->ma_huyen				= $request->mahuyen;
		// $hoso->ma_xa 				= $request->maxa;
		// $hoso->sdt  				= $request->sdt;
		// $hoso->email 				= $request->email;
		// $hoso->dia_chi 				= $request->diachi;
		// $hoso->nam_tot_nghiep		= $request->namtotnghiep;
		// $hoso->kv_uu_tien 			= $request->kvuutien;
		// $hoso->doi_tuong_uu_tien	= $request->dtuutien;
		// $hoso->trang_thai			= 0;
		// //xu lý upload anh
		// $this->validate($request, [
		// 	'photos'=>'required', 'cmnd' => 'required|unique:ho_sos,cmnd' ],[
		// 	'photos.required' => 'Bạn chưa chọn file học bạ !',
		// 	'cmnd.required' => 'Bạn chưa nhập cmnd',
		// 	'cmnd.unique' => 'cmnd đã có người sử dụng'
		// 	]
		// );
        // kiểm tra có files sẽ xử lý
		// if($request->hasFile('photos')) {
		// 	$arr_link = array();
		// 	$allowedfileExtension=['jpg','png','jpeg','pdf'];
		// 	$files = $request->file('photos');
		// 	$exe_flg = true;
		// 	foreach($files as $file) {
		// 		$extension = $file->getClientOriginalExtension();
		// 		$check=in_array($extension,$allowedfileExtension);

		// 		if(!$check) {
		// 			$exe_flg = false;
		// 			break;
		// 		}
		// 	} 
		// 	if($exe_flg) {
		// 		foreach ($request->photos as $photo) {
		// 			$filename = $photo->store('');
		// 		//chuyển file vào mục images
		// 			$photo->move(public_path('photos'),$filename);
		// 			array_push($arr_link,$filename);
					
		// 		}
		// 		// lưu db //
		// 		//$hoso->anh_hoc_ba = json_encode($arr_link);
		// 	} else {
		// 		echo "Falied to upload. Only accept jpg, png, jpeg, pdf photos.";
		// 	}
		// }
		//$hoso->save();	

		// for($i = 0; $i < count($hs_nganh); $i ++) {
		// $hoso_nganh = new HosoNganh;
		// $hoso_nganh->ma_ho_so = $hoso->id;
		// $hoso_nganh->ma_nganh = $hs_nganh[$i];
		// $hoso_nganh->save();
		// }
		// $lop10 = new Lop10;
		// $lop10->ma_ho_so 	= $hoso->id;
		// $lop10->ten_truong	= $request->lop10ten;
		// $lop10->dia_chi 	= $request->lop10diachi;
		// $lop10->ma_tinh		= $request->lop10tinh;
		// $lop10->ma_truong	= $request->lop10truong;
		// $lop10->diem_mon1	= $request->lop10diemtb1;
		// $lop10->diem_mon2	= $request->lop10diemtb2;
		// $lop10->diem_mon3 	= $request->lop10diemtb3;
		// $lop10->save();
		// $lop11 = new Lop11;
		// $lop11->ma_ho_so 	= $hoso->id;
		// $lop11->ten_truong	= $request->lop11ten;
		// $lop11->dia_chi 	= $request->lop11diachi;
		// $lop11->ma_tinh		= $request->lop11tinh;
		// $lop11->ma_truong	= $request->lop11truong;
		// $lop11->diem_mon1	= $request->lop11diemtb1;
		// $lop11->diem_mon2	= $request->lop11diemtb2;
		// $lop11->diem_mon3 	= $request->lop11diemtb3;
		// $lop11->save();
		// $lop12 = new Lop12;
		// $lop12->ma_ho_so 	= $hoso->id;
		// $lop12->ten_truong	= $request->lop12ten;
		// $lop12->dia_chi 	= $request->lop12diachi;
		// $lop12->ma_tinh		= $request->lop12tinh;
		// $lop12->ma_truong	= $request->lop12truong;
		// $lop12->diem_mon1	= $request->lop12diemtb1;
		// $lop12->diem_mon2	= $request->lop12diemtb2;
		// $lop12->diem_mon3 	= $request->lop12diemtb3;
		// $lop12->save();
		// $email = $request->email;
		// Mail::send('email', array('name'=>$request->hoten, 'link' => 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http://ttts.local/public/thongtin/'.$hoso->id.'&choe=UTF-8'), function($message) use ($email){
	 //        $message->to($email)->subject('Đăng Ký Xét Tuyển Online');
	 //    });
  //       Session::flash('flash_message', 'Send message successfully!');
  //       return redirect()->route('formdk')->with('success','nộp hồ sơ thành công, vui lòng kiểm tra email để xem lại thông tin');
	}
	
	public function getThongTin(Request $request) {
		$id 	= $request->id;
		$hoso 	= HoSo::where('id', $id)->first();
		$lop10 	= Lop10::where('ma_ho_so', $id)->first();
		$lop11 	= Lop11::where('ma_ho_so', $id)->first();
		$lop12 	= Lop12::where('ma_ho_so', $id)->first();
		return view('thongtin', ['hoso' => $hoso, 'lop10' => $lop10, 'lop11' => $lop11, 'lop12' => $lop12]);
	}
	public function getApiNganh() {
		$nganh = Nganh::all();
		$tohop = Tohop::all();
		$temp = NganhTohop::all();
		return response()->json(['nganh' => $nganh, 'tohop' => $tohop, 'nganh_tohop' => $temp]);
	}

	
}
