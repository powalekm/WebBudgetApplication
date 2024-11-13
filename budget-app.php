<?php
	session_start();
	if ( ( !isset($_SESSION['logged-in'])) && ($_SESSION['logged-in']==false) ){
		header('Location: index.php');
    exit();
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
    <section class="main-section">
      <div class="main-section-bg-image">
        <div class="d-flex flex-column justify-content-center height-100">
          <div id="header" class="px-5 py-4 ">
            <h1 class="pb-4">Control your expenses!</h1>
            <p class="lead">Start tracking your budget and control your financial flow with great balance!</p>
            <a type="button" class="btn btn-lg btn-outline-success" href="./register.php">Create your account today!</a>
          </div>
        </div>
    </section>

    <!--  Second section-->
    <section class="p-5 px-sm-5">
      <div class="row justify-content-center align-items-center px-sm-5 py-sm-5">
        <div class="col-lg-6 order-lg-2 ps-lg-5 pb-4 pb-lg-0">
          <h2 class="pb-3">Saving for the future</h2>
          <p class="lead">Controlling your spending is an essential part of saving. Without proper money management in
            terms of spending, you can't effectively save large amounts.</p>
          <p class="lead">You can't talk about effective saving without addressing the topic of effectively monitoring
            all your expenses on a monthly or annual basis.</p>
          <p class="lead">Start thinking about <span class="text-highlighted">your future now!</span></p>
        </div>
        <div class="col-lg-6 order-lg-1 text-center">
          <img class="section-img img-fluid rounded" alt="Jar with pennies" src="./images/Save.jpg">
        </div>
      </div>
    </section>

    <!--  Third section-->
    <section class="bg-light p-5 px-sm-5 border">
      <div class="row justify-content-center align-items-center px-sm-5 py-sm-5">
        <div class="col-lg-6 order-lg-1 pe-lg-5 pb-4 pb-lg-0">
          <h2 class="pb-3">Financial planning</h2>
          <p class="lead">It's important to know how to properly control your spending in order to effectively
            accumulate funds for private and business investments.</p>
          <p class="lead">By planning your own budget, it will be much easier realize your financial plans related to
            make <span class="text-highlighted">your dreams!</span></p>
        </div>
        <div class="col-lg-6 order-lg-2 text-center">
          <img class="section-img img-fluid rounded" alt="Happy woman in journey" src="./images/Traveling.jpg">
        </div>
      </div>
    </section>

    <!--  Forth section-->
    <section class="p-5 px-sm-5">
      <div class="row justify-content-center align-items-center px-sm-5 py-sm-5">
        <div class="col-lg-6 order-lg-2 ps-lg-5 pb-4 pb-lg-0">
          <h2 class="pb-3">Monitoring your progress</h2>
          <p class="lead">Regular analysis of expenses allows you to track whether savings or cost control activities
            are bringing results.</p>
          <p class="lead">Are you ready to start your Journey with <span class="text-highlighted">expense
              analysis?</span></p>
        </div>
        <div class="col-lg-6 order-lg-1 text-center">
          <img class="section-img img-fluid rounded" alt="Luggage on the platform before the journey"
            src="./images/Traveling2.jpg">
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

<?php
	if(isset($_SESSION['Error']))	echo $_SESSION['Error'];
?>

</body>
</html>