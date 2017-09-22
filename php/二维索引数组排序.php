/**
 * 数组排序
 * @param array 二维索引数组 $array
 * @param string 比较的键名 $str
 * @author lluck42 <lluck42@163.com>
 * @date 2017/09/21
 * @return array
 */

 function mySort($array,$str):array{
    $arr = [];
    $count = count($array);
    (array)$tmp;
    for($i;$i<=$count;$i++){
        foreach($array as $k=>$v){
            if(!isset($array[$k-1])){
                continue;
            }else{
                if($array[$k-1][$str] > $v[$str]){
                    $tmp = $array[$k-1];
                    $array[$k-1] = $v;
                    $array[$k] = $tmp;
                }
            }
        }

    }
    return $array;
 }
