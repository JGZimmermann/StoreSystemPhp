<?php
    function getLog()
    {
        return file("data/log.txt");
    }

    function getData()
    {
        return date("d.m.Y H:i:s");
    }

    function getUser()
    {
        $user = file("data/loggedUsers.txt");
        return $user[0];
    }

    function setLogLoginRegister($user,$action)
    {
        $log = getLog();
        $data = getData();
        $log[] = "O $user realizou $action no dia $data\n";
        file_put_contents("data/log.txt", $log);
    }

    function setLogRegister($item)
    {
        $log = getLog();
        $data = getData();
        $user = trim(getUser());
        $log[] = "O $user registrou o item $item no dia $data\n";
        file_put_contents("data/log.txt", $log);
    }
    function setLogUpdate($item)
    {
        $log = getLog();
        $data = getData();
        $user = trim(getUser());
        $log[] = "O $user alterou o item $item no dia $data\n";
        file_put_contents("data/log.txt", $log);
    }

    function setLogDeleteItem($item)
    {
        $log = getLog();
        $data = getData();
        $user = trim(getUser());
        $log[] = "O $user apagou o item $item no dia $data\n";
        file_put_contents("data/log.txt", $log);
    }

    function setLogSellItem($item)
    {
        $log = getLog();
        $data = getData();
        $user = trim(getUser());
        $log[] = "O $user vendeu o item $item no dia $data\n";
        file_put_contents("data/log.txt", $log);
    }