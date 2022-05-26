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
        $grid->level1_price(__('Giá loại A'))->display(function ($price) {
            return "min: ".number_format($price["min"])." - max: ".number_format($price["max"]);
        });
        $grid->level2_price(__('Giá loại B'))->display(function ($price) {
            return "min: ".number_format($price["min"])." - max: ".number_format($price["max"]);
        });
        $grid->level3_price(__('Giá loại C'))->display(function ($price) {
            return "min: ".number_format($price["min"])." - max: ".number_format($price["max"]);
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
        $show = new Show(Price::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('model_id', __('Model id'));
        $show->field('storage', __('Storage'));
        $show->field('level1_price', __('Giá loại A'))->as(function ($price) {
            return "max: ".number_format($price["max"])." - min: ".number_format($price["min"]);
            //return json_encode($price);
        });
        $show->field('level2_price', __('Giá loại B'))->as(function ($price) {
            return json_encode($price);
        });
        $show->field('level3_price', __('Giá loại C'))->as(function ($price) {
            return json_encode($price);
        });
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
        $form = new Form(new Price());

        $form->select('type', __('Loại'))->options(Constant::DEVICE_TYPE)->setWidth(2, 2)->required();
        $form->select('model_id', __('Dòng máy'))->options(SupportedModel::all()->pluck('model', 'id'))->required();
        $form->number('storage', __('Dung lượng bộ nhớ (GB)'))->required();
        $form->embeds('level1_price',  __('Giá hàng loại A'), function ($form) {
            $form->currency('max')->symbol('VND')->rules('required');
            $form->currency('min')->symbol('VND')->rules('required');
        });
        $form->embeds('level2_price',  __('Giá hàng loại B'), function ($form) {
            $form->currency('max')->symbol('VND')->rules('required');
            $form->currency('min')->symbol('VND')->rules('required');
        });
        $form->embeds('level3_price',  __('Giá hàng loại C'), function ($form) {
            $form->currency('max')->symbol('VND')->rules('required');
            $form->currency('min')->symbol('VND')->rules('required');
        });

        return $form;
    }
}
