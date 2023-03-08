<?php

namespace Src\controllers;

use Src\app\QuoteGateway;
use Src\models\Quote;

class QuoteController
{
    // CRUD mechanism for the quotes

    public function __construct(private QuoteGateway $quoteGateway) {

    }

    public function processRequest(string $method, ?string $id): void {
        if($id) {
            $this->processResourceRequest($method, $id);
        } else {
            $this->processCollectionRequest($method);
        }
    }

    private function processResourceRequest(string $method, string $id): void {

    }

    private function processCollectionRequest(string $method): void {
        switch ($method) {
            case 'GET':
                echo json_encode($this->quoteGateway->getAll());
                break;
            case 'POST':
                print 'POST';
                break;
        }
    }
}