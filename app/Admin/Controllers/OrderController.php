<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use App\Models\Price;
use App\Models\SupportedModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Đơn hàng';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        $grid->column('id', __('Id'));
        $grid->column('type', __('Loại máy'));
        $grid->model_id('Dòng máy')->display(function ($model_id) {
            $model = SupportedModel::find($model_id);
            if ($model) {
                return $model->model;
            }
        })->filter();
        $grid->column('phone_number', __('Phone number'));
        $grid->column('model_id', __('Model id'));
        $grid->column('storage', __('Storage'));
        $grid->column('battery', __('Battery'))->using(Constant::BATTERY_STATUS);
        $grid->column('screen', __('Screen'))->using(Constant::SCREEN_STATUS);
        $grid->column('case', __('Case'))->using(Constant::CASE_STATUS);
        $grid->column('keyboard', __('Keyboard'))->using(Constant::KEYBOARD_STATUS);
        $grid->column('price', __('Price'));
        $grid->column('status', __('Status'))->using(Constant::PHONE_STATUS);

        $grid->model()->orderBy('id', 'DESC');
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
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('model_id', __('Model id'));
        $show->field('storage', __('Storage'));
        $show->field('battery', __('Battery'));
        $show->field('screen', __('Screen'));
        $show->field('case', __('Case'));
        $show->field('keyboard', __('Keyboard'));
        $show->field('ring_tone', __('Ring tone'));
        $show->field('finger_print', __('Finger print'));
        $show->field('sim_tray', __('Sim tray'));
        $show->field('home', __('Home'));
        $show->field('face_id', __('Face id'));
        $show->field('touch_3d', __('Touch 3d'));
        $show->field('true_tone', __('True tone'));
        $show->field('charger', __('Charger'));
        $show->field('wireless_charger', __('Wireless charger'));
        $show->field('cellphone_wave', __('Cellphone wave'));
        $show->field('wifi', __('Wifi'));
        $show->field('speaker', __('Speaker'));
        $show->field('microphone', __('Microphone'));
        $show->field('front_camera', __('Front camera'));
        $show->field('back_camera', __('Back camera'));
        $show->field('calling_sensor', __('Calling sensor'));
        $show->field('light_sensor', __('Light sensor'));
        $show->field('compass_sensor', __('Compass sensor'));
        $show->field('headphone', __('Headphone'));
        $show->field('status', __('Status'));
        $show->field('price', __('Price'));
        $show->field('bank_name', __('Bank name'));
        $show->field('bank_account', __('Bank account'));
        $show->field('shipping_company', __('Shipping company'));
        $show->field('address', __('Address'));
        $show->field('province', __('Province'));
        $show->field('district', __('District'));
        $show->field('commune', __('Commune'));
        $show->field('phone_number', __('Phone number'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Order());
        $form->text('phone_number', __('Số điện thoại'))->required();
        $form->select('type', __('Loại'))->options(Constant::DEVICE_TYPE)->setWidth(2, 2)->required();
        $form->select('model_id', __('Dòng máy'))->options(SupportedModel::all()->pluck('model', 'id'))->required();
        $form->number('storage', __('Storage'));
        $form->number('battery', __('Battery'));
        $form->number('screen', __('Screen'));
        $form->number('case', __('Case'));
        $form->number('keyboard', __('Keyboard'));
        $form->number('ring_tone', __('Ring tone'));
        $form->number('finger_print', __('Finger print'));
        $form->number('sim_tray', __('Sim tray'));
        $form->number('home', __('Home'));
        $form->number('face_id', __('Face id'));
        $form->number('touch_3d', __('Touch 3d'));
        $form->number('true_tone', __('True tone'));
        $form->number('charger', __('Charger'));
        $form->number('wireless_charger', __('Wireless charger'));
        $form->number('cellphone_wave', __('Cellphone wave'));
        $form->number('wifi', __('Wifi'));
        $form->number('speaker', __('Speaker'));
        $form->number('microphone', __('Microphone'));
        $form->number('front_camera', __('Front camera'));
        $form->number('back_camera', __('Back camera'));
        $form->number('calling_sensor', __('Calling sensor'));
        $form->number('light_sensor', __('Light sensor'));
        $form->number('compass_sensor', __('Compass sensor'));
        $form->number('headphone', __('Headphone'));
        $form->text('price', __('Price'));
        $form->text('bank_name', __('Bank name'));
        $form->text('bank_account', __('Bank account'));
        $form->text('shipping_company', __('Shipping company'));
        $form->text('address', __('Address'));
        $form->text('province', __('Province'));
        $form->text('district', __('District'));
        $form->text('commune', __('Commune'));
        $form->select('status', __('Status'))->options(Constant::PHONE_STATUS)->default(0);

        return $form;
    }
}
