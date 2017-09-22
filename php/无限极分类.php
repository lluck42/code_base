<?php

//拆分无限极分类
//查询子集，返回结果
function classify($array,$pid=0){
    $arr = [];
    foreach($array as $val){
        if($val['pid']==$pid){
            $val = array_merge($val,classify($array,$val['id']));
            $arr[] = $val;
        }
    }
    return $arr;
}