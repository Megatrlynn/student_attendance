<?php
include 'phpback/dbconn.php';
include 'phpback/sessionadmin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/style2.css" rel="stylesheet">
</head>

<body>

  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard.php" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">Dashboard</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/img1.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['username']; ?></span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6 style="text-align: left;"><?php echo $_SESSION['username']; ?></h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </nav>
  </header>
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Institution</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="view1.php">
              <i class="bi bi-circle"></i><span>View</span>
            </a>
          </li>
          <li>
            <a href="register1.php">
              <i class="bi bi-circle"></i><span>Register</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Lecturers</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="view2.php">
              <i class="bi bi-circle"></i><span>View</span>
            </a>
          </li>
          <li>
            <a href="register2.php">
              <i class="bi bi-circle"></i><span>Register</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Students</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="view3.php">
              <i class="bi bi-circle"></i><span>View</span>
            </a>
          </li>
          <li>
            <a href="register3.php">
              <i class="bi bi-circle"></i><span>Register</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Courses</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="view4.php">
              <i class="bi bi-circle"></i><span>View</span>
            </a>
          </li>
          <li>
            <a href="register4.php">
              <i class="bi bi-circle"></i><span>Register</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>

  </aside>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1 style="color: white; text-align: left;">Lecturer Update</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="view2.php">Lecturers</a></li>
          <li class="breadcrumb-item active">Edit data</li>
        </ol>
      </nav>
    </div>
    <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
      <?php
      include 'phpback/dbconn.php';
      include 'phpback/uplec.php';
      ?>
      <section class="container">
          <header style="font-size: 20px;">Update Lecturer</header>
          <form action="phpback/update_lecturer_process.php" class="form" method="POST">
              <input type="hidden" name="lecturer_id" value="<?php echo $lecturer['id']; ?>">
              <div class="input-box">
                  <label>Lecturer Name</label>
                  <input style="font-size: 15px;" type="text" name="name" value="<?php echo $lecturer['name']; ?>">
              </div>
              <div class="input-box">
                  <label for="institution">Institution</label>
                  <select name="institution_id" id="institution" required style="border: none; color: #707070; width: 100%; height: 50px; border: 1px solid #ddd; display: flex; border-radius: 6px;">
                      <option value="">Select an institution</option>
                      <?php
                      $stmt_inst = $pdo->query("SELECT id, name FROM institution");
                      while ($row = $stmt_inst->fetch(PDO::FETCH_ASSOC)) {
                          $id = $row['id'];
                          $name = $row['name'];
                          echo "<option value='$id'>$name</option>";
                      }
                      ?>
                  </select>
              </div>
              <div class="input-box">
                  <label>Phone Number</label>
                  <input style="font-size: 15px;" type="text" name="phone" value="<?php echo $lecturer['phone']; ?>">
              </div>
              <div class="input-box">
                  <label>Email Address</label>
                  <input style="font-size: 15px;" type="email" name="email" value="<?php echo $lecturer['email']; ?>" />
              </div>
              <div class="input-box">
                  <label>Lecturer username</label>
                  <input style="font-size: 15px;" type="text" name="username" value="<?php echo $user['username']; ?>" />
              </div>
              <div class="input-box">
                  <label>Lecturer password</label>
                  <input style="font-size: 15px;" type="password" name="password" value="<?php echo $user['password']; ?>" />
              </div>
              <center>
                <button style="font-size: 15px;" type="submit">Update</button>
                <button style="font-size: 15px;" class="button-59" onclick="goBack()"><span class="text">Revert</span><span>Load previous page</span></button>
              </center>
          </form>
      </section>
      </div>
      <div class="col-md-1">
      </div>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
  <script>
    function goBack() {
      window.history.back();
    }
  </script>
</body>

</html>