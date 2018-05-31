<?php

namespace app\index\controller;

//导入staff表模型
use app\index\model\Staff as StaffModel;
use think\Db;


class Staff{

//    查询
    public function find(){

//        主键查询 get();返回一条数据
        $st = StaffModel::get(1);
        dump($st);
        echo $st['name'].'<br>';                        //数组
        echo $st->name.'--'.$st->age.'--'.$st->address; //返回staff对象，显示对象中name属性；


        //如果查询条件复杂可以使用闭包方式创建查询条件；
        $st1 = StaffModel::get(function ($query){
           $query->where('staff_id','>=','10')->where('age','>',24);
        });

        dump($st1);
        echo $st1['name']; //返回staff对象，显示对象中name属性；


        //查询构造器进行查询
        $st2 = StaffModel::where('staff_id','>=','10')->find();
        dump($st2); //返回staff对象，显示对象中name属性；



        //查询全部 //根据staff_id;
        $st3 = StaffModel::all([1,5,11]);
        dump($st3);

        $st4 = StaffModel::all(function ($query){
           $query->where('staff_id','>=','10')->where('age','>=',18)->select();
        });
        dump($st4);

        foreach ($st4 as $value) {
            echo '姓名：'.$value['name'].'  年龄：'.$value['age'].'<br>';
        }

    }

    //新增
    public function add(StaffModel $staff){
//        $staff->name='典韦';
//        $staff->age=38;
//        $staff->address='黄典坡';
//        $staff->iphone='001100';
//
//        $staff->save();

        //批量增加
        $list = [
            ['name'=>'老夫子','age'=>60,'address'=>'暂缺','iphone'=>01],
            ['name'=>'达摩','age'=>35,'address'=>'印度','iphone'=>001]
        ];

        $staff->saveAll($list);
        //和save方法不同的是，create方法返回的是当前模型的对象实例。
    }

    //和save方法不同的是，create方法返回的是当前模型的对象实例。
    public function create(StaffModel $staff){
        $stff = $staff::create(
            ['name'=>'王昭君','age'=>24]
        );
        echo $stff->name.'__'.$stff->age;
    }

    //修改
    public function update(){

        //先查询--后更新
//        $st = StaffModel::get(28);
//        $st->name='貂蝉';
//        $st->age='18';
//        $st->address='王府';
//        $st->iphone='1200';
//        $st->save();

        //对于复杂的查询条件，可以使用查询构造器查询数据并更新；
//        StaffModel::update(
//          ['name'=>'关二爷'],
//          ['staff_id'=>23]
//        );

        $st1 = StaffModel::where('staff_id','=',23)->where('name','=','关公')->find();
//        $st1->name='关公';
        $st1->name=Db::raw('name+2');
        $st1->save();




    }

    public function del(StaffModel $staff){
//        用静态方法（根据主键删除）
        $staff::destroy(27);

        $staff::destroy(function ($query){
           $query->where('staff_id','=',27);
        });

    }


    //软删除
    public function des(StaffModel $staff){
        //软删除
        $staff::destroy(31);

        //真实删除
        $staff::destroy(32,true);
    }


    public function sel(StaffModel $staff){
//        $st = $staff::all();
        //默认情况下查询的数据不包含软删除数据，
        //如果需要包含软删除的数据，可以使用下面的方式查询：
//        $st = $staff::withTrashed()->select();

//        仅仅需要查询软删除的数据，可以使用：
        //$st = $staff::onlyTrashed()->select();
        //恢复被软删除的数据
        $st = $staff::onlyTrashed()->find(31);
        $st->restore();

        dump($st);
    }

}

