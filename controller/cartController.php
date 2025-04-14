<?php

class cartController {
    public function addToCart(){
        $productId = $_POST['productId'] ?? 0;
        $name = $_POST['name'] ?? '';
        $price = $_POST['price'] ?? 0;
        $color = $_POST['color'] ?? 'Default Color';
        $quantity = $_POST['product-quantity'] ?? 1;
        $img = $_POST['img'] ?? '';
        $brand = $_POST['brand'] ?? '';

        if(empty($productId) || empty($name) || $price <= 0){
            header('Location: index.php?act=cart&error=invalid_data');
            exit();
        }

        if(!isset($_SESSION['mycart'])){
            $_SESSION['mycart'] = [];
        }

        $found = false;
        foreach($_SESSION['mycart'] as &$item){
            if($item['id'] == $productId && $item ['color'] == $color){
                $item['quantity'] += $quantity;
                $found = true;
                break; 
            }
        }
        if(!$found){
            $_SESSION['mycart'][]=[
                'id' => $productId,
                'name' => $name,
                'price' => $price,
                'color' => $color,
                'quantity' => $quantity,
                'img' => $img,
                'brand' => $brand,
            ];
        }
        header('Location: index.php?act=cart');
        exit();
    }
    public function cart(){
        require_once 'view/cart.php';
    }
    // public function deleteToCart(){
    //     if(isset($_GET['id'])){
    //         $productId = $_GET['id'];
    //         foreach ($_SESSION['mycart'] as $index => $item){
    //             if($item['id'] == $productId){
    //                 unset($_SESSION['mycart'][$index]);
    //                 break;
    //             }
    //         }
    //         $_SESSION['mycart'] = array_values($_SESSION['mycart']);
    //     }
    //     header('Location: '.$_SERVER['HTTP_REFERER']);
    //     exit();
    // }
    public function deleteToCart(){
        if(isset($_GET['id'])){
            $productId = $_GET['id'];
            foreach ($_SESSION['mycart'] as $index => $item){
                if($item['id'] == $productId){
                    unset($_SESSION['mycart'][$index]);
                    break;
                }

            }
            $_SESSION['mycart'] = array_values($_SESSION['mycart']);
            }
            header('Location: '.$_SERVER['HTTP_REFERER']);
            exit();
        }
    }
?>

