<?php
require_once './BaseDao.php';

class CartItemsDao extends BaseDao {
    public function __construct() {
        parent::__construct('cart_items');
    }

    // Get all cart items for a user
    public function getAllCartItems($user_id) {
        $stmt = $this->connection->prepare("SELECT * FROM cart_items WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Get a specific cart item by user ID and product ID
    public function getCartItemByUserAndProduct($user_id, $product_id) {
        $stmt = $this->connection->prepare("SELECT * FROM cart_items WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Add an item to the cart
    public function addToCart($data) {
        return $this->insert($data);
    }

    // Update quantity of an existing cart item
    public function updateCartItem($id, $data) {
        return $this->update($id, $data);
    }

    // Remove an item from the cart
    public function removeCartItem($id) {
        return $this->delete($id);
    }
}
?>
