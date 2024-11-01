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
    <section class="p-5 px-sm-5">
      <div class="row justify-content-center align-items-center px-sm-5">
        <div class="col-lg-6 p-3">
          <form>
            <h2 class="p-2">Add expense</h2>
            <div class="form-floating mb-3">
              <input type="text" class="form-control rounded-3" id="floatingName" placeholder="Name of expense">
              <label for="floatingName">Name of expense</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control rounded-3" id="floatingDescription" placeholder="Description">
              <label for="floatingDescription">Description</label>
            </div>
            <div class="form-floating mb-3">
              <input type="number" class="form-control rounded-3" id="floatingValue" placeholder="Value">
              <label for="floatingValue">Value</label>
            </div>
            <div class="form-floating mb-3">
              <select class="form-control" id="floatingType">
                <option>Food costs</option>
                <option>Credits, rental, subscription</option>
                <option>Health, hygiene and cleaning products</option>
                <option>Clothes</option>
                <option>Transport</option>
                <option>Relaxation and hobbies</option>
                <option>Others</option>
              </select>
              <label for="floatingType">Type of expense</label>
            </div>
            <div class="form-floating mb-3">
              <input type="date" class="form-control rounded-3" id="floatingDate" value="<?php
                $currentDate = new DateTime();
                echo $currentDate->format('Y-m-d');
                ?>">
              <label for="floatingDate">Date</label>
            </div>
            <button class="w-100 mb-4 btn btn-lg rounded-3 btn-primary" type="submit">Submit</button>
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