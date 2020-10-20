<?php


class CatalogController
{

    public function actionIndex(){

        $categories   = array();
        $categories   = Category::getCategoriesList();

        $latestProducts = array();
        $latestProducts = Product::getLatestProducts(10);

        require_once ROOT . '/views/catalog/catalog.php';

        return true;

    }


    public function actionCategory($categoryId, $page = 1){

        $categories   = array();
        $categories   = Category::getCategoriesList();

        $categoryProducts = array();

        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);

        $total = Product::getTotalProductsInCategory($categoryId);
        $pagination = new Pagination($total, $page, Product::DEFAULT_COUNT, 'page-');

        require_once ROOT . '/views/catalog/category.php';

        return true;

    }

}