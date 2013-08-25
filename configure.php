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

/** Facebookのアプリケーション名 */
define("APP_NAME", "Test");

/** FacebookのアプリケーションID */
define("APP_ID", "464151050329346");

/** Facebookのアプリケーションシークレット */
define("APP_SECRET", "43125b00a5b148801f381e203a14d8bb");

/** アルバム投稿をするかどうか、falseなら通常のウォール投稿になります。 */
define("ALBUM_POST", true);

/** アルバム投稿する場合のアルバム名 */
define("ALBUM_NAME", "テスト");

/** アルバム投稿する場合の画像ファイル名 */
define("ALBUM_IMAGE_FILE", "/album_image.jpg");

/** ウォールに投稿するタイトル */
define("WALL_TITLE", "テストです");

/** ウォールに投稿する本文のテキストファイル */
define("WALL_TEXT_FILE", "/wall.txt");

/** OGP投稿をするかどうか、falseなら通常のウォール投稿になります。アルバム投稿よりも優先されます。 */
define("OGP_POST", true);

/** OGPの画像のリンク先を指定 */
define("OGP_IMAGE_URL", "/ogp_image.jpg");

/** OGPのページのキャプション */
define("OGP_IMAGE_CAPTION", "キャプションです。");

/** 申込完了画面のファイル名 */
define("LANDING_PAGE", "/index.html");

/** 申込完了画面のファイル名 */
define("THANKS_PAGE", "/thanks.html");
