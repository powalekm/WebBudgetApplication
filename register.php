<?php
	session_start();

	if ((isset($_SESSION['logged-in'])) && ($_SESSION['logged-in']==true)){
		header('Location: budget-app.php');
		exit();
	}

  if ( isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['password']) )	{
		$registrationVerification = true;

    $name = $_POST['name'];
    if ( (strlen($name) < 3) || (strlen($name) > 20) ){
      $registrationVerification = false;
      $_SESSION['registrationError'] = "Name cannot be shorter than 3 characters and longer than 20!";
    }
    else if (!ctype_alnum($name)) {
      $registrationVerification = false;
      $_SESSION['registrationError'] = "Name contain incorrect characters!";
    }

    $surname = $_POST['surname'];
    if ( (strlen($surname) < 3) || (strlen($surname) > 20) ){
      $registrationVerification = false;
      $_SESSION['registrationError'] = "Surname cannot be shorter than 3 characters and longer than 20!";
    }
    else if (!ctype_alnum($surname)) {
      $registrationVerification = false;
      $_SESSION['registrationError'] = "Surname contain incorrect characters!";
    }

    $email = $_POST['email'];
    $emailFilter = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ( filter_var($emailFilter, FILTER_VALIDATE_EMAIL) == false || ($emailFilter != $email ) ){
      $registrationVerification = false;
      $_SESSION['registrationError'] = "Email is incorrect!";
    }

    $password = $_POST['password'];
    if ( (strlen($password) < 6) || (strlen($password) > 20) ){
      $registrationVerification = false;
      $_SESSION['registrationError'] = "Password cannot be shorter than 6 characters and longer than 20!";
    } else {
      $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
    }
    
    if ( !isset($_POST['terms-of-service']) ) {
      $registrationVerification = false;
      $_SESSION['registrationError'] = "Accept the Terms of service is required!";
    }
    
    $secretCode = "6LdoznAcAAAAAJbNVksSBl9RQNb-HE_QTzwlCIWN";
    $reCaptchaVerficication = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretCode.'&response='.$_POST['g-recaptcha-response']);
    $captchaRespond = json_decode($reCaptchaVerficication);
    if ( !($captchaRespond->success) ){
      $registrationVerification = false;
      $_SESSION['registrationError'] = "Check reCAPTCHA!";
     }

    $_SESSION['temporaryName'] = $name;
    $_SESSION['temporarySurname'] = $surname;
    $_SESSION['temporaryEmail'] = $email;
    $_SESSION['temporaryPassword'] = $password;
    if (isset($_POST['terms-of-service'])){
      $_SESSION['temporaryTermsOfService'] = true;
    }

    if ($registrationVerification == true){
      require_once "./connect.php";
        mysqli_report(MYSQLI_REPORT_OFF);
      try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno!=0) {
          throw new Exception(mysqli_connect_errno());
        } else {
          $result = @$connection->query("SELECT userid FROM users WHERE email='$email'");
          if (!$result) {
            throw new Exception($connection->error);
          }
          $fetchUsers = $result->num_rows;
          if($fetchUsers!=0){
            $registrationVerification = false;
            $_SESSION['registrationError'] ="Account for this email already exists!";
          }
        }
      } catch (Exception $error){
        $registrationVerification = false;
        $_SESSION['registrationError'] = "Server is not responding! Please try again later.";
        echo "<br/> Dev comment: ".$error;
      }
      if ($registrationVerification == true){
        if( $connection->query("INSERT INTO users VALUES (NULL, '$email', '$passwordHashed', '$name','$surname')")) {
          unset($_SESSION['temporaryName']);
          unset($_SESSION['temporarySurname']);
          unset($_SESSION['temporaryEmail']);
          unset($_SESSION['temporaryPassword']);
          unset($_SESSION['temporaryTermsOfService']);
          $_SESSION['registrationCorrect'] = "The Account has been created correctly!";
        } else {
          throw new Exception($connection->error);
        }
      }
      $connection->close();
    }
	}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="./style.css">
  <title>Budget Tracking Application</title>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
  <!--  Navbar -->
  <header>
   <nav class="navbar navbar-expand-lg bg-light border-bottom">
      <div class="container-fluid">
        <a class="navbar-brand ps-4 py-2" href="./index.php">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" onclick="buttonAnimation()">
          <div id="nav-line-1"></div>
          <div id="nav-line-2"></div>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link ps-4 py-2" href="./login.php">Sign In</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ps-4 py-2" href="./register.php">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <!--  First section-->
    <section class="p-5 px-sm-5">
      <div class="row justify-content-center align-items-center px-sm-5">
        <div class="col-lg-6 p-3 order-lg-2">
        <form method="POST">
            <h2 class="p-2">Registration Form</h2>
            <div class="form-floating mb-3">
              <input type="text" name="name" class="form-control rounded-3" id="floatingName" placeholder="Name" value="<?php
                if (isset($_SESSION['temporaryName'])){
                  echo $_SESSION['temporaryName'];
                  unset($_SESSION['temporaryName']);
                }
                ?>">
              <label for="floatingName">Name</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" name="surname" class="form-control rounded-3" id="floatingSurname" placeholder="Surname" value="<?php
                  if (isset($_SESSION['temporarySurname'])){
                    echo $_SESSION['temporarySurname'];
                    unset($_SESSION['temporarySurname']);
                  }
                ?>">
              <label for="floatingSurname">Surname</label>
            </div>
            <div class="form-floating mb-3">
              <input type="email" name="email" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com" value="<?php
                  if (isset($_SESSION['temporaryEmail'])){
                    echo $_SESSION['temporaryEmail'];
                    unset($_SESSION['temporaryEmail']);
                  }
                ?>">
              <label for="floatingInput">Email address</label>
            </div>
            <div class="d-flex mb-3">
              <div class="col form-floating z-index-1">
                <input type="password" name="password" class="form-control rounded-left" id="password" placeholder="Password" value="<?php
                  if (isset($_SESSION['temporaryPassword'])){
                    echo $_SESSION['temporaryPassword'];
                    unset($_SESSION['temporaryPassword']);
                  }
                ?>">
                <label for="password">Password</label>
              </div>
              <div class="col-3 col-sm-2 form-floating" onclick="password_show_hide();">
                <span class="input-group-text rounded-right justify-content-center">
                  <i class="" id="show_eye"><img class="icon-eye" src="./icons/eye-slash.svg" alt="Icon of the eye slashed"></i>
                  <i class="d-none" id="hide_eye"><img class="icon-eye" src="./icons/eye.svg" alt="Icon of the eye"></i>
                </span>
              </div>
            </div>
            <div class="g-recaptcha d-flex justify-content-center mb-3" data-sitekey="6LdoznAcAAAAAI8J_grRXmxNHdJ6S23Ex049Oyx0"></div>
            <div class="form-check d-flex justify-content-center mb-4">
              <input class="form-check-input me-2" type="checkbox" name="terms-of-service" id="checkbox" <?php 
                if (isset($_SESSION['temporaryTermsOfService'])){
                  echo "checked";
                  unset($_SESSION['temporaryTermsOfService']);
                }?>/>
              <label class="form-check-label" for="checkbox">
                I agree all statements in <a href="./terms-of-service.html">Terms of service</a>
              </label>
            </div>
            <button class="w-100 mb-4 btn btn-lg rounded-3 btn-primary" type="submit">Register</button>

            <div class="py-3 text-center">
                <?php
                if (isset($_SESSION['registrationError'])) {
                  echo '<svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="red" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                  <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                  <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/></svg>';
                  echo '<span class="p-3">'.$_SESSION['registrationError'].'</span>';
                  unset($_SESSION['registrationError']);
                } 
                if (isset($_SESSION['registrationCorrect'])) {
                  echo '<svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="green" class="bi bi-person-check" viewBox="0 0 16 16">
                  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                  <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                  </svg>';
                  echo '<span class="p-3">'.$_SESSION['registrationCorrect'].'</span>';
                  unset($_SESSION['registrationCorrect']);
                }
                ?>
            </div>

            <!--  <span class="hr-text mb-4 ">or</span>
            <button class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="submit">
              <img class="icon pe-2" src="./icons/icons8-gmail.svg" alt="Gmail icon">
              <use xlink:href="#gmail"></use>Register with Gmail
            </button>
            <button class="w-100 py-2 mb-0 btn btn-outline-primary rounded-3" type="submit">
              <img class="icon pe-2" src="./icons/icons8-facebook.svg" alt="Facebook icon">
              <use xlink:href="#facebook"></use>Register up with Facebook
            </button>-->
          </form>
        </div>
        <div class="d-none d-lg-block col-lg-6 text-center p-3 order-lg-1">
          <img class="section-img img-fluid rounded" alt="Happy woman in journey" src="./images/Expense.jpeg">
        </div>
      </div>
    </section>
  </main>

  <!--  Footer-->
  <footer class="bg-light py-3 border">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="./index.html" class="nav-link px-2 text-body-secondary">Home</a></li>
      <li class="nav-item"><a href="./about.html" class="nav-link px-2 text-body-secondary">About</a></li>
      <li class="nav-item"><a href="./contact.html" class="nav-link px-2 text-body-secondary">Contact</a></li>
    </ul>
    <p class="text-center text-body-secondary">Copyright 2024 © Budget Tracking Application.</p>
  </footer>

  <!-- JavaScript -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="index.js"></script>
</body>
</html>