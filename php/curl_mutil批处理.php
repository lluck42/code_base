<?php
function curl_muti($data){

    foreach($data as $k=>$v){
        $init = curl_init();//初始化curl
        curl_setopt($init, CURLOPT_URL,$v['url']);//抓取指定网页
        curl_setopt($init, CURLOPT_HEADER, 0);//设置header
        curl_setopt($init, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($init, CURLOPT_POST, 1);//post提交方式
        curl_setopt($init, CURLOPT_POSTFIELDS, $v['json']);
        
        curl_multi_add_handle($mh, $init);
        $conn[$k] = $init;
    }
    $mh = curl_multi_init();
    //执行
    do {
        curl_multi_exec($mh, $active);
    } while ($active);
    //获取
    foreach ($conn as $k=>$v) {
        $re = curl_multi_getcontent($v);
        $country_info = json_decode($re, true);
        //var_dump($country_info);
        //echo "$k---$data<br/>";
        $data['return'] = $country_info;
    }
    //关闭
    foreach ($conn as $v) {
        curl_multi_remove_handle($mh, $v);
        curl_close($v);
    }
    curl_multi_close($mh);

    return $data;

}
