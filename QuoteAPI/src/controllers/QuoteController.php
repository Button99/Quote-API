<?php
namespace Runner\QuoteApi\controllers;

use Runner\QuoteApi\app\QuoteGateway;

class QuoteController {
  private $quoteGateway;
  public function __construct(QuoteGateway $quoteGateway) {
    $this->quoteGateway= $quoteGateway;
  }

      public function processRequest(string $method, ?string $id): void {
        if($id) {
              $this->processResourceRequest($method, $id);
        } else {
            $this->processRandomResourceRequest($method);
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
      }

      private function processRandomResourceRequest(string $method): void {
        switch ($method) {
            case 'GET':
                echo json_encode($this->quoteGateway->getRandom());
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
        // add more custom vals.

        return $errors;
    }

  
}
?>