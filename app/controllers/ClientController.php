<?php

namespace App\Controllers;
use App\Models\Client; 

class ClientController {
    
    public function create() {
        $pageTitle = "Create Client";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            $client = new Client(null, $name, $email, $phone); 
            $client->save();

            header('Location: /client/read');
            exit();
        }

        include __DIR__ . '/../views/create_client.php';
    }

    public function read() {
        $pageTitle = "Client List";
        $clients = Client::fetchAll();
        include __DIR__ . '/../views/list_client.php';
    }

    public function update($id) {
        $pageTitle = "Edit Client";
        if (!is_numeric($id)) {
            $error = "Invalid client ID";
        }

        $client = Client::findById($id);

        if (!$client) {
            $error = "Client not found";
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            $client->setName($name);
            $client->setEmail($email);
            $client->setPhone($phone);
            $client->update();

            header('Location:/client/read');
            exit();
        }

        include __DIR__ . '/../views/edit_client.php';
    }
    
    public function delete($id) {
        $client = Client::findById($id);
        
        if (!$client) {
            $error = "Client not found";
        }
        
        $client->delete($id);
        
        header('Location: /client/read');
        exit();
    }
}
    