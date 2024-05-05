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
    <link rel="stylesheet" href="dashboard/assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
  </head>

<body>
  <header class="main-header clearfix" role="header">
    <div class="logo">
      <a style="font-size: clamp(12px, 4vw, 32px);" href="lecturer.php"><em>E</em>COURSES - Lecturers</a>
    </div>
    <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
    <nav id="menu" class="main-nav" role="navigation">
      <ul class="main-menu">
        <li><a href="#section4" id="home">Courses</a></li>
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
          <h2 id="home" style="margin-bottom: -1px;">Welcome back, <?php
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
                                                                        ?>!</h2><br>
            <h2 id="home">Your Courses</h2>
          </div>
        </div>
        <div class="container">
        <center>
        <?php
          $username = $_SESSION['username'];
          $stmt = $pdo->prepare("SELECT courses.course_name
                                FROM courses
                                JOIN lecturer_course ON courses.id = lecturer_course.course_id
                                JOIN lecturers ON lecturer_course.lecturer_id = lecturers.id
                                JOIN users ON lecturers.users_id = users.id
                                WHERE users.username = :username");
          $stmt->execute(['username' => $username]);
          $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
          ?>

          <?php foreach ($courses as $course): ?>
            <div class="items bg-light" style="margin: 10px; max-width: 1000px; border-radius: 10px; display: fixed;">
                      <img style="border-radius: 10px; margin-top: 50px;" src="assets/images/courses-01.jpg" alt="Course #1">
                      <div class="down-content">
                        <h4 style="font-weight: 900; margin-top: 60px;"><?php echo $course['course_name']; ?></h4>
                        <p></p>
                        <div class="text-button-pay">
                        <?php
                          include 'dashboard/phpback/dbconn.php';

                          $username = $_SESSION['username'];

                          $stmt = $pdo->prepare("SELECT lecturer_course.course_id, lecturers.name AS lecturer_name FROM users JOIN lecturers ON users.id = lecturers.users_id JOIN lecturer_course ON lecturers.id = lecturer_course.lecturer_id WHERE users.username = :username");
                          $stmt->execute(['username' => $username]);
                          $data = $stmt->fetch(PDO::FETCH_ASSOC);

                          if ($data) {
                              $course_id = $data['course_id'];
                              $lecturer_name = $data['lecturer_name'];
                          } else {
                              echo "No data found for the current user.";
                          }
                        ?>
                        <a style="font-weight: bold;" href="do_attendance.php?course_id=<?php echo $course_id; ?>&lecturer_name=<?php echo $lecturer_name; ?>">Check In <i class="fa fa-angle-double-right"></i></a>
                        </div>
                      </div>
                  </div>
          <?php endforeach; ?>
        </center>
        </div>
      </div>
    </div>
  </section>
  <section class="section video" data-section="section5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 align-self-center">
                <div class="left-content">
                    <h4>Student Attendance</h4>
                </div>
                <form method="post" class="w-25" id="attendanceForm">
                    <div class="form-group">
                        <label for="course">Select Course:</label>
                        <select name="course" id="course" class="form-control text-light" style="height: 50px; background: transparent; font-size: 15px;">
                            <option style="color: black" value="">Select a course</option>
                            <?php
                            $stmt_courses = $pdo->prepare("SELECT courses.id, courses.course_name FROM courses INNER JOIN lecturer_course ON courses.id = lecturer_course.course_id INNER JOIN lecturers ON lecturer_course.lecturer_id = lecturers.id INNER JOIN users ON lecturers.users_id = users.id WHERE users.username = ?");
                            $stmt_courses->execute([$username]);
                            while ($course = $stmt_courses->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option style='color: black' value='{$course['id']}'>{$course['course_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button style="font-size: 15px; border-radius: 10px;" type="submit" class="btn btn-outline-success">Show Attendance</button>
                </form>
                <div id="attendanceTableContainer"></div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const courseSelect = document.getElementById('course');
    const attendanceForm = document.getElementById('attendanceForm');
    const attendanceTableContainer = document.getElementById('attendanceTableContainer');

    attendanceForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const selectedCourse = courseSelect.value;
        fetchAttendance(selectedCourse);
    });

    function fetchAttendance(courseId) {
        fetch('fetch_attendance.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'course_id=' + courseId
        })
        .then(response => response.text())
        .then(html => {
            attendanceTableContainer.innerHTML = html;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});
</script>
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