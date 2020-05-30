<?php

namespace App\Admin\Controllers;

use App\NganhTohop;
use App\Nganh;
use App\Tohop;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AdminControllerNganhTohop extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'NganhTohop';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new NganhTohop());

        $grid->column('id', __('Id'));
        $grid->column('ma_nganh', __('Ma nganh'))->display(function($id) {
            return isset($id) ? "<b style='color:red'>".$id."</b>"." - ".Nganh::find($id)->ten." - ".Nganh::find($id)->ma_xet_tuyen : "N/A";
        });
        $grid->column('ma_to_hop', __('Ma to hop'))->display(function($id) {
            return isset($id) ? "<b style='color:red'>".$id."</b>"." - ".ToHop::find($id)->ten : "N/A";
        });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->filter(function($filter){

            $filter->equal('ma_nganh', 'Mã Ngành ');
            $filter->equal('ma_to_hop', 'Mã Tổ Hợp');
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
        $show = new Show(NganhTohop::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('ma_nganh', __('Ma nganh'));
        $show->field('ma_to_hop', __('Ma to hop'));
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
        $form = new Form(new NganhTohop());

        $form->number('ma_nganh', __('Ma nganh'));
        $form->number('ma_to_hop', __('Ma to hop'));

        return $form;
    }
}
