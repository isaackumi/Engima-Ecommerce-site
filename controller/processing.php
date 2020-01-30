<?php

include_once( dirname(__FILE__)."/../functions/dbOperations.php");

class Processing extends DBOperation{

    public function vendorDropdown(){
        $table = "vendor";
        $results = $this->getAllrecords($table);

        foreach($results as $vendors){
            echo('<option value="'.$vendors["vendor_id"].'">'.$vendors["vendor_fullname"].'</option>');
        }

    }

    public function shopDropdown(){
        $table = "shop";
        $sresults = $this->getAllrecords($table);
        foreach($sresults as $shops){
            echo('<option value="'.$shops["shop_id"].'">'.$shops["shop_name"].'</option>');
        }


    }



    public function subcatDropdown(){
        $table = "subcategory";
        $sresults = $this->getAllrecords($table);
        foreach($sresults as $subcat){
            echo('<option value="'.$subcat["subcaetgeory_id"].'">'.$subcat["subcategory_name"].'</option>');
        }


    }

   



    public function shopTable(){
        $table = "shop";
        $results = $this->getAllrecords($table);
        foreach($results as $shtable){

                echo('<tr>'.
                    '<td>'. $shtable["shop_id"]. '</td>'.
                    '<td>'. $shtable["shop_name"]. '</td>'.
                    '<td>'. $shtable["shop_description"]. '</td>'.
                    '<td>'. $shtable["shop_address"]. '</td>'.
                    '<td><a class="btn btn-outline-warning btn-block"  href="http://localhost/enigma/controller/process.php?suid='.$shtable["shop_id"].'">Edit</td>'.
                    '<td><a class="btn btn-outline-danger btn-block" id="shopdel_btn" href="http://localhost/enigma/controller/process.php?dsid='.$shtable["shop_id"].'" >Delete</td>'.
                    '</tr>');
        }
    }

    public function vendorTable(){
        $table = "vendor";
        $results = $this->getAllrecords($table);
        foreach($results as $vtable){

                echo('<tr>'.
                    '<td>'. $vtable["vendor_id"]. '</td>'.
                    '<td>'. $vtable["vendor_fullname"]. '</td>'.
                    '<td>'. $vtable["vendor_email"]. '</td>'.
                    '<td>'. $vtable["vendor_city"]. '</td>'.
                    '<td>'. $vtable["phone_details"]. '</td>'.
                    '<td><a class="btn btn-outline-warning btn-block" href="http://localhost/enigma/controller/process.php?vuid='.$vtable["vendor_id"].'" >Edit</td>'.
                    '<td><a class="btn btn-outline-danger btn-block" href="http://localhost/enigma/controller/process.php?vdid='.$vtable["vendor_id"].'" >Delete</td>'.
                    '</tr>');
        }
    }

    public function categoryTable(){
        $table = "category";
        $results = $this->getAllrecords($table);
        foreach($results as $vtable){

                echo('<tr>'.
                    '<td>'. $vtable["category_id"]. '</td>'.
                    '<td>'. $vtable["category_name"]. '</td>'.
                    '<td><a class="btn btn-outline-warning btn-block" href="http://localhost/enigma/controller/process.php?cuid='.$vtable["category_id"].'" >Edit</td>'.
                    '<td><a class="btn btn-outline-danger btn-block" href="http://localhost/enigma/controller/process.php?cdid='.$vtable["category_id"].'" >Delete</td>'.
                    '</tr>');
        }
    }


    public function subcategoryTable(){
        $table = "subcategory";
        $results = $this->getAllrecords($table);
        foreach($results as $sbtable){

                echo('<tr>'.
                    '<td>'. $sbtable["subcategory_id"]. '</td>'.
                    '<td>'. $sbtable["subcategory_name"]. '</td>'.
                    '<td><a class="btn btn-outline-warning btn-block" href="http://localhost/enigma/controller/process.php?scuid='.$sbtable["subcategory_id"].'" >Edit</td>'.
                    '<td><a class="btn btn-outline-danger btn-block" href="http://localhost/enigma/controller/process.php?scdid='.$sbtable["subcategory_id"].'" >Delete</td>'.
                    '</tr>');
        }
    }

