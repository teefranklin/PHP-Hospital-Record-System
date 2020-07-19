<?php
@session_start();
//Database connection
$db = new PDO('mysql:host=localhost;dbname=hospital;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

/* user management */

//login function
function login($email, $password)
{
    global $db;
    try {
        $sql = "SELECT * FROM auth_user WHERE email=?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($email));
        $rslt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();

        if ($count > 0) {
            if (password_verify($password, $rslt[0]["password"])) {
                $result["status"] = "ok";
                $storeSessions = storeSessions($email);
            } else {
              $result["status"] = 'wrong password !';
            }
        } else {
            $result["status"] = "fail";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
    return $result;
}
//check Account

function checkAccount($id)
{
    global $db;
    try {
        $sql = "SELECT * FROM account WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $rslt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();

        if ($count > 0) {
            return 'yes';
        } else {
            return 'no';
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
}
//store sessions 
function storeSessions($email)
{
    global $db;
    try {
        $sql = "SELECT * FROM auth_user WHERE email=?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($email));
        $rslt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if ($count > 0) {
            $result["status"] = "ok";
            $_SESSION["id"] = $rslt[0]["id"];
            $_SESSION["password"] = $rslt[0]["password"];
            $_SESSION["username"] = $rslt[0]["username"];
            $_SESSION["first_name"] = $rslt[0]["first_name"];
            $_SESSION["last_name"] = $rslt[0]["last_name"];
            $_SESSION["email"] = $rslt[0]["email"];
            $_SESSION['fullname'] = $rslt[0]["first_name"] . " " . $rslt[0]["last_name"];
            $_SESSION['admin'] = $rslt[0]["is_staff"];
        } else {
            $result["status"] = "fail";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
    return $result;
}


//function to check if the user is logged
function isLogggedIn()
{
    if (isset($_SESSION['id'])) {
        return true;
    }
}

//update login
function updateLogin($email, $date)
{
    global $db;
    try {
        $stmt = $db->prepare("update auth_user set last_login=? where email=?");
        $stmt->execute(array($date, $email));
        $counter = $stmt->rowCount();
        if ($counter > 0) {
            $result["status"] = "ok";
            $result["id"] = $db->lastInsertId();
        } else {
            $result["status"] = "error";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
    return $result;
}
//logout function
function logout()
{
    session_destroy();
    header("Location:login.php");
}

//Function to register a new user
function create_user($email, $password, $first_name, $last_name, $hospital)
{
    $password = password_hash($password, PASSWORD_DEFAULT);
    $id = rand(10111111, 10999999);

    global $db;
    $date_joined=date('Y-m-d H:i:s');
    try {
        $stmt = $db->prepare("INSERT INTO auth_user (id,email,password,first_name,last_name,hospital) VALUES(?,?,?,?,?,?)");
        $stmt->execute(array($id, $email, $password, $first_name, $last_name, $hospital));
        $counter = $stmt->rowCount();
        
        return 'ok';
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}

//Function to register a new patient
function create_patient($id_no,$first_name, $last_name, $email, $dob, $blood_type, $address, $hospital, $nkfirstname, $nklastname, $nkemail, $nkaddress)
{
    $id = rand(10111111, 10999999);

    global $db;
    $date_added=date('Y-m-d');
    try {
        $stmt = $db->prepare("INSERT INTO `patient`(`id`,`id_no`, `fname`, `lname`, `email`, `dob`, `blood_type`, `address`, `hospital`, `date_added`, `nok_fname`, `nok_lname`, `nok_email`, `nok_address`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->execute(array($id, $id_no, $first_name, $last_name, $email, $dob, $blood_type, $address, $hospital , $date_added, $nkfirstname, $nklastname, $nkemail, $nkaddress));
        $counter = $stmt->rowCount();
        
        return 'ok';
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}

//Function to add new record
function get_patient($id_no){
    global $db; 
    try {
        $sql = "SELECT * FROM patient WHERE id_no=?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id_no));
        $rslt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        $result["status"] = $rslt[0]["id"];

        if ($count > 0) {
            return $result["status"];
        } else {
            return 'Record Not Found';
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
}
function create_record($id_no, $description, $doctor)
{
    $id = rand(10111111, 10999999);

    global $db;
    $added_date=date('Y-m-d');
    $get_patient = get_patient($id_no);
    if($get_patient!="Record Not Found"){
        try {
        $stmt = $db->prepare("INSERT INTO med_history (`id`, `patient_id`, `description`, `doctor`, `added_date`) VALUES(?,?,?,?,?)");
        $stmt->execute(array($id, $get_patient, $description, $doctor, $added_date));
        $counter = $stmt->rowCount();
        
        return 'ok';
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
    }
}
//My User Create Account Function
function createAccount($id)
{
    global $db;
    try {
        $depo_date = date('Y-m-d H:i:s');
        $query ="INSERT INTO account(id) VALUES(".$id.")";
        $statement = $db->prepare($query);
        $statement->execute();
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
}
//insert payment details
function insertPayment($invoice,$amount,$thash,$user)
{
    global $db;
    try {
        $tdate = date('Y-m-d H:i:s');
        $query ="INSERT INTO transaction_log(invoice,amount,transaction_hash,transaction_date,user,action) VALUES($invoice,$amount,'".$thash."','".$tdate."',$user,'deposit')";
        $statement = $db->prepare($query);
        $statement->execute();
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
}
//Function to check if the user already exists
function user_exist($username)
{
    global $db;
    try {
        $sql = "SELECT * FROM auth_user WHERE username=? ";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($username));
        $rslt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if ($count > 0) {
            $result["status"] = "ok";
        } else {
            $result["status"] = "error";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
    return $result;
}
//Function to check if the patient already exists
function patient_exist($email)
{
    global $db;
    try {
        $sql = "SELECT * FROM patient WHERE patient=? ";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($email));
        $rslt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if ($count > 0) {
            $result["status"] = "ok";
        } else {
            $result["status"] = "error";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
    return $result;
}


function count_users(){
    global $db;

    try {
        $sql = "SELECT * FROM auth_user";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rslt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        $result["status"] = $count;
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
    return $result;

}

function count_patients(){
    global $db;

    try {
        $sql = "SELECT * FROM patient";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rslt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        $result["status"] = $count;
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
    return $result;
}
function count_medical_history(){
    global $db;

    try {
        $sql = "SELECT * FROM med_history";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rslt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        $result["status"] = $count;
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
    return $result;
}

//Function to check if the email already exists
function email_exist($email)
{
    global $db;
    try {
        $sql = "SELECT * FROM auth_user WHERE email=? ";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($email));
        $rslt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if ($count > 0) {
            $result["status"] = "ok";
        } else {
            $result["status"] = "error";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
    return $result;
}
/* End of user management */

//update user information
function updateProfile($db_field, $variable, $email)
{
    global $db;
    try {
        $stmt = $db->prepare("update auth_user set " . $db_field . "=? where email=?");
        $stmt->execute(array($variable, $email));
        $counter = $stmt->rowCount();
        if ($counter > 0) {
            $result["status"] = "ok";
            $result["id"] = $db->lastInsertId();
        } else {
            $result["status"] = "error";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
    return $result;
}
function updateAmount()
{
    $pesent = (rand(150, 250) / 100) / 100;
    $amounts = getAmount();
    $total_revenue = round(($amounts[1] * $pesent) + $amounts[1]);
    $generated_revenue = $total_revenue - $amounts[0];

    global $db;
    try {
        $stmt = $db->prepare("update account set total_revenue=?, generated_revenue=? where id=?");
        $stmt->execute(array($total_revenue, $generated_revenue, $_SESSION['id']));
        $counter = $stmt->rowCount();
        if ($counter > 0) {
            $result["status"] = "ok";
            $result["id"] = $db->lastInsertId();
        } else {
            $result["status"] = "error";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
}
function getAmount()
{
    global $db;
    try {
        $sql = "SELECT * FROM account WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($_SESSION['id']));
        $rslt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if ($count > 0) {
            $result["status"] = "ok";
            $amount_deposited = $rslt[0]["amount_deposited"];
            $total_revenue = $rslt[0]["total_revenue"];
            $generated_revenue = $rslt[0]["generated_revenue"];
            //last_logged date to be added later
        } else {
            $result["status"] = "fail";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
    $values = array();
    $values[0] = $amount_deposited;
    $values[1] = $total_revenue;
    $values[3] = $generated_revenue;
    return $values;
}
function insertAudit($tr, $gr)
{
    global $db;
    try {
        $stmt = $db->prepare("insert into audit (email,password,first_name,last_name,username,gender) values(?,?,?,?,?,?)");
        $stmt->execute(array($email, $password, $first_name, $last_name, $username, $gender));
        $counter = $stmt->rowCount();
        if ($counter > 0) {
            $result["status"] = "ok";
            $result["id"] = $db->lastInsertId();
        } else {
            $result["status"] = "error";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
    return $result;
}
function withdraw($amount)
{
    $amounts = getAmount();
    $total_revenue = $amounts[1] - $amount;
    global $db;
    try {
        $stmt = $db->prepare("update account set total_revenue=? where id=?");
        $stmt->execute(array($total_revenue, $_SESSION['id']));
        $counter = $stmt->rowCount();
        if ($counter > 0) {
            $result["status"] = "ok";
            $result["id"] = $db->lastInsertId();
        } else {
            $result["status"] = "error";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
}
