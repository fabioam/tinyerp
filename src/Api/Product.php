<?php

namespace TinyERP\Api;

class Product extends AbstractApi {


    /**
     * @return mixed
     */

    function create( $data = null ){

        $pages = $this->getPagesToProcess($data);

        for ($page=0; $page<=$pages; $page++) {

            $offsetEnd = $page*$this->getBatchMaxItems()+$this->getBatchMaxItems()-1;
            if($offsetEnd >= sizeof($data)) $offsetEnd = sizeof($data);
            
            $dataSlice = array_slice($data, $page*$this->getBatchMaxItems(), $offsetEnd);
            $data_json = [ "produto" => json_encode(array('produtos' => $dataSlice), JSON_UNESCAPED_SLASHES) ];
            $response[] = $this->client->request( 'POST', 'produto.incluir.php', $data_json );
        }

        return $response;

    }

    /**
     * @return mixed
     */

    function update( $data = null ){

        $pages = $this->getPagesToProcess($data);

        for ($page=0; $page<=$pages; $page++) {

            $offsetEnd = $page*$this->getBatchMaxItems()+$this->getBatchMaxItems()-1;
            if($offsetEnd >= sizeof($data)) $offsetEnd = sizeof($data);

            $dataSlice = array_slice($data, $page*$this->getBatchMaxItems(), $offsetEnd);
            $data_json = [ "produto" => json_encode(array('produtos' => $dataSlice), JSON_UNESCAPED_SLASHES) ];
            $response[] = $this->client->request( 'POST', 'produto.alterar.php', $data_json );
        }

        return $response;

    }

    /**
     * @return mixed
     */

    function search( $sku = null ){

        $data_json = [ "produto" => json_encode(array('pesquisa' => $sku), JSON_UNESCAPED_SLASHES) ];
        $response[] = $this->client->request( 'POST', 'produtos.pesquisa.php', $data_json );

        return $response;

    }

}