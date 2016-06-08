<?php

      $directory = "http://192.168.0.204/pwc/orufolder";
      $name = "007";

      $target = join(DIRECTORY_SEPARATOR, array($directory,$name));

      $path = parse_url($target, PHP_URL_PATH);

//To get the dir, use: dirname($path)

echo $_SERVER['DOCUMENT_ROOT'] . $path;
        echo "</br>";
      $ser = "http://" . $_SERVER['SERVER_NAME'];
      echo $ser."</br>";
      echo str_replace($ser, "", $target);
      echo "</br>";
      var_dump($target);
      die;

      $file_headers = @get_headers($directory);
      $isWin = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');
      if($isWin){
        if($file_headers[0] == 'HTTP/1.1 404 Not Found'){
          $folderInaccessible = false;
        }else{
          $r = fopen($directory, 'r');
          $w = fopen($directory, 'W');
          $meta_r = stream_get_meta_data($r);
          $meta_w = stream_get_meta_data($w);
          if($meta_r['mode'] == 'r' && $meta_w['mode'] == 'W'){
            $folderInaccessible = true;
          }else{
            $folderInaccessible = false;
          }
        }
      }else{
        if($file_headers[0] == 'HTTP/1.1 404 Not Found'){
          $folderInaccessible = false;
        }else{
          $w = fopen($directory, 'W');
          $meta_w = stream_get_meta_data($w);
          if($meta_w['mode'] == 'W'){
            $folderInaccessible = true;
          }else{
            $folderInaccessible = false;
          }
        }
      }

      var_dump($folderInaccessible);

?>
