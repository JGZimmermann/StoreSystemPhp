<?php
    require_once('loginLogic.php');
    require_once('salesLogic.php');
    $ids = [];
    $items = [];
    $prices = [];
    $stocks = [];
    $cashDrawer = 0;

    function homepage()
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
                sales();
                break;
            case 2:
                register();
                sales();
                break;
            default:
                echo "Esta entrada não é válida! \n";
                homepage();
                break;
        }
    }
    $cashDrawer = readline("Digite quanto dinheiro existe no caixa: ");
    homepage();

    function sales()
    {
        global $ids;
        global $cashDrawer;

        system("clear");
        echo "Qual operação deseja realizar: \n1 - Cadastrar um item\n2 - Alterar um item\n3 - Deletar um item\n4 - Listar itens\n5 - Vender item\n6 - Logout\n7 - Exibir log\n8 - Exibir quanto tem em caixa\n9 - Sair\n";
        $choice = readline("Digite o numero da operação que deseja fazer: ");
        switch ($choice){
            case 1:
                $id = readline("Digite o ID do produto: ");
                $item = readline("Digite o nome do produto: ");
                $price = readline("Digite o preço do produto: ");
                $stock = readline("Digite a quantidade do produto: ");
                registerFullItem($id,$item,$price,$stock);
                sales();
                break;
            case 2:
                updateItem();
                sales();
                break;
            case 3:
                $id = readline("Digite o id do produto que deseja deletar: ");
                echo "Item deletado!";
                delete($id,$ids);
                sales();
                break;
            case 4:
                listItem();
                sales();
                break;
            case 5:
                $id = readline("Digite o id do produto que deseja vender: ");
                $quantity = readline("Digite a quantidade que deseja vender: ");
                $change = readline("Digite a quantidade de dinheiro que o cliente entregou: ");
                sellItem($id,$quantity,$cashDrawer,$change);
                sales();
                break;
            case 6:
                logout();
                homepage();
                break;
            case 7:
                showLog();
                sales();
                break;
            case 8:
                echo "$cashDrawer\n";
                sales();
                break;
            default:
                break;
        }
    }