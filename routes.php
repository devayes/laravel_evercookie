<?php
/* 
Examples:
  /ec/cache
  /ec/etag
  /ec/png
*/ 
Route::group(array('prefix' => 'ec'), function() {
    Route::get('cache', function(){ 
        if (!isset($_COOKIE["ec_cache"])) {
            return Response::make(null, 304);
        }
        $response = Response::make($_COOKIE["ec_cache"], 200);
        $response->header('Content-Type', 'text/html');
        $response->header('Last-Modified', 'Wed, 30 Jun 2010 21:36:48 GMT');
        $response->header('Expires', 'Tue, 31 Dec 2030 23:30:45 GMT');
        $response->header('Cache-Control', 'private, max-age=630720000');
        return $response;
    });
    Route::get('etag', function(){ 
        if (!isset($_COOKIE["ec_etag"])) {
            $response = Response::make(null, 304);
            $response->header('If-None-Match', '*');
            return $response;
        }
        $response = Response::make($_COOKIE["ec_etag"], 200);
        $response->header('Etag', $_COOKIE["ec_etag"]);
        return $response;
    });
    Route::get('png', function(){ 
        if (!isset($_COOKIE["ec_png"])) {
            return Response::make(null, 304);
        }
        $x = 200; $y = 1;
        $gd = imagecreatetruecolor($x, $y);
        $data_arr = str_split($_COOKIE["ec_png"]);
        $x = 0; $y = 0;
        for ($i = 0; $i < count($data_arr); $i += 3) {
            $color = imagecolorallocate($gd, ord($data_arr[$i]), ord($data_arr[$i+1]), ord($data_arr[$i+2]));
            imagesetpixel($gd, $x++, $y, $color);
        }
        ob_start();
        imagepng($gd);
        $img = ob_get_contents();
        ob_end_clean();
        imagedestroy($gd);
        $response = Response::make($img, 200);
        $response->header('Content-Type', 'image/png');
        $response->header('Last-Modified', 'Wed, 30 Jun 2010 21:36:48 GMT');
        $response->header('Expires', 'Tue, 31 Dec 2030 23:30:45 GMT');
        $response->header('Cache-Control', 'private, max-age=630720000');
        return $response;
    });
});
