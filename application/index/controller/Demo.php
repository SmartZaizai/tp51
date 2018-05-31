<?php


namespace app\index\controller;
use think\db;

class Demo
{

//    public function demo(){
//        var_dump(DB::execute("select * from staff"));
//    }



//    单一查询
    public function find(){
        $num = Db::table('staff') //表
            ->field(['name'=>'姓名','age'=>' 年龄','address'=>'地址']) //字段别名
            ->where('staff_id','>=','10') //查询条件
            ->find();
        dump($num);
    }

    //SQL : SELECT name,age FROM staff where staff_id>=10 limit 1;



//    查询
    public function select(){
        $num = Db::table('staff')
            ->field(['name'=>'姓名','age'=>' 年龄','address'=>'地址']) //字段别名
            ->where('age',">=",30)
            ->select();
        dump($num);
    }


//    插入
//用 Db 类的 insert 方法向数据库提交数据
    public function insert(){

        $data=[
            'name'=>'张飞',
            'age'=>'45',
            'address'=>'汉中',
            'iphone'=>'98989898'
        ];


//        添加数据后如果需要返回新增数据的自增主键，可以使用insertGetId方法新增数据并返回主键值：
//        $num = Db::table('staff')
//            ->insertGetId($data);
//
//        echo $num;
//        echo "<hr>";

        $data2=[
            'name'=>'关羽',
            'age'=>'50',
            'address'=>'香港',
            'iphone'=>'98980000'
        ];

        $num1 = Db::name('staff')
            ->data($data2)
            ->insert();

        echo $num1 ? '插入成功':'插入失败';



    }


    //添加多条数据直接向 Db 类的 insertAll 方法传入需要添加的数据即可
    public function insertAll(){

        $data2=[
            ['name'=>'凯','age'=>20,'address'=>'苏州','iphone'=>'33333333'],
            ['name'=>'曹操','age'=>60,'address'=>'济南','iphone'=>'44444444']
        ];

        $num = Db::table('staff')
            ->data($data2)
            ->insertAll();
        echo $num ? '插入成功,插入了'.$num.'条数据':'插入失败';
    }




    public function update(){

        //支持使用data方法传入要更新的数据
//        $num = Db::table('staff')
//            ->where('age','>=',40)
//            ->data(['iphone'=>'0108888888'])
//            ->update();
//
//        echo $num ? '更新成功,更新了'.$num.'条数据':'更新失败';

        //V5.1.7+版本以后，支持使用raw方法进行数据更新，适合在数组更新的情况。
        $num1 = Db::table('staff')
            ->where('staff_id','=',11)
            ->update(['iphone'=>Db::raw('010+iphone')]);

        echo $num1 ? '更新成功,更新了'.$num1.'条数据':'更新失败';
    }

    public function del(){
        $num = Db::table('staff')
            ->where('staff_id','=',11)
            ->delete();

        echo $num ? '成功删除了'.$num.'条数据':'删除失败';
    }

}