<?php
require_once './BaseDao.php';

class OrdersDao extends BaseDao {
    public function __construct() {
        parent::__construct('orders');
    }

    // Get all orders
    public function getAllOrders() {
        return $this->getAll();
    }

    // Get order by ID
    public function getOrderById($id) {
        return $this->getById($id);
    }

    // Create a new order
    public function createOrder($data) {
        return $this->insert($data);
    }

    // Update an order
    public function updateOrder($id, $data) {
        return $this->update($id, $data);
    }

    // Delete an order
    public function deleteOrder($id) {
        return $this->delete($id);
    }
}
?>
