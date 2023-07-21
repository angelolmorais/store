<?php 
namespace App\Controllers;
use App\Models\User; 

class UserController {  
    
    public function create() {
        $pageTitle = "Create User";
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $user = new User(null, $name, $email, $password);
            $user->save();
            
            header('Location: /user/read');
            exit();
        }
        
        include __DIR__ . '/../views/create_user.php';
    }

    public function read() {
        $pageTitle = "List User";
        $users = User::findAll();
        include __DIR__ . '/../views/list_users.php';
    }
    
    public function update($id) {
        $pageTitle = "Edit User";
        if (!is_numeric($id)) {
            $error = "Invalid user ID";
        }
        
        $user = User::findById($id);
        
        if (!$user) {
            $error = "User not found";
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            
            $user->setName($name);
            $user->setEmail($email);
            $user->update();
            
            header('Location:/user/read');
            exit();
        }
        
        include __DIR__ . '/../views/edit_user.php';
    }
    
    public function delete($id) {
        $user = User::findById($id);
        
        if (!$user) {
            $error = "User not found";
        }
        
        $user->delete($id);
        
        header('Location: /user/read');
        exit();
    }
    
    public function login() {
        $pageTitle = "Login";
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            
            $user = User::findByEmail($email); 
            
            if ($user && password_verify($password, $user->getPassword())) {
                session_start();
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['user_name'] = $user->getName();
               
                header('Location: /sale/read');
                exit();
            } else {
                $error = "Invalid credentials. Please try again.";
            }
        }
        
        include __DIR__ . '/../views/login.php';
    }
    
    
    public function logout() {
        
        session_start();        
        $_SESSION = array();        
        session_destroy();        
        header('Location: /login');
        exit();
    }
    
    
    public function dashboard() {
        $pageTitle = "Dashboard";
        
        if (!isset($_SESSION['user_id'])) {
            session_destroy();
            header('Location: /user/login');
            exit();
        }
        
        include __DIR__ . '/../views/dashboard.php';
    }
}
