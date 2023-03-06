<?php

namespace Src\controllers;

class QuoteController
{
    // CRUD mechanism for the quotes

    public function processRequest(string $method, ?string $id): void {
        if($id) {

        } else {

        }
    }

    private function processResourceRequest(string $method, string $id): void {

    }

    private function processCollectionRequest(string $method): void {
        switch ($method) {
            case 'GET':
                print 'GET';
                break;
            case 'POST':
                print 'POST';
                break;
        }
    }
}