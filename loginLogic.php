<?php
    require_once("logLogic.php");
    function getUsers()
    {
        return file('data/users.txt');
    }
    function getPasswords()
    {
        return file('data/passwords.txt');
    }
    function verifyLogin()
    {
        $user = readline("Digite o usuário: ");
        $password = readline("Digite a senha: ");
        $users = getUsers();
        $passwords = getPasswords();
        $login = false;

        foreach ($users as $value){
            $value = trim($value);
            if($value == $user){
                $position = array_search($value,$users);
                if(trim($passwords[$position]) == $password){
                    $login = true;
                    file_put_contents('data/loggedUsers.txt',"$user\n$password");
                    setLogLoginRegister($user,"login");
                    return $login;
                } else{
                    echo "Senha incorreta!\n";
                    $login = false;
                }
            } else{
                echo "Usuário não encontrado!\n";
                $login = false;
            }
        }
        return $login;
    }

    function register()
    {
        $user = readline("Digite o usuário: ");
        $passwords = getPasswords();
        $users = getUsers();
        $userExists = false;
        foreach ($users as $value){
            $value = trim($value);
            if($value == $user){
                echo "Usuário já cadastrado!";
                $userExists = true;
            }
        }
        if(!$userExists){
            $password = readline("Digite a senha do usuário: ");
            $users[] = "$user\n";
            $passwords[] = "$password\n";
            file_put_contents('data/users.txt',$users);
            file_put_contents('data/passwords.txt',$passwords);
            setLogLoginRegister($user,"cadastro");
        }
    }

    function logout()
    {
        $log = getLog();
        $data = getData();
        $user = trim(getUser());
        $log[] = "O $user se deslogou no dia $data\n";
        file_put_contents("data/log.txt", $log);
        file_put_contents('data/loggedUsers.txt',"");
    }

    function showLog()
    {
        $logs = getLog();
        foreach ($logs as $log){
            echo $log;
        }
    }

    /*  Função com variável global
     *
     * function userGlobal()
    {
        global $users;
        $users = ["teste"];
        return $users;
    }

    function passwordGlobal()
    {
        global $passwords;
        $passwords = ["123"];
        return $passwords;
    }

    function login()
    {
        $users = userGlobal();
        $passwords = passwordGlobal();
        $userLogin = readline("Digite o usuário: ");
        $password = readline("Digite a senha: ");

        foreach ($users as $user){
            if($userLogin == $user){
                $position = array_search($user,$users);
                if($passwords[$position] == $password){
                    return true;
                } else{
                    echo "Senha incorreta! \n";
                    return false;
                }
            } else {
                echo "Usuário não encontrado! \n";
                return false;
            }
        }
        return false;
    }*/