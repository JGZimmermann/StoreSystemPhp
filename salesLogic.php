<?php

    function registerItems($item)
    {
        global $items;
        $items[] = $item;
    }
    function registerIds($id)
    {
        global $ids;
        $ids[] = $id;
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
        registerIds($id);
        registerItems($item);
        registerPrice($price);
        registerStock($stock);
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
        unset($ids[$position]);
        unset($items[$position]);
        unset($prices[$position]);
        unset($stocks[$position]);
    }

    function listItem($ids,$items,$prices,$stocks)
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


    function updateItem($ids)
    {
        echo "Qual valor deseja alterar: \n1 - Nome\n2 - Preço\n3 - Estoque\n";
        $choiceAlter = readline("Digite o numero da operação que deseja fazer: ");
        switch ($choiceAlter){
            case 1:
                $choiceId = readline("Digite o id do produto que deseja alterar: ");
                $choiceName = readline("Digite o valor que deseja: ");
                alterItem($choiceId,$ids,$choiceName);
                echo "Valor alterado!";
                break;
            case 2:
                $choiceId = readline("Digite o id do produto que deseja alterar: ");
                $choicePrice = readline("Digite o valor que deseja: ");
                alterPrice($choiceId,$ids,$choicePrice);
                echo "Valor alterado!";
                break;
            case 3:
                $choiceId = readline("Digite o id do produto que deseja alterar: ");
                $choiceStock = readline("Digite o valor que deseja: ");
                alterStock($choiceId,$ids,$choiceStock);
                echo "Valor alterado!";
                break;
        }
    }


