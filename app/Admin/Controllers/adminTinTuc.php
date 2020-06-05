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
    protected function grid()
    {
        $grid = new Grid(new TinTuc());
        $grid->model()->orderBy('id', 'desc');
        $grid->column('id', __('Id'))->sortable();
        $grid->column('tieu_de', __('Tieu de'));
        $grid->column('mo_ta', __('Mo ta'));
        $grid->column('noi_dung', __('Noi dung'));
        $grid->column('anh', __('Anh'))->image();
        $grid->column('trang_thai', __('Trang thai'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        // $grid->actions(function ($actions) {
        //     $actions->disableEdit();
        //     $actions->add(new Replicate);
        // });
        /////////////////
        /// tìm kiếm ///
        ////////////////
        $grid->quickSearch('tieu_de', 'mo_ta', 'noi_dung', 'created_at', 'updated_at');
        $grid->filter(function($filter){
            $filter->like('tieu_de','Tiêu Đề');
            $filter->between('created_at','Ngày Tạo')->datetime();
            $filter->equal('trang_thai','Trạng Thái')->radio([
                    0 => 'Chưa Duyệt',
                    1 => 'Đã Duyệt',
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
        $show->field('anh', __('Anh'));
        $show->field('trang_thai', __('Trang thai'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TinTuc());
        $form->text('tieu_de', __('Tieu de'));
        $form->text('mo_ta', __('Mo ta'));
        $form->text('noi_dung', __('Noi dung'));
        $form->image('anh', __('Anh'));
        $form->number('trang_thai', __('Trang thai'));
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
                'anh' => 'required',
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
    public function editNews(Request $request) {
        echo "ahihihih";
        
    }

    
}
