<?php
include_once('../database/db_connection.php');


class Admin extends dbConnection{

     // To prevent the platform from sql injection ....  KEEP THIS PROPERTY : emailExists PRIVATE
     private function emailExists($email){
        $stmt = $this->dbconnect()->prepare("SELECT admin_id FROM admin WHERE admin_email = ? ");
        $stmt->bind_param("s",$email);
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            // return 1;
            return "EMAIL_ALREADY_EXIST";
        }
        else{
            return 0;
        }
    }

    public function createAdminAccount($af,$ae,$ap,$sc){
    // To protect your application from sql attack you can user 
    // prepares statement
    if($this->emailExists($ae)){
        return "ADMINSTRATOR_ALREADY_EXISTS";
    }
    else{
        $stmt = $this->dbconnect()->prepare("SELECT * FROM admin ");
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        if($result->num_rows == 2 ){
            return "ADMIN_LIST_FULL";
        }else{
            $time_format = "Y-m-d h:m:s";
            $last_login = date($time_format);
            $password = password_hash($ap,PASSWORD_BCRYPT,["cost"=>8]);
            $stmt = $this->dbconnect()->prepare("INSERT INTO admin(admin_fullname,admin_email,admin_password,security_code,login_date) VALUES(?,?,?,?,?)");
            $stmt->bind_param("sssss",$af,$ae,$password,$sc,$last_login);
            $result = $stmt->execute() or die($this->dbconnect()->error);
            if($result){
                // return $this->dbconnect()->insert_id;
                return "ADMIN_REGISTRATION_SUCCESSFUL";
            }else{
                return "SOME_ERROR";
            }
        }
        
    }
}

    public function adminLogin($email,$password){
        $stmt = $this->dbconnect()->prepare("SELECT admin_id,admin_fullname,admin_email,security_code,admin_password,phone_details,login_date FROM admin WHERE admin_email = ? ");
        $stmt->bind_param("s",$email);
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        if($result->num_rows < 1){
            // return 1;
            return "NOT_REGISTERED";
        }
        else{
            $row = $result->fetch_assoc();
                if(password_verify($password,$row["admin_password"])){
                    session_start();
                    $_SESSION["admin_id"] = $row["admin_id"];
                    $_SESSION["admin_fullname"] = $row["admin_fullname"];
                    $_SESSION["admin_email"] = $row["admin_email"];
                    $_SESSION["admin_code"] = $row["security_code"];
                    $_SESSION["admin_log"] = $row["login_date"];
                    $_SESSION["admin_phone"] = $row["phone_details"];
                    
                    #Time Updates : User Login Time
                    $time_format = "Y-m-d h:m:s";
                    $last_login = date($time_format);
                    $stmt = $this->dbconnect()->prepare("UPDATE admin SET login_date = ? WHERE admin_email = ? ");
                    $stmt->bind_param("ss",$last_login,$email);
                    $result = $stmt->execute() or die($this->dbconnect()->error);
                    if($result){
                        return "LOGGED_IN";
                    }else{
                        return 0;
                    }
            }else{
                return "PASSWORD_NOT_MATCHED";
            }
        }
    }

##########################################################
##################### Admin General Update  Method #######
##########################################################
public function adminGenenralUpdate($aid,$afn,$aph,$aadd){
    $stmt = $this->dbconnect()->prepare("SELECT admin_fullname FROM admin WHERE admin_id = ?");
    $stmt->bind_param("s",$aid);
    $stmt->execute() or die($this->dbconnect()->error);
    $result = $stmt->get_result();

    if($result->num_rows == 1){
            $stmt = $this->dbconnect()->prepare("UPDATE admin SET admin_fullname = ?, phone_details = ?, admin_address = ?  WHERE admin_id = $aid");
            $stmt->bind_param("sss",$afn,$aph,$aadd);
            $result = $stmt->execute() or die($this->dbconnect()->error);
            if($result){
                return "ADMIN_DETAILS_UPDATED";
            }else{
                return "SOME_ERROR";
        }
        
        
    }else{
        return "ADMIN_DOES_NOT_EXIST";
    }
}


