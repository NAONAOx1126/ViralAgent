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

session_start();

$urlPath = str_replace("?".$_SERVER["QUERY_STRING"], "", $_SERVER["REQUEST_URI"]);

$rootPath = realpath(dirname(__FILE__));

$basePath = str_replace($_SERVER["DOCUMENT_ROOT"], "", realpath(dirname(__FILE__)));

$templatePath = str_replace($basePath, "", $urlPath);
if(substr($templatePath, -1) == "/"){
	$templatePath .= "index.html";
}

/**
 * 定数の設定
 */
define("APP_ROOT_PATH", $rootPath);

define("ROOT_URL", "https://".$_SERVER["SERVER_NAME"]);

define("URL_BASE", $basePath);

define("TEMPLATE_NAME", $templatePath);

/**
 * 設定ファイルの読み込み
 */
require_once(APP_ROOT_PATH."/configure.php");

/**
 * WALLのテキストを取得
 */
$wallText = "";
if(file_exists(APP_ROOT_PATH.WALL_TEXT_FILE)){
	$wallText = file_get_contents(APP_ROOT_PATH.WALL_TEXT_FILE);
}
define("WALL_TEXT", $wallText);

