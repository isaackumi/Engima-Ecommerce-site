<?php
 include_once(dirname(__FILE__)."/../database/db_connection.php");

class DBOperation extends dbConnection{


    public function getOnecategory($category_name){
        $stmt = $this->dbconnect()->prepare("SELECT * FROM  category WHERE category_name ='$category_name'");
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        $rows = array();
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }
        return "NO_CATEGORY_FOUND";
    }

    // Get one product
    public function getOneproduct($product_id){
        $stmt = $this->dbconnect()->prepare("SELECT * FROM  products WHERE product_id ='$product_id'");
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        $rows = array();
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }
        return "NO_PRODUCT_FOUND";
    }


    public function getproductShop(){
        $stmt = $this->dbconnect()->prepare("SELECT * from products");
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        $rows = array();
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }
        return "NO_PRODUCT_FOUND";
    }

    public function getproductAfford(){
        $stmt = $this->dbconnect()->prepare("SELECT * from products where product_price <= 100");
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        $rows = array();
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }
        return "NO_PRODUCT_FOUND";
    }


    public function getAllrecords($table){
        $stmt = $this->dbconnect()->prepare("SELECT * FROM ".$table);
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        // var_dump($result);

        $rows = array();
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }
        else{
            return "NO_RECORDS_FOUND";
        }
        
    }
    

    public function countRecords($table){
        $stmt = $this->dbconnect()->prepare("SELECT * FROM ".$table);
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        // var_dump($result);

        $rows = array();
        if($result->num_rows >0){
           $count = $result->num_rows;
           return $count;
        }
        else{
            return "NO_RECORDS_FOUND";
        }
        
    }

    public function getCustomerIp(){
        $this->customerIp = "";
        if (isset($_SERVER['HTTP_CLIENT_IP'])){
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        }
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else if(isset($_SERVER['HTTP_X_FORWARDED'])){
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        }
        else if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        }
        else if(isset($_SERVER['HTTP_FORWARDED'])){
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        }
        else if(isset($_SERVER['REMOTE_ADDR'])){
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        }
        else{
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;   
}


    public function addProductCart($product_id){
        $quantity = 1;
        $customer_IP = $this->getCustomerIp();
        $stmt = $this->dbconnect()->prepare("SELECT product_id,ip_address FROM cart WHERE product_id = ? and ip_address = ? ");
        $stmt->bind_param("ss",$product_id,$customer_IP);
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return "PRODUCT_EXIST_IN_CART";
        }
        else{
            $stmt = $this->dbconnect()->prepare("INSERT INTO cart(product_id,ip_address,quantity) VALUES(?,?,?)");
            $stmt->bind_param("sss",$product_id,$customer_IP,$quantity);
            $result = $stmt->execute() or die($this->connection->error);
            if($result){
                return "PRODUCT_ADDED_TO_CART";
            }else{
                return "SOME_ERROR";
            }

        }

        
    }


    public function updateCart($product_id,$quantity){
        $customer_IP = $this->getCustomerIp();
        $stmt = $this->dbconnect()->prepare("SELECT product_id,ip_address FROM cart WHERE product_id = ? and ip_address = ? ");
        $stmt->bind_param("ss",$product_id,$customer_IP);
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $stmt = $this->dbconnect()->prepare("UPDATE cart SET quantity= ? WHERE product_id = $product_id");
            $stmt->bind_param("s",$quantity);
            $result = $stmt->execute() or die($this->dbconnect()->error);
            if($result){
                return "PRODUCT_QUANTITY_UPDATED";
            }else{
                return "SOME_ERROR";
            }
           
        }else{
            return "PRODUCT_DOES_NOT_EXIST_IN_CART";
        }

    }


    // public function cartTotal($p)

    public function cartTotalPrice(){
        $customer_IP = $this->getCustomerIp();
        // $customer_IP = "::1";
        $total = 0; 
        $stmt = $this->dbconnect()->prepare("SELECT * FROM cart WHERE ip_address = ? ");
        $stmt->bind_param("s",$customer_IP);
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        $fetch = $result->fetch_all();
        // var_dump($fetch);

        foreach($fetch as $item){
            // print_r($item[2]);
            $stmt = $this->dbconnect()->prepare("SELECT * FROM products WHERE product_id = $item[0]");
            $result = $stmt->execute() or die($this->dbconnect()->error);
            $result = $stmt->get_result();
            $pricefetch = $result->fetch_array();
            var_dump($pricefetch["product_price"]);
            $price = $item[2] * $pricefetch["product_price"];
            return $price;
        }
    }


    // create a sale function 

    // create a order function 
    // create a requests function 
    // create a totals function : sales , orders, earnings,
    // create a best selling function 


    // Make sure all the button work. {edit / delete}






    // Shop Category Model
    public function shopCategory($shop_id){
    $stmt = $this->dbconnect()->prepare("Select category.category_name,category.category_id,category.category_image from category,products where product_shop = $shop_id and category.category_id=product_category ");
    $stmt->execute() or die($this->dbconnect()->error);
    $result = $stmt->get_result();
    $rows = array();
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }else{
            return "SHOP_CATEGORY_NOT_FOUND";
        }

    
}

// Products under each category.. 
// so if you click on Mens fashion category under a shop ---> the following products
public function catProductCategory($cat_id){
    // echo("testing");
    $stmt = $this->dbconnect()->prepare("Select * from products where product_category = $cat_id ");
    $stmt->execute() or die($this->dbconnect()->error);
    $result = $stmt->get_result();
    //  var_dump($result);
    $rows = array();
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }else{
            return "NO_PRODUCT_FOUND_IN_CATEGORY";
        }

    
}


public function getCartDisplay(){
    // echo("testing");
    $stmt = $this->dbconnect()->prepare("Select * from products,cart where products.product_id = cart.product_id");
    $stmt->execute() or die($this->dbconnect()->error);
    $result = $stmt->get_result();
    //  var_dump($result);
    $rows = array();
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }else{
            return "CART_EMPTY";
        }

    
}

public function DeleteProdCart($cart_prodid){
    $stmt = $this->dbconnect()->prepare("SELECT product_id FROM cart WHERE product_id = ?");
    $stmt->bind_param("s",$cart_prodid);
    $stmt->execute() or die($this->dbconnect()->error);
    $result = $stmt->get_result();
    if($result->num_rows == 1){
        $stmt = $this->dbconnect()->prepare("DELETE FROM cart WHERE product_id = $cart_prodid");
        $result = $stmt->execute() or die($this->dbconnect()->error);
        if($result){
            return "ITEM_DELETED";
        }else{
            return "SOME_ERROR";
    }
    }else{
    return "ITEM_DOES_NOT_EXIST";
    }
}




}

// $obj = new DBOperation();
// var_dump($obj->getAllrecords("shop"));




// catProductCategory 
// shopCategory
// getOneProduct