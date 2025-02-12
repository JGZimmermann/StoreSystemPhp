<?php

    require_once("logLogic.php");
    function registerItems($item)
    {
        global $items;
        $items[] = $item;
    }
    function registerIds($id)
    {
        global $ids;
        if(!in_array($id,$ids)) {
            $ids[] = $id;
            return false;
        } else{
            return true;
        }
    }
    function registerPrice($price)
    {
        global $prices;
        $prices[] = $price;
    }
    function registerStock($stock)
    {
        global $stocks;
        $stocks[] = $stock;
    }
    function registerFullItem($id,$item,$price,$stock)
    {
        if(!registerIds($id)) {
            registerItems($item);
            registerPrice($price);
            registerStock($stock);
            setLogRegister($item);
        } else{
            echo "ID já cadastrado!\n";
        }
    }

    function alterPrice($id,$idArray,$updateValue)
    {
        global $prices;
        $position = array_search($id,$idArray);
        $prices[$position] = $updateValue;
    }
    function alterItem($id,$idArray,$updateValue)
    {
        global $items;
        $position = array_search($id,$idArray);
        $items[$position] = $updateValue;
    }

    function alterStock($id,$idArray,$updateValue)
    {
        global $stocks;
        $position = array_search($id,$idArray);
        $stocks[$position] = $updateValue;
    }

    function delete($id,$idArray)
    {
        global $ids;
        global $items;
        global $prices;
        global $stocks;
        $position = array_search($id,$idArray);
        setLogDeleteItem($items[$position]);
        unset($ids[$position]);
        unset($items[$position]);
        unset($prices[$position]);
        unset($stocks[$position]);
    }

    function listItem()
    {
        global $ids;
        global $items;
        global $prices;
        global $stocks;
        foreach ($ids as $id){
            $position = array_search($id,$ids);
            $nome = $items[$position];
            $preco = $prices[$position];
            $estoque = $stocks[$position];
            echo "ID - $id     Nome - $nome     Preço - $preco    Estoque - $estoque\n";
        }
    }

    function sellItem($id,$quantity,$cashDrawer,$change)
    {
        global $cashDrawer;
        global $ids;
        global $items;
        global $stocks;
        global $prices;
        $position = array_search($id,$ids);
        if($stocks[$position] - $quantity >= 0) {
            if ($quantity * $prices[$position] <= $change && $cashDrawer > $change){
                $stocks[$position] -= $quantity;
                setLogSellItem($items[$position]);
                if($quantity * $prices[$position] < $change) {
                    $change -= $quantity * $prices[$position];
                    echo "O cliente entregou a mais do que necessário, o troco precisará ser para $change\n";
                    $cashDrawer -= $change;
                }
            } else{
                echo "Não foi possível concluir a compra!\n";
            }
        } else{
            echo "Não foi possível finalizar a compra, não possuímos essa quantidade do item em estoque!\n";
        }
    }
    function updateItem()
    {
        global $ids;
        echo "Qual valor deseja alterar: \n1 - Nome\n2 - Preço\n3 - Estoque\n";
        $choiceAlter = readline("Digite o numero da operação que deseja fazer: ");
        switch ($choiceAlter){
            case 1:
                $choiceId = readline("Digite o id do produto que deseja alterar: ");
                $choiceName = readline("Digite o valor que deseja: ");
                setLogUpdate($choiceName);
                alterItem($choiceId,$ids,$choiceName);
                echo "Valor alterado!";
                break;
            case 2:
                $choiceId = readline("Digite o id do produto que deseja alterar: ");
                $choicePrice = readline("Digite o valor que deseja: ");
                setLogUpdate("de id $choiceId");
                alterPrice($choiceId,$ids,$choicePrice);
                echo "Valor alterado!";
                break;
            case 3:
                $choiceId = readline("Digite o id do produto que deseja alterar: ");
                $choiceStock = readline("Digite o valor que deseja: ");
                setLogUpdate("de id $choiceId");
                alterStock($choiceId,$ids,$choiceStock);
                echo "Valor alterado!";
                break;
        }
    }