##########################################################
##################### Admin Email Update  Method #######
##########################################################
public function adminEmailUpdate($aid,$ae){
    $stmt = $this->dbconnect()->prepare("SELECT admin_fullname FROM admin WHERE admin_id = ?");
    $stmt->bind_param("s",$aid);
    $stmt->execute() or die($this->dbconnect()->error);
    $result = $stmt->get_result();

    if($this->emailExists($ae)){
        return "EMAIL_ALREADY_IN_USE";
    }else{
        if($result->num_rows == 1){
            $stmt = $this->dbconnect()->prepare("UPDATE admin SET admin_email = ?  WHERE admin_id = $aid");
            $stmt->bind_param("s",$ae);
            $result = $stmt->execute() or die($this->dbconnect()->error);
            if($result){
                return "ADMIN_EMAIL_UPDATED";
            }else{
                return "SOME_ERROR";
        }
        
        
    }else{
        return "ADMIN_DOES_NOT_EXIST";
    }
    }
    
}

##########################################################
##################### Admin Security Update  Method ######
##########################################################
public function adminSecurityUpdate($aid,$apwd,$asc){
    $stmt = $this->dbconnect()->prepare("SELECT admin_fullname FROM admin WHERE admin_id = ?");
    $stmt->bind_param("s",$aid);
    $stmt->execute() or die($this->dbconnect()->error);
    $result = $stmt->get_result();

    if($result->num_rows == 1){
            $pwd = password_hash($apwd,PASSWORD_BCRYPT,["cost"=>8]);
            $stmt = $this->dbconnect()->prepare("UPDATE admin SET admin_password = ?,security_code = ?  WHERE admin_id = $aid");
            $stmt->bind_param("ss",$pwd,$asc);
            $result = $stmt->execute() or die($this->dbconnect()->error);
            if($result){
                return "ADMIN_SECURITY_DETAILS_UPDATED";
            }else{
                return "SOME_ERROR";
        }
        
    }else{
        return "ADMIN_DOES_NOT_EXIST";
    }
    
    
}


######## Admin External Functions #########################

###########################################################
#####################  Vendor Functions ####################
############################################################
public function checkVendor($vendor_email){
    $stmt = $this->dbconnect()->prepare("SELECT vendor_id FROM vendor WHERE vendor_email = ? ");
    $stmt->bind_param("s",$vendor_email);
    $stmt->execute() or die($this->dbconnect()->error);
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        // return 1;
        return "VENDOR_ALREADY_EXIST";
    }
    else{
        return 0;
    }
}

public function createVendorAccount($vn,$ve,$vc,$vcy,$vp){
    // To protect your application from sql attack you can user 
    // prepares statement
    if($this->checkVendor($ve)){
        return "VENDOR_ALREADY_EXISTS";
    }
    else{
        $stmt = $this->dbconnect()->prepare("INSERT INTO vendor(vendor_fullname,vendor_email,vendor_country,vendor_city,phone_details) VALUES(?,?,?,?,?)");
        $stmt->bind_param("sssss",$vn,$ve,$vc,$vcy,$vp);
        $result = $stmt->execute() or die($this->dbconnect()->error);
        if($result){
            return $this->dbconnect()->insert_id;
        }else{
            return "SOME_ERROR";
        }
}
    }

public function UpdateVendor($vid,$vn,$ve,$vc,$vcy,$vp){
        $stmt = $this->dbconnect()->prepare("SELECT vendor_fullname FROM vendor WHERE vendor_id = ?");
        $stmt->bind_param("s",$vid);
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            if($this->checkVendor($vn)){
                return "VENDOR_EMAIL_ALREADY_IN_USE";
            }
            else{
                $stmt = $this->dbconnect()->prepare("UPDATE vendor SET vendor_fullname = ?,vendor_email = ?,vendor_country = ?,vendor_city = ?,phone_details = ? WHERE vendor_id = $vid");
                $stmt->bind_param("sssss",$vn,$ve,$vc,$vcy,$vp);
                $result = $stmt->execute() or die($this->dbconnect()->error);
                if($result){
                    return "VENDOR_DETAILS_UPDATED";
                }else{
                    return "SOME_ERROR";
            }
            }
            
        }else{
            return "VENDOR_DOES_NOT_EXIST";
        }

    }
 public function DeleteVendor($vendor_id){
    $stmt = $this->dbconnect()->prepare("SELECT vendor_fullname FROM vendor WHERE  vendor_id = ?");
    $stmt->bind_param("s",$vendor_id);
    $stmt->execute() or die($this->dbconnect()->error);
    $result = $stmt->get_result();
    if($result->num_rows == 1){
        $stmt = $this->dbconnect()->prepare("DELETE FROM shop WHERE vendor_id = $vendor_id");
        $result = $stmt->execute() or die($this->dbconnect()->error);

        $stmt = $this->dbconnect()->prepare("DELETE FROM vendor WHERE vendor_id = $vendor_id");
        $result = $stmt->execute() or die($this->dbconnect()->error);
        if($result){
            return "VENDOR_DELETED";
        }else{
            return "SOME_ERROR";
    }
    }else{
    return "VENDOR_DOES_NOT_EXIST";
    }
}




###########################################################
#####################  Shop Functions #####################
############################################################
public function checkShop($shop_name){
    $stmt = $this->dbconnect()->prepare("SELECT shop_id FROM shop WHERE shop_name = ? ");
    $stmt->bind_param("s",$shop_name);
    $stmt->execute() or die($this->dbconnect()->error);
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        // return 1;
        return "EXIST";
    }
    else{
        return 0;
    }
}


public function createShop($vid,$sn,$sd,$si,$sad){
        if($this->checkShop($sn)){
            // return 1;
            return "SHOP_ALREADY_EXIST";
        }else{
            $stmt = $this->dbconnect()->prepare("INSERT INTO shop(vendor_id,shop_name,shop_description,shop_image,shop_address) VALUES(?,?,?,?,?)");
            $stmt->bind_param("sssss",$vid,$sn,$sd,$si,$sad);
            $result = $stmt->execute() or die($this->dbconnect()->error);
            if($result){
                // return $this->dbconnect()->insert_id;
                return "SHOP_CREATED";
            }else{
                return "SOME_ERROR";
            }
        }
    }

    

public function UpdateShop($sid,$vid,$sn,$sd,$sad){
        $stmt = $this->dbconnect()->prepare("SELECT shop_name FROM shop WHERE shop_id = ?");
        $stmt->bind_param("s",$sid);
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            if($this->checkShop($sn)){
                return "SHOP_ALREADY_EXIST";
            }
            else{
                $stmt = $this->dbconnect()->prepare("UPDATE shop SET vendor_id = ? , shop_name = ?,  shop_description = ?, shop_address = ?   WHERE shop_id = $sid");
                $stmt->bind_param("ssss",$vid,$sn,$sd,$sad);
                $result = $stmt->execute() or die($this->dbconnect()->error);
                if($result){
                    return "SHOP_DETAILS_UPDATED";
                }else{
                    return "SOME_ERROR";
            }
            }
            
        }else{
            return "SHOP_DOES_NOT_EXIST";
        }

    }


    public function DeleteShop($shop_id){
        $stmt = $this->dbconnect()->prepare("SELECT shop_name FROM shop WHERE shop_id = ?");
        $stmt->bind_param("s",$shop_id);
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $stmt = $this->dbconnect()->prepare("DELETE FROM shop WHERE shop_id = $shop_id");
            $result = $stmt->execute() or die($this->dbconnect()->error);
            if($result){
                return "SHOP_DELETED";
            }else{
                return "SOME_ERROR";
        }
        }else{
        return "SHOP_DOES_NOT_EXIST";
        }
    }




    
