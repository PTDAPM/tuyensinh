<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use App\HoSo;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        $hoso = HoSo::whereBetween('created_at',[date('Y').'-'.date('m').'-01 00:00:00',date('Y').'-'.date('m').'-31 00:00:00'])
    ->get();

        return $content
            ->title('Dashboard')
            ->description('Welcome - admin')
            ->body(view('chart',['hoso' => $hoso]));



     //        ->row(function (Row $row) {
     //            $row->column(12, '<div style="margin:10px auto"><img src="https://scontent.fhan2-1.fna.fbcdn.net/v/t1.0-9/98294224_2723252784615695_2074047085992214528_n.jpg?_nc_cat=101&_nc_sid=8024bb&_nc_ohc=JO0Hcs9oYwsAX9I__Fu&_nc_ht=scontent.fhan2-1.fna&oh=fecbb992bb7ab3328c72e584a60fb583&oe=5EF25332" alt="banner">
					// <h2>-	Hướng Dẫn: ADMIN sử dụng menu bên trái để xem và quản lý bài viết. Sử dụng chức năng user và role để thêm user và phân quyền user</h2>
					// <hr>
					// <h2>-	Team Dev Leader: <span style="color:red"><b>Nguyễn Văn Anh</b><span></h2>
     //            	</div>');
                
     //        });
    }
}
