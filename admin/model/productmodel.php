<?php
class productModel{
    public $conn;
    function __construct()
    {
        $this->conn = connDBAss();
    }
    function product($categoryId = null){
        if($categoryId !==null){
            $sql = "SELECT * FROM products JOIN categories ON categories.id_category = products.id_category
                    WHERE products.id_category = $categoryId ORDER BY id_product DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }else{
            $sql = "SELECT * FROM products JOIN categories ON categories.id_category = products.id_category ORDER BY id_product DESC";
            return $this->conn->query($sql)->fetchAll();
        }
    }
    function category(){
        $sql = "SELECT * FROM categories";
        return $this->conn->query($sql)->fetchAll();
    }
    function variant(){
        $sql = "SELECT * FROM variant";
        return $this->conn->query($sql)->fetchAll();
    }
    function product_variant($id_product){
        $sql = "SELECT * FROM product_variant JOIN variant ON product_variant.id_variant=variant.id_variant JOIN products ON product_variant.id_product=products.id_product WHERE product_variant.id_product = $id_product";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function findProductById($id){
        $sql = "SELECT * FROM products WHERE id_product=$id";
        return $this->conn->query($sql)->fetch();
    }
    function findPro_varById($id_pro,$id_var){
        $sql = "SELECT * FROM product_variant WHERE id_product=$id_pro AND id_variant=$id_var";
        return $this->conn->query($sql)->fetch();
    }
    function checkColorExists($id_product, $new_color_id, $current_color_id){
        $sql = "SELECT * FROM product_variant WHERE id_product = $id_product";
        $stmt = $this->conn->query($sql);
        $existingVariants = $stmt->fetchAll();
        foreach($existingVariants as $variant){
            if($variant['id_variant'] == $new_color_id && $variant['id_variant'] != $current_color_id){
                return true;
            }
        }
        return false;
    }
    function insert($id_category, $firms, $name, $price, $amount, $discount, $description, $img_product, $variants){
        $sql = "INSERT INTO products values (null,$id_category,'$firms','$name',$price,$amount,$discount,'$description','$img_product',0,0,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute()){
            $id_product = $this->conn->lastInsertId();
            foreach($variants as $variant){
                $id_variant = $variant['name_color'];
                $quantity = $variant['quantity'];
                $sql_product_variant = "INSERT INTO product_variant VALUES ($id_product, $id_variant, $quantity)";
                $stmt_product_variant = $this->conn->prepare($sql_product_variant);
                $stmt_product_variant->execute();
            }
            return true;
        }
        return false;
    }
    function update($id_product, $id_category, $firms, $name, $price, $amount, $discount, $description, $img_product){
        if(empty($img_product)){
            $sql = "UPDATE products SET id_category=$id_category, firms='$firms',name='$name',price=$price,amount=$amount,discount=$discount,description='$description',updated_at=CURRENT_TIMESTAMP WHERE id_product=$id_product";
        }else{
            $sql = "UPDATE products SET id_category=$id_category, firms='$firms',name='$name',price=$price,amount=$amount,discount=$discount,description='$description',img_product='$img_product',updated_at=CURRENT_TIMESTAMP WHERE id_product=$id_product";
        }
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    function delete($id){
        $sql = "DELETE from products where id_product=$id";
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute()){
            $sql_variant = "DELETE FROM product_variant WHERE id_product=$id";
            $stmt_variant = $this->conn->prepare($sql_variant);
            $stmt_variant->execute();
            return true;
        }
        return false;
    }
    function updateProduct_variant($id_pro, $id_var,$new_id_variant, $quantity){
        $sql_quantity = "SELECT quantity FROM product_variant WHERE id_product = $id_pro AND id_variant = $id_var";
        $stmt_quantity = $this->conn->query($sql_quantity)->fetchColumn();

        $sql = "UPDATE product_variant SET id_variant=$new_id_variant, quantity=$quantity WHERE id_product=$id_pro AND id_variant=$id_var";
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute()){
            $amount = $quantity - $stmt_quantity;
            $sql_product = "UPDATE products SET amount=amount+$amount WHERE id_product=$id_pro";
            $stmt_product = $this->conn->prepare($sql_product);
            $stmt_product->execute();
            return true;
        }
        return false;
    }
    function deleteProduct_variant($id_pro, $id_var){
        $sql_quantity = "SELECT quantity FROM product_variant WHERE id_product = $id_pro AND id_variant = $id_var";
        $stmt_quantity = $this->conn->query($sql_quantity)->fetchColumn();

        $sql = "DELETE from product_variant where id_product=$id_pro AND id_variant=$id_var";
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute()){
            $sql_product = "UPDATE products SET amount=amount-$stmt_quantity WHERE id_product=$id_pro";
            $stmt_product = $this->conn->prepare($sql_product);
            $stmt_product->execute();
            return true;
        }
        return false;
    }
}