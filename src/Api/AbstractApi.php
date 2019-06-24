<?php

namespace TinyERP\Api;

abstract class AbstractApi {

    const ENDPOINT = 'https://api.tiny.com.br/api2/'; // including slash

    public $client;

    private $_batchMaxItems = 20;

    public function __construct($client) {
        $this->client = $client;
    }

    public function getBatchMaxItems() {
        return $this->_batchMaxItems;
    }

    public function getPagesToProcess($data) {
        $dataSize = sizeof($data);
        if($dataSize > $this->_batchMaxItems) {
            return ($dataSize % $this->_batchMaxItems == 0) ? intval($dataSize/$this->_batchMaxItems) : intval($dataSize/$this->_batchMaxItems) + 1 ;
        }

        return 1;
    }


}