    public function productTable(){
        $table = "products";
        $results = $this->getAllrecords($table);
        foreach($results as $sbtable){

                echo('<tr>'.
                    '<td>'. $sbtable["product_id"]. '</td>'.
                    '<td>'. $sbtable["product_title"]. '</td>'.
                    '<td>'. $sbtable["product_price"]. '</td>'.
                    '<td>'. $sbtable["product_qty"]. '</td>'.
                    '<td>'. $sbtable["product_color"]. '</td>'.
                    '<td>'. $sbtable["product_tags"]. '</td>'.
                    '<td><a class="btn btn-outline-warning btn-block" href="http://localhost/enigma/controller/process.php?puid='.$sbtable["product_id"].'" >Edit</td>'.
                    '<td><a class="btn btn-outline-danger btn-block" href="http://localhost/enigma/controller/process.php?pdid='.$sbtable["product_id"].'" >Delete</td>'.
                    '</tr>');
        }
    }


   

    public function catDisplay(){
        $category = $_GET["suid"];
        $result = $this->shopCategory($category);
        foreach($result as $sbtable){
        
        echo('<div class="col-sm col-md-6 col-lg-3 ftco-animate">'.
            '<div class="product">'.
            '<a href="#" class="img-prod"><img class="img-fluid" src="'.$sbtable["category_image"].'" alt="Colorlib Template"> <span class="status">category</span><a>'.
            '<div class="text py-3 px-3">'.
            '<h3><a href="http://localhost/enigma/?suid='.$sbtable["shop_id"].'">'.$sbtable["category_name"].'</a></h3>'.
            '</div>'.
            '</div>'.
    '</div>');
            
    }

    }


    public function shopNameDis(){
        $category = $_GET["suid"];
        $result = $this->shopCategory($category);
        foreach($result as $sbtable){
            echo('<p>'.$sbtable["shop_name"].'</p>');

        }

    }

    public function categoryDropdown(){
        $table = "category";
        $cresults = $this->getAllrecords($table);
        foreach($cresults as $category){
            echo('<option value="'.$category["category_id"].'">'.$category["category_name"].'</option>');
        }


    }

    public function vendorCount(){
        $table = "vendor";
        $vcresults = $this->countRecords($table);
        return $vcresults;
    }

    public function shopCount(){
        $table = "shop";
        $vcresults = $this->countRecords($table);
        return $vcresults;
    }

    public function catCount(){
        $table = "category";
        $vcresults = $this->countRecords($table);
        return $vcresults;
    }

    public function prodCount(){
        $table = "products";
        $vcresults = $this->countRecords($table);
        return $vcresults;
    }



    // Products in a shop ....

