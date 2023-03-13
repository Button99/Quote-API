<?php

namespace Src\controllers;

use Src\app\QuoteGateway;

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
        $quote= $this->quoteGateway->get($id);
        if(!$quote) {
            http_response_code(404);
            echo json_encode(['message'=> 'Quote not found']);
        }

        switch ($method) {
            case 'GET':
                echo json_encode($quote);
                break;
            case 'PATCH':
                $data= (array) json_decode(file_get_contents("php://input"), true);
                $errors= $this->getValidationErrors($data);
                if(!empty($errors)) {
                    http_response_code(422);
                    echo json_encode(["Errors"=> $errors]);
                    break;
                }
                $rows= $this->quoteGateway->update($quote, $data);
                http_response_code(201);
                echo json_encode([
                    "message"=> "Quote updated!",
                    "rows"=> $rows
                ]);
                break;
            case 'DELETE':
                $rows= $this->quoteGateway->delete($id);
                echo json_encode([
                    'mesage'=> 'Deleted',
                    'rows' => $rows
                ]);
                break;
            default:
                http_response_code(405);
                header('Allowed methods: GET and POST');
        }
        echo json_encode($quote);
    }

    private function processCollectionRequest(string $method): void {
        switch ($method) {
            case 'GET':
                echo json_encode($this->quoteGateway->getAll());
                break;
            case 'POST':
                $data= (array) json_decode(file_get_contents("php://input"), true);
                $errors= $this->getValidationErrors($data);
                if(!empty($errors)) {
                    http_response_code(422);
                    echo json_encode(["Errors"=> $errors]);
                    break;
                }
                $id= $this->quoteGateway->create($data);
                http_response_code(201);
                echo json_encode([
                    "message"=> "Quote added!",
                    "id"=> $id
                ]);
                break;
            default:
                http_response_code(405);
                header('Allowed methods: GET, PATCH and DELETE');
        }
    }

    protected function getValidationErrors(array $data): array {
        $errors= [];
        if(empty($data['name'])) {
            $errors[]= 'name is required';
        }
        if(empty($data['quote'])) {
            $errors[]= 'quote is required';
        }
        if(empty($data['topic'])) {
            $errors[]= 'quote is required';
        }

        return $errors;
    }
}