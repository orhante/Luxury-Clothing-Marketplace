<?php
require_once './BaseDao.php';

class ProductsDao extends BaseDao {
    public function __construct() {
        parent::__construct('products');
    }

    // Get all products
    public function getAllProducts() {
        return $this->getAll();
    }

    // Get product by ID
    public function getProductById($id) {
        return $this->getById($id);
    }

    // Create a new product
    public function createProduct($data) {
        return $this->insert($data);
    }

    // Update a product
    public function updateProduct($id, $data) {
        return $this->update($id, $data);
    }

    // Delete a product
    public function deleteProduct($id) {
        return $this->delete($id);
    }
}
?>
