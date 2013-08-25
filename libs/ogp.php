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
 * FacebookのOGP投稿を行うためのモジュールです。
 */

/**
 * OGPのテキストを取得
 */
$wallText = "";
if(file_exists(APP_ROOT_PATH."/ogp.txt")){
	$ogpText = file_get_contents(APP_ROOT_PATH."/ogp.txt");
}
define("OGP_TEXT", $ogpText);


$_SERVER["facebook"]->api("/".$_SERVER["facebook_user"]["id"]."/feed", "POST", array(
	"message" => WALL_TEXT, 
	"picture" => ROOT_URL.URL_BASE.OGP_IMAGE_URL, 
	"link" => ROOT_URL.URL_BASE.LANDING_PAGE,
	"caption" => OGP_IMAGE_CAPTION,
	"description" => OGP_TEXT
));