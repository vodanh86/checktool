<?php

namespace App\Admin\Controllers;

use URL;
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
        $grid->column('order_code', __('Mã giao dịch'));
        $grid->column('type')->filter(Constant::DEVICE_TYPE);
        $grid->model_id('Dòng máy')->display(function ($model_id) {
            $model = SupportedModel::find($model_id);
            if ($model) {
                return $model->model;
            }
        })->filter();
        $grid->column('name', __('Tên'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('appearance', __('Ngoại hình'))->image(URL::to("../storage/app/"),60,60);
        $grid->column('storage', __('Storage'));
        $grid->column('battery', __('Battery'))->display(function ($batery) {
            return $batery ? $batery." %" : "";
        });
        $grid->column('screen', __('Screen'))->using(Constant::SCREEN_STATUS);
        $grid->column('case', __('Case'))->using(Constant::CASE_STATUS);
        $grid->column('keyboard', __('Keyboard'))->using(Constant::KEYBOARD_STATUS);
        $grid->column('price', __('Price'));
        $grid->column('status', __('Status'))->editable('select', Constant::PHONE_STATUS);
        $grid->column('created_at', __('Created at'))->display(function ($date) {
            return date ("H:i d/m/Y", strtotime($date));  
        });
        $grid->column('updated_at', __('Updated at'))->display(function ($date) {
            return date ("H:i d/m/Y", strtotime($date));  
        });
        $grid->disableCreation();

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
        });

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

        $show->field('model_id', __('Model id'))->as(function ($model_id) {
            $model = SupportedModel::find($model_id);
            if ($model) {
                return $model->model;
            }
        });
        $show->field('name', __('Họ tên'));
        $show->field('birth_date', __('Ngày sinh'));
        $show->field('phone_number', __('Phone number'));
        $show->appearance()->image(URL::to("../storage/app/")."/");
        $show->front_image()->image(URL::to("../storage/app/")."/");
        $show->back_image()->image(URL::to("../storage/app/")."/");
        $show->field('storage', __('Storage'));
        $show->field('battery', __('Battery'));
        $show->field('crew', __('Ốc vít'))->using(Constant::SCREEN_STATUS);
        $show->field('screen', __('Screen'))->using(Constant::SCREEN_STATUS);
        $show->field('case', __('Case'))->using(Constant::CASE_STATUS);
        $show->field('keyboard', __('Keyboard'))->using(Constant::KEYBOARD_STATUS);
        $show->field('diaphragm', __('Màng loa'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('charging_port', __('charging port'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('finger_print', __('Finger print'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('sim_tray', __('Sim tray'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('home', __('Home'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('face_id', __('Face id'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('touch_3d', __('Touch 3d'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('true_tone', __('True tone'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('charger', __('Charger'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('wireless_charger', __('Wireless charger'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('cellphone_wave', __('Cellphone wave'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('wifi', __('Wifi'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('speaker', __('Speaker'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('tone_speaker', __('Tone speaker'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('recording_microphone', __('Recording microphone'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('front_microphone', __('Front microphone'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('back_microphone', __('Back microphone'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('microphone', __('Microphone'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('front_camera', __('Front camera'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('back_camera', __('Back camera'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('calling_sensor', __('Calling sensor'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('light_sensor', __('Light sensor'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('rotation_sensor', __('Rotation sensor'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('compass_sensor', __('Compass sensor'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('headphone', __('Headphone'))->using(Constant::DIAPHRAGM_STATUS);
        $show->field('status', __('Status'));
        $show->field('price', __('Price'));
        $show->field('bank_name', __('Bank name'));
        $show->field('bank_account', __('Bank account'));
        $show->field('shipping_company', __('Shipping company'));
        $show->field('address', __('Address'));
        $show->field('province', __('Province'));
        $show->field('district', __('District'));
        $show->field('commune', __('Commune'));

        $show->panel()->tools(function ($tools) {
            $tools->disableEdit();
            $tools->disableDelete();
        });;

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
        $form->number('diaphragm', __('Màng loa'));
        $form->number('charging_port', __('charging port'));
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
        $form->number('rotation_sensor', __('Rotation sensor'));
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
        $form->number('tone_speaker', __('Tone speaker'));
        $form->number('recording_microphone', __('Recording microphone'));
        $form->number('front_microphone', __('Front microphone'));
        $form->number('back_microphone', __('Back microphone'));

        return $form;
    }
}
