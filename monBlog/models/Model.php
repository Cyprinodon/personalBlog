<?php
namespace models;
class Model
{
  protected function connectToDatabase()
  {
    $database = new \PDO("mysql:host=localhost;dbname=personal_blog;charset=utf8", "root", "");
    return $database;
  }
}