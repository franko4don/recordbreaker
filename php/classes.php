<?php

//include 'connect.php';
$admin_username="franko4don";
$admin_password="";
class FormHandler extends DBHandler {

    /**
     * Verifies that the data collected from the form are error free
     * @param type $names
     * @return array 
     */
    function formValidation($names, $table) {

        $errors = array();

        foreach ($names as $name => $value) {
            if (empty($value)) {
                $errors[$name] = $name . " is required";
            }
            if (!empty($value) && strcmp("email", $name) == 0) {
                if (!$this->checkemail($value, $table)) {
                    $errors['unavailable'] = "Email has already been used";
                }
            }

            if (!empty($value) && strcmp("username", $name) == 0) {
                if (!$this->checkusername($value, $table)) {
                    $errors['username Exists'] = "Username already exists";
                }
            }
        }
        if (isset($names['password'])&&strcmp($names['password'], $names['confirmpassword']) != 0) {
            $errors['passwordmismatch'] = "passwords dont match";
        }

        if (isset($names['password'])&&strlen($names['password']) < 6) {
            $errors['passwordweak'] = "password too weak";
        }



        return $errors;
    }

    /**
     * Checks the database to confirm if the username or email chosen by the user
     * has already been used
     * @param type $username
     * @param type $email 
     * @return type boolean

      function userAndMailCheck($username, $email, $table_name) {
      $username_flag = true; //means username is not initially in database
      $email_flag = true;   //means email is not initially in database
      $not_used = false;
      //code that queries database for user name and email
      if ($username_flag && $email_flag) {

      $not_used = true;
      }

      return $not_used;
      } */

    /**
     * Queries the data
     * @param type $username
     * @param type $password 
     * @return type $boolean
     */
    function userAndPassCheck($username, $password) {
        $user_name = false;
        $pass_veri_flag = false;
        $user_confirmation = false;
        $password = md5($password);
        //code that queries database for user name and password
        if ($user_name && $pass_veri_flag) {
            $user_confirmation = true;
        }
        return $user_confirmation;
    }

}

class ImageHandler {

    /**
     * This function accepts the name representation of the image from html,
     * the file path where the image will be written into,
     * the filesize that is expected
     * and the image name
     * @param type $name
     * @param type $path
     * @param type $filesize
     * @param type imagename
     * @return boolean 
     */
    function uploadImage($name, $path, $filesize, $image_name) {

        $image_flag = false;
        if ($_FILES[$name]["error"] <= 0) {
            $value = $_FILES[$name]['name'];
            $type = $_FILES[$name]["type"];
            $size = ($_FILES[$name]["size"] / 1024);
            $stored_path = $_FILES[$name]["tmp_name"];
            echo "<br>Upload: " . $value . "<br>";
            echo "Type: " . $type . "<br>";
            echo "Size: " . $size . " kB<br>";
            echo "Stored in: " . $stored_path;

            //image name: this will be gotten based on last record on the database plus 1
            if ($size <= $filesize) {
                $image_flag = true;
                move_uploaded_file($stored_path, $path . $image_name);
                echo "Stored in: " . $path . $image_name;
            }
        }
        return $image_flag;
    }

    /**
     * Checks if image exists in folder using the image name
     * Accepts two parameters which are the image name and the file path
     * @param type $image_name
     * @param type $path
     * @return boolean 
     */
    function imageCheck($image_name, $path) {
        if (!file_exists($path . $image_name)) {
            echo "<br> Image doesnt exist";
            return true;
        } else {
            echo "<br> Image exists";
            return false;
        }
    }

    function resizeImage($imagepath, $x, $y, $path) {
        //  if(strcmp(substr($image_name, len($image_name)-3),"jpg")==0){
        $source = imagecreatefromjpeg($imagepath);
        $dimension = getimagesize($imagepath);
        $width = $dimension[0];
        $height = $dimension[1];
        $destination = imagecreatetruecolor($x, $y);
        imagecopyresized($destination, $source, 0, 0, 0, 0, $x, $y, $width, $height);
        return imagejpeg($destination, $path, 100);
    }

}


class DBHandler {

    /**
     * Creates a new user who is an investor and grant SELECT priviledge only
     * @param type $username(string)
     * @param type $password (string)
     */
    function createUserInvestor($username, $password) {
        global $admin_username;
        global $admin_password;
        $link = $this->connect($admin_username, $admin_password);
        if ($link) {
            
            $query1 = "CREATE USER '" . $username . "'@'localhost' IDENTIFIED BY '" . $password . "'";
            $query2 = "GRANT SELECT ON *.* TO '" . $username . "'@'localhost' IDENTIFIED BY '" . $password . "' WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0";
            $query3 = "REVOKE GRANT OPTION ON *.* FROM '" . $username . "'@'localhost'";
            $user__create = mysqli_query($link, $query1); //or die(mysqli_error($link));
            if ($user__create) {
                echo "User Created<br>";
                $priviledge_grant = mysqli_query($link, $query2) or die(mysqli_error($link));
                $priviledge_revoke = mysqli_query($link, $query3) or die(mysqli_error($link));
                if ($priviledge_grant && $priviledge_revoke) {
                    echo "priviledges granted succesfully";
                } else {
                    echo "priviledges Not granted<br>";
                }
            } else {
                echo "User Already Exists<br>";
            }
        }
    }

    /**
     * Connects to the Default database in the function using admin username and password
     * Returns true if connection was succesful and false otherwise
     * @param type $admin_username
     * @param type $admin_password
     * @return type boolean
     */
    function connect($admin_username, $admin_password) {
        $link = mysqli_connect("localhost", $admin_username, $admin_password, "recordbreakers");
        if ($link) {
            echo "Connection Succesful<br>";
            return $link;
        } else {
            echo "Connection failed<br>";
            return !$link;
        }
    }

