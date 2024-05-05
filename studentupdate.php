<?php
include 'dashboard/phpback/dbconn.php';
include 'dashboard/phpback/sessionstu.php';
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
  <link href="dashboard/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="dashboard/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="dashboard/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="dashboard/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="dashboard/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="dashboard/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="dashboard/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="dashboard/assets/css/style.css" rel="stylesheet">
  <link href="dashboard/assets/css/style2.css" rel="stylesheet">
</head>

<body>
  <div id="" class="container-fluid" style="margin-top: 100px;">
    <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
<section class="container">
<header style="font-size: 20px;">Modify your data</header>
    <?php
    include 'dashboard/phpback/forstudentupdate.php';
    ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" method="POST">
                <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                <div class="input-box">
                    <label>Your Name</label>
                    <input style="font-size: 15px;" type="text" name="name" value="<?php echo $student['name']; ?>">
                </div>
                <div class="input-box">
                    <label>Your Reg. No</label>
                    <input style="font-size: 15px;" type="text" name="reg_no" value="<?php echo $student['reg_no']; ?>">
                </div>
                <div class="input-box">
                    <label for="institution">Institution</label>
                    <select name="institution_id" id="institution" required style="border: none; color: #707070; width: 100%; height: 50px; border: 1px solid #ddd; display: flex; border-radius: 6px;" disabled>
                        <?php foreach ($institutions as $institution): ?>
                            <option value="<?php echo $institution['id']; ?>" <?php if ($institution['id'] == $student['institution_id']) echo 'selected'; ?>>
                                <?php echo $institution['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <center><button style="font-size: 15px;" type="submit">Modify</button></center>
            </form>
</section>

      </div>
      <div class="col-md-1">
      </div>
</div>

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