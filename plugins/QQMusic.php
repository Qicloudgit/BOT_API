<?php
/*
* @Plugin Name：QQ音乐点歌
* @Author：Hanximeng
* @Version：Beta_0.0.1
*/

if(strpos($Data['message'],"QQ点歌 ")!==false){
	$Info=explode('QQ点歌 ',$Data['message']);
	if($Info[1]!=='' && $Info[0]==''){
		$Song=curl('https://c.y.qq.com/soso/fcgi-bin/client_search_cp?n=1&format=json&w='.$Info[1]);
		$ID=json_decode($Song,true)['data']['song']['list']['0']['songid'];
		$Text='[CQ:music,type=qq,id='.$ID.']';
		//判断是否存在group_id，若不存在则为私聊
		if(!empty($Data['group_id'])){
			http_post_json('send_msg','{"group_id":"'.$Data['group_id'].'","message":"'.$Text.'"}');
		}else{
			http_post_json('send_msg','{"user_id":"'.$Data['user_id'].'","message":"'.$Text.'"}');
		}
	}
}
?>