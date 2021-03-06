<?php
// Initialize the session
session_start();




include_once 'includes/CDNs.php';
$servername = "localhost";
$username = "student_user";
$password = "";
$db_name = "Student_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST["submit"])) {
    $name = $_POST["contact_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone_no"];
    $message = $_POST["message"];

    $sql = ("INSERT INTO contact(contact_name, email, phone_no, message) VALUES ('$name', '$email', '$phone', '$message')");
    if (mysqli_query($conn, $sql)) {
        echo "<script language = javascript>
                  thankYou();
              </script>";
    } else {
        echo "Failed";
    }
}
?>

<!DOCTYPE html>
<html>

<head>


    <meta charset="UTF-8">
    <title>Contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/recipeasy-icons-logos/small-logo.png">
    <?php include_once 'includes/CDNs.php'; ?>

    <link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />



</head>

<body class='site'>
    <?php include_once 'includes/nav-menu.php'; ?>

    <main class='site-content'>
        <div class="container">



            <div data-aos="fade-in" data-aos-once="true" data-aos-duration="1000">
                <h1 class="contact-heading"><span class="underline"> Contact Us </span></h1>
                <p> Have a question or query? Contact us below and a member of our team will get back to you shortly!</p>
            </div>
            <br>
            <br>
            <div class="row">

                <div data-aos="fade-right" data-aos-once="true" data-aos-duration="1000" class="col-md-5">

                    <form id="contact-form" method="post" action="">
                        <br>
                        <br>
                        <div class="form-group">
                            <label>Name :</label>
                            <input type="text" class="form-control input-form" name="contact_name" placeholder="">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Email :</label>
                            <input type="email" class="form-control" name="email" placeholder="">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Phone :</label>
                            <input type="text" class="form-control" name="phone_no" placeholder="">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Message :</label>
                            <textarea class="form-control" name="message" rows="3" placeholder=""></textarea>
                        </div>


                        <button class="btn btn-light" name="submit" type="submit">Send</button>

                    </form>
                </div>



                <div data-aos="fade-left" data-aos-once="true" data-aos-duration="1000" class="col-md-7 contact-page-right-col ">

                    <p> <i class="fas fa-phone"></i> +353 87 3514 621</p>
                    <p> <i class="fas fa-envelope"></i> recipeasye@info.com</p>

                    <div style="width: 100%"><iframe width="100%" height="400" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9609.44323479979!2d-6.041754760434871!3d52.9779120986533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4867b732a3ac6d6b%3A0x1e1c0bc39de7e2d4!2sCorporation+Lands%2C+Wicklow!5e0!3m2!1sen!2sie!4v1541498160699" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                            <a href="https://www.maps.ie/create-google-map/">Google map generator</a></iframe></div><br />
                </div>



            </div>
        </div>

    </main>

    <?php include_once 'includes/footer.php'; ?>






</body>

</html>