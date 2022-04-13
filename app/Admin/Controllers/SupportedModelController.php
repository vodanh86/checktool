<?php

namespace App\Admin\Controllers;

use App\Models\SupportedModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SupportedModelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Các dòng máy hỗ trợ';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SupportedModel());

        $grid->column('type', __('Loại máy'));
        $grid->column('model', __('Model'));
        $grid->column('manufacturer', __('Hãng sản xuất'));
        $grid->column('board', __('Loại '));
        $grid->column('status', __('Trạng thái'))->using(Constant::STATUS);

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
        $show = new Show(SupportedModel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('type', __('Type'));
        $show->field('model', __('Model'));
        $show->field('manufacturer', __('Manufacturer'));
        $show->field('board', __('Board'));
        $show->field('status', __('Status'));
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
        $form = new Form(new SupportedModel());

        $form->select('type', __('Loại'))->options(Constant::DEVICE_TYPE)->setWidth(2, 2)->required();
        $form->text('model', __('Model'))->required();
        $form->text('manufacturer', __('Manufacturer'));
        $form->text('board', __('Board'));
        $form->select('status', __('Status'))->options(Constant::STATUS)->setWidth(2, 2)->default(1);

        return $form;
    }
}
