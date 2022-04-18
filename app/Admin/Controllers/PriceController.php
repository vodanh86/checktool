<?php

namespace App\Admin\Controllers;

use App\Models\Price;
use App\Models\SupportedModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PriceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Giá nhập';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Price());
        $grid->column('type', __('Loại máy'));
        $grid->model_id('Dòng máy')->display(function ($model_id) {
            $model = SupportedModel::find($model_id);
            if ($model) {
                return $model->model;
            }
        })->filter();
        $grid->column('storage', __('Dung lương bộ nhớ (GB)'));
        $grid->column('level1_price', __('Giá loại 1'));
        $grid->column('level2_price', __('Giá loại 2'));
        $grid->column('level3_price', __('Giá loại 3'));
        $grid->column('level4_price', __('Giá loại 4'));

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
        $show = new Show(Price::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('model_id', __('Model id'));
        $show->field('storage', __('Storage'));
        $show->field('level1_price', __('Level1 price'));
        $show->field('level2_price', __('Level2 price'));
        $show->field('level3_price', __('Level3 price'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('level4_price', __('Level4 price'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Price());

        $form->select('type', __('Loại'))->options(Constant::DEVICE_TYPE)->setWidth(2, 2)->required();
        $form->select('model_id', __('Dòng máy'))->options(SupportedModel::all()->pluck('model', 'id'))->required();
        $form->number('storage', __('Dung lượng bộ nhớ (GB)'));
        $form->text('level1_price', __('Giá loại 1'));
        $form->text('level2_price', __('Giá loại 2'));
        $form->text('level3_price', __('Giá loại 3'));
        $form->text('level4_price', __('Giá loại 4'));

        return $form;
    }
}
