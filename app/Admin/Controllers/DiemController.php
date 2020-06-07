<?php

namespace App\Admin\Controllers;

use App\Diem;
use App\NguyenVong;
use App\HoSo;
use App\Tohop;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DiemController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'QL - Điểm';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Diem());

        $grid->column('id', __('Id'));
        $grid->column('ma_nguyen_vong', __('Ma nguyen vong'));
        $grid->column('lop10_m1', __('Lop10 m1'));
        $grid->column('lop10_m2', __('Lop10 m2'));
        $grid->column('lop10_m3', __('Lop10 m3'));
        $grid->column('lop11_m1', __('Lop11 m1'));
        $grid->column('lop11_m2', __('Lop11 m2'));
        $grid->column('lop11_m3', __('Lop11 m3'));
        $grid->column('lop12_m1', __('Lop12 m1'));
        $grid->column('lop12_m2', __('Lop12 m2'));
        $grid->column('lop12_m3', __('Lop12 m3'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->like('ma_nguyen_vong','Mã Nguyện Vọng');
            
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
        $show = new Show(Diem::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('ma_nguyen_vong', __('Ma nguyen vong'));
        $show->field('lop10_m1', __('Lop10 m1'));
        $show->field('lop10_m2', __('Lop10 m2'));
        $show->field('lop10_m3', __('Lop10 m3'));
        $show->field('lop11_m1', __('Lop11 m1'));
        $show->field('lop11_m2', __('Lop11 m2'));
        $show->field('lop11_m3', __('Lop11 m3'));
        $show->field('lop12_m1', __('Lop12 m1'));
        $show->field('lop12_m2', __('Lop12 m2'));
        $show->field('lop12_m3', __('Lop12 m3'));
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
        $form = new Form(new Diem());

        $form->number('ma_nguyen_vong', __('Ma nguyen vong'));
        $form->decimal('lop10_m1', __('Lop10 m1'));
        $form->decimal('lop10_m2', __('Lop10 m2'));
        $form->decimal('lop10_m3', __('Lop10 m3'));
        $form->decimal('lop11_m1', __('Lop11 m1'));
        $form->decimal('lop11_m2', __('Lop11 m2'));
        $form->decimal('lop11_m3', __('Lop11 m3'));
        $form->decimal('lop12_m1', __('Lop12 m1'));
        $form->decimal('lop12_m2', __('Lop12 m2'));
        $form->decimal('lop12_m3', __('Lop12 m3'));

        return $form;
    }
}