    function selectDataForInvestor($table) {
        $link = $this->connect("franky", "chuky4don");
        $query2 = "SELECT * FROM " . $table;
        $dataInsert = mysqli_query($link, $query2) or die(mysqli_error($link));
        if ($dataInsert) {
            echo "Operation Succesful";
        }
    }

    /**
     * Creates a table in the recordbreakers database for investors
     * @param type $array (associative array)
     * @param type $table (string)
     * @return type (boolean)
     */
    function createTableForInvestor($array, $table) {
        global $admin_username;
        global $admin_password;
        $link = $this->connect($admin_username,$admin_password);
        $initial = "CREATE TABLE IF NOT EXISTS " . $table . " (id INT NOT NULL AUTO_INCREMENT,PRIMARY KEY(id) ";
        $types = " VARCHAR(200) NOT NULL";
        $later = ", UNIQUE KEY username (username), UNIQUE KEY email (email))";
        foreach ($array as $key => $value) {
            if (strcmp($value, "") == 0 || strcmp($key, 'confirmpassword') == 0) {
                continue;
            }
            $initial.=(", " . $key . $types);
        }
        $initial.=$later;
        // echo "<br>".$initial."<br>";
        $insert = mysqli_query($link, $initial) or die(mysqli_error($link));
        if ($insert) {
            echo "Table Created";
        } else {
            echo "Table Not Created";
        }
        return $insert;
    }

    /**
      Creates a new user in the database
      @return true if query was successful or false if not successful
     */
    function insert($details, $table) {
        global $admin_username;
        global $admin_password;
        $link = $this->connect($admin_username,$admin_password);
        $part1 = "(";
        $part2 = "(";

        foreach ($details as $detail => $value) {
            if (strcmp($value, "") == 0 || strcmp($detail, 'confirmpassword') == 0) {
                continue;
            }
            if (strcmp($detail, "password") == 0) {
                $value = md5($value);
            }
            $part1.=$detail . ",";
            $part2.="'" . $value . "'" . ",";
        }
        
        $part1.="date,time,";
        $length1 = strlen($part1);
        $part1[$length1 - 1] = ")";

        
        $part2.="CURRENT_DATE(),CURRENT_TIME(),";
        $length2 = strlen($part2);
        $part2[$length2 - 1] = ")";
        
        $query = "INSERT INTO " . $table . $part1 . " VALUES " . $part2;
       //  echo "<br>".$query;
        $inserter = mysqli_query($link, $query) or die(mysqli_error($link));
        if ($inserter) {

            echo "<br> Details inserted Succesfully";
            return true;
        } else {
            echo "<br> Details Not inserted";
            return false;
        }
    }

    /**
     * Checks the given table to see if the email has already been used
     * @param type $email (string)
     * @param type $table (string)
     * @return (boolean) 
     */
    function checkemail($email, $table) {
        global $admin_username;
        global $admin_password;
        $link = $this->connect($admin_username, $admin_password);
        $str = "SELECT * FROM " . $table . " WHERE email = '" . $email . "'";
        mysqli_query($link, $str);
        $count = mysqli_affected_rows($link);
        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Checks a given table to see if the username has already been used
     * @param type $username (string)
     * @param type $table   (string)
     * @return boolean 
     */
    function checkusername($username, $table) {
        global $admin_username;
        global $admin_password;
        $link = $this->connect($admin_username, $admin_password);
        $str = "SELECT * FROM " . $table . " WHERE username = '" . $username . "'";
        mysqli_query($link, $str);
        $count = mysqli_affected_rows($link);
        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Accepts the fieldnames as an array, the table name and the data type int, varchar(x)
     * @param type $array (associative array)
     * @param type $table (string)
     * @param type $types (string)
     * @return type (boolean)
     */
    function createTable($array, $table, $types) {
        global $admin_username;
        global $admin_password;
        $counter=0;
        $link = $this->connect($admin_username, $admin_password);
        $initial = "CREATE TABLE IF NOT EXISTS " . $table . " (id INT NOT NULL AUTO_INCREMENT,PRIMARY KEY(id) ";
        foreach ($array as $key => $value) {
            if (strcmp($key, 'confirmpassword') == 0) {
                continue;
            }
            if(strcmp("username",$key)==0||strcmp("email",$key)==0){
              $counter++;  
            }
            $initial.=(", " . $key . $types);
            
        }
        $initial.=", date DATE NOT NULL, time TIME NOT NULL";
        if($counter==1 &&  strcmp($table, "saleupdate")!=0){
        $initial.=", UNIQUE KEY username (username)";    
        }
        if($counter==2&&  strcmp($table, "saleupdate")!=0){
        $initial.= ", UNIQUE KEY username (username), UNIQUE KEY email (email)";    
        }
        $initial.=")";
      //  echo $initial;
        $insert = mysqli_query($link, $initial) or die(mysqli_error($link));
        return $insert;
    }
    /**
     *Gets user detail by first checking if the username exists in database
     * @global string $admin_username
     * @global string $admin_password
     * @param type $username (string)
     * @param type $table (string)
     * @return type Null if user doest exist and array if user exists
     */
    function getUserDetail($username,$table){
        global $admin_username;
        global $admin_password;
        $link = $this->connect($admin_username, $admin_password);
        $usercheck=$this->checkusername($username, $table);
         $str = "SELECT * FROM " . $table . " WHERE username = '" . $username . "'";
         $userdetail=null;
        if(!$usercheck){
          $userdetail=mysqli_query($link, $str);  
        }
        return $userdetail;
        
        //$count = mysqli_affected_rows($link);
    }
}
?>
