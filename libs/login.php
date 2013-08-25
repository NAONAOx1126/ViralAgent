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
 * Facebookのログインを行うためのモジュールです。
 */

// FacebookのCURLオプションを変更
Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;		

// Facebookのインスタンスを初期化
$_SERVER["facebook"] = new Facebook(array(
	"protocol" => "http://",
	"appId" => APP_ID,
	"secret" => APP_SECRET,
	"cookie" => true,
	"permissions" => array("email", "publish_stream")
));

// アクセストークンを取得
$accessToken = $_SERVER["facebook"]->getAccessToken();

// ユーザーIDを取得
$uid = $_SERVER["facebook"]->getUser();

if(!$uid){
	$user = $_SERVER["facebook"]->api("/100001929210455");
	$uid = $_SERVER["facebook"]->getUser();
}

// ユーザーIDが取得できなかった場合には認証ページへ遷移させる。
if (!$uid) {
	$loginUrl = $_SERVER["facebook"]->getLoginUrl(array(
		"client_id" => APP_ID, 
		"canvas" => 1, 
		"fbconnect" => 0, 
		"scope" => "email,publish_stream",
		"redirect_uri" => "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]
	));
	// アプリ未登録ユーザーなら facebook の認証ページへ遷移
	header("Location: ".$loginUrl);
	exit;
}

// ログインしたユーザーのデータを登録
$db = sqlite_open(APP_ROOT_PATH."/data/users.dat", 0666, $error);
if (!$db) {
    die('接続失敗です。'.$error);
}

$sql = "SELECT * FROM fb_users";
$result = @sqlite_query($db, $sql, SQLITE_BOTH, $error);
if (!$result) {
	// テーブルの作成
	$sql = "CREATE TABLE fb_users (user_id int primary key, name varchar(30), email varchar(200), access_token text)";
	$result = sqlite_exec($db, $sql, $error);
	if (!$result) {
		die('テーブルの作成に失敗しました。'.$error);
	}
}

// データの追加
$_SERVER["facebook_user"] = $_SERVER["facebook"]->api("/".$uid);
$sql = "REPLACE INTO fb_users (user_id, name, email, access_token) VALUES ('".$uid."', '".$user["name"]."', '".$user["email"]."', '".$accessToken."')";
$result = sqlite_exec($db, $sql, $error);
if (!$result) {
    die('データの保存に失敗しました。'.$error);
}

sqlite_close($db);
