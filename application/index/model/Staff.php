<?php

namespace app\index\model;

use think\Model;
//引入SoftDelete类
use think\model\concern\SoftDelete;

class Staff extends Model
{
    use SoftDelete;
    //表名
    protected $table = 'staff';

    protected $pk = 'staff_id';


    //软删除
    protected $deleteTime = 'delete_time';

    protected $defaultSoftDelete=0;



    //获取器
    //get Xxx Attr方法名
    //Xxx 表中字段，首字母大写
    // getFieldNameAttr 为数据表字段的驼峰转换

    //获取器1
//    protected function getAgeAttr($value){
//
//        //$date=[18=>'小鲜肉',30=>'中年危机',60=>'夕阳红',1000=>'老妖精'];
//
//        if($value>=18 && $value<=30){
//            return '小鲜肉';
//        }else if($value>=31 && $value<=60){
//            return '中年危机';
//        }else if($value>60){
//            return '老妖精';
//        }
//        //return $date[$value];
//    }

    //////获取器2
//    protected function getAgeAttr($value,$date){
//        if($value>=18 && $value<=30){
//            return $date['name'].',年龄为:'.$date['age'].',划分为：'.'小鲜肉行列';
//        }else if($value>=31 && $value<=60){
//            return $date['name'].',年龄为:'.$date['age'].',划分为：'.'老腊肉行列';
//        }else if($value>60){
//            return $date['name'].',年龄为:'.$date['age'].',划分为：'.'活死人行列';
//        }
//    }
    //////获取器3
    /// 定义表中不存在的字段
    protected function getStaffTextAttr($value,$date){
        //
        return '没有staff_text字段，自定义了俏皮了一下，其实我是:'.$date['name'];
    }


    //修改器
    //create_time字段写入操作时会自动转换为时间戳格式；
    protected function setCreateTimeAttr($value){
        return strtotime($value);
    }

}