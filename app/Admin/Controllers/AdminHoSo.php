<?php

namespace App\Admin\Controllers;

use App\HoSo;
use App\NguyenVong;
Use Encore\Admin\Widgets\Table;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
//use Encore\Admin\Admin;
use Illuminate\Http\Request;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;

class AdminHoSo extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Quản Lý Hồ Sơ';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    public function edit($id, Content $content)
    {
    return $content
        ->title($this->title())
        ->description($this->description['edit'] ?? trans('admin.edit'))
        ->body($this->form($id)->edit($id));
    }
    protected function grid()
    {
        $grid = new Grid(new HoSo());
        $grid->column('actions', 'Actions')->display(function(){
            $token  = md5("toan".$this->id."toan1");
            return "<a href='ho-sos/$this->id'>Show</a><br><a href='ho-sos/$this->id/edit'>Edit</a><br><a href='ho-sos/delete/$this->id?token=$token' Onclick='return ConfirmDelete();'>Delete</a><br>";
        });
        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            //$actions->disableView();
        });

        $grid->model()->orderBy('id', 'desc');
        $grid->column('id', __('Id'))->sortable();
        $grid->column('ho_ten', __('Ho ten'));
        $grid->column('gioi_tinh', __('Gioi tinh'))->display(function() {
            return HoSo::GIOITINH[$this->gioi_tinh];

        });
        $grid->column('ngay_thang_nam_sinh', __('Ngày sinh'))->display(function ($created_at) {
            return date("Y-m-d", strtotime($created_at));
        });
        $grid->column('noi_sinh', __('Noi sinh'));
        $grid->column('dan_toc', __('Dan toc'))->style('max-width:100px;word-wrap: break-word;');
        $grid->column('cmnd', __('Cmnd'));
        $grid->column('ngay_cap', __('Ngay cap'))->display(function ($created_at) {
            return date("Y-m-d", strtotime($created_at));
        });
        $grid->column('noi_cap', __('Noi cap'));
        $grid->column('ho_khau', __('Ho khau'));
        $grid->column('ma_tinh', __('Ma tinh'));
        $grid->column('ten_tinh', __('Ten tinh'));
        $grid->column('ma_huyen', __('Ma huyen'));
        $grid->column('ma_xa', __('Ma xa'));
        $grid->column('sdt', __('Sdt'));
        $grid->column('email', __('Email'));
        $grid->column('dia_chi', __('Dia chi'));
        $grid->column('nam_tot_nghiep', __('Nam tot nghiep'));
        $grid->column('kv_uu_tien', __('Kv uu tien'));
        $grid->column('doi_tuong_uu_tien', __('Doi tuong uu tien'));

        $grid->column('anh_hoc_ba', __('Anh hoc ba'))->display(function($text) {
                return json_decode($text, true);
            })->image(50, 50);
        $grid->column('Ngành Đăng Ký')->display(function(){
            return "<a href='hoso-nganhs?ma_ho_so=".$this->id."'>CLICK TO VIEW</a>";
        });
        $grid->column('Nguyện Vọng ĐK')->display(function(){
            return "<a href=nguyen-vongs?ma_ho_so=".$this->id."'>CLICK TO VIEW</a>";
        });
        
        $grid->column('trang_thai', __('Trang thai'))->editable('select', HoSo::STATUS);
        //$grid->column('ket_qua', __('Ket Qua'))->editable('select', HoSo::KQ);
        //$grid->column('created_at', __('Created at'));
        //$grid->column('updated_at', __('Updated at'));
        $grid->disableActions();
        $grid->actions(function ($actions) {
            $actions->disableEdit();
            if (!Admin::user()->can('delete-image')) {
                $actions->disableDelete();
            }
            //$actions->add(new Replicate);
        });
        /////////////////
        /// tìm kiếm ///
        ////////////////
        $grid->quickSearch('id', 'ho_ten', 'gioi_tinh', 'noi_sinh', 'dan_toc', 'sdt', 'email', 'cmnd');
        $grid->filter(function($filter){
            $filter->column(1/2, function ($filter) {
                $filter->like('ho_ten','Họ Tên');
                $filter->like('ngay_thang_nam_sinh','Năm Sinh');
                $filter->like('noi_sinh','Nơi Sinh');
                $filter->like('dan_toc','Dân Tộc');
                $filter->equal('cmnd','CMND');
                $filter->like('sdt','Số Điện Thoại');
                $filter->like('email','Email');

            });

            $filter->column(1/2, function ($filter) {
                //$filter->equal('created_at')->datetime();              
                //$filter->disableIdFilter();
                $filter->like('dia_chi','Địa Chỉ');
                $filter->like('nam_tot_nghiep','Năm Tốt Ngiệp');
                $filter->like('kv_uu_tien','Khu Vực ƯT');
                $filter->like('doi_tuong_uu_tien','Đối Tượng ƯT');
                $filter->between('created_at','Ngày Tạo')->datetime();
                $filter->equal('gioi_tinh','Giới Tính')->radio([
                    0 => 'Nam',
                    1 => 'Nữ',
                ]);
                $filter->equal('trang_thai','Trạng Thái')->radio([
                    0 => 'Chưa Duyệt',
                    1 => 'Đã Duyệt',
                ]);
            });
        });
        Admin::script("$('img').click(function(e) {
            var link = $(this).attr('src');
            e.preventDefault();
            window.open(link);
            });
        ");
        Admin::script(" $('body').keydown(function(e) {
        if(e.keyCode == 37) { // left key down
            $('#left_scroll').click();
            console.log('click');
        } else if(e.keyCode == 39) { // right key down
            $('#right_scroll').click();
            console.log('click');
        }
        });
        ");
        Admin::style('img:hover {cursor: pointer}');
        return $grid;
    }


    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(HoSo::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('ho_ten', __('Ho ten'));
        $show->field('gioi_tinh', __('Gioi tinh'))->as(function ($status){
            if($status == 0)
            {
                return HoSo::GIOITINH[0];
            }
            else
            {
                return HoSo::GIOITINH[1];
            }
        });
        $show->field('ngay_thang_nam_sinh', __('Ngay thang nam sinh'));
        $show->field('noi_sinh', __('Noi sinh'));
        $show->field('dan_toc', __('Dan toc'));
        $show->field('cmnd', __('Cmnd'));
        $show->field('ngay_cap', __('Ngay cap'));
        $show->field('noi_cap', __('Noi cap'));
        $show->field('ho_khau', __('Ho khau'));
        $show->field('ma_tinh', __('Ma tinh'));
        $show->field('ten_tinh', __('Ten tinh'));
        $show->field('ma_huyen', __('Ma huyen'));
        $show->field('ma_xa', __('Ma xa'));
        $show->field('anh_hoc_ba', __('Anh hoc ba'))->as(function($text) {
                return json_decode($text, true);
            })->image(250, 250);
        $show->field('sdt', __('Sdt'));
        $show->field('email', __('Email'));
        $show->field('dia_chi', __('Dia chi'));
        $show->field('nam_tot_nghiep', __('Nam tot nghiep'));
        $show->field('kv_uu_tien', __('Kv uu tien'));
        $show->field('doi_tuong_uu_tien', __('Doi tuong uu tien'));
        $show->field('trang_thai', __('Trang thai'))->as(function ($status){
            if($status == 0)
            {
                return 'Chưa Duyệt';
            }
            else
            {
                return 'Đã Duyệt';
            }
        });
        // $show->field('ket_qua', __('Ket qua'))->as(function ($status){
        //     if($status == 0)
        //     {
        //         return 'Không Đạt';
        //     }
        //     else
        //     {
        //         return 'Đạt';
        //     }
        // });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($id = null)
    {
        $form = new Form(new HoSo());

        // $form->text('ho_ten', __('Ho ten'));
        // $form->number('gioi_tinh', __('Gioi tinh'));
        // $form->datetime('ngay_thang_nam_sinh', __('Ngay thang nam sinh'))->default(date('Y-m-d H:i:s'));
        // $form->text('noi_sinh', __('Noi sinh'));
        // $form->text('dan_toc', __('Dan toc'));
        // $form->text('cmnd', __('Cmnd'));
        // $form->datetime('ngay_cap', __('Ngay cap'))->default(date('Y-m-d H:i:s'));
        // $form->text('noi_cap', __('Noi cap'));
        // $form->text('ho_khau', __('Ho khau'));
        // $form->number('ma_tinh', __('Ma tinh'));

        // $form->number('ma_huyen', __('Ma huyen'));
        // $form->number('ma_xa', __('Ma xa'));
        // $form->textarea('anh_hoc_ba', __('Anh hoc ba'));
        // $form->text('sdt', __('Sdt'));
        // $form->email('email', __('Email'));
        // $form->text('dia_chi', __('Dia chi'));
        // $form->text('nam_tot_nghiep', __('Nam tot nghiep'));
        // $form->text('kv_uu_tien', __('Kv uu tien'));
        // $form->text('doi_tuong_uu_tien', __('Doi tuong uu tien'));
        $form->select('trang_thai', __('Trang thai'))->options([0 => 'Chưa Duyệt', 1 => 'Đã Duyệt']);
        //$form->select('ket_qua', __('Ket Qua'))->options([0 => 'Chưa Đạt', 1 => 'Đạt']);
        $form->footer(function ($footer) {

            // disable reset btn
            $footer->disableReset();

            // disable submit btn
            //$footer->disableSubmit();

            // disable `View` checkbox
            $footer->disableViewCheck();

            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();

            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();

        });
        $form->tools(function (Form\Tools $tools) use($id) {

            // Disable `List` btn.
            //$tools->disableList();
            //dd($id);
            // Disable `Delete` btn.
            $tools->disableDelete();
            // Disable `Veiw` btn.
            //$tools->disableView();
            // Add a button, the argument can be a string, or an instance of the object that implements the Renderable or Htmlable interface
            $token  = md5("toan".$id."toan1");
            $tools->add("<a class='btn btn-sm btn-danger' href='../delete/$id?token=$token' Onclick='return ConfirmDelete();'><i class='fa fa-trash'></i>&nbsp;&nbsp;delete &nbsp;</a>");
        });
        return $form;
    }
    public function delete(Request $request) {
        if(md5("toan".$request->id."toan1") === $request->token) {
            $delete = HoSo::find($request->id);
            if($delete != null) {
                try {
                $delete->delete();
                }
                catch(\Illuminate\Database\QueryException $ex) {
                    admin_toastr('Có lỗi!!!', 'error', ['timeOut' => 5000]);
                    return redirect('admin/ho-sos');
                }
            }
            admin_toastr('Xoá Thành Công', 'success', ['timeOut' => 5000]);
            return redirect('admin/ho-sos');
        }
        else {
            admin_toastr('Có lỗi!!!', 'error', ['timeOut' => 5000]);
            return redirect()->back();
        }
        
    }
    
}
