<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
</head>

<body>

    <?php

    include 'login_credentials.php';
    //  ini_set('display_errors',1);
    //  ini_set('display_startup_errors',1);
    //  error_reporting(E_ALL);

    $fname = $_REQUEST['First_Name'];
    // echo "$fname<br/>";
    $lname = $_REQUEST['Last_Name'];
    // echo "$lname<br/>";
    $addr = $_REQUEST['address'];
    // echo "$addr<br/>";
    $email = $_REQUEST['email'];
    // echo "$email<br/>";
    $phn = $_REQUEST['Phone'];
    // echo "$phn<br/>";
    $gndr = $_REQUEST['Gender'];
    // echo "$gndr<br/>";
    $dob = $_REQUEST['dob'];
    // echo "$dob<br/>";
    $lng = $_REQUEST['Language'];
    foreach ($lng as $selected)
        // echo "$selected<br/>";
        $cnt = $_REQUEST['Country'];
    // echo "$cnt<br/>";
    $fl = $_REQUEST['File'];
    // $fl=$_FILES['File']['name'];
    echo "$fl<br/>";
    $pswd = md5($_REQUEST['password']);
    // echo "$pswd<br/>";
    $cnfpswd = md5($_REQUEST['confirmPassword']);
    // echo "$cnfpswd<br/>";

    echo "<br/>";

    // $selectedLng = implode(' ',$lng);
    $datecreated = date('Y-m-d');


    $currentDirectory = getcwd();
    $uploadDirectory = "/uploads/";

    $fileName = $_FILES['File']['name'];
    $fileTmpName  = $_FILES['File']['tmp_name'];
    $fileExtension = strtolower(end(explode('.', $fileName)));

    $newFileName = rand() . time() . '.' . $fileExtension;

    $uploadPath = $currentDirectory . $uploadDirectory .  $newFileName;

    // $files = glob('uploads/*');
    // foreach($files as $f)
    // {
    //   if(is_file($f))
    //   {
    //     unlink($f);
    //   }
    // }

    if (isset($_POST['Submit'])) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
    }

    if (isset($_POST['Submit'])) {
        // Create connection
        $conn = new mysqli($hostname, $username, $password, 'adarsh');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";
        $sql = "INSERT INTO customer(`created_on_date`,`modified_on_date`,`first_name`, `last_name`, `address`, `email`, `phone`, `gender`, `date_of_birth`, `language`, `country`, `file_name`, `password`) 
          VALUES ('$datecreated','$datecreated','$fname','$lname','$addr','$email','$phn','$gndr','$dob','$selectedLng','$cnt','$newFileName','$pswd')";

        if ($conn->query($sql) === TRUE) {
            echo "record inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        header("Location:http://10.10.10.17/listings.php#");
    }

    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/validationUsingJquery.js"></script>
    <form name="applicationForm" id="applicationForm" method="post" enctype="multipart/form-data" action="">
        <table border="2" bordercolor="orange" align="center">
            <th colspan="2">Application Form</th>
            <tr>
                <td align="middle">First_Name</td>
                <td>
                    <input type="text" name="First_Name" id="First_Name" value="" />
                    <br />
                    <span id="SFirst_Name"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Last_Name</td>
                <td>
                    <input type="text" name="Last_Name" id="Last_Name" value="" />
                    <br />
                    <span id="SLast_Name"></span>
                </td>
            </tr>
            <tr>
                <td align="middle" valign="top">Address</td>
                <td>
                    <textarea name="address" id="address"></textarea>
                    <br />
                    <span id="SAddress"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Email</td>
                <td>
                    <input type="email" name="email" id="email" value="" />
                    <br />
                    <span id="SEmail"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Phone</td>
                <td>
                    <input type="text" name="Phone" id="Phone" value="" />
                    <br />
                    <span id="SPhone"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Gender</td>
                <td>
                    <input type="radio" name="Gender" class="Gender" value="Male" />Male
                    <input type="radio" name="Gender" class="Gender" value="Female" />Female
                    <br />
                    <span id="SGender"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Date of Birth</td>
                <td>
                    <input type="date" id="dob" name="dob" />
                    <br />
                    <span id="SDob"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Language</td>
                <td>
                    <input type="checkbox" name="Language[]" class="Language" value="English" />English
                    <input type="checkbox" name="Language[]" class="Language" value="Hindi" />Hindi
                    <input type="checkbox" name="Language[]" class="Language" value="Bengali" />Bengali
                    <br />
                    <span id="SLanguage"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Country</td>
                <td>
                    <select name="Country">
                        <option id="Country" select="selected">--Select--</option>
                        <?php
                        $country_list = array("japan", "india", "nepal", "china", "usa", "canada", "Russia");

                        foreach ($country_list as $item) {
                            echo "<option value=$item>$item</option>";
                        }
                        ?>
                    </select>
                    <br />
                    <span id="SCountry"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">File</td>
                <td>
                    <input type="file" name="File" id="File" value="" />
                    <br />
                    <span id="SFile"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Password</td>
                <td>
                    <input type="password" name="password" id="password" value="" />
                    <br />
                    <span id="SPassword"></span>
                </td>
            </tr>
            <tr>
                <td align="middle">Confirm Password</td>
                <td>
                    <input type="password" name="confirmPassword" id="confirmPassword" value="" />
                    <br />
                    <span id="SConfirmpassword"></span>
                </td>
            </tr>
            <th colspan="2">
                <a href="listings.php"><button type="button">back</button></a>
                <input type="submit" name="Submit" id="submit" value="Submit" />
                <input type="button" name="Reset" id="reset" value="Reset" />
            </th>
        </table>
    </form>
</body>

</html>