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
                  <a class="nav-link ps-4 py-2" href="./expenses.php">Expenses</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link ps-4 py-2" href="./balance.php">Balance</a>
                </li>
              </ul>
              <button type="button" class="btn px-4 py-2" id="btn-log-out">
                <a class="nav-link" id="log-out" href="./logout.php">Logout</a>
              </button>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <!--  First section-->
    <section class="p-5 px-sm-5 px-0">
      <div class="row justify-content-center align-items-center">
        <div class="text-center">
          <h1 class="p-2">Balance</h2>
        </div>
        <div class="col-md-5 ps-5">
          <h2 class="p-2">Income:</h2>
          <ul class="">
            <li class="">Income1</li>
            <li class="">Income2</li>
            <li class="">Income3</li>
            <li class="">Income4</li>
          </ul>
          <p class="p-2">In total: 1000zł</p>
        </div>
        <div class="col-md-5 ps-5">
          <h2 class="p-2">Expenses:</h2>
          <ul class="">
            <li class="">Expense1</li>
            <li class="">Expense2</li>
            <li class="">Expense3</li>
            <li class="">Expense4</li>
          </ul>
          <p class="p-2">In total: 1000zł</p>
        </div>
        <div class="col-md-12 text-center">
          <div class="d-flex flex-row justify-content-center">
            <canvas id="myChart" class="text-center" style="width:100%;max-width:800px;"></canvas>
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

</body>

</html>