    public function allProductDisplay(){
        $result= $this->getproductShop();
        if($result == "NO_PRODUCT_FOUND_IN_CATEGORY"){
            echo("NO_CATEGORY_FOUND");
        }
        else{
            foreach($result as $sbtable){
                echo('<div class="col-sm col-md-6 col-lg-3 ftco-animate">'.
                    '<div class="product">'.
                    '<a href="#" class="img-prod"><img class="img-fluid" src="'.$sbtable["product_mainimg"].'" alt="Colorlib Template"> <span class="status">Qty: '.$sbtable["product_qty"].'</span><a>'.
                    '<div class="text py-3 px-3">'.
                    '<h3><a href="http://localhost/enigma/product-single.php?pdisid='.$sbtable["product_id"].'">'.$sbtable["product_title"].'</a></h3>'.
                    '<div class="d-flex">'.
                    '<div class="pricing"><p class="price"><span> GHC'.$sbtable["product_price"].'</span></p></div>'.
                    '</div>'.
                    '<a class="price" ><span>Color: </span>'.$sbtable["product_color"].'</a>'.
                    '<hr>'.
                    '<p class="bottom-area d-flex">'.
                    '<a href="http://localhost/enigma/controller/process.php?pid='.$sbtable["product_id"].'" class="add-to-cart"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>'.
                    '</p>'.
                    '</div>'.
                    '</div>'.
                    '</div>');
    }
    
        }
    
        
    
    }


  

// Display the shop card on the index product.
public function shopCard(){
    $table = "shop";
    $results = $this->getAllrecords($table);
    foreach($results as $sbtable){
        
            echo('<div class="item">'.
                 '<div class="product">'.
                 '<a href="#" class="img-prod"><img class="img-fluid" src="'.$sbtable["shop_image"].'" alt="Colorlib Template"> <span class="status">Top shops</span></a>'.
                 '<div class="text pt-3 px-3">'.
                 '<h3><a style="color:red;font-size:1.3rem;" href="http://localhost/enigma/shop.php?suid='.$sbtable["shop_id"].'" >'.$sbtable["shop_name"].'</a></h3>'.
            '</div>'			
           .'</div>'
           .' </div>');
    }
}


// / Display the shop card on the index product.
public function AffordableProduct(){
    $result= $this->getproductAfford();
    if($result == "NO_PRODUCT_FOUND_IN_CATEGORY"){
        echo("NO_CATEGORY_FOUND");
    }
    else{
        foreach($result as $sbtable){
            echo('<div class="col-sm col-md-6 col-lg-3 ftco-animate">'.
                '<div class="product">'.
                '<a href="#" class="img-prod"><img class="img-fluid" src="'.$sbtable["product_mainimg"].'" alt="Colorlib Template"> <span class="status">Affordable</span><a>'.
                '<div class="text py-3 px-3">'.
                '<h3><a href="http://localhost/enigma/product-single.php?pdisid='.$sbtable["product_id"].'">'.$sbtable["product_title"].'</a></h3>'.
                '<div class="d-flex">'.
                '<div class="pricing"><p class="price"><span> GHC'.$sbtable["product_price"].'</span></p></div>'.
                '</div>'.
                '<a class="price" ><span>Color: </span>'.$sbtable["product_color"].'</a>'.
                '<hr>'.
                '<p class="bottom-area d-flex">'.
                '<a href="http://localhost/enigma/controller/process.php?pid='.$sbtable["product_id"].'" class="add-to-cart"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>'.
                '</p>'.
                '</div>'.
                '</div>'.
                '</div>');
}

    }

    

}


//Shop dropdown in the header....
public function shopNavdrop(){
    $table = "shop";
    $sresults = $this->getAllrecords($table);
    foreach($sresults as $shops){
        echo('<a class="dropdown-item" href="http://localhost/enigma/shop.php?suid='.$shops["shop_id"].'">'.$shops["shop_name"].'</a>');
    }


}

// public function allShopNavdrop(){
//     $table = "shop";
//     $sresults = $this->getAllrecords($table);
//     foreach($sresults as $shops){
//         echo('<a class="dropdown-item" href="http://localhost/enigma/shop.php?suid='.$shops["shop_id"].'">'.$shops["shop_name"].'</a>');
//     }


// }

  // Category under shop ...
  public function shopItem($sid){
    $result= $this->shopCategory($sid);
    // print_r($result);

    if($result == "SHOP_CATEGORY_NOT_FOUND"){
        echo("No Category Available");
    }
    else{
        foreach($result as $sbtable){

            echo('<div class="col-sm col-md-6 col-lg-3 ftco-animate">'.
                '<div class="product">'.
                '<a href="#" class="img-prod"><img class="img-fluid" src="'.$sbtable["category_image"].'" alt="Colorlib Template"> <span class="status">category</span><a>'.
    
                '<div class="text py-3 px-3">'.
                '<h3>'.
                '<a href="http://localhost/enigma/category.php?cuid='.$sbtable["category_id"].'">'.$sbtable["category_name"].
                '</a>'.
                '</h3>'.
                '</div>'.
    
    
                '</div>'.
    
    
                '</div>');
    
    }
    }

    

}




