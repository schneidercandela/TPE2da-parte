<?php

require_once 'app/model/admin.model.php';
require_once 'app/helpers/auth.helpers.php';
require_once 'app/view/product.view.php';
require_once 'app/view/admin.view.php';
require_once 'app/model/category.model.php';
require_once 'app/view/category.view.php';

class AdminController
{
    private $model;
    private $view;
    private $AdminView;
    private $modelCategories;
    private $categoryView;


    public function __construct()
    {
        $this->model = new AdminModel();
        $this->view = new AuthView();
        $this->modelCategories = new CategoryModel();

    }

    public function showListProds(){
        $products = $this->model->getAllProducts();
        if (!empty($products)) {
            require_once 'templates/products.phtml';
        }else{
            $this->view->showError('No hay productos disponibles');
        }
    }

    public function showFormAddProduct(){
    require_once 'templates/add_product_admin.phtml';
    }

    public function showDeleteProds()
    {
        $products = $this->model->getAllProducts();

        if (!empty($products)) {
            require_once 'templates/delete_products_admin.phtml';
        }else{
            $this->view->showError('No hay productos para eliminar');
        }
    }

    public function deleteProductById($id)
    {
        $this->model->deleteProductById($id);
        header("Location:" . BASE_URL);
    }

    public function categoriesForm(){
        require_once './templates/add_product_with_category.phtml';
    }

    public function addProduct(){

        $img = $_POST['img'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        if(!empty($img)||!empty($name)||!empty($description)||!empty($price)||!empty($category)){
            $this->model->addProduct($img, $name, $description, $price, $category);
            header("Location:" . BASE_URL);
        }else{
            $this->view->showError('No se pudo añadir el producto');
        }
    }

    public function showAllUpdatedProduct(){
        $products = $this->model->getAllProducts();
        if(!empty($products)){
            require_once './templates/updated_products_admin.phtml';
        }else{
            $this->view->showError('No se pudo actualizar el producto');
        }
    }

    public function showDescriptionProductUpdated($id){
        $product = $this->model->getProductById($id);
        if(!empty($product)){
            require_once './templates/description_product_admin.phtml';
        }else{
            $this->view->showError('No se pudo actualizar el producto');
        }
    }
    
   

    //CATEGORY

    public function showDescriptionCategory(){
        $categories = $this->model->allCategory();
        if(!empty($categories)){
            require_once './templates/update_categories_admin.phtml';
        }else{
            $this->view->showError('No se pudieron traer las categorias');
        }
    }

    public function showDescriptionCategoryUpdated($id){
        $category = $this->model->getCategoryById($id);
        if(!empty($category)){
            require_once './templates/description_category_admin.phtml';
        }else{
            $this->view->showError('No se pudo actualizar el producto');
        }
    }
    
    public function showListCat()
    {

        $categories = $this->model->AllCategory();
        if (!empty($categories)) {
            require_once 'templates/category.phtml';
        }
        else{
            $this->view->showError('No hay categorias disponibles');
        }
    }
    public function showListCatUpdate()
    {

        $categories = $this->model->AllCategory();
        if (!empty($categories)) {
            require_once 'templates/updated_categories_admin.phtml';
        }
        else{
            $this->view->showError('No hay categorias disponibles');
        }
    }

    public function showFormAddCategory()
    {
        require_once 'templates/add_category_admin.phtml';
       
    }
    
    public function deleteCategoryById($id)
    {

    $this->model->deleteCategoryById($id);
    header("Location:" . BASE_URL . 'listarCategoria');
    }

    public function addCategory()
    {

        $name = $_POST['name'];
        $season = $_POST['season'];

        if (!empty($name) || !empty($season)) {

            $this->model->addCategory($name, $season);
            header("Location:" . BASE_URL . 'listarCategoria');
        } else {
            $this->view->showError('No se pudo agregar categoria');
        }
    }
    public function showDeleteCat()
    {
        $categories = $this->model->AllCategory();

        if (!empty($categories)) {
            require_once './templates/delete_category_admin.phtml';
        }
        else{
            $this->view->showError('No hay categorias para eliminar');

        }
    }
    public function showAllUpdatedCategories(){
        $products = $this->model->AllCategory();
        if(!empty($products)){
            require_once './templates/updated_categories_admin.phtml';
        }else{
            $this->view->showError('No se pudo actualizar la categoria');
        }
    }

    public function updateProduct($name, $description, $price, $id){

        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $id = $_POST['id'];


        if(!empty($name)||!empty($description)||!empty($price)||!empty($id)){
            $this->model->updateProduct($name, $description, $price, $id);
            header("Location:" . BASE_URL);
        }else{
            $this->view->showError('No se pudo actualizar');
        }
    }

    public function updateCategory() {
      
        $name = $_POST['name'];
        $season = $_POST['season'];
        $id = $_POST['id'];

        if (!empty($name) && !empty($season) && !empty($id)) {
     
            $this->model->updatedCategory($name, $season, $id);
       
            header("Location: " . BASE_URL . 'listarCategoria');
            exit;
        } else {
    
            $this->view->showError('No se pudo actualizar');
        }
    }

    //ver categorias a eliminar
    public function showDeleteCategories()
    {
        //recibimos las categorias
        $categories = $this->model->allCategory();

        //verificamos que no este vacio
        if (!empty($categories)) {
            require_once 'templates/delete_category_admin.phtml';
        }else{
            $this->view->showError('No hay productos para eliminar');
        }
    }
    
}

