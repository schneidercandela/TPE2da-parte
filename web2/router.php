<?php

require_once 'app/controller/product.controller.php';
require_once 'app/controller/auth.controller.php';
require_once 'app/controller/admin.controller.php';
require_once 'app/helpers/auth.helpers.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; 
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action); 

$ProductController = new ProductController();
$AuthController = new AuthController();
$AdminController = new AdminController();
$AuthHelper = new AuthHelper();

         //[0]eliminarCategoria/[1]:3    
switch ($params[0]) {
    case 'login':
        $AuthController->showLogin();
     break;
     case 'register':
        $AuthController->showRegister();
     break;
     case 'registered':
        $AuthController->registered();
     break;
     case 'logged':
        $AuthController->logged();
     break;
     case 'logout':
        $AuthHelper->logout();
     break;
    case 'home':
       $ProductController->showAllProducts();
    break;
    case 'descripcion':
        $ProductController->showDescriptionProduct($params[1]);
    break; 
    case 'listar':
      $AdminController->showListProds();
   break;
    case 'agregar':
      $AdminController->showFormAddProduct();
   break;
    case 'agregarProducto':
      $AdminController->addProduct();
   break;
   case 'actualizar':
      $AdminController->showAllUpdatedProduct();
   break;
   case 'actualizarProducto':
      $AdminController->showDescriptionProductUpdated($params[1]);
   break;
   case 'actualizarProductoTotal':     //id        name     description    price 
      $AdminController->updateProduct($params[1],$params[2],$params[3],$params[4]);
   break;
   case 'eliminar':
      $AdminController->showDeleteProds();
   break;
   case 'eliminarProducto':
      $AdminController->deleteProductById($params[1]);
   break;
   //CATEGORIAS
   case 'listarCategoria':
      $AdminController->showListCat();
   break;
    case 'agregaCategoria':
      $AdminController->showFormAddCategory();
   break;
    case 'agregarCategoria':
      $AdminController->addCategory();
   break;
   //muestro todas las categorias
   case'actualizarCategoria':
   $AdminController->showDescriptionCategory();
   break;
   //veo la categoria que clicke 
   case 'actualizarCategoriaId':
      $AdminController->showDescriptionCategoryUpdated($params[1]);
   break;
   //actualiza la categoria
   case 'actualizarCategoriaTotal':
      $AdminController->updateCategory();
      break;
      //muestro las categorias que quiero eliminar
    case 'eliminarCategoria':
   $AdminController->showDeleteCategories();
    break;
    //elimino la categoria que elegi 
   case 'eliminarCategoriaId':
   $AdminController->deleteCategoryById($params[1]);
   break;
    default: 
        echo "404 Page Not Found";
        break;
}