<?php
    function getLog()
    {
        return file("log.txt");
    }

    function getData()
    {
        return date("d.m.Y H:i:s");
    }

    function setLogLoginRegister($user,$action)
    {
        $log = getLog();
        $data = getData();
        $log[] = "O $user realizou $action no dia $data\n";
        file_put_contents("log.txt", $log);
    }

