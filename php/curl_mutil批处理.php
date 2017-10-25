<?php
function curl_muti($data){

    foreach($data as $k=>$v){
        $init = curl_init();//��ʼ��curl
        curl_setopt($init, CURLOPT_URL,$v['url']);//ץȡָ����ҳ
        curl_setopt($init, CURLOPT_HEADER, 0);//����header
        curl_setopt($init, CURLOPT_RETURNTRANSFER, 1);//Ҫ����Ϊ�ַ������������Ļ��
        curl_setopt($init, CURLOPT_POST, 1);//post�ύ��ʽ
        curl_setopt($init, CURLOPT_POSTFIELDS, $v['json']);
        
        curl_multi_add_handle($mh, $init);
        $conn[$k] = $init;
    }
    $mh = curl_multi_init();
    //ִ��
    do {
        curl_multi_exec($mh, $active);
    } while ($active);
    //��ȡ
    foreach ($conn as $k=>$v) {
        $re = curl_multi_getcontent($v);
        $country_info = json_decode($re, true);
        //var_dump($country_info);
        //echo "$k---$data<br/>";
        $data['return'] = $country_info;
    }
    //�ر�
    foreach ($conn as $v) {
        curl_multi_remove_handle($mh, $v);
        curl_close($v);
    }
    curl_multi_close($mh);

    return $data;

}
