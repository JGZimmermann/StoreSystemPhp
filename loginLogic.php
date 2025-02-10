<?php
    function getUsers()
    {
        return file('users.txt');
    }
    function getPasswords()
    {
        return file('passwords.txt');
    }
    function verifyLogin($user, $password)
    {
        $users = getUsers();
        $passwords = getPasswords();
        $login = false;

        foreach ($users as $value){
            if($value == $user){
                $position = array_search($value,$users);
                if($passwords[$position] == $password){
                    $login = true;
                } else{
                    echo "Senha incorreta!";
                    $login = false;
                }
            } else{
                echo "Usuário não encontrado!";
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
            $users[] = $user."\n";
            $passwords[] = $password."\n";
            file_put_contents('users.txt',$users);
            file_put_contents('passwords.txt',$passwords);
        }
    }
    register();