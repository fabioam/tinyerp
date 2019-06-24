<?php
/**
 * @author        Fabio AM <contact@fabioamartins.com.br>
 */

namespace TinyERP;

use TinyERP\Http;
use TinyERP\Api;
use TinyERP\Entity;

class TinyERP {

    protected $client;

    public function __construct($token)    {
        $this->client = new Http\Client($token);
    }

    public function product()
    {
        return new Api\Product($this->client);
    }
}