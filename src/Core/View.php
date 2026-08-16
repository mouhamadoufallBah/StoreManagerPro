<?php

namespace StoreManagerPro\Src\Core;

class View
{
    public static function render(string $path, array $data, string $layout = "base")
    {
        extract($data);


        $file = BASEPATH . "/views/$path.php";
        if (file_exists($file)) {
            ob_start();
            require_once($file);
            $content = ob_get_clean();
            require(BASEPATH."/views/layout/$layout.html.php");
        }
    }
}
