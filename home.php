<?php
// Start the session
session_start();
// Check if the user_name is set in the session
//if set then user allow to access the homepage and username is displayed in homepage.
if (isset($_SESSION['user'])) {  
} else {
  // Redirect to the login page if the user_name is not set in the session. when user logout & try to access the system, it doesnot directly navigate to homepage instead it redirects to login page. only the authorized user can access the system.
  header("Location: loginpage.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>Homepage</title>
    <link rel="stylesheet" href="css/home.css"/>
  </head>
  <body>
  
    <!-- navbar -->
    <nav class="navbar">
      <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        <img src="images/logo.png" alt="">HR Software
      </div>
      
      <div class="search_bar">
        <input type="text" placeholder="Search" />
      </div>
      <div class="username"></div>
      
      <div class="navbar_content">

        <div class="profile_section">
     
        <img src="images/koli.jpg" alt="" class="profile" style="width: 40px; height: 40px;" onclick="toggleMenu()"/>
        <i class='bx bx-bell' ></i>
      </div>
      </div>
    </nav>
  
    <!-- sidebar -->
    <nav class="sidebar">
      <div class="menu_content">
        <ul class="menu_items">
     
          <li class="item">
            <a href="chart.php" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class="bx bx-home-alt"></i>
              </span>
              <span class="navlink">Home</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </a>
          </li>
          
            <a href="view_attendance.php" class="nav_link submenu_item">
              <span class="navlink_icon">
              <i class="bx bx-calendar"></i>
              </span>
              <span class="navlink">Attendance</span>
              <i class="bx bx-chevron-right arrow-left"></i>
              </a>
        
            <a href="add_payroll.php" class="nav_link submenu_item">
              <span class="navlink_icon">
              <i class="bx bx-dollar-circle"></i>
              </span>
              <span class="navlink">Payroll</span>
              <i class="bx bx-chevron-right arrow-left"></i>
              </a>
          
            <a href="admin_view_leave.php" class="nav_link submenu_item">
              <span class="navlink_icon">
              <i class="bx bx-history"></i>
              </span>
              <span class="navlink">Leave History</span>
              <i class="bx bx-chevron-right arrow-left"></i>
              </a>

              <a href="view_department.php" class="nav_link submenu_item">
              <span class="navlink_icon">
              <i class="bx bx-laptop"></i>
              </span>
              <span class="navlink">Department</span>
              <i class="bx bx-chevron-right arrow-left"></i>
              </a>

            <a href="view_rate.php" class="nav_link submenu_item">
              <span class="navlink_icon">
              <i class="bx bx-time"></i>
              </span>
              <span class="navlink">Hourly Rate</span>
              <i class="bx bx-chevron-right arrow-left"></i>
              </a>

              <a href="view_salary.php" class="nav_link submenu_item">
              <span class="navlink_icon">
              <i class="bx bx-dollar"></i>
              </span>
              <span class="navlink">Salary Details</span>
              <i class="bx bx-chevron-right arrow-left"></i>
              </a> 

             <a href="viewdetail.php" class="nav_link submenu_item">
              <span class="navlink_icon">
              <i class="bx bx-check"></i>
              </span>
              <span class="navlink">Employee_List</span>
              <i class="bx bx-chevron-right arrow-left"></i>
              </a>

            <a href="view_schedule.php" class="nav_link submenu_item">
              <span class="navlink_icon">
              <i class="bx bx-calendar"></i>
            </span>
              <span class="navlink">View Schedule</span>
              <i class="bx bx-chevron-right arrow-left"></i>
              </a>
              <a href="admin_view_document.php" class="nav_link submenu_item">
              <span class="navlink_icon">
              <i class="bx bx-file"></i>
            </span>
              <span class="navlink">Document</span>
              <i class="bx bx-chevron-right arrow-left"></i>
              </a> 
              <a href="document_type.php" class="nav_link submenu_item">
              <span class="navlink_icon">
              <i class="bx bx-file-find"></i>
            </span>
              <span class="navlink">Docum_Type</span>
              <i class="bx bx-chevron-right arrow-left"></i>
              </a> 
        </div>
      </div>
    </nav>
   
    <!-- for profile popup -->
    <nav class="profilepopup">
        
     <div class="sub-menu-wrap" id="subMenu">
     <div class="sub-menu">
     <div class="user-info">
  <img src="images/koli.jpg">

  <h3> <?php echo $_SESSION['user']; ?></h3>
     </div>
     <hr>
     <a href="#" class="sub-menu-link"> 
        <img src="images/profile.png">
        <p>Edit profile</p> 
    </a>
    
    <a href="#" class="sub-menu-link">
        <img src="images/setting.png">
        <p>Settings</p>
          </a>
    
    <a href="logout.php" class="sub-menu-link">
        <img src="images/logout.png">
        <p>Logout</p>
         </a>
     </div>
     </div>
     </nav>

  <script>
    // for profile popup
  let subMenu = document.getElementById("subMenu");
      function toggleMenu(){
         subMenu.classList.toggle("open-menu");
      }

  // for sidebar toggle
  const sidebar = document.querySelector('.sidebar');
const sidebarOpen = document.getElementById('sidebarOpen');

sidebarOpen.addEventListener('click', () => {
  sidebar.classList.toggle('close');
});
</script>
  </body>
</html>