    public function catItem($cid){
        $result= $this->catProductCategory($cid);
        if($result == "NO_PRODUCT_FOUND_IN_CATEGORY"){
            echo("NO_CATEGORY_FOUND");
        }
        else{
            foreach($result as $sbtable){
                echo('<div class="col-sm col-md-6 col-lg-3 ftco-animate">'.
                    '<div class="product">'.
                    '<a href="#" class="img-prod"><img class="img-fluid" src="'.$sbtable["product_mainimg"].'" alt="Colorlib Template"> <span class="status">-30%</span><a>'.
                    '<div class="text py-3 px-3">'.
                    '<h3><a href="http://localhost/enigma/product-single.php?pdisid='.$sbtable["product_id"].'">'.$sbtable["product_title"].'</a></h3>'.
                    '<div class="d-flex">'.
                    '<div class="pricing"><p class="price"><span> GHC'.$sbtable["product_price"].'</span></p></div>'.
                    '</div>'.
                    '<a class="price" ><span>Posted by</span>'.$sbtable["product_price"].'</a>'.
                    '<hr>'.
                    '<p class="bottom-area d-flex">'.
                    '<a href="http://localhost/enigma/controller/process.php?pid='.$sbtable["product_id"].'" class="add-to-cart"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>'.
                    '</p>'.
                    '</div>'.
                    '</div>'.
                    '</div>');
    }

        }

        

    }


    public function singleproductDisplay($pid){
        $result= $this->getOneproduct($pid);
        foreach($result as $proddis){
            
            echo('<div class="row">'.
            '<div class="col-lg-6 mb-5 ftco-animate">'.
            '	<a  class="image-popup"><img src="'.$proddis["product_mainimg"].'"  class="img-fluid" alt="Colorlib Template"></a>'.
            '</div>'.
            '<div class="col-lg-6 product-details pl-md-5 ftco-animate">'.
            '<h3>'.$proddis["product_title"].'</h3>'.
            '<p class="price"><span>$'.$proddis["product_price"].'</span></p>'.
            '<p class="desc"><span>$'.$proddis["product_descripton"].'</span></p>'.
            '<div class="row mt-4">'.
            '<div class="input-group col-md-6 d-flex mb-3">'.
            '<p><a href="http://localhost/enigma/controller/process.php?pid='.$proddis["product_id"].'" class="btn btn-primary py-3 px-5">Add to Cart</a></p>'.
            '</div>'.
            '</div>'.
            '</div>'.
            '</div>');
        }
    }



//Shop dropdown in the header....
public function cartDisplay(){
    // $table = "cart";
    $sresults = $this->getCartDisplay();
    if($sresults == "CART_EMPTY"){
        echo("No product in carts currently");
    }
    else{
        foreach($sresults as $cart){
            echo('<tr class="text-center">'.
            '<td class="product-remove"><a href="#">No.</a>'.$cart['product_id'].'</td>'.
            '<td class="image-prod"><div class="img" style="background-image:url('.$cart['product_mainimg'].');"></div></td>'.
            '<td class="product-name">'.
            '<h3>'.$cart['product_title'].'</h3>'.
            '<p>'.$cart['product_descripton'].'</p>'.
            '</td>'.
            ' <td class="price"> GHC '.$cart['product_price'].'</td>'.
            ' <td class="quantity">'.
            '<div class="input-group mb-3">'.
            '<input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">'.
            '<div>'.
            '<td>'.
            '<td class="total">'.
            '<p><a href="http://localhost/enigma/controller/process.php?cpuid='.$cart["product_id"].'" class="btn btn-primary py-3 px-5">Update</a></p>'
            .'</td>'.
            '<td class="total">'.
            '<p><a href="http://localhost/enigma/controller/process.php?cpdid='.$cart["product_id"].'" class="btn btn-danger py-3 px-5">Delete Product</a></p>'
            .'</td>'
            .'</tr>');
        }
        
    }
    


}





    

   

    


}

// $obj = new Processing();
// echo($obj->singleproductDisplay("3"));


?>