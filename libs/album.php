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
 * Facebookのアルバム投稿を行うためのモジュールです。
 */

$album_id = $_SERVER["facebook"]->api("/".$_SERVER["facebook_user"]["id"]."/albums", "POST", array(
	"name" => ALBUM_NAME 
));

$_SERVER["facebook"]->setFileUploadSupport( true );
$_SERVER["facebook"]->api("/".$album_id["id"]."/photos", "POST", array(
	"source" => "@".APP_ROOT_PATH.ALBUM_IMAGE_FILE, 
	"message" => WALL_TEXT."\r\n\r\n".ROOT_URL.URL_BASE.LANDING_PAGE
));