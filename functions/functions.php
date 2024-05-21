<?php  

function clean($string) {
    return htmlentities($string);
}

function redirect($location) {
    header("location: {$location}");
    exit();
}

function set_message($message) {
    if(!empty($message)) {
        $_SESSION['message'] = $message;
    } else {
        $message = "";
    }
}

function display_message() {
    if(isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function email_exists($email) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $query = "SELECT id FROM korisnici WHERE email = '$email'";
    $result = query($query);

    if($result->num_rows > 0) {
        return true;
    }
    return false;
}

function user_exists($user) {
    $user = filter_var($user, FILTER_SANITIZE_STRING);
    $query = "SELECT id FROM korisnici WHERE username = '$user'";
    $result = query($query);

    if($result->num_rows > 0) {
        return true;
    }
    return false;
}

function validate_user_registration() {
    $errors = [];
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = clean($_POST['name']);
        $email = clean($_POST['email']);
        $username = clean($_POST['username']);
        $password = clean($_POST['password']);
        $confirm_password = clean($_POST['confirm_password']);

        if(strlen($name) < 3) {
            $errors[] = "Your first name cannot be less then 3 characters!";
        }
        if(strlen($username) < 3) {
            $errors[] = "Your username cannot be less then 3 characters!";
        }
        if(strlen($name) > 20) {
            $errors[] = "Your username cannot be bigger then 20 characters!";
        }
        if(email_exists($email)) {
            $errors[] = "Sorry that Email is already taken";
        }
        // Provera da li e-mail ima domen gmail.com
        /*if (substr(strrchr($email, "@"), 1) !== 'gmail.com') {
            $errors[] = "Email must be a gmail.com address.";
        }
        // Provera složenosti lozinke (slova, brojevi, specijalni karakteri)
        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = "Your password must include at least one uppercase letter.";
        }
        if (!preg_match('/[a-z]/', $password)) {
            $errors[] = "Your password must include at least one lowercase letter.";
        }
        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = "Your password must include at least one number.";
        }
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            $errors[] = "Your password must include at least one special character.";
        }
        */
        if(user_exists($username)) {
            $errors[] = "Sorry that Username is already taken";
        }
        if(strlen($password) > 10) {
            $errors[] = "Your Password cannot be more than 8 characters";
        }
        if(strlen($password) < 3) {
            $errors[] = "Your Password cannot be less than 3 characters";
        }
        if($password != $confirm_password) {
            $errors[] = "The password was not confirmed correctly";
        }
        if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<div class='alert'>" . $error . "</div>";
                }
            }else {
                $name = filter_var($name, FILTER_SANITIZE_STRING);
                $email = filter_var($email, FILTER_SANITIZE_STRING);
                $username = filter_var($username, FILTER_SANITIZE_STRING);
                $password = filter_var($password, FILTER_SANITIZE_STRING);
                create_user($name, $email, $username, $password);
            }
        }
    }

    function create_user($name, $email, $username, $password) {
    
    $name = escape($name);
    $email = escape($email);
    $username = escape($username);
    $password = escape($password);
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO korisnici (name, email, username, password, is_admin)";
    $sql .= "VALUES ('$name','$email','$username','$password', 1)";
    
    confirm(query($sql));
    set_message("You have been successfully registered! Please log in!");
    redirect("login.php");
}

function validate_user_login() {
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);

        if(empty($email)) {
            $errors[] = "Email field cannot be empty";
        }
        if(empty($password)) {
            $errors[] = "Password field cannot be empty";
        }

        if(empty($errors)) {
            if(user_login($email, $password)) {
                if($_SESSION['is_admin'] == 1) {
                    redirect("index.php");
                } elseif($_SESSION['is_admin'] == 2) {
                    redirect("index.php");
                }
            } else {
                $errors[] = "Your email or password is incorrect. Please try again.";
            }
        }

        if(!empty($errors)) {
            foreach ($errors as $error) {
                echo '<div class="alert">' . $error . '</div>';
            }
        }
    }
}

