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
      <h1 style="color: white; text-align: left;">Student View</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">View</li>
        </ol>
      </nav>
    </div>
    <div class="row">
      <div class="col-md-12" id="maincont">
        <h1 style="color: white; margin-top: 5px; margin-bottom: -5px;">Available Students</h1>
        <div class="table-1" style="overflow: auto; max-width: 100%;">
          <?php
          include 'phpback/dbconn.php';
            $stmt = $pdo->query("SELECT * FROM students");
            $institutions = $stmt->fetchAll(PDO::FETCH_ASSOC);
          ?>
            <div class="cont">
              <div class="container-1">
                <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Write something...">
                <div class="search"></div>
              </div>
            </div>
            <table id="data-table" style="table-layout: auto;">
              <tbody>
                <tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>Institution</th>
                  <th>Reg. No</th>
                  <th>Created By</th>
                  <th>Created At</th>
                  <th>Updated By</th>
                  <th>Action</th>
                  <center><button class="btn btn-info btn-rounded mt-3 mb-3" style="font-size: 15px; " id="export-btn">Export to Excel</button></center>
                </tr>
                <tr>
                <?php 
                $i = 1;
                
                foreach ($institutions as $institution): ?> 
                  <td data-th="No."><?php echo $i; ?></td>
                  <td data-th="Name"><?php echo $institution['name']; ?></td>
                      <?php
                      $institution_id = $institution['institution_id'];
                      $stmt_inst = $pdo->prepare("SELECT name FROM institution WHERE id = :institution_id");
                      $stmt_inst->execute(['institution_id' => $institution_id]);
                      $institution_name = $stmt_inst->fetchColumn();
                      ?>
                  <td data-th="Institution"><?php echo $institution_name; ?></td>
                  <td data-th="Reg. No"><?php echo $institution['reg_no']; ?></td>
                  <td data-th="Created By"><?php echo $institution['created_by']; ?></td>
                  <td data-th="Created At"><?php echo $institution['created_at']; ?></td>
                  <td data-th="Updated At"><?php echo $institution['updated_at']; ?></td>
                  <td data-th="Action">
                        <div class="container-button" style="width: auto; text-align: center; display: flex;">
                          <form action="phpback/delete_student.php" method="post">
                              <input type="hidden" name="student_id" value="<?php echo $institution['id']; ?>">
                              <button class="button-57" role="button" type="submit" onclick="return confirm('Are you sure you want to delete this record?')"><span class="text">Drop</span><span>Delete Record</span></button>
                          </form>
                          <form action="update_student.php" method="post">
                            <input type="hidden" name="student_id" value="<?php echo $institution['id']; ?>">
                            <button class="button-58" role="button" type="submit" ><span class="text">Modify</span><span>Update Record</span></button>
                          </form>
                          <form action="add_course_student.php" method="post">
                            <input type="hidden" name="student_id" value="<?php echo $institution['id']; ?>">
                            <button class="button-59" role="button" type="submit" ><span class="text">Enroll</span><span>Add to course</span></button>
                          </form>
                        </div>
                  </td>
                </tr>
                <?php 
                $i++;
                
                endforeach; ?>
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
  <script>
    document.getElementById('export-btn').addEventListener('click', function() {
      var table = document.getElementById('data-table');
      
      var clonedTable = table.cloneNode(true);
      
      var rows = clonedTable.getElementsByTagName('tr');
      for (var i = 0; i < rows.length; i++) {
        rows[i].deleteCell(-1);
      }
      
      var wb = XLSX.utils.table_to_book(clonedTable);
      
      XLSX.writeFile(wb, 'table_data.xlsx');
    });
  </script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/tablesearch.js"></script>
</body>

</html>