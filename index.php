<?php
    require_once('loginLogic.php');

    function homepage()
    {
        echo "Qual operação deseja fazer: \n1 - Login\n2 - Registre-se \n";
        $choice = readline("Digite a operação que deseja realizar: ");
        $logged = false;
        switch ($choice){
            case 1:
                while(!$logged){
                    $logged = verifyLogin();
                }
                break;
            case 2:
                register();
                break;
            default:
                echo "Esta entrada não é válida! \n";
                homepage();
                break;
        }
    }
    homepage();
