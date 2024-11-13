<?php
	session_start();
	if ( ( !isset($_SESSION['logged-in'])) && ($_SESSION['logged-in']==false) ){
		header('Location: index.php');
    exit();
	}
  if ( isset($_POST['datePeriod']) ) { //&& isset($_POST['operationStartDate']) && isset($_POST['operationEndDate']) ) { 
    $_SESSION['temporaryDatePeriod'] = $_POST['datePeriod'];
    $_SESSION['temporaryStartDate'] = $_POST['operationStartDate'];
    $_SESSION['temporaryEndDate'] = $_POST['operationEndDate'];
  } else {
    $currentDate = new DateTime();
    $firstDayOfCurrentMonth = date('Y-m-01');
    $_SESSION['temporaryStartDate'] = $firstDayOfCurrentMonth; 
    $_SESSION['temporaryEndDate'] = $currentDate->format('Y-m-d');
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
    <section class="p-4 px-sm-3 px-lg-5 px-0">
      <div class="text-center">
          <h2 class="p-2">Balance</h2>
      </div>
      <form method="POST">
        <div class="d-flex flex-md-row flex-column justify-content-center px-3 mb-3">
          <div class="px-2">
              <div class="form-floating mb-md-0 mb-3">
                <select class="form-control rounded-3" name="datePeriod" id="floatingDatePeriod" onchange="dateFilter()">
                  <option value="1">Current Month</option>
                  <option value="2">Previous Month</option>
                  <option value="3">Last Three Months</option>
                  <option value="4">Custom Period</option>
                </select>
                <label for="floatingDatePeriod">Period</label>
              </div>
          </div>
          <div class="px-2">
            <!--  Starting date  -->
            <div class="form-floating mb-md-0 mb-3">
              <input type="date" name="operationStartDate" class="form-control rounded-3" id="floatingStartDate" onclick="periodSelectorChange(4)" value="<?php
                if (isset($_SESSION['temporaryStartDate'])){
                echo $_SESSION['temporaryStartDate'];
              }
                ?>">
              <label for="floatingStartDate">Starting Date</label>
            </div>
          </div>
          <div class="px-2">
            <!--  Ending date  -->
            <div class="form-floating mb-md-0 mb-3">
              <input type="date" name="operationEndDate" class="form-control rounded-3" id="floatingEndDate" onclick="periodSelectorChange(4)" value="<?php
                if (isset($_SESSION['temporaryEndDate'])){
                echo $_SESSION['temporaryEndDate'];
              }
                ?>">
              <label for="floatingEndDate">Ending Date</label>
            </div>
          </div>
          <!--  Button date  -->
          <div class="px-2 d-flex align-items-center justify-content-center">
            <button id="filterButton" class="btn btn-secondary px-4" type="submit">Filter</button>
          </div>
        </div>  
      </form>
      <div class="row justify-content-around align-items-start">
        <!-- Income  -->
        <div class="col-md-6 ps-5">
          <h2 class="text-center">Incomes</h2>
          <?php
            require_once "connect.php";
            mysqli_report(MYSQLI_REPORT_OFF);
            try {
              $connection = new mysqli($host, $db_user, $db_password, $db_name);
              if ($connection->connect_errno!=0) {
                throw new Exception(mysqli_connect_errno());
              } else {
                $userid = $_SESSION['userid'];
                $startDate = $_SESSION['temporaryStartDate'];
                $endDate = $_SESSION['temporaryEndDate'];

                $result = $connection->query("SELECT incomes_category_assigned_to_users.name, incomes.amount
                                              FROM incomes_category_assigned_to_users, incomes
                                              WHERE incomes_category_assigned_to_users.user_id='$userid'
                                              AND incomes_category_assigned_to_users.id = incomes.income_category_assigned_to_user_id
                                              AND incomes_category_assigned_to_users.user_id = incomes.user_id
                                              AND '$startDate' <= incomes.date_of_income
                                              AND '$endDate' >= incomes.date_of_income
                                              GROUP BY incomes_category_assigned_to_users.id
                                              ORDER BY incomes.amount DESC");
                if (!$result) {
                  throw new Exception($connection->error);
                }
                echo '<div class="container form-floating mb-3"><ol>';
                while($row = mysqli_fetch_array($result))  {
                  echo '<li><div class="row px-2">
                          <div class="col">'.$row['name'].'</div>
                          <div class="col text-end">'.$row['amount'].'</div>
                        </div></li>';
                } 
                echo "</ol></div>";
                $result->free_result();
              } 
            } catch (Exception $error){
              $_SESSION['balanceError'] = "Server is not responding! Please try again later.";
            }
            $connection->close();
          ?>
        </div>
        <!-- Expense  -->
        <div class="col-md-6 ps-5">
          <h2 class="text-center">Expense</h2>
          <?php
            require_once "connect.php";
            mysqli_report(MYSQLI_REPORT_OFF);
            try {
              $connection = new mysqli($host, $db_user, $db_password, $db_name);
              if ($connection->connect_errno!=0) {
                throw new Exception(mysqli_connect_errno());
              } else {
                $userid = $_SESSION['userid'];
                $startDate = $_SESSION['temporaryStartDate'];
                $endDate = $_SESSION['temporaryEndDate'];
                $result = $connection->query("SELECT expenses_category_assigned_to_users.name, expenses.amount
                                              FROM expenses_category_assigned_to_users, expenses
                                              WHERE expenses_category_assigned_to_users.user_id='$userid'
                                              AND expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id 
                                              AND expenses_category_assigned_to_users.user_id = expenses.user_id
                                              AND '$startDate' <= expenses.date_of_expense
                                              AND '$endDate' >= expenses.date_of_expense
                                              GROUP BY expenses_category_assigned_to_users.id
                                              ORDER BY expenses.amount DESC");
                if (!$result) {
                  throw new Exception($connection->error);
                }
                echo '<div class="container form-floating mb-3"><ol>';
                echo '<script>xValues = new Array()</script>';
                echo '<script>yValues = new Array()</script>';
                echo '<script>barColors = new Array()</script>';
                echo '<script>
                        function getRandomColor() {
                          var letters = "0123456789ABCDEF";
                          var color = "#";
                          for (var i = 0; i < 6; i++) {
                            color += letters[Math.floor(Math.random() * 16)];
                          }
                          return color;
                        }
                      </script>';
                while($row = mysqli_fetch_array($result))  {
                  echo '<li><div class="row px-2">
                          <div class="col">'.$row['name'].'</div>
                          <div class="col text-end">'.$row['amount'].'</div>
                        </div></li>';
                  echo '<script>xValues.push("'.$row['name'].'")</script>';
                  echo '<script>yValues.push("'.$row['amount'].'")</script>';
                  echo '<script>barColors.push(getRandomColor())</script>';
                } 
                echo "</ol></div>";
                $result->free_result();
              } 
            } catch (Exception $error){
              $_SESSION['balanceError'] = "Server is not responding! Please try again later.";
            }
            $connection->close();
          ?>
        </div>
      </div>
      <!-- Error Div -->
      <div class="text-center">
        <?php
        if (isset($_SESSION['balanceError'])) {
          echo '<svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="red" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
          <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
          <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/></svg>';
          echo '<span class="p-3">'.$_SESSION['balanceError'].'</span><br/><br/>';
          unset($_SESSION['balanceError']);
        } 
        ?>
      </div>
      <!-- Chart -->
      <div class="col-md-12 text-center">
        <div class="d-flex flex-row justify-content-center">
          <canvas id="myChart" class="text-center" style="width:100%;max-width:800px;"></canvas>
        </div>
      </div>
    </section>
    <hr>
    <!--  Second section-->
    <section class="p-5 px-sm-5 px-0">
      <div class="row justify-content-center align-items-start">
        <div class="text-center">
          <h2 class="p-2">Summary</h2>
        </div>
        <div class="col-md-5 ps-5">
          <h2 class="p-2">Incomes:</h2>
          <!--Incomes-->
          <?php
            require_once "connect.php";
            mysqli_report(MYSQLI_REPORT_OFF);
            try {
              $connection = new mysqli($host, $db_user, $db_password, $db_name);
              if ($connection->connect_errno!=0) {
                throw new Exception(mysqli_connect_errno());
              } else {
                $userid = $_SESSION['userid'];
                $startDate = $_SESSION['temporaryStartDate'];
                $endDate = $_SESSION['temporaryEndDate'];

                $result = $connection->query("SELECT * FROM incomes WHERE user_id='$userid' AND '$startDate' <= date_of_income AND '$endDate' >= date_of_income");
                if (!$result) {
                  throw new Exception($connection->error);
                }
                echo '<div class="container form-floating mb-3"><ol>';
                while($row = mysqli_fetch_array($result))  {
                  echo '<li><div class="row">
                          <div class="col">'.$row['income_comment'].'</div>
                          <div class="col">'.$row['date_of_income'].'</div>
                          <div class="col text-end">'.$row['amount'].'</div>
                        </div></li>';
                } 
                echo "</ol>";
                $result = $connection->query("SELECT SUM(amount) FROM incomes WHERE user_id='$userid' AND '$startDate' <= date_of_income AND '$endDate' >= date_of_income");
                if (!$result) {
                  throw new Exception($connection->error);
                }
                $row = mysqli_fetch_array($result);
                $totalAmmount = $row['SUM(amount)'];
                echo '<div class="text-center">In total: '.$totalAmmount.'</div>';
                echo "</div>";
                $result->free_result();
              } 
            } catch (Exception $error){
              $_SESSION['incomeError'] = "Server is not responding! Please try again later.";
            }
            $connection->close();
          ?>
          <!-- Income Error -->
          <div class="text-center">
            <?php
            if (isset($_SESSION['incomeError'])) {
              echo '<svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="red" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
              <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
              <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/></svg>';
              echo '<span class="p-3">'.$_SESSION['incomeError'].'</span><br/><br/>';
              unset($_SESSION['incomeError']);
            } 
            ?>
          </div>
        </div>
        <div class="col-md-5 ps-5">
          <h2 class="p-2">Expenses:</h2>
          <!--Expense-->
          <?php
            require_once "connect.php";
            mysqli_report(MYSQLI_REPORT_OFF);
            try {
              $connection = new mysqli($host, $db_user, $db_password, $db_name);
              if ($connection->connect_errno!=0) {
                throw new Exception(mysqli_connect_errno());
              } else {
                $userid = $_SESSION['userid'];
                $startDate = $_SESSION['temporaryStartDate'];
                $endDate = $_SESSION['temporaryEndDate'];
                $result = $connection->query("SELECT * FROM expenses WHERE user_id='$userid' AND '$startDate' <= date_of_expense AND '$endDate' >= date_of_expense");
                if (!$result) {
                  throw new Exception($connection->error);
                }
                echo '<div class="container form-floating mb-3"><ol>';
                while($row = mysqli_fetch_array($result))  {
                  echo '<li><div class="row">
                          <div class="col">'.$row['expense_comment'].'</div>
                          <div class="col">'.$row['date_of_expense'].'</div>
                          <div class="col text-end">'.$row['amount'].'</div>
                        </div></li>';
                } 
                echo "</ol>";
                $result = $connection->query("SELECT SUM(amount) FROM expenses WHERE user_id='$userid' AND '$startDate' <= date_of_expense AND '$endDate' >= date_of_expense");
                if (!$result) {
                  throw new Exception($connection->error);
                }
                $row = mysqli_fetch_array($result);
                $totalAmmount = $row['SUM(amount)'];
                echo '<div class="text-center">In total: '.$totalAmmount.'</div>';
                echo "</div>";
                $result->free_result();
              } 
            } catch (Exception $error){
              $_SESSION['incomeError'] = "Server is not responding! Please try again later.";
            }
            $connection->close();
          ?>
          <!-- Expense Error -->
          <div class="text-center">
            <?php
            if (isset($_SESSION['incomeError'])) {
              echo '<svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="red" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
              <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
              <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/></svg>';
              echo '<span class="p-3">'.$_SESSION['incomeError'].'</span><br/><br/>';
              unset($_SESSION['incomeError']);
            } 
            ?>
          </div>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="index.js"></script>
  <?php
    if (isset($_SESSION['temporaryDatePeriod'])){
      echo '<script>periodSelectorChange('.$_POST['datePeriod'].')</script>';
      unset($_SESSION['temporaryDatePeriod']);
    } 
    if (isset($_SESSION['temporaryStartDate'])){
      unset($_SESSION['temporaryStartDate']);
    }
    if (isset($_SESSION['temporaryEndDate'])){
      unset($_SESSION['temporaryEndDate']);
    }
  ?>
</body>

</html>