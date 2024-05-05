<?php
include 'dashboard/phpback/dbconn.php';
include 'dashboard/phpback/sessionlec.php';
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Created By Major">
    <meta name="author" content="Major">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <title>ECOURSES - Online Teachings</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-grad-school.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <link rel="stylesheet" href="dashboard/assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/style3.css">
    <link href="dashboard/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  </head>

<body>
  <header class="main-header clearfix" role="header">
    <div class="logo">
      <a style="font-size: clamp(12px, 4vw, 32px);" href="lecturer.php"><em>E</em>COURSES - Lecturers</a>
    </div>
    <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
    <nav id="menu" class="main-nav" role="navigation">
      <ul class="main-menu">
        <li><a href="lecturer.php" class="external" id="home">Courses</a></li>
        <li><a href="lecturerupdate.php" class="external">Edit your data</a></li>
        <li><a href="logout.php" class="external" id="home">Logout</a></li>
      </ul>
    </nav>
  </header>
  <section class="section courses" data-section="section4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
          <h2 id="home" style="margin-bottom: -1px;"><?php
                                                      if (isset($_SESSION['username'])) {
                                                      $username = $_SESSION['username'];

                                                      $stmt = $pdo->prepare("SELECT lecturers.*, users.username AS username FROM lecturers JOIN users ON lecturers.users_id = users.id WHERE users.username = :username");
                                                      $stmt->execute(['username' => $username]);
                                                      $lecturer = $stmt->fetch(PDO::FETCH_ASSOC);

                                                        if ($lecturer) {
                                                          $studentName = $lecturer['name'];
                                                          $relatedUsername = $lecturer['username'];
                                                          echo "$studentName";
                                                        } else {
                                                          echo "No lecturer found for the current session username.";
                                                        }
                                                      } else {
                                                        echo "Username not found in the session.";
                                                      }
                                                    ?></h2><br>
            <h2 id="home">Do attendance</h2>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="row">
      <div class="col-md-12" id="maincont">
        <h1 style="color: white; margin-top: 5px; margin-bottom: -5px;">Students in selected course</h1>
        <div class="table-1" style="overflow: auto; max-width: 100%; height: auto;">
        <?php
          include 'dashboard/phpback/dbconn.php';

          function isAttendanceExists($pdo, $student_id, $date) {
              $stmt = $pdo->prepare("SELECT COUNT(*) FROM student_attendance WHERE student_id = ? AND date = ?");
              $stmt->execute([$student_id, $date]);
              $count = $stmt->fetchColumn();
              return $count > 0;
          }
          
          function recordAttendance($pdo, $student_id, $course_id, $date, $lecturer_name, $attendance) {
            if (isAttendanceExists($pdo, $student_id, $date)) {
                $stmt_student_name = $pdo->prepare("SELECT name FROM students WHERE id = ?");
                $stmt_student_name->execute([$student_id]);
                $student_name = $stmt_student_name->fetchColumn();
                
                return "$student_name already recorded on $date";
            }

            $stmt_lecturer = $pdo->prepare("SELECT id FROM lecturers WHERE name = ?");
            $stmt_lecturer->execute([$lecturer_name]);
            $lecturer = $stmt_lecturer->fetch(PDO::FETCH_ASSOC);
            $lecturer_id = $lecturer['id'];

            $stmt_attendance = $pdo->prepare("INSERT INTO student_attendance (course_id, student_id, date, attendance, lecturer_id, created_by) VALUES (?, ?, ?, ?, ?, ?)");
            $success = $stmt_attendance->execute([$course_id, $student_id, $date, $attendance, $lecturer_id, $lecturer_name]);

            return $success;
          }

          if ($_SERVER["REQUEST_METHOD"] == "POST") {
              foreach ($_POST['attendance'] as $student_id => $attendance) {
                  if (!empty($attendance)) {
                      $result = recordAttendance($pdo, $student_id, $_POST['course_id'], $_POST['date'], $_POST['lecturer_name'], $attendance);

                      if ($result === true) {
                          echo "<script>alert('Attendance recorded successfully');</script>";
                      } else {
                          echo "<script>alert('$result');</script>";
                      }
                  }
              }

              echo "<script>window.location.href = 'lecturer.php';</script>";
          }

          $course_id = $_GET['course_id'] ?? null;
          $lecturer_name = $_GET['lecturer_name'] ?? null;

          if ($course_id && $lecturer_name) {
              $stmt_course = $pdo->prepare("SELECT course_name FROM courses WHERE id = ?");
              $stmt_course->execute([$course_id]);
              $course = $stmt_course->fetch(PDO::FETCH_ASSOC);

              if ($course) {
                  $course_name = $course['course_name'];

                  $stmt_students = $pdo->prepare("SELECT students.id, students.name AS student_name FROM student_course JOIN students ON student_course.student_id = students.id WHERE student_course.course_id = ?");
                  $stmt_students->execute([$course_id]);
                  $students = $stmt_students->fetchAll(PDO::FETCH_ASSOC);

                  $current_date = date("Y-m-d");
          ?>
          <form method="post" style="height: auto;">
              <table style="height: auto;">
                  <thead>
                      <tr>
                          <th>No.</th>
                          <th>Student</th>
                          <th>Creator</th>
                          <th>Date</th>
                          <th>Attendance</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($students as $index => $student): ?>
                      <tr>
                          <td><?= ($index + 1) ?></td>
                          <td><?= $student['student_name'] ?></td>
                          <td><?= $lecturer_name ?></td>
                          <td><?= $current_date ?></td>
                          <td>
                              <input type="hidden" name="attendance[<?= $student['id'] ?>]" value="">
                              <div class="row">
                                <div class="col-md-3"><input type="radio" name="attendance[<?= $student['id'] ?>]" value="attended"> Attended</div>
                                <div class="col-md-3"><input type="radio" name="attendance[<?= $student['id'] ?>]" value="not attended"> Not Attended</div>
                              </div>
                          </td>
                      </tr>
                      <?php endforeach; ?>
                  </tbody>
              </table>
              <input type="hidden" name="course_id" value="<?= $course_id ?>">
              <input type="hidden" name="date" value="<?= $current_date ?>">
              <input type="hidden" name="lecturer_name" value="<?= $lecturer_name ?>">
              <center><button class="mb-5 bg-dark text-light" style="width: 200px; border-radius: 10px; border: 1px solid #2e2e2e;" type="submit">Submit Attendance</button></center>
          </form>

          <?php
              } else {
                  echo "Course not found.";
              }
          }
          ?>
        </div>
      </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="dashboard/assets/js/tablesearch.js"></script>
    <script>
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .scroll-to-section').on('click', 'a', function (e) {
          if($(e.target).hasClass('external')) {
            return;
          }
          e.preventDefault();
          $('#menu').removeClass('active');
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
</body>
</html> 