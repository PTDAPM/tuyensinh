<?php

namespace App\Admin\Controllers;

use App\HosoNganh;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AdminHosoNganh extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\HosoNganh';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new HosoNganh());

        $grid->column('id', __('Id'));
        $grid->column('ma_ho_so', __('Ma ho so'));
        $grid->column('ma_nganh', __('Ma nganh'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(HosoNganh::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('ma_ho_so', __('Ma ho so'));
        $show->field('ma_nganh', __('Ma nganh'));
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
        $form = new Form(new HosoNganh());

        $form->number('ma_ho_so', __('Ma ho so'));
        $form->number('ma_nganh', __('Ma nganh'));

        return $form;
    }
}
