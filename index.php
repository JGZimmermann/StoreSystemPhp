<?php
    require_once('loginLogic.php');
    require_once('salesLogic.php');
    $ids = [];
    $var =& $ids;
    $items = [];
    $prices = [];
    $stocks = [];

    function homepage($ids,$items,$prices,$stocks)
    {
        system("clear");
        echo "Qual operação deseja fazer: \n1 - Login\n2 - Registre-se \n";
        $choice = readline("Digite a operação que deseja realizar: ");
        $logged = false;
        switch ($choice){
            case 1:
                while(!$logged){
                    $logged = verifyLogin();
                }
                sales($ids,$items,$prices,$stocks);
                break;
            case 2:
                register();
                sales($ids,$items,$prices,$stocks);
                break;
            default:
                echo "Esta entrada não é válida! \n";
                homepage($ids,$items,$prices,$stocks);
                break;
        }
    }
    homepage($ids,$items,$prices,$stocks);
    function sales($ids,$items,$prices,$stocks)
    {
        system("clear");
        echo "Qual operação deseja realizar: \n1 - Cadastrar um item\n2 - Alterar um item\n3 - Deletar um item\n4 - Listar itens\n5 - Logout\n";
        $choice = readline("Digite o numero da operação que deseja fazer: ");
        switch ($choice){
            case 1:
                $id = readline("Digite o ID do produto: ");
                $item = readline("Digite o nome do produto: ");
                $price = readline("Digite o preço do produto: ");
                $stock = readline("Digite a quantidade do produto: ");
                registerFullItem($id,$item,$price,$stock);
                sales($ids,$items,$prices,$stocks);
                break;
            case 2:
                updateItem($ids);
                sales($ids,$items,$prices,$stocks);
                break;
            case 3:
                $id = readline("Digite o id do produto que deseja deletar: ");
                echo "Item deletado!";
                delete($id,$ids);
                sales($ids,$items,$prices,$stocks);
                break;
            case 4:
                listItem($ids,$items,$prices,$stocks);
                sales($ids,$items,$prices,$stocks);
                break;
            case 5:
                logout();
                homepage($ids,$items,$prices,$stocks);
                break;
        }
    }