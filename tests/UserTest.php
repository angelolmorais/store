<?php
use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Config\Database;
require_once 'config/test_config.php'; 


class UserTest extends TestCase
{
    public function testGetName()
    {
        $user = new User(null, "Beltrano de Tal", "Beltrano@gmail.com", "password123");
        $expectedName = "Fulano, Beltrano e Sicrano";

        $this->assertEquals($expectedName, $user->getName());
    }

    public function testGetEmail()
    {
        $user = new User(null, "Angelo Morais", "angelolmorais@gmail.com", "pass123");
        $expectedEmail = "angelolmorais@gmail.com";

        $this->assertEquals($expectedEmail, $user->getEmail());
    }

    public function testSetPassword()
    {
        $user = new User(null, "Fulano de Tal ", "fulano@gmail.com", "oldpassword");
        $newPassword = "newpassword123";

        $user->setPassword($newPassword);

        $this->assertEquals($newPassword, $user->getPassword());
    }

}
