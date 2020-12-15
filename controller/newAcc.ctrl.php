<?php
class newAccCtrl{
    public function createAccount($ID,$pswrd1,$pswrd2,$first_name,$second_name,$address,$telephone,$email,$school,$occupation)
    {
        if($ID!=null){
            if ((strlen($ID)==10 and (($ID[strlen($ID)-1] =='v') or ($ID[strlen($ID)-1] =='V') )) or (strlen($ID) ==12) ){   
                if (preg_match("/^[a-zA-Z-' ]*$/",$first_name.$second_name)) {   
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if ($pswrd1==$pswrd2 and $pswrd1!=null ) {
                            
                            include_once 'model/newAcc.model.php';
                            $cn = new newAaccModel();
                            $idResult=$cn->runIdQuery($ID);
                                        
                            if ($idResult){
                                $idDetails=$cn->numRows($idResult);
                                
                                if ($idDetails==null){

                                

                                    $result= $cn->insertUserDetails($ID,$first_name,$second_name,$address,$telephone,$email,$school,$occupation);
                                    $pass  = $cn->insertPasswordDetails($ID,$pswrd1);
                        
                                                            
                                    if ($pass && $result) {
                                        
                                        $massage="Account created successfully<br>Head to Login.        " ;
                                        $status="success"; 
                                    
                                    }  
                                                                
                                    else { $massage="account creation failed."; 
                                        $status="error"; }
                                
                                }
                                else {$massage= "Already account exists!";
                                    $status="warning";
                                
                                }
                            
                            }    
                            else  {$massage="account creation failed ";  
                                $status="error";
                            }

                        }
                        elseif ($pswrd1==null){
                            $massage="password can not be empty.";
                            $status="warning";    
                        }
                        elseif ($pswrd2==null){
                            $massage="Confirm the password.";
                            $status="warning";    
                        }

                        else {$massage="passwords are not maching.";
                            $status="warning";  
                        
                        }
                    }
                    else{
                        $massage = "Invalid Email Address.";
                        $status = "warning";
                    }
                }
                else{
                    $massage = "Invalid name.";
                    $status = "warning";
                }
            } 
            else{
                $massage = "Invalid ID number.";
                $status = "warning";
            } 
        }
        
        else {$massage='National Identy value can not be empty.';
                $status="warning";
        }                    
        
    
    return array($massage,$status);
    }




    public function checkDetails($ID,$pswrd1,$pswrd2)
    {
        $PswrdColumn='passwords';
    }   

}

?>  