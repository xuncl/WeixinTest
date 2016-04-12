<?php


$data='{
           "touser":"oQoIuwPcoG_fwLMDiJGWdZ4RmGmI",
           "template_id":"ngqIpbwh8bUfcSsECmogfXcV14J0tQlEpBO27izEYtY",
           "url":"http://www.baidu.com/",
           "topcolor":"#FF0000",            
           "data":{
                   "first": {
                       "value":"你好，你收到了新消息！",
                       "color":"#173177"
                   },
                   "keynote1":{
                       "value":"铝矾土",
                       "color":"#173177"
                   },
                   "keynote2": {
                       "value":"26吨",
                       "color":"#173177"
                   },
                   "keynote3": {
                       "value":"2014年9月22日",
                       "color":"#173177"
                   },
                   "remark":{
                       "value":"超级矿资源！",
                       "color":"#173177"
                   }
           }
       }';
$sendUrl="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".getToken();
$sendarr=(array)json_decode(postOutput($data,$sendUrl));
// echo $shortarr['short_url'];
print_r($sendarr);

function getToken(){
	/*获取Token*/
	$appid="wxd4b77c94a9bc7e46";
	$secret="f264362d4d2e7626ac4c19b40b860509";
	$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
	$output = getOutput($url);
	$token=(array)json_decode($output);
	return $token['access_token'];
}

function getOutput($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}

function postOutput($data, $url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	// curl_setopt($ch, CURLOPT_USERAGENT, "");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$tmpInfo = curl_exec($ch);
	if (curl_errno($ch)){
		return curl_errno($ch);
	}
	curl_close($ch);
	return $tmpInfo;
}
?>