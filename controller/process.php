<?php

// Classes Included.
include_once("../functions/dbOperations.php");
include_once("../functions/customerOperations.php");
include_once("../functions/adminOperations.php");


############################################################
##################### Customer Controller ###################
############################################################

// Customer Registration Controller
if(isset($_POST['customer_fullname']) && isset($_POST['customer_email'])){
    $user = new Customer();
    $result= $user->createUserAccount($_POST['customer_fullname'],$_POST['customer_email'],$_POST['customer_password1']);
    echo($result);
}

//Customer Login Controller
if(isset($_POST['log_email']) && isset($_POST['log_pass'])){
    $user = new Customer();
    $result= $user->customerLogin($_POST['log_email'],$_POST['log_pass']);
    echo($result);

    // if($result == )
}

//Customer General Update Controller
if(isset($_POST['customer_fullname']) && isset($_POST['customer_age']) && isset($_POST['customer_gender'])&& isset($_POST['customer_country'])&& isset($_POST['customer_city'])&& isset($_POST['phone_details'])&& isset($_POST['address'])){
    $user = new Customer();
    $result= $user->custGeneralUpdate($_SESSION['customer_id'],$_POST['customer_fullname'],$_POST['customer_age'],$_POST['customer_gender'],$_POST['customer_country'], $_POST['customer_city'], $_POST['phone_details'], $_POST['address']);
}

// Customer Email Update Controller
// if(isset($_POST['customer_email'])){
//     $user = new Customer();
//     $result= $user->custEmailUpdate($_SESSION['customer_id'],$_POST['customer_email']);
// }

// Customer Password Update Controller
if(isset($_POST['customer_password'])){
    $user = new Customer();
    $result= $user->custPassUpdate($_SESSION['customer_id'],$_POST['customer_password1']);
}


//Add to cart 
if(isset($_POST['quantity']) && isset($_GET['product_id'])){
    $queue = new dbConnection();
    $result= $queue->addProductCart($_GET['product_id'],$_POST['quantity']);
    echo($result);
}

############################################################
##################### Admin Controller ###################
############################################################

//Admin Login Controller
if(isset($_POST['admin_log_email']) && isset($_POST['admin_log_pass'])){
    $user = new Admin();
    $result= $user->adminLogin($_POST['admin_log_email'],$_POST['admin_log_pass']);
    echo($result);
}

//Admin Registration Controller
if(isset($_POST['admin_email']) && isset($_POST['admin_password1'])){
    $user = new Admin();
    $result= $user->createAdminAccount($_POST['admin_fullname'],$_POST['admin_email'],$_POST['admin_password1'],$_POST['security_code']);
    echo($result);
}

//Admin General Update Controller
if(isset($_POST['admin_up_name']) && isset($_POST['admin_up_phone'])){
    $user = new Admin();
    $result= $user->adminGenenralUpdate($_SESSION["admin_id"],$_POST['admin_up_name'],$_POST['admin_up_phone'],$_POST['admin_address'],$_POST['admin_security_code']);
    echo($result);
}


//Admin Email Update Controller
if(isset($_POST['admin_up_email'])){
    $user = new Admin();
    $result= $user->adminEmailUpdate($_SESSION["admin_id"],$_POST['admin_up_email']);
    echo($result);
}

//Admin Password Update Controller
if(isset($_POST['admin_up_email'])){
    $user = new Admin();
    $result= $user->adminSecurityUpdate($_SESSION["admin_id"],$_POST['admin_up_email'],$_POST['admin_up_code']);
    echo($result);
}





############################################################
##################### Category  Insertion  Controller #######
############################################################
if(isset($_POST['cat_name'])){
    $user = new Admin();
    $result = $user->createCategory($_POST['cat_name'],$_POST['cat_image']);
    echo($result);

}


// Delete Category
if(isset($_GET['cdid'])){
    $user = new Admin();
    $result= $user->DeleteCategory($_GET['cdid']);
    echo($result);
    if($result == "CATEGORY_DELETED"){
        header("Location: http://localhost/enigma/admin/pages/category.php");
        die();
    }
    if($result =""){
        return "CATEGORY_DOES_NOT_EXIST";
    }
}


############################################################
##################### SubCategory  Insertion  Controller #######
############################################################
if(isset($_POST['subcat_name'])){
    $user = new Admin();
    $result = $user->createSubcategory($_POST['subcat_name']);
    echo($result);

}

if(isset($_GET['scdid'])){
    $user = new Admin();
    $result= $user->DeleteSubcategory($_GET['scdid']);
    echo($result);
    if($result == "SUBCATEGORY_DELETED"){
        header("Location: http://localhost/enigma/admin/pages/subcategory.php");
        die();
    }
    if($result =""){
        return "SUBCATEGORY_DOES_NOT_EXIST";
    }
}

############################################################
##################### Product  Deletion  Controller #######
############################################################


if(isset($_GET['pdid'])){
    $user = new Admin();
    $result= $user->DeleteProduct($_GET['pdid']);
    echo($result);
    if($result == "PRODUCT_DELETED"){
        header("Location: http://localhost/enigma/admin/pages/inventory.php");
        die();
    }
    if($result =""){
        return "PRODUCT_DOES_NOT_EXIST";
    }
}




############################################################
##################### Product Insertion  Controller #######
############################################################
if(isset($_POST['product_name'])){
    $user = new Admin();
    $result = $user->createProduct($_POST['shpi'],$_POST['icati'],$_POST['subcatna'],$_POST['product_na'],$_POST['product_pr'],$_POST['product_qt'],$_POST['product_co'],$_POST['product_de'],$_POST['product_i'],$_POST['product_ta']);
    echo($result);

}


    // // Shop Route 
    // if(isset($_GET['suid'])){
    //     $user = new DBOperation();
    //     $result= $user->shopCategory($_GET['suid']);
    //     if($result){
    //         header("Location:http://localhost/enigma/shop.php?suid=".$_GET['suid']);
    //     }
        
    // }

    if(isset($_GET['pid'])){
        $product = new DBOperation();
        $result = $product->addProductCart($_GET['pid']);
        // var_dump($result);
        // echo($result);

        if($result == "PRODUCT_ADDED_TO_CART"){
            header("Location:http://localhost/enigma/cart.php?pcid=".$_GET['pid']);

        }
        else if($result == "PRODUCT_EXIST_IN_CART"){
            header("Location:http://localhost/enigma/cart.php?pcid=".$_GET['pid']);

        }
    }



    if(isset($_GET['cpdid'])){
        $product = new DBOperation();
        $result = $product->DeleteProdCart($_GET['cpdid']);
        if($result == "ITEM_DELETED"){
            header("Location:http://localhost/enigma/cart.php");
        }else{
            header("Location:http://localhost/enigma/shop.php");
        }
    }





?> 