############################################################
##################### Category Functions ###################
############################################################
    public function categoryDuplicateCheck($cat_name){
        $stmt = $this->dbconnect()->prepare("SELECT category_id FROM category WHERE category_name = ?");
        $stmt->bind_param("s",$cat_name);
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            // return 1;
            return "EXIST";
        }
        else{
            return 0;
        }
    }


    public function createCategory($category_name,$category_image){
        if($this->categoryDuplicateCheck($category_name)){
            return "CATEGORY_ALREADY_EXIST";
        }
            else{
           
            $stmt = $this->dbconnect()->prepare("INSERT INTO category(category_name,category_image) VALUES(?,?)");
            $stmt->bind_param("ss",$category_name,$category_image);
            $result = $stmt->execute() or die($this->dbconnect()->error);
            if($result){
                // return $this->dbconnect()->insert_id;
                return "SUCCESS";
            }else{
                return "SOME_ERROR";
            }
        }
    }


    public function UpdateCategory($cat_id,$cat_name){
        $stmt = $this->dbconnect()->prepare("SELECT category_name FROM category WHERE category_id = ?");
        $stmt->bind_param("s",$cat_id);
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            if($this->checkCategory($cat_name)){
                return "CATEGORY_ALREADY_EXIST";
            }
            else{
                $stmt = $this->connection->prepare("UPDATE category SET category_name = ? WHERE category_id = $cat_id");
                $stmt->bind_param("s",$cat_name);
                $result = $stmt->execute() or die($this->dbconnect()->error);
                if($result){
                    return "CATEGORY_UPDATED";
                }else{
                    return "SOME_ERROR";
            }
            }
            
        }else{
            return "CATEGORY_DOES_NOT_EXIST";
        }

    }

    public function DeleteCategory($cat_id){
        $stmt = $this->dbconnect()->prepare("SELECT category_name FROM category WHERE category_id = ?");
        $stmt->bind_param("s",$cat_id);
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $stmt = $this->dbconnect()->prepare("DELETE FROM category WHERE category_id = $cat_id");
            $result = $stmt->execute() or die($this->dbconnect()->error);
            if($result){
                return "CATEGORY_DELETED";
            }else{
                return "SOME_ERROR";
        }
        }else{
        return "CATEGORY_DOES_NOT_EXIST";
        }
    }





############################################################
##################### Sub-Category Functions ###############
############################################################
public function subcategoryDuplicateCheck($subcat_name){
    $stmt = $this->dbconnect()->prepare("SELECT subcategory_id FROM subcategory WHERE subcategory_name = ?");
    $stmt->bind_param("s",$subcat_name);
    $stmt->execute() or die($this->dbconnect()->error);
    $result = $stmt->get_result();
    if($result->num_rows == 1){
        // return 1;
        return "EXIST";
    }
    else{
        return 0;
    }
}


public function createSubcategory($subcat_name){
    if($this->subcategoryDuplicateCheck($subcat_name)){
        return "SUBCATEGORY_ALREADY_EXIST";
    }
        else{
       
        $stmt = $this->dbconnect()->prepare("INSERT INTO subcategory(subcategory_name) VALUES(?)");
        $stmt->bind_param("s",$subcat_name);
        $result = $stmt->execute() or die($this->dbconnect()->error);
        if($result){
            // return $this->dbconnect()->insert_id;
            return "SUCCESS";
        }else{
            return "SOME_ERROR";
        }
    }
}

public function UpdateSubcategory($subcat_id,$cat_id,$subcat_name){
    $stmt = $this->dbconnect()->prepare("SELECT subcategory_name FROM subcategory WHERE subcategory_id = ?");
    $stmt->bind_param("s",$subcat_id);
    $stmt->execute() or die($this->dbconnect()->error);
    $result = $stmt->get_result();
    if($result->num_rows == 1){
        if($this->subcategoryDuplicateCheck($cat_id,$subcat_name)){
            return "SUBCATEGORY_ALREADY_EXIST";
        }
        else{
            $stmt = $this->dbconnect()->prepare("UPDATE subcategory SET subcategory_name = ? WHERE subcategory_id = $subcat_id");
            $stmt->bind_param("s",$subcat_name);
            $result = $stmt->execute() or die($this->dbconnect()->error);
            if($result){
                return "SUB CATEGORY_UPDATED";
            }else{
                return "SOME_ERROR";
        }
        }
        
    }else{
        return "SUBCATEGORY_DOES_NOT_EXIST";
    }

}

