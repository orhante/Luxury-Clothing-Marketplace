<?php

class ProductService {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        return $this->db->select('products', '*');
    }

    public function getById($id) {
        return $this->db->get('products', '*', ['id' => $id]);
    }

    public function create($data) {
        if (empty($data['name']) || !isset($data['price'])) {
            throw new Exception("Name and Price are required.");
        }

        if (!is_numeric($data['price']) || $data['price'] < 0) {
            throw new Exception("Price must be a positive number.");
        }

        $data['stock'] = isset($data['stock']) ? (int)$data['stock'] : 0;
        $data['created_at'] = date('Y-m-d H:i:s');

        return $this->db->insert('products', $data);
    }

    public function update($id, $data) {
        if (isset($data['price']) && (!is_numeric($data['price']) || $data['price'] < 0)) {
            throw new Exception("Price must be a positive number.");
        }

        return $this->db->update('products', $data, ['id' => $id]);
    }

    public function delete($id) {
        return $this->db->delete('products', ['id' => $id]);
    }
}
