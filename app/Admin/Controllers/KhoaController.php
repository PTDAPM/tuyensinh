<?php

namespace App\Admin\Controllers;

use App\Khoa;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
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
        $grid->column('anh', __('Anh'));
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
        $show->field('anh', __('Anh'));
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
        $form->text('anh', __('Anh'));
        $form->textarea('gioi_thieu', __('Gioi thieu'));
        $form->number('so_sv', __('So sv'));

        return $form;
    }
}