public function DeleteSubcategory($subcat_id){
    $stmt = $this->dbconnect()->prepare("SELECT subcategory_name FROM subcategory WHERE subcategory_id = ?");
    $stmt->bind_param("s",$subcat_id);
    $stmt->execute() or die($this->dbconnect()->error);
    $result = $stmt->get_result();
    if($result->num_rows == 1){
        $stmt = $this->dbconnect()->prepare("DELETE FROM subcategory WHERE subcategory_id = $subcat_id");
        $result = $stmt->execute() or die($this->dbconnect()->error);
        if($result){
            return "SUBCATEGORY_DELETED";
        }else{
            return "SOME_ERROR";
    }
    }else{
    return "SUBCATEGORY_DOES_NOT_EXIST";
    }
}



############################################################
##################### Products  Functions ##################
############################################################

    public function checkProducts($product_name){
        $stmt = $this->dbconnect()->prepare("SELECT product_id FROM products WHERE product_title = ? ");
        $stmt->bind_param("s",$product_name);
        $stmt->execute() or die($this->dbconnect->error);
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            // return 1;
            return "EXIST";
        }
        else{
            return 0;
        }
    }

// Create Product Details
    public function createProduct($pshp,$pc,$psc,$pn,$pp,$pq,$pcl,$pd,$pimg,$pt){
        // if($this->checkProducts($pn)){
        //     // return 1;
        //     return "ALREADY_INSERTED";
        // }else{
            $stmt = $this->dbconnect()->prepare("INSERT INTO products(product_shop,product_category,product_subcategory,product_title,product_price,product_qty,product_color,product_descripton,product_mainimg,product_tags) VALUES(?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ssssssssss",$pshp,$pc,$psc,$pn,$pp,$pq,$pcl,$pd,$pimg,$pt);
            $result = $stmt->execute() or die($this->dbconnect()->error);
            if($result){
                return "SUCCESS";
            }else{
                return "SOME_ERROR";
            }
           
            
        // }
    }

//  Update Product Details
    public function UpdateProduct($product_id,$pc,$pb,$product_name,$pp,$pd,$pk){
        $stmt = $this->connection->prepare("SELECT product_title FROM products WHERE product_id = ?");
        $stmt->bind_param("s",$product_id);
        $stmt->execute() or die($this->connection->error);
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            if($this->checkProduct($product_name)){
                return "PRODUCT_NAME_ALREADY_EXIST";
            }
            else{
                $stmt = $this->connection->prepare("UPDATE products SET product_cat = ?,product_brand = ?,product_title = ?,product_price = ?,product_desc = ?,product_keywords = ? WHERE product_id = $product_id");
                $stmt->bind_param("ssssss",$pc,$pb,$product_name,$pp,$pd,$pk);
                $result = $stmt->execute() or die($this->connection->error);
                if($result){
                    return "PRODUCT_UPDATED";
                }else{
                    return "SOME_ERROR";
            }
            }
            
        }else{
            return "PRODUCT_DOES_NOT_EXIST";
        }

    }
// Delete Products
    public function DeleteProduct($product_id){
        $stmt = $this->dbconnect()->prepare("SELECT product_title FROM products WHERE product_id = ?");
        $stmt->bind_param("s",$product_id);
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $stmt = $this->dbconnect()->prepare("DELETE FROM products WHERE product_id = $product_id");
            $result = $stmt->execute() or die($this->dbconnect()->error);
            if($result){
                return "PRODUCT_DELETED";
            }else{
                return "SOME_ERROR";
        }
        }else{
        return "PRODUCT_DOES_NOT_EXIST";
        }
    }


############################################################
##################### Search Functions ###################
############################################################
    
}


$obj = new Admin();
echo($obj->createProduct("1","2","3","ddaad","10","2","rd","dsds","dsds","dsd"));
// echo($obj->checkProducts("dsdss"));


?>