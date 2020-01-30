<?php

include_once("../database/db_connection.php");

class Customer extends dbConnection {

    public $customerIp;

        // To prevent the platform from sql injection ....  KEEP THIS PROPERTY : emailExists PRIVATE
        private function emailExists($email){
            $stmt = $this->dbconnect()->prepare("SELECT customer_id FROM customer WHERE customer_email = ? ");
            $stmt->bind_param("s",$email);
            $stmt->execute() or die($this->dbconnect()->error);
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                //return 1;
                return "already exist";
            }
            else{
                return 0;
            }
        }

        // Create Customer Function
        public function createUserAccount($cn,$ce,$cp){
            // To protect your application from sql attack you can user 
            // prepares statement
            if($this->emailExists($ce)){
                return "EMAIL_ALREADY_EXISTS";
            }
            else{
                $pass_hash = password_hash($cp,PASSWORD_BCRYPT,["cost"=>8]); //Encrypt the password.
                $stmt = $this->dbconnect()->prepare("INSERT INTO customer(customer_fullname,customer_email,customer_password) VALUES(?,?,?)");
                $stmt->bind_param("sss",$cn,$ce,$pass_hash);
                $result = $stmt->execute() or die($this->dbconnect()->error);
                if($result){
                    // return $this->dbconnect()->insert_id;
                    return "REGISTRATION_SUCCESS";
                }else{
                    return "SOME_ERROR";
                }
        }
            }

            // public function createUserHard($cn,$ce,$cp,$cc,$ccy,$ccon,$ca){
            //     // To protect your application from sql attack you can user 
            //     // prepares statement
            //     if($this->emailExists($ce)){
            //         return "EMAIL_ALREADY_EXISTS";
            //     }
            //     else{
            //         $pass_hash = password_hash($cp,PASSWORD_BCRYPT,["cost"=>8]); 
            //         $stmt = $this->dbconnect()->prepare("INSERT INTO customer(customer_fullname,customer_email,customer_password,customer_gender,customer_country,customer_city,phone_details,customer_address) VALUES(?,?,?,?,?,?,?)");
            //         $stmt->bind_param("sssssss",$cn,$ce,$pass_hash,$cc,$ccy,$ccon,$ca);
            //         $result = $stmt->execute() or die($this->dbconnect()->error);
            //         if($result){
            //             return $this->dbconnect()->insert_id;
            //         }else{
            //             return "SOME_ERROR";
            //         }
            // }
            //     }


        // Customer Login Method
        public function customerLogin($email,$password){
                $stmt = $this->dbconnect()->prepare("SELECT customer_id,customer_fullname,customer_email,customer_password,customer_country,customer_city,phone_details,address FROM customer WHERE customer_email = ? ");
                $stmt->bind_param("s",$email);
                $stmt->execute() or die($this->dbconnect()->error);
                $result = $stmt->get_result();
                if($result->num_rows < 1 ){
                    return "NOT_REGISTERED";
                }
                else{
                    $row = $result->fetch_assoc();
                    if(password_verify($password,$row["customer_password"])){
                        session_start();
                        $_SESSION["customer_id"] = $row["customer_id"];
                        $_SESSION["customer_fullname"] = $row["customer_fullname"];
                        $_SESSION["customer_email"] = $row["customer_email"];
                        $_SESSION["customer_password"] = $row["customer_password"];
                        $_SESSION["customer_country"] = $row["customer_country"];
                        $_SESSION["customer_city"] = $row["customer_city"];
                        $_SESSION["phone_details"] = $row["phone_details"];
                        $_SESSION["address"] = $row["address"];
                        
                        $time_format = "Y-m-d h:m:s";
                        $login_date = date($time_format);
                        $stmt = $this->dbconnect()->prepare("UPDATE customer SET login_date = ? WHERE customer_email = ?");
                        $stmt->bind_param("ss",$login_date,$email);
                        $result = $stmt->execute() or die($this->dbconnect()->error);
                        if($result){
                            return "LOGIN_SUCCESSFUL";
                        }
                        else{
                            return 0;
                        }
                        
        
                    }
                    else{
                        return "PASSWORD_NOT_MATCHED";
                    }
                }
        
        
            }

            public function custGenenralUpdate($cid,$cfn,$ca,$cg,$ccon,$ccity,$cp,$cad){
                $stmt = $this->dbconnect()->prepare("SELECT customer_fullname FROM customer WHERE customer_id = ?");
                $stmt->bind_param("s",$cid);
                $stmt->execute() or die($this->dbconnect()->error);
                $result = $stmt->get_result();

                if($result->num_rows == 1){
                $stmt = $this->dbconnect()->prepare("UPDATE customer SET customer_fullname = ?, customer_age = ?, customer_gender = ?, customer_country = ?, customer_city = ?,phone_details = ?, address = ? WHERE customer_id = $cid");
                $stmt->bind_param("sssssss",$cfn,$ca,$cg,$ccon,$ccity,$cp,$cad);
                $result = $stmt->execute() or die($this->dbconnect()->error);
                if($result){
                    return "CUSTOMER_DETAILS_UPDATED";
                }else{
                    return "SOME_ERROR";
            }
           
           
        }else{
            return "CUSTOMER_DOES_NOT_EXIST";
        }
    }


         public function custEmailUpdate($cid,$ce){
            $stmt = $this->dbconnect()->prepare("SELECT customer_fullname FROM customer WHERE customer_id = ?");
            $stmt->bind_param("s",$cid);
            $stmt->execute() or die($this->dbconnect()->error);
            $result = $stmt->get_result();

            if($this->emailExists($ce)){
                return "EMAIL_ALREADY_IN_USE";
            }else{
                if($result->num_rows == 1){
                    $stmt = $this->dbconnect()->prepare("UPDATE customer SET customer_email = ? WHERE customer_id = $cid");
                    $stmt->bind_param("s",$ce);
                    $result = $stmt->execute() or die($this->dbconnect()->error);
                    if($result){
                        return "CUSTOMER_EMAIL_UPDATED";
                    }else{
                        return "SOME_ERROR";
                    }
                   
                }else{
                    return "CUSTOMER_DOES_NOT_EXIST";
                }
                }
               
            }


  public function custPassUpdate($cid,$cpwd){
        $stmt = $this->dbconnect()->prepare("SELECT customer_fullname FROM customer WHERE customer_id = ?");
        $stmt->bind_param("s",$cid);
        $stmt->execute() or die($this->dbconnect()->error);
        $result = $stmt->get_result();

        if($result->num_rows == 1){
                $pwd = password_hash($cpwd,PASSWORD_BCRYPT,["cost"=>8]);
                $stmt = $this->dbconnect()->prepare("UPDATE customer SET customer_password = ? WHERE customer_id = $cid");
                $stmt->bind_param("s",$pwd);
                $result = $stmt->execute() or die($this->dbconnect()->error);
                if($result){
                    return "CUSTOMER_PASSWORD_UPDATED";
                }else{
                    return "SOME_ERROR";
            }
           
        }else{
            return "CUSTOMER_DOES_NOT_EXIST";
        }
       
       
    }
}

 // $user = new Customer();
// echo($user->emailExists("winston@ashesi.edu.gh"));
// echo($user->getCustomerIp());
// echo($user->createUserAccount("Winston Best","winston.best@gamil.com","1234"));
// echo($user->customerLogin("cdcd@gmail.com","987654321"));
// echo($user->customerUpdate("eugene@gmail.com","1234"));
// echo($user->custGenenralUpdate("1","Winston Best-Ezeani","25","Male","Nigeria","Lagos","05553940028","Ashesi"))
// echo($user->custEmailUpdate("1","eugene@gmail.com"));
// echo($user->custPassUpdate("1","99985440"))



?>