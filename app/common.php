<?php
// 应用公共文件

/**
 * 创建订单号
 * @param $prefix  string 订单号前缀
 * @return string
 */
function CreateOrderId($prefix){
    return $prefix . date('YmdHis') . str_pad(rand(1,99999),5,'0',STR_PAD_LEFT);
}


/**
 * 加密
 * @param string $str    要加密的数据
 * @return bool|string   加密后的数据
 */
function encrypt($str) {
    $data = openssl_encrypt($str, 'AES-128-ECB', env('AES_KEY','bUYJ3nTV6VBasdJF'), OPENSSL_RAW_DATA);
    $data = base64_encode($data);
    return $data;
}

/**
 * 解密
 * @param string $str    要解密的数据
 * @return string        解密后的数据
 */
function decrypt($str) {
    $decrypted = openssl_decrypt(base64_decode($str), 'AES-128-ECB', env('AES_KEY','bUYJ3nTV6VBasdJF'), OPENSSL_RAW_DATA);
    return $decrypted;
}

/**
 * curl请求
 * @param $url
 * @param string $data
 * @param array $httpHeader
 * @return bool|string
 */
function curl_request($url,$data='',$httpHeader=[]){
    $curl = curl_init();
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, $url);
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 0); //set header
    if (!empty($httpHeader)) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $httpHeader);
    }
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    // CURLINFO_HEADER_OUT选项可以拿到请求头信息
    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    $output = curl_exec($curl);
    // 打印请求头信息
    echo curl_error($curl);
    // echo curl_getinfo($curl, CURLINFO_HEADER_OUT);
    curl_close($curl);
    return $output;
}

/**
 * 参数拼接
 * @param $param
 * @return string
 */
function getParamStr($param){
    if(!empty($param)){
        $str = '';
        foreach ($param as $k=>$val){
            $str .= $k.'='.$val.'&';
        }
        $strs = rtrim($str, '&');
        return $strs;
    }
    return '参数错误';
}

// 格式化时间：x秒前，x小时前，x天前，x月前
function format_time($time){
    if (empty($time)) {
        return $time;
    }
    if(!is_numeric($time)){
        if (PHP_VERSION < 5) {
            $matchs = array();
            preg_match_all('/(\S+)/', $time, $matchs);
            if ($matchs[0]) {
                $Mtom=array('Jan' => '01',
                    'Feb' => '02',
                    'Mar' => '03',
                    'Apr' => '04',
                    'May' => '05',
                    'Jun' => '06',
                    'Jul' => '07',
                    'Aug' => '08',
                    'Sep' => '09',
                    'Oct' => '10',
                    'Nov' => '11',
                    'Dec' => '12');
                $time = $matchs[0][5].$Mtom[$matchs[0][1]].$matchs[0][2].' '.$matchs[0][3];
            }
        }
        $t = strtotime($time);
    }else{
        $t = $time;
    }

    $differ = time() - $t;

    $year = date('Y', time());

    if (($year % 4) == 0 && ($year % 100) > 0) {
        //闰年
        $days = 366;
    } elseif (($year % 100) == 0 && ($year % 400) == 0) {
        //闰年
        $days = 366;
    } else {
        $days = 365;
    }

    if ($differ <= 60) {
        //小于1分钟
        if ($differ <= 0) {
            $differ = 1;
        }
        $format_time = L('%d秒前', $differ);
    } elseif ($differ > 60 && $differ <= 60 * 60) {
        //大于1分钟小于1小时
        $min = floor($differ / 60);
        $format_time = L('%d分钟前', $min);
    } elseif ($differ > 60 * 60 && $differ <= 60 * 60 * 24) {
        if (date('Y-m-d', time()) == date('Y-m-d', $t)) {
            //大于1小时小于当天
            $format_time = L('今天 %s', date('H:i', $t));
        } else {
            //大于1小时小于24小时
            $format_time = L('%s月%s日 %s', date('n', $t), date('j', $t), date('H:i', $t));
        }
    } elseif ($differ > 60 * 60 * 24 && $differ <= 60 * 60 * 24 * $days) {
        if (date('Y', time()) == date('Y', $t)) {
            //大于当天小于当年
            $format_time = L('%s月%s日 %s', date('n', $t), date('j', $t), date('H:i', $t));
        } else {
            //大于当天不是当年
            $format_time = L('%s年%s月%s日 %s', date('Y', $t), date('n', $t), date('j', $t), date('H:i', $t));
        }
    } else {
        //大于今年
        $format_time = L('%s年%s月%s日 %s', date('Y', $t), date('n', $t), date('j', $t), date('H:i', $t));
    }
    return $format_time;
}

/**
 * 显示时间 week
 * @param $time
 * @return mixed|string
 */
function foramt_show_time($time) {
    if(empty($time)){
        return $time;
    }
    if (date('Y', time()) == date('Y', $time)) {
        $format_time = sprintf('%s月%s日 %s',date('n',$time),date('j',$time),date('H:i',$time));
    } else {
        $week=array(0=> L('周日'),
            1=> L('周一'),
            2=> L('周二'),
            3=>L('周三'),
            4=> L('周四'),
            5=> L('周五'),
            6=> L('周六'));
        $format_time = L('%s年%s月%s日 %s %s',date('Y',$time),date('n',$time),date('j',$time),$week[date('w',$time)],date('H:i',$time));
    }

    return $format_time;

}

function L(){
    $p = func_get_args();
    return call_user_func_array('sprintf',$p);
}
