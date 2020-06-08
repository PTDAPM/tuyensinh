<?php

namespace App\Admin\Controllers;

use App\HosoNganh;
use App\HoSo;
use App\Nganh;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Facades\Admin;

class AdminHosoNganh extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'HoSo_Nganh';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new HosoNganh());

        $grid->column('id', __('Id'));
        $grid->column('ma_ho_so', __('Ma ho so'))->display(function($id) {
            return isset($id) ? "<b style='color:red'>".$id."</b>"." - ".HoSo::find($id)->ho_ten : "N/A";
        });
        $grid->column('ma_nganh', __('Ma nganh'))->display(function($id) {
            return isset($id) ? "<b style='color:red'>".$id."</b>"." - "."<a href='nganh-tohops?ma_nganh=".$id."'>".Nganh::find($id)->ten."</a>" : "N/A";
        });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->filter(function($filter){

            $filter->equal('ma_ho_so', 'Mã Hồ Sơ');
            $filter->equal('ma_nganh', 'Mã Ngành');
        });
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
