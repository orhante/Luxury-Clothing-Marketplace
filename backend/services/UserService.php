<?php

class UserService {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Get all users
    public function getAll() {
        return $this->db->select('users', '*');
    }

    // Get one user by ID
    public function getById($id) {
        return $this->db->get('users', '*', ['id' => $id]);
    }

    // Create a new user
    public function create($data) {
        // Validate required fields
        if (empty($data['name']) || empty($data['email'])) {
            throw new Exception("Name and Email are required.");
        }

        // Check email format
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        // Check if email already exists
        $existing = $this->db->get('users', '*', ['email' => $data['email']]);
        if ($existing) {
            throw new Exception("Email already exists.");
        }

        // Insert user
        return $this->db->insert('users', [
            'name' => $data['name'],
            'email' => $data['email'],
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    // Update user
    public function update($id, $data) {
        // Optionally validate inputs
        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        return $this->db->update('users', $data, ['id' => $id]);
    }

    // Delete user
    public function delete($id) {
        return $this->db->delete('users', ['id' => $id]);
    }
}
