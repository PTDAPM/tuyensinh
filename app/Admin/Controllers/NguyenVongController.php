<?php

namespace App\Admin\Controllers;

use App\NguyenVong;
use App\ToHop;
use App\Nganh;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Facades\Admin;

class NguyenVongController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'QL Nguyện Vọng';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new NguyenVong());

        $grid->column('id', __('Id'));
        
        $grid->column('ma_ho_so', __('Ma ho so'));
        $grid->column('ma_to_hop', __('Ma to hop'))->display(function($id){
            return isset($id) ? ToHop::find($id)->ten : "NULL";
        });
       
        $grid->column('ma_nganh', __('Ma nganh'))->display(function($id){
            return isset($id) ? Nganh::find($id)->ten : "NULL";
        });
        $grid->column('XEM ĐIỂM')->display(function(){
            return "<a href='diems?ma_nguyen_vong=".$this->id."'>XEM ĐIỂM</a>";
        });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->filter(function($filter){
            //$filter->disableIdFilter();
            $filter->equal('ma_ho_so','Mã Hồ Sơ');
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
        $show = new Show(NguyenVong::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('ma_ho_so', __('Ma ho so'));
        $show->field('ma_to_hop', __('Ma to hop'));
        
        
        $show->field('ma_nganh', __('Ma nganh'));
        $show->field('thu_tu', __('Thu tu'));
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
        $form = new Form(new NguyenVong());

        $form->number('ma_to_hop', __('Ma to hop'));
        $form->number('ma_ho_so', __('Ma ho so'));
        $form->number('thu_tu', __('Thu tu'));
        $form->number('ma_nganh', __('Ma nganh'));

        return $form;
    }
}
