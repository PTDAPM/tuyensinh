<?php

namespace App\Admin\Controllers;

use App\Khoa;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use App\Services\ImgurService;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Facades\Admin;
class KhoaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'QL Khoa';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Khoa());

        $grid->column('id', __('Id'));
        $grid->column('ten_khoa', __('Ten khoa'));
        $grid->column('anh', __('Anh'))->image();
        $grid->column('gioi_thieu', __('Gioi thieu'));
        $grid->column('so_sv', __('So sv'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->actions(function ($actions) {
            //$actions->disableEdit();
            if (!Admin::user()->can('delete-image')) {
                $actions->disableDelete();
            }
            //$actions->add(new Replicate);
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
        $show = new Show(Khoa::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('ten_khoa', __('Ten khoa'));
        $show->field('anh', __('Anh'))->image();
        $show->field('gioi_thieu', __('Gioi thieu'));
        $show->field('so_sv', __('So sv'));
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
        $form = new Form(new Khoa());

        $form->text('ten_khoa', __('Ten khoa'));
        $form->image('anh', __('Anh'));
        $form->textarea('gioi_thieu', __('Gioi thieu'));
        $form->number('so_sv', __('So sv'));
        $form->saved(function ($form) {
            $id             = $form->model()->id;
            $ten_khoa       = $form->model()->ten_khoa;
            $gioi_thieu     = $form->model()->gioi_thieu;
            $so_sv          = $form->model()->so_sv;
            $anh            = request()->anh;
            if(isset($anh)) {
                $imageUrl = ImgurService::uploadImage($anh->getRealPath());
                Khoa::where('id', $id)

              ->update(['ten_khoa' => $ten_khoa, 'gioi_thieu' => $gioi_thieu, 'so_sv' => $so_sv, 'anh' => $imageUrl]);
              admin_toastr('Sửa thành công', 'success');
                return redirect('admin/khoas');

            }
            else {
                Khoa::where('id', $id)
              ->update(['ten_khoa' => $ten_khoa, 'gioi_thieu' => $gioi_thieu, 'so_sv' => $so_sv]);
              admin_toastr('Sửa thành công', 'success');
                return redirect('admin/khoas'); 
            }
            
            

                
        });
        return $form;
    }
    public function createKhoa() {
        return view('formcreatekhoa');
    }
    public function saveKhoa(Request $request) {
        $request->validate([
                'ten' => 'required',
                'anh' => 'required',
                'noidung' => 'required',
                'sosv' => 'required',
                ]);
        $image = $request->anh;
        $imageUrl = ImgurService::uploadImage($image->getRealPath());
        $khoas = new Khoa;
        $khoas->ten_khoa    = $request->ten;
        $khoas->anh         = $imageUrl;
        $khoas->gioi_thieu  = $request->noidung;
        $khoas->so_sv       = $request->sosv;
        $khoas->save();
        return redirect()->back()->with('status', 'Thêm Khoa Thành Công!');
    }
}
