<?php

namespace App\Admin\Controllers;

use App\TinTuc;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use App\Services\ImgurService;
use App\Admin\Actions\Post\Replicate;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;



class adminTinTuc extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'QL Tin Tức';

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

        $grid   = new Grid(new TinTuc());
        
        $grid->column('actions', 'Actions')->display(function(){
            $token  = md5("toan".$this->id."toan1");
            //$text = 'Bạn có muốn xoá ?';
            return "<a href='tin-tucs/$this->id'>Show</a><br><a href='tin-tucs/$this->id/edit'>Edit</a><br><a href='tin-tucs/delete/$this->id?token=$token' Onclick='return ConfirmDelete();'>Delete</a><br>";
        });
        $grid->model()->orderBy('id', 'desc');
        $grid->column('id', __('Id'))->sortable();
        $grid->column('tieu_de', __('Tieu de'))->display(function(){
            return mb_substr(strip_tags($this->tieu_de), 0, 100);
        });
        $grid->column('mo_ta', __('Mo ta'))->display(function(){
            return mb_substr(strip_tags($this->noi_dung), 0, 100);
        });
        $grid->column('noi_dung', __('Noi dung'))->display(function(){
            return mb_substr(strip_tags($this->noi_dung), 0, 250);
        });
        $grid->column('anh', __('Anh'))->image();
        $grid->column('trang_thai', __('Trang thai'))->editable('select',TinTuc::STATUS);
        $grid->column('created_at', __('Created at'))->display(function ($created_at) {
            return date("Y-m-d", strtotime($created_at));
        });
        $grid->column('updated_at', __('Updated at'))->display(function ($updated_at) {
            return date("Y-m-d", strtotime($updated_at));
        });
        $grid->disableActions();
        $grid->actions(function ($actions) {
            //$actions->disableEdit();
            if (!Admin::user()->can('delete-image')) {
                $actions->disableDelete();
            }
            //$actions->add(new Replicate);
        });
        /////////////////
        /// tìm kiếm ///
        ////////////////
        $grid->quickSearch('id', 'tieu_de', 'mo_ta', 'noi_dung', 'created_at', 'updated_at');
        $grid->filter(function($filter){
            $filter->like('tieu_de','Tiêu Đề');
            $filter->between('created_at','Ngày Tạo')->datetime();
            $filter->equal('trang_thai','Trạng Thái')->radio([
                    0 => 'Đã Duyệt',
                    1 => 'Chưa Duyệt',
                ]);
        });
        

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
        $show = new Show(TinTuc::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('tieu_de', __('Tieu de'));
        $show->field('mo_ta', __('Mo ta'));
        $show->field('noi_dung', __('Noi dung'));
        $show->field('anh', __('Anh'))->image();
        $show->field('trang_thai', __('Trang thai'))->as(function ($status){
            if($status == 0)
            {
                return 'Đang Hiển Thị';
            }
            else
            {
                return 'Đang Ẩn';
            }
        });
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($id = null)
    {
        $form = new Form(new TinTuc());
        $form->text('tieu_de', __('Tieu de'))->rules('required|min:10',['required' => 'Tiêu đề k đc để trống', 'min' => 'Tiêu đề tối thiểu 10 kí tự']);
        $form->text('mo_ta', __('Mo ta'))->rules('required|min:10',['required' => 'Mô tả k đc để trống', 'min' => 'Mô tả tối thiểu 10 kí tự']);
        $form->textarea('noi_dung', __('Noi dung'))->rules('required|min:10',['required' => 'Nội dung k đc để trống', 'min' => 'Nội dung tối thiểu 10 kí tự']);
        $form->image('anh', __('Anh'))->rules('required');
        $form->select('trang_thai', __('Trang thai'))->options([0 => 'Đang hiển thị', 1 => 'Đang ẩn']);
        //$form->setAction('editnew');
        $form->saved(function ($form) {
            $id         = $form->model()->id;
            $tieude     = $form->model()->tieu_de;
            $mota       = $form->model()->mo_ta;
            $noidung    = $form->model()->noi_dung;
            $anh        = request()->anh;
            if(isset($anh)) {
                $imageUrl = ImgurService::uploadImage($anh->getRealPath());
                TinTuc::where('id', $id)

              ->update(['tieu_de' => $tieude, 'mo_ta' => $mota, 'noi_dung' => $noidung, 'anh' => $imageUrl]);
              admin_toastr('Sửa thành công', 'success');
                return redirect('admin/tin-tucs');

            }
            else {
                TinTuc::where('id', $id)
              ->update(['tieu_de' => $tieude, 'mo_ta' => $mota, 'noi_dung' => $noidung]);
              admin_toastr('Sửa thành công', 'success');
                return redirect('admin/tin-tucs'); 
            }
            
            

                
        });
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
    public function createNews() {
        return view('themtin');
    }
    public function saveNews(Request $request) {
        $request->validate([
                'tieude' => 'required',
                'mota' => 'required',
                'noidung' => 'required',
                'anh' => 'required'], [
                'tieude.required' => 'Tiêu Đề Không Được Bỏ Trống',
                'mota.required'    => 'Mô Tả Không Được Bỏ Trống',
                'noidung.required' => 'Nội Dung Không Được Bỏ Trống',
                'anh.required' => 'Ảnh Không Được Bỏ Trống',
                ]);
        $image = $request->anh;
        $imageUrl = ImgurService::uploadImage($image->getRealPath());
        $tintuc = new TinTuc;
        $tintuc->tieu_de = $request->tieude;
        $tintuc->mo_ta = $request->mota;
        $tintuc->noi_dung = $request->noidung;
        $tintuc->anh = $imageUrl;
        $tintuc->trang_thai = 0;
        $tintuc->save();
        return redirect()->back()->with('status', 'Thêm Tin Thành Công!');

    }
    public function delete(Request $request) {
        if(md5("toan".$request->id."toan1") === $request->token) {
            $delete = TinTuc::find($request->id);
            if($delete != null) {
                $delete->delete();
                admin_toastr('Xoá thành công', 'success', ['timeOut' => 5000]);
                return redirect('admin/tin-tucs');
            }
            admin_toastr('Xoá thành công', 'success', ['timeOut' => 5000]);
            return redirect('admin/tin-tucs');
        }
        else {
            admin_toastr('Có lỗi!!!', 'error', ['timeOut' => 5000]);
            return redirect()->back();
        }
        
    }


    
}
