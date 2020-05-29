<?php

namespace App\Admin\Controllers;

use App\Nganh;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AdminNganhController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Nganh';

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
        $show = new Show(Nganh::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('ten', __('Ten'));
        $show->field('ma_xet_tuyen', __('Ma xet tuyen'));

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

        return $form;
    }
}
