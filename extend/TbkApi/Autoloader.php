<?php

class Autoloader_tbk{
  
  /**
     * 类库自动加载，写死路径，确保不加载其他文件。
     * @param string $class 对象类名
     * @return void
     */
    public static function autoload_tbk($class) {
        $name = $class;
        if(false !== strpos($name,'\\')){
          $name = strstr($class, '\\', true);
        }
        
        $filename = TOP_AUTOLOADER_PATH."/top/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }

        $filename = TOP_AUTOLOADER_PATH."/top/request/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }

        $filename = TOP_AUTOLOADER_PATH."/top/domain/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }

        $filename = TOP_AUTOLOADER_PATH."/aliyun/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }

        $filename = TOP_AUTOLOADER_PATH."/aliyun/request/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }

        $filename = TOP_AUTOLOADER_PATH."/aliyun/domain/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }      

        $filename = TOP_AUTOLOADER_PATH."/dingtalk/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }
        $filename = TOP_AUTOLOADER_PATH."/dingtalk/request/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }

        $filename = TOP_AUTOLOADER_PATH."/dingtalk/domain/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }         
    }
}

if(!class_exists('Autoloader_tbk')){
    if(!function_exists('autoload_tbk')){
      spl_autoload_register('Autoloader_tbk::autoload_tbk');
    }
}
?>
