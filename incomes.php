<?php
	session_start();
	if ( ( !isset($_SESSION['logged-in'])) && ($_SESSION['logged-in']==false) ){
		header('Location: index.php');
    exit();
  }

  if ( isset($_POST['operationName']) && isset($_POST['operationValue']) 
    && isset($_POST['operationCategory']) && isset($_POST['operationDate']) )	{
    $operationVerification = true;

    //operationValue verification
    $operationValue = $_POST['operationValue'];
    if ( $operationValue <= 0 ){
      $operationVerification = false;
      $_SESSION['operationError'] = "The value cannot be 0 or lower!";
    }

    //name verification
    $operationName = htmlentities($_POST['operationName'], ENT_QUOTES, "UTF-8");
    if ( (strlen($operationName) < 3) || (strlen($operationName) > 20) ){
      $operationVerification = false;
      $_SESSION['operationError'] = "Name cannot be shorter than 3 characters and longer than 20!";
    } 

    $_SESSION['temporaryOperationName'] = $_POST['operationName'];
    $_SESSION['temporaryOperationValue'] = $_POST['operationValue'];
    $_SESSION['temporaryOperationCategory'] = $_POST['operationCategory'];
    $_SESSION['temporaryOperationDate'] = $_POST['operationDate'];

    if ($operationVerification == true) {
      $operationCategory = $_POST['operationCategory'];
      $operationDate = $_POST['operationDate'];

      require_once "connect.php";
      mysqli_report(MYSQLI_REPORT_OFF);
      try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno!=0) {
          throw new Exception(mysqli_connect_errno());
        } else {
          $userid = $_SESSION['userid'];
          if( $connection->query("INSERT INTO incomes VALUES (NULL, '$userid', '$operationCategory', '$operationValue', '$operationDate', '$operationName')")) {
            unset($_SESSION['temporaryOperationName']);
            unset($_SESSION['temporaryOperationValue']);
            unset($_SESSION['temporaryOperationCategory']);
            unset($_SESSION['temporaryOperationDate']);
            $_SESSION['operationCorrect'] = "The income added correctly!";
          }
        }
      } catch (Exception $error){
          $_SESSION['operationError'] = "Server is not responding! Please try again later.";
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
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link ps-4 py-2" href="./incomes.php">Add Income</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ps-4 py-2" href="./expenses.php">Add Expense</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ps-4 py-2" href="./balance.php">Balance</a>
            </li>
          </ul>
          <div>
            <button type="button" class="btn px-4 py-2" id="btn-log-out">
              <a class="nav-link" id="log-out" href="./settings.php">Settings
                <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="currentColor" class="bi bi-gear ps-2" viewBox="0 0 16 16">
                  <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                  <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
                </svg>
              </a>
            </button>
            <button type="button" class="btn px-4 py-2" id="btn-log-out">
              <a class="nav-link" id="log-out" href="./logout.php">Logout</a>
            </button>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <!--  First section-->
    <section class="p-5 px-sm-5">
      <div class="row justify-content-center align-items-start px-sm-5">
        <div class="col-lg-6 p-3">
          <form method="POST">
            <h2 class="p-2">Add income</h2>
            <!-- Expense Name -->
            <div class="form-floating mb-3">
              <input type="text" name="operationName" class="form-control rounded-3" id="floatingName" placeholder="Name of income" value="<?php
                if (isset($_SESSION['temporaryOperationName'])){
                  echo $_SESSION['temporaryOperationName'];
                  unset($_SESSION['temporaryOperationName']);
                }
                ?>">
              <label for="floatingName">Name of income</label>
            </div>
            <!-- Expense Value -->
            <div class="form-floating mb-3">
              <input type="number" name="operationValue" class="form-control rounded-3" id="floatingValue" placeholder="Value" step=".01" value="<?php
                if (isset($_SESSION['temporaryOperationValue'])){
                  echo $_SESSION['temporaryOperationValue'];
                  unset($_SESSION['temporaryOperationValue']);
                }
                ?>">
              <label for="floatingValue">Value</label>
            </div>
            <!-- Income Type -->
            <div class="form-floating mb-3">
              <select class="form-control" name="operationCategory" id="floatingoOperationCategory">
                 <?php
                    require_once "connect.php";
                    mysqli_report(MYSQLI_REPORT_OFF);
                    try {
                      $connection = new mysqli($host, $db_user, $db_password, $db_name);
                      if ($connection->connect_errno!=0) {
                        throw new Exception(mysqli_connect_errno());
                      } else {
                        $userid = $_SESSION['userid'];
                        $result = @$connection->query("SELECT * FROM incomes_category_assigned_to_users WHERE user_id='$userid'");
                        if (!$result) {
                          throw new Exception($connection->error);
                        }
                        while($row = mysqli_fetch_array($result))  {
                          if (isset($_SESSION['temporaryOperationCategory']) && ($row['id'] == $_SESSION['temporaryOperationCategory']) ){
                            echo "<option selected value=".$row['id'].">".$row['name']."</option>";
                            unset($_SESSION['temporaryOperationCategory']);
                          } else {
                            echo "<option value=".$row['id'].">".$row['name']."</option>";
                          }
                        }
                        $result->free_result();
                      } 
                    } catch (Exception $error){
                      $_SESSION['categoryError'] = "Server is not responding! Please try again later.";
                    }
                    $connection->close();
                  ?>
              </select>
              <label for="floatingoOperationCategory">Type of income</label>
            </div>
            <!-- Category Error -->
            <div class="text-center">
                <?php
                if (isset($_SESSION['categoryError'])) {
                  echo '<svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="red" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                  <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                  <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/></svg>';
                  echo '<span class="p-3">'.$_SESSION['categoryError'].'</span><br/><br/>';
                  unset($_SESSION['categoryError']);
                } 
                ?>
            </div>
            <!-- Expense Date -->
            <div class="form-floating mb-3">
              <input type="date" name="operationDate" class="form-control rounded-3" id="floatingDate" value="<?php
               if (isset($_SESSION['temporaryOperationDate'])){
                echo $_SESSION['temporaryOperationDate'];
                unset($_SESSION['temporaryOperationDate']);
              } else {
                $currentDate = new DateTime();
                echo $currentDate->format('Y-m-d');
              }
                ?>">
              <label for="floatingDate">Date</label>
            </div>
            <button class="w-100 mb-4 btn btn-lg rounded-3 btn-primary" type="submit">Submit</button>

            <div class="py-3 text-center">
                <?php
                if (isset($_SESSION['operationError'])) {
                  echo '<svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="red" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                  <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                  <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/></svg>';
                  echo '<span class="p-3">'.$_SESSION['operationError'].'</span>';
                  unset($_SESSION['operationError']);
                } 
                if (isset($_SESSION['operationCorrect'])) {
                  echo '<svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="green" class="bi bi-check2-circle" viewBox="0 0 16 16">
                  <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                  <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                  </svg>';
                  echo '<span class="p-3">'.$_SESSION['operationCorrect'].'</span>';
                  unset($_SESSION['operationCorrect']);
                }
                ?>
            </div>
          </form>
        </div>
        <div class="d-none d-lg-block col-lg-6 text-center p-3">
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