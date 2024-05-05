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
      <h1 style="color: white; text-align: left;">Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Users <span style="display: flex;">| Total</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="ps-3">
                      <?php
                      include 'phpback/dbconn.php';
                      include 'phpback/totalstuff.php';
                      ?>
                      <h6><?php echo $total_users; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xxl-2 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Admins <span style="display: flex;">| Total</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $total_admins; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xxl-2 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Lecturers <span style="display: flex;">| Total</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-lines-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $total_lecturers; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xxl-2 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Students <span style="display: flex;">| Total</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $total_students; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Courses <span style="display: flex;">| Total</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file-text-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $total_courses; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="card recent-sales overflow-auto" id="maincont">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Menu</h6>
                    </li>
                    <li><a class="dropdown-item" href="view1.php">View Institutions</a></li>
                  </ul>
                </div>
                <div class="card-body">
                  <h4 class="card-title" style="color: white;">Recent Data Inputs in Institutions</h4>
                  <table id="data-table" style="table-layout: auto;">
                    <?php
                      include 'phpback/dbconn.php';
                      include 'phpback/tabledata.php';
                    ?>
                    <tbody>
                      <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date added</th>
                        <th>Date modified</th>
                        <th>Creator</th>
                        <th>Status</th>
                      </tr>
                      <tr>
                        <?php 
                          $i = 1;
                          foreach ($institutions as $institution):
                        ?>
                        <td data-th="No."><?php echo $i++; ?></td>
                        <td data-th="Userame"><?php echo $institution['name']; ?></td>
                        <td data-th="Address"><?php echo $institution['physical_codes']; ?></td>
                        <td data-th="Email"><?php echo $institution['email']; ?></td>
                        <td data-th="Phone"><?php echo $institution['phone']; ?></td>
                        <td data-th="Date added"><?php echo $institution['created_at']; ?></td>
                        <td data-th="Date modified"><?php echo $institution['updated_at']; ?></td>
                        <td data-th="Creator"><?php echo $institution['created_by']; ?></td>
                        <td data-th="Status">
                          <?php 
                            $status = (!isset($institution['name']) ||
                                        empty($institution['name']) ||
                                        !isset($institution['physical_codes']) ||
                                        empty($institution['physical_codes']) ||
                                        !isset($institution['email']) ||
                                        empty($institution['email']) ||
                                        !isset($institution['phone']) ||
                                        empty($institution['phone']) ||
                                        !isset($institution['created_at']) ||
                                        empty($institution['created_at']) ||
                                        !isset($institution['updated_at']) ||
                                        empty($institution['updated_at']) ||
                                        !isset($institution['created_by']) ||
                                        empty($institution['created_by']))
                                        ? 'bg-danger' : 'bg-success';

                            $statusText = (!isset($institution['name']) ||
                                            empty($institution['name']) ||
                                            !isset($institution['physical_codes']) ||
                                            empty($institution['physical_codes']) ||
                                            !isset($institution['email']) ||
                                            empty($institution['email']) ||
                                            !isset($institution['phone']) ||
                                            empty($institution['phone']) ||
                                            !isset($institution['created_at']) ||
                                            empty($institution['created_at']) ||
                                            !isset($institution['updated_at']) ||
                                            empty($institution['updated_at']) ||
                                            !isset($institution['created_by']) ||
                                            empty($institution['created_by']))
                                            ? 'Missing data' : 'All set';
                          ?>
                          <span class="badge <?php echo $status; ?>"><?php echo $statusText; ?></span>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="card recent-sales overflow-auto" id="maincont">
                <div class="card-body">
                  <h4 class="card-title" style="color: white;">Recent Data Inputs in Users</h4>
                  <table id="data-table" style="table-layout: auto;">
                    <?php
                      include 'phpback/dbconn.php';
                      include 'phpback/tabledata.php';
                    ?>
                    <tbody>
                      <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Date added</th>
                        <th>Date modified</th>
                        <th>Creator</th>
                        <th>Role</th>
                        <th>Status</th>
                      </tr>
                      <tr>
                        <?php 
                          $i = 1;
                          foreach ($users as $user):
                        ?>
                        <td data-th="No."><?php echo $i++; ?></td>
                        <td data-th="Userame"><?php echo $user['username']; ?></td>
                        <td data-th="Date added"><?php echo $user['created_at']; ?></td>
                        <td data-th="Date modified"><?php echo $user['updated_at']; ?></td>
                        <td data-th="Creator"><?php echo $user['created_by']; ?></td>
                          <?php
                            $stmt_role = $pdo->prepare("SELECT role_name FROM roles where id = :role_id");
                            $stmt_role->execute(['role_id' => $user['role_id']]);
                            $role = $stmt_role->fetch(PDO::FETCH_ASSOC);
                            $role_name = $role['role_name'];
                          ?>
                        <td data-th="Role"><?php echo $role_name; ?></td>
                        <td data-th="Status">
                          <?php 
                            $status = (!isset($user['username']) ||
                                        empty($user['username']) ||
                                        !isset($user['created_at']) ||
                                        empty($user['created_at']) ||
                                        !isset($user['updated_at']) ||
                                        empty($user['updated_at']) ||
                                        !isset($user['created_by']) ||
                                        empty($user['created_by']) ||
                                        !isset($role_name) ||
                                        empty($role_name))
                                        ? 'bg-danger' : 'bg-success';

                            $statusText = (!isset($user['username']) ||
                                          empty($user['username']) ||
                                          !isset($user['created_at']) ||
                                          empty($user['created_at']) ||
                                          !isset($user['updated_at']) ||
                                          empty($user['updated_at']) ||
                                          !isset($user['created_by']) ||
                                          empty($user['created_by']) ||
                                          !isset($role_name) ||
                                          empty($role_name))
                                          ? 'Missing data' : 'All set';
                          ?>
                          <span class="badge <?php echo $status; ?>"><?php echo $statusText; ?></span>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="card recent-sales overflow-auto" id="maincont">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Menu</h6>
                    </li>
                    <li><a class="dropdown-item" href="view3.php">View Lecturers</a></li>
                  </ul>
                </div>
                <div class="card-body">
                  <h4 class="card-title" style="color: white;">Recent Data Inputs in Lecturers</h4>
                  <table id="data-table" style="table-layout: auto;">
                    <?php
                      include 'phpback/dbconn.php';
                      include 'phpback/tabledata.php';
                    ?>
                    <tbody>
                      <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Institution</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Date added</th>
                        <th>Date modified</th>
                        <th>Creator</th>
                        <th>Status</th>
                      </tr>
                      <tr>
                        <?php 
                          $i = 1;
                          foreach ($lecturers as $lecturer):
                        ?>
                        <td data-th="No."><?php echo $i++; ?></td>
                        <td data-th="Name"><?php echo $lecturer['name']; ?></td>
                        <?php
                          $institution_id = $lecturer['institution_id'];
                          $stmt_inst = $pdo->prepare("SELECT name FROM institution WHERE id = :institution_id");
                          $stmt_inst->execute(['institution_id' => $institution_id]);
                          $institution_name = $stmt_inst->fetchColumn();
                        ?>
                        <td data-th="Institution"><?php echo $institution_name; ?></td>
                        <td data-th="Phone"><?php echo $lecturer['phone']; ?></td>
                        <td data-th="Email"><?php echo $lecturer['email']; ?></td>
                        <td data-th="Date added"><?php echo $lecturer['created_at']; ?></td>
                        <td data-th="Date modified"><?php echo $lecturer['updated_at']; ?></td>
                        <td data-th="Creator"><?php echo $lecturer['created_by']; ?></td>
                        <td data-th="Status">
                          <?php 
                            $status = (!isset($lecturer['name']) ||
                                        empty($lecturer['name']) ||
                                        !isset($institution_name) ||
                                        empty($institution_name) ||
                                        !isset($lecturer['phone']) ||
                                        empty($lecturer['phone']) ||
                                        !isset($lecturer['email']) ||
                                        empty($lecturer['email']) ||
                                        !isset($lecturer['created_at']) ||
                                        empty($lecturer['created_at']) ||
                                        !isset($lecturer['updated_at']) ||
                                        empty($lecturer['updated_at']) ||
                                        !isset($lecturer['created_by']) ||
                                        empty($lecturer['created_by']))
                                        ? 'bg-danger' : 'bg-success';

                            $statusText = (!isset($lecturer['name']) ||
                                            empty($lecturer['name']) ||
                                            !isset($institution_name) ||
                                            empty($institution_name) ||
                                            !isset($lecturer['phone']) ||
                                            empty($lecturer['phone']) ||
                                            !isset($lecturer['email']) ||
                                            empty($lecturer['email']) ||
                                            !isset($lecturer['created_at']) ||
                                            empty($lecturer['created_at']) ||
                                            !isset($lecturer['updated_at']) ||
                                            empty($lecturer['updated_at']) ||
                                            !isset($lecturer['created_by']) ||
                                            empty($lecturer['created_by']))
                                            ? 'Missing data' : 'All set';
                          ?>
                          <span class="badge <?php echo $status; ?>"><?php echo $statusText; ?></span>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="card recent-sales overflow-auto" id="maincont">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Menu</h6>
                    </li>
                    <li><a class="dropdown-item" href="view2.php">View Students</a></li>
                  </ul>
                </div>
                <div class="card-body">
                  <h4 class="card-title" style="color: white;">Recent Data Inputs in Students</h4>
                  <table id="data-table" style="table-layout: auto;">
                    <?php
                      include 'phpback/dbconn.php';
                      include 'phpback/tabledata.php';
                    ?>
                    <tbody>
                      <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Institution</th>
                        <th>Reg. No.</th>
                        <th>Date added</th>
                        <th>Date modified</th>
                        <th>Creator</th>
                        <th>Status</th>
                      </tr>
                      <tr>
                        <?php 
                          $i = 1;
                          foreach ($students as $student):
                        ?>
                        <td data-th="No."><?php echo $i++; ?></td>
                        <td data-th="Name"><?php echo $student['name']; ?></td>
                        <?php
                          $institution_id = $student['institution_id'];
                          $stmt_inst = $pdo->prepare("SELECT name FROM institution WHERE id = :institution_id");
                          $stmt_inst->execute(['institution_id' => $institution_id]);
                          $institution_name_stu = $stmt_inst->fetchColumn();
                        ?>
                        <td data-th="Institution"><?php echo $institution_name_stu; ?></td>
                        <td data-th="Phone"><?php echo $student['reg_no']; ?></td>
                        <td data-th="Date added"><?php echo $student['created_at']; ?></td>
                        <td data-th="Date modified"><?php echo $student['updated_at']; ?></td>
                        <td data-th="Creator"><?php echo $student['created_by']; ?></td>
                        <td data-th="Status">
                          <?php 
                            $status = (!isset($student['name']) ||
                                        empty($student['name']) ||
                                        !isset($institution_name_stu) ||
                                        empty($institution_name_stu) ||
                                        !isset($student['reg_no']) ||
                                        empty($student['reg_no']) ||
                                        !isset($lecturer['created_at']) ||
                                        empty($lecturer['created_at']) ||
                                        !isset($lecturer['updated_at']) ||
                                        empty($lecturer['updated_at']) ||
                                        !isset($lecturer['created_by']) ||
                                        empty($lecturer['created_by']))
                                        ? 'bg-danger' : 'bg-success';

                            $statusText = (!isset($lecturer['name']) ||
                                            empty($lecturer['name']) ||
                                            !isset($institution_name_stu) ||
                                            empty($institution_name_stu) ||
                                            !isset($student['reg_no']) ||
                                            empty($student['reg_no']) ||
                                            !isset($lecturer['created_at']) ||
                                            empty($lecturer['created_at']) ||
                                            !isset($lecturer['updated_at']) ||
                                            empty($lecturer['updated_at']) ||
                                            !isset($lecturer['created_by']) ||
                                            empty($lecturer['created_by']))
                                            ? 'Missing data' : 'All set';
                          ?>
                          <span class="badge <?php echo $status; ?>"><?php echo $statusText; ?></span>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="card recent-sales overflow-auto" id="maincont">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Menu</h6>
                    </li>
                    <li><a class="dropdown-item" href="view4.php">View Courses</a></li>
                  </ul>
                </div>
                <div class="card-body">
                  <h4 class="card-title" style="color: white;">Recent Data Inputs in Courses</h4>
                  <table id="data-table" style="table-layout: auto;">
                    <?php
                      include 'phpback/dbconn.php';
                      include 'phpback/tabledata.php';
                    ?>
                    <tbody>
                      <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Institution</th>
                        <th>Date added</th>
                        <th>Date modified</th>
                        <th>Creator</th>
                        <th>Status</th>
                      </tr>
                      <tr>
                        <?php 
                          $i = 1;
                          foreach ($courses as $course):
                        ?>
                        <td data-th="No."><?php echo $i++; ?></td>
                        <td data-th="Name"><?php echo $course['course_name']; ?></td>
                        <td data-th="Code"><?php echo $course['course_code']; ?></td>
                        <?php
                          $institution_id = $course['institution_id'];
                          $stmt_inst = $pdo->prepare("SELECT name FROM institution WHERE id = :institution_id");
                          $stmt_inst->execute(['institution_id' => $institution_id]);
                          $institution_name_cou = $stmt_inst->fetchColumn();
                        ?>
                        <td data-th="Institution"><?php echo $institution_name_cou; ?></td>
                        <td data-th="Date added"><?php echo $course['created_at']; ?></td>
                        <td data-th="Date modified"><?php echo $course['updated_at']; ?></td>
                        <td data-th="Creator"><?php echo $course['created_by']; ?></td>
                        <td data-th="Status">
                          <?php 
                            $status = (!isset($course['course_name']) ||
                                        empty($course['course_name']) ||
                                        !isset($course['course_code']) ||
                                        empty($course['course_code']) ||
                                        !isset($institution_name_cou) ||
                                        empty($institution_name_cou) ||
                                        !isset($course['created_at']) ||
                                        empty($course['created_at']) ||
                                        !isset($course['updated_at']) ||
                                        empty($course['updated_at']) ||
                                        !isset($course['created_by']) ||
                                        empty($course['created_by']))
                                        ? 'bg-danger' : 'bg-success';

                            $statusText = (!isset($course['course_name']) ||
                                            empty($course['course_name']) ||
                                            !isset($course['course_code']) ||
                                            empty($course['course_code']) ||
                                            !isset($institution_name_cou) ||
                                            empty($institution_name_cou) ||
                                            !isset($course['created_at']) ||
                                            empty($course['created_at']) ||
                                            !isset($course['updated_at']) ||
                                            empty($course['updated_at']) ||
                                            !isset($course['created_by']) ||
                                            empty($course['created_by']))
                                            ? 'Missing data' : 'All set';
                          ?>
                          <span class="badge <?php echo $status; ?>"><?php echo $statusText; ?></span>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
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

</body>

</html>