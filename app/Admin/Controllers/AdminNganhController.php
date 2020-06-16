<?php

namespace App\Admin\Controllers;

use App\Nganh;
use App\Khoa;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Facades\Admin;

class AdminNganhController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'QL Ngành';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Nganh());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('ten', __('Ten'));
        $grid->column('ma_xet_tuyen', __('Ma xet tuyen'));
        $grid->column('id_khoa', __('Ma Khoa'));
        $grid->column('tin_tuc', __('Tin Tuc'));
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
        $show = new Show(Nganh::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('ten', __('Ten'));
        $show->field('ma_xet_tuyen', __('Ma xet tuyen'));
        $show->field('id_khoa', __('Ma Khoa'));
        $show->field('tin_tuc', __('Tin Tuc'));
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
        $form = new Form(new Nganh());

        $form->text('ten', __('Ten'));
        $form->text('ma_xet_tuyen', __('Ma xet tuyen'));
        $form->number('id_khoa', 'Mã Khoa');

        return $form;
    }
}
