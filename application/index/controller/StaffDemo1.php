<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\Staff;

class StaffDemo1 extends Controller{

    public function getatr(Staff $staff){
        $st = $staff::all();
        //$st = $staff::get(28);
        //dump($st);

        ////获取器1
//        foreach ($st as $value){
//            echo $value->name.'---'.$value->age.'<br>';
//        }


        ////获取器2
        ////getData 获取原始值
//        foreach ($st as $value){
//            echo $value->age.'--->'.$value->getData('age').'<br>';
//        }

        ////获取器3
        foreach ($st as $value){
            //查看一个不存在的字段信息
            echo $value->staff_text.'<br>';
        }
    }

    public function setatr(Staff $staff){
        $staff::create(['name'=>'宫本武藏','create_time'=>'2018-05-30']);
    }


}
