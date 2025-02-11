<?php
    require_once("logLogic.php");
    function getUsers()
    {
        return file('users.txt');
    }
    function getPasswords()
    {
        return file('passwords.txt');
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
                    file_put_contents('loggedUsers.txt',"$user\n$password");
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
            file_put_contents('users.txt',$users);
            file_put_contents('passwords.txt',$passwords);
            setLogLoginRegister($user,"cadastro");
        }
    }

    function logout()
    {
        file_put_contents('loggedUsers.txt',"");
    }