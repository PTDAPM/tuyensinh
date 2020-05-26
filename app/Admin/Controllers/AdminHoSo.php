<?php

namespace App\Admin\Controllers;

use App\HoSo;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Admin;

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
    protected function grid()
    {
        $grid = new Grid(new HoSo());
        $grid->disableCreateButton();
        //$grid->disableActions();
        $grid->column('id', __('Id'))->sortable();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('ho_ten', __('Ho ten'));
        $grid->column('gioi_tinh', __('Gioi tinh'));
        $grid->column('ngay_thang_nam_sinh', __('Ngay thang nam sinh'));
        $grid->column('noi_sinh', __('Noi sinh'));
        $grid->column('dan_toc', __('Dan toc'));
        $grid->column('cmnd', __('Cmnd'));
        $grid->column('ngay_cap', __('Ngay cap'));
        $grid->column('noi_cap', __('Noi cap'));
        $grid->column('ho_khau', __('Ho khau'));
        $grid->column('ma_tinh', __('Ma tinh'));
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
            })->image('/public/photos', 50, 50);
        $grid->column('trang_thai', __('Trang thai'))->editable('select', HoSo::STATUS);
        Admin::script("$('img').click(function(e) {
            var link = $(this).attr('src');
            e.preventDefault();
            window.open(link);
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
        $show->field('gioi_tinh', __('Gioi tinh'));
        $show->field('ngay_thang_nam_sinh', __('Ngay thang nam sinh'));
        $show->field('noi_sinh', __('Noi sinh'));
        $show->field('dan_toc', __('Dan toc'));
        $show->field('cmnd', __('Cmnd'));
        $show->field('ngay_cap', __('Ngay cap'));
        $show->field('noi_cap', __('Noi cap'));
        $show->field('ho_khau', __('Ho khau'));
        $show->field('ma_tinh', __('Ma tinh'));
        $show->field('ma_huyen', __('Ma huyen'));
        $show->field('ma_xa', __('Ma xa'));
        $show->field('anh_hoc_ba', __('Anh hoc ba'));
        $show->field('sdt', __('Sdt'));
        $show->field('email', __('Email'));
        $show->field('dia_chi', __('Dia chi'));
        $show->field('nam_tot_nghiep', __('Nam tot nghiep'));
        $show->field('kv_uu_tien', __('Kv uu tien'));
        $show->field('doi_tuong_uu_tien', __('Doi tuong uu tien'));
        $show->field('trang_thai', __('Trang thai'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new HoSo());

        $form->text('ho_ten', __('Ho ten'));
        $form->number('gioi_tinh', __('Gioi tinh'));
        $form->datetime('ngay_thang_nam_sinh', __('Ngay thang nam sinh'))->default(date('Y-m-d H:i:s'));
        $form->text('noi_sinh', __('Noi sinh'));
        $form->text('dan_toc', __('Dan toc'));
        $form->text('cmnd', __('Cmnd'));
        $form->datetime('ngay_cap', __('Ngay cap'))->default(date('Y-m-d H:i:s'));
        $form->text('noi_cap', __('Noi cap'));
        $form->text('ho_khau', __('Ho khau'));
        $form->number('ma_tinh', __('Ma tinh'));
        $form->number('ma_huyen', __('Ma huyen'));
        $form->number('ma_xa', __('Ma xa'));
        $form->textarea('anh_hoc_ba', __('Anh hoc ba'));
        $form->text('sdt', __('Sdt'));
        $form->email('email', __('Email'));
        $form->text('dia_chi', __('Dia chi'));
        $form->text('nam_tot_nghiep', __('Nam tot nghiep'));
        $form->text('kv_uu_tien', __('Kv uu tien'));
        $form->text('doi_tuong_uu_tien', __('Doi tuong uu tien'));
        $form->number('trang_thai', __('Trang thai'));

        return $form;
    }
}
