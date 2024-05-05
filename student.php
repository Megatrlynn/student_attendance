<?php
include 'dashboard/phpback/dbconn.php';
include 'dashboard/phpback/sessionstu.php';
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
    <link rel="stylesheet" href="dashboard/assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
  </head>

<body>
  <header class="main-header clearfix" role="header">
    <div class="logo">
      <a style="font-size: clamp(12px, 4vw, 32px);" href="student.php"><em>E</em>COURSES - STUDENTS</a>
    </div>
    <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
    <nav id="menu" class="main-nav" role="navigation">
      <ul class="main-menu">
        <li><a href="#section4" id="home">Courses</a></li>
        <li><a href="#section6" id="home">Attendance</a></li>
        <li><a href="studentupdate.php" class="external">Edit your data</a></li>
        <li><a href="logout.php" class="external" id="home">Logout</a></li>
      </ul>
    </nav>
  </header>
  <section class="section courses" data-section="section4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
          <h2 id="home" style="margin-bottom: -1px;">Welcome back, <?php
                                                                        if (isset($_SESSION['username'])) {
                                                                            $username = $_SESSION['username'];

                                                                            $stmt = $pdo->prepare("SELECT students.*, users.username AS username FROM students JOIN users ON students.users_id = users.id WHERE users.username = :username");
                                                                            $stmt->execute(['username' => $username]);
                                                                            $student = $stmt->fetch(PDO::FETCH_ASSOC);

                                                                            if ($student) {
                                                                                $studentName = $student['name'];
                                                                                $relatedUsername = $student['username'];
                                                                                echo "$studentName";
                                                                            } else {
                                                                                echo "No student found for the current session username.";
                                                                            }
                                                                        } else {
                                                                            echo "Username not found in the session.";
                                                                        }
                                                                        ?>!</h2><br>
            <h2 id="home">Courses you're enrolled in</h2>
          </div>
        </div>
        <div class="container">
        <center>
        <?php
          $username = $_SESSION['username'];
          $stmt = $pdo->prepare("SELECT courses.course_name FROM courses
                                JOIN student_course ON courses.id = student_course.course_id
                                JOIN students ON student_course.student_id = students.id
                                JOIN users ON students.users_id = users.id
                                WHERE users.username = :username");
          $stmt->execute(['username' => $username]);
          $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
          if ($courses) {
              foreach ($courses as $course) {
                  ?>
                  <div class="items bg-light" style="margin: 10px; max-width: 1000px; border-radius: 10px; display: fixed;">
                      <img style="border-radius: 10px; margin-top: 50px;" src="assets/images/courses-01.jpg" alt="Course #1">
                      <div class="down-content">
                        <h4 style="font-weight: 900; margin-top: 60px;"><?php echo $course['course_name']; ?></h4>
                        <p></p>
                        <div class="text-button-pay">
                          <a style="font-weight: bold;" href="#">Read <i class="fa fa-angle-double-right"></i></a>
                        </div>
                      </div>
                  </div>
                  <?php
              }
          } else {
              echo "<h4 style='color: white;'>No courses found for this user.</h4>";
          }
        ?>
        </center>
        </div>
      </div>
    </div>
  </section>
  <section class="section video" data-section="section5">
    <div class="container1">
      <div class="row">
        <div class="col-md-12 align-self-center">
          <div class="left-content text-center">
            <h4>No quiz / assessment available.</h4>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section contact" data-section="section6">
    <div class="container1">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2 id="discover">Check your attendance level</h2>
                    <center>
                    <form method="post" class="w-25 mt-5 mb-5" id="attendanceForm">
                        <div class="form-group">
                            <label style="color: white;" for="course">Select Course:</label>
                            <select name="course" id="course" class="form-control text-light" style="height: 50px; background: transparent; font-size: 15px;">
                                <option style="color: black" value="">Select a course</option>
                                <?php
                                include 'dashboard/phpback/dbconn.php';
                                $username = $_SESSION['username'];
                                $stmt_courses = $pdo->prepare("SELECT courses.id, courses.course_name FROM courses INNER JOIN student_course ON courses.id = student_course.course_id INNER JOIN students ON student_course.student_id = students.id INNER JOIN users ON students.users_id = users.id WHERE users.username = ?");
                                $stmt_courses->execute([$username]);
                                while ($course = $stmt_courses->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option style='color: black' value='{$course['id']}'>{$course['course_name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button style="font-size: 15px; border-radius: 10px;" type="submit" class="btn btn-outline-success">Show Attendance</button>
                    </form>
                    </center>
                    <?php
                    if (isset($_POST['course'])) {
                        $selected_course_id = $_POST['course'];

                        $stmt_student_id = $pdo->prepare("SELECT id FROM students WHERE users_id = (SELECT id FROM users WHERE username = ?)");
                        $stmt_student_id->execute([$username]);
                        $student_id = $stmt_student_id->fetchColumn();

                        if ($student_id) {
                            $stmt_attendance = $pdo->prepare("SELECT date, attendance FROM student_attendance WHERE student_id = ? AND course_id = ?");
                            $stmt_attendance->execute([$student_id, $selected_course_id]);

                            $attendance_data = [];
                            while ($row = $stmt_attendance->fetch(PDO::FETCH_ASSOC)) {
                                $attendance_data[$row['date']] = $row['attendance'];
                            }

                            echo "<table class='mt-5' id='data-table' style='table-layout: auto;'>";
                            echo "<thead><tr><th>Name</th>";
                            foreach ($attendance_data as $date => $attendance) {
                                echo "<th>$date</th>";
                            }
                            echo "</tr></thead><tbody>";

                            echo "<tr>";
                            echo "<td data-th='Name'>" . $username . "</td>";
                            foreach ($attendance_data as $attendance) {
                                echo "<td data-th='Attendance'>" . $attendance . "</td>";
                            }
                            echo "</tr>";

                            echo "</tbody></table>";
                            
                        } else {
                            echo "Student ID not found.";
                        }
                    }
                    ?>
                    <?php
                      if (isset($_POST['course'])) {
                          $selected_course_id = $_POST['course'];

                          $stmt_student_id = $pdo->prepare("SELECT id FROM students WHERE users_id = (SELECT id FROM users WHERE username = ?)");
                          $stmt_student_id->execute([$username]);
                          $student_id = $stmt_student_id->fetchColumn();

                          if ($student_id) {
                              $stmt_attendance_counts = $pdo->prepare("SELECT 
                                  SUM(CASE WHEN attendance = 'Attended' THEN 1 ELSE 0 END) AS attended_count,
                                  SUM(CASE WHEN attendance = 'Not Attended' THEN 1 ELSE 0 END) AS not_attended_count,
                                  COUNT(*) AS total_records
                                  FROM student_attendance 
                                  WHERE student_id = ? AND course_id = ?");
                              $stmt_attendance_counts->execute([$student_id, $selected_course_id]);
                              $attendance_counts = $stmt_attendance_counts->fetch(PDO::FETCH_ASSOC);

                              $total_records = $attendance_counts['total_records'];
                              $attended_count = $attendance_counts['attended_count'];
                              $not_attended_count = $attendance_counts['not_attended_count'];

                              $attendance_percentage = ($total_records > 0) ? round(($attended_count / $total_records) * 100, 2) : 0;
                              
                              $eligibility = ($attendance_percentage >= 70) ? "Eligible for exam" : "Not eligible for exam";

                              $badge_color = ($eligibility == "Eligible for exam") ? "badge-success" : "badge-danger";

                              echo "<table class='mt-5' id='aggregated-attendance-table'>";
                              echo "<thead><tr><th>Attendance Metric</th><th>Count</th></tr></thead>";
                              echo "<tbody>";
                              echo "<tr><td>Total attended classes</td><td>$attended_count</td></tr>";
                              echo "<tr><td>Total not attended classes</td><td>$not_attended_count</td></tr>";
                              echo "<tr><td>Total classes</td><td>$total_records</td></tr>";
                              echo "<tr><td>Attendance Percentage</td><td>$attendance_percentage%</td></tr>";
                              echo "<tr><td>Eligibility</td><td><span class='badge $badge_color'>$eligibility</span></td></tr>";
                              echo "</tbody>";
                              echo "</table>";
                          } else {
                              echo "Student ID not found.";
                          }
                      }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>


  <footer>
    <div class="container1">
      <div class="row">
        <div class="col-md-12">
          <p><i class="fa fa-copyright"></i> Copyright 2024 by ECOURSES  
          
           | Design: GigaChad</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        //according to loftblog tut
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