<?php

// Start the session
session_start();

// Check if the username is set in the session
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user']; 
} else {
    // Redirect to the login page if the username is not set in the session
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
    <title>Side Navigation Bar in HTML CSS</title>
    <link rel="stylesheet" href="css/home.css"/>
  </head>
  <body>
  
    <!-- navbar -->
    <nav class="navbar">
      <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        <img src="images/logo.png" alt=""></i>HR Software
      </div>
      
      <div class="search_bar">
        <input type="text" placeholder="Search" />
      </div>
      <div class="username"><?php echo $username; ?></div>
      <div class="navbar_content">
        <i class="bi bi-grid"></i>
        
        <i class='bx bx-bell' ></i>
        <img src="images/koli.jpg" alt="" class="profile" />
      </div>
    </nav>
   
    <!-- sidebar -->
    <nav class="sidebar">
      <div class="menu_content">
        <ul class="menu_items">
          <div class="menu_title menu_dahsboard"></div>
          <!-- duplicate or remove this li tag if you want to add or remove navlink with submenu -->
          <!-- start -->
          <li class="item">
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class="bx bx-home-alt"></i>
              </span>
              <span class="navlink">Home</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>
          </li>
          <!-- end -->

          <!-- duplicate this li tag if you want to add or remove  navlink with submenu -->
          <!-- start --> 
          
      
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
              <i class="bx bx-calendar"></i>
              </span>
              <span class="navlink">Attendance</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>
        
        
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
              <i class="bx bx-dollar-circle"></i>
              </span>
              <span class="navlink">Payroll</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>
          

            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
              <i class="bx bx-calendar-minus"></i>
              </span>
              <span class="navlink">Leave</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>

            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
              <i class="bx bx-user"></i>
              </span>
              <span class="navlink">Self-service</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>

            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
              <i class="bx bx-plus"></i> 
              </span>
              <span class="navlink">Add Employee</span>
             <i class="bx bx-chevron-right arrow-left"></i>
             </div>

           <div href="#" class="nav_link submenu_item">
            <span class="navlink_icon">
            <i class="bx bx-list-ul"></i> 
            </span>
            <span class="navlink">Employee List</span>
            <i class="bx bx-chevron-right arrow-left"></i>
            </div>
           
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
            <i class="bx bx-bar-chart"></i>
            </span>
              <span class="navlink">Overview</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>

            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
              <i class="bx bx-cog"></i>
              </span>
              <span class="navlink">Settings</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>
            
           <a href="logout.php">logout</a>
           
        </div>
      </div>
    </nav>
   
        <!-- middle paragraph outside the main content area -->
        <div class="middle-paragraph">
            <p>This is homepage.</p>
        </div>
    </div>
    <!-- JavaScript -->
    <script src="script.js"></script>

  <script>
  const sidebar = document.querySelector('.sidebar');
const sidebarOpen = document.getElementById('sidebarOpen');

sidebarOpen.addEventListener('click', () => {
  sidebar.classList.toggle('close');
});
</script>
  </body>
</html>
