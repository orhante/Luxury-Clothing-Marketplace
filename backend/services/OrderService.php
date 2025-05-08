<?php

class OrderService {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        return $this->db->select('orders', '*');
    }

    public function getById($id) {
        return $this->db->get('orders', '*', ['id' => $id]);
    }

    public function create($data) {
        if (empty($data['user_id']) || empty($data['product_id']) || empty($data['quantity'])) {
            throw new Exception("user_id, product_id, and quantity are required.");
        }

        if ($data['quantity'] <= 0) {
            throw new Exception("Quantity must be greater than zero.");
        }

        // Check user exists
        $user = $this->db->get('users', '*', ['id' => $data['user_id']]);
        if (!$user) throw new Exception("User not found.");

        // Check product exists
        $product = $this->db->get('products', '*', ['id' => $data['product_id']]);
        if (!$product) throw new Exception("Product not found.");

        // Calculate total price
        $data['total_price'] = $product['price'] * $data['quantity'];
        $data['created_at'] = date('Y-m-d H:i:s');

        return $this->db->insert('orders', $data);
    }

    public function update($id, $data) {
        return $this->db->update('orders', $data, ['id' => $id]);
    }

    public function delete($id) {
        return $this->db->delete('orders', ['id' => $id]);
    }
}
