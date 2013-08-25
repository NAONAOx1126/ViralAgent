<?php
/**
 * Copyright (C) 2012 Clay System All Rights Reserved.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 * http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @author    Naohisa Minagawa <info@clay-system.jp>
 * @copyright Copyright (c) 2010, Clay System
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Apache License, Version 2.0
 * @since PHP 5.3
 * @version   4.0.0
 */
 
/**
 * WEBからのアクセスを受け取るためのメインPHPです。
 */

// 出力バッファをフィルタするための関数です。
function filterOutputBuffer($content){
	return trim($content);
}

// 出力を抑制
ob_start("filterOutputBuffer");

try{
	// 共通のライブラリの呼び出し。
	require(dirname(__FILE__)."/require.php");
	if(TEMPLATE_NAME == THANKS_PAGE){
		// 現在のページがTHANKSページかチェックし、THANKSページであれば処理を実行
		require_once(APP_ROOT_PATH."/libs/Facebook.php");
		require_once(APP_ROOT_PATH."/libs/login.php");
		if(OGP_POST){
			require_once(APP_ROOT_PATH."/libs/ogp.php");
		}elseif(ALBUM_POST){
			require_once(APP_ROOT_PATH."/libs/album.php");
		}else{
			require_once(APP_ROOT_PATH."/libs/wall.php");
		}
	}
	
	if(file_exists(APP_ROOT_PATH.TEMPLATE_NAME)){
		echo file_get_contents(APP_ROOT_PATH.TEMPLATE_NAME);
	}
	ob_end_flush();
	
}catch(Exception $ex){
	// ダウンロードの際は、よけいなバッファリングをクリア
	while(ob_get_level() > 0){
		ob_end_clean();
	}
		// キャッシュ無効にするヘッダを送信
	echo $ex->getMessage();
}
