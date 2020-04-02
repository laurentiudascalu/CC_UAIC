<?php

/*
 * Copyright 2019 Google LLC.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

// [START appengine_flex_helloworld_index_php]
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
header("HTTP/1.0 200 OK");
header('Content-Type: text/html');
$app->get('/', function () {
	require('./pages/home.php');
	return false;
});
$app->get('/map', function () {
	require('./pages/map.php');
	return false;
});
$app->get('/fonts', function () {
	require('./pages/fonts.php');
	return false;
});
$app->get('/books', function () {
	require('./pages/books.php');
	return false;
});
$app->get('/youtube', function () {
	require('./pages/youtube.php');
	return false;
});

// @codeCoverageIgnoreStart
if (PHP_SAPI != 'cli') {
    $app->run();
}
// @codeCoverageIgnoreEnd

return $app;
// [END appengine_flex_helloworld_index_php]
