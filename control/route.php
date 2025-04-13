<?php

 if(!isset($_REQUEST['submit'])){
    if(!isset($_REQUEST['page'])){
        if(!isset($_REQUEST['main'])){
            require($template['home']);
            die(0);
        }else{
            require("./route/main.php");
        }
    }else{
        require("./route/page.php");
    }
}else {
    require("./route/action.php");
}        

?>