function user_login($email, $password) {
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $query = "SELECT * FROM korisnici WHERE email='$email'";
    $result = query($query);

    if($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        if(password_verify($password, $data['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['is_admin'] = $data['is_admin'];
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function get_users() {
    $sql = "SELECT * FROM korisnici";

    $run = query($sql);
    
    if ($run) {
        return $run->fetch_all(MYSQLI_ASSOC);
    } else {
        return array(); // Vraćamo prazan niz ako se dogodi greška
    }
}



// restrikcija ako korisnik nije ulogovan/npr da ne moze da ode na neku stranicu
function user_restrictions() {
    if(!isset($_SESSION['email'])) {
        redirect("login.php");
    }
}

// restrikcija ako korisnik jeste ulogovan/da kroz url ne moze ode na login i register ako je vec ulogovan
function login_check_pages() {
    if(isset($_SESSION['email'])) {
        redirect("index.php");
    }
}

/*Validacija i registracija kompanije*/

function validate_company_registration() {
    if($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $tax_id = $_POST['tax_id'];
    $photo_path = $_POST['photo_path'];

    $sql = "INSERT INTO kompanije (name, email, logo, address, tax_id)
    VALUES ('$name','$email','$photo_path', '$address', '$tax_id')";
    confirm(query($sql));
    set_message("Uspesno ste registrovali kompaniju!");
    
}


}

function get_company() {
    $sql = "SELECT * FROM kompanije";

    $run = query($sql);
    
    if ($run) {
        return $run->fetch_all(MYSQLI_ASSOC);
    } else {
        return array(); // Vraćamo prazan niz ako se dogodi greška
    }
}


/*Validacija i registracija klijenata*/

function validate_client_registration() {
    if($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $company = $_POST['company'];

    $sql = "INSERT INTO klijenti (name, email, phone, company_id)
    VALUES ('$name','$email','$phone', '$company')";
    confirm(query($sql));
    set_message("Uspesno ste registrovali klijenta!");
    
}
}

function get_client() {
    $sql = "SELECT * FROM klijenti";

    $run = query($sql);
    
    if ($run) {
        return $run->fetch_all(MYSQLI_ASSOC);
    } else {
        return array(); // Vraćamo prazan niz ako se dogodi greška
    }
}

/* Za super admina */

function validate_user_registration_admin() {
    $errors = [];
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = clean($_POST['name']);
        $email = clean($_POST['email']);
        $username = clean($_POST['username']);
        $password = clean($_POST['password']);
        $confirm_password = clean($_POST['confirm_password']);
        $is_admin = clean($_POST['is_admin']);

        if(strlen($name) < 3) {
            $errors[] = "Your first name cannot be less then 3 characters!";
        }
        if(strlen($username) < 3) {
            $errors[] = "Your username cannot be less then 3 characters!";
        }
        if(strlen($name) > 20) {
            $errors[] = "Your username cannot be bigger then 20 characters!";
        }
        if(email_exists($email)) {
            $errors[] = "Sorry that Email is already taken";
        }
        if(user_exists($username)) {
            $errors[] = "Sorry that Username is already taken";
        }
        if(strlen($password) > 10) {
            $errors[] = "Your Password cannot be more than 8 characters";
        }
        if($password != $confirm_password) {
            $errors[] = "The password was not confirmed correctly";
        }
        if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<div class='alert'>" . $error . "</div>";
                }
            }else {
                $name = filter_var($name, FILTER_SANITIZE_STRING);
                $email = filter_var($email, FILTER_SANITIZE_STRING);
                $username = filter_var($username, FILTER_SANITIZE_STRING);
                $password = filter_var($password, FILTER_SANITIZE_STRING);
                create_user_for_admin($name, $email, $username, $password, $is_admin);
            }
        }
    }

    function create_user_for_admin($name, $email, $username, $password, $is_admin) {
    
    $name = escape($name);
    $email = escape($email);
    $username = escape($username);
    $password = escape($password);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $is_admin = escape($is_admin);
    
    $sql = "INSERT INTO korisnici (name, email, username, password, is_admin)";
    $sql .= "VALUES ('$name','$email','$username','$password', $is_admin)";
    
    confirm(query($sql));
    set_message("Uspesno ste registrovali korisnika!");

}