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
            <a href="home.php" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class="bx bx-home-alt"></i>
              </span>
              <span class="navlink">Home</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </a>
          </li>
          
  
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

          
             <a href="viewdetail.php" class="nav_link submenu_item">
             <span class="navlink_icon">
             <i class="bx bx-list-ul"></i> 
             </span> 
             <span class="navlink">Emp_Details</span>
             <i class="bx bx-chevron-right arrow-left"></i>
             </a>
           
             <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
              <i class="bx bx-check"></i>
              </span>
              <span class="navlink">Employee_List</span>
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
            
        
           
        </div>
      </div>
    </nav>
   
    <nav class="profilepopup">
        
     <div class="sub-menu-wrap" id="subMenu">
     <div class="sub-menu">
     <div class="user-info">
  <img src="images/koli.jpg">
  <h3><?php echo $username; ?></h3>
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
    
    <!-- JavaScript -->
    <script src="script.js"></script>

  <script>
  let subMenu = document.getElementById("subMenu");
      function toggleMenu(){
         subMenu.classList.toggle("open-menu");
      }

  const sidebar = document.querySelector('.sidebar');
const sidebarOpen = document.getElementById('sidebarOpen');

sidebarOpen.addEventListener('click', () => {
  sidebar.classList.toggle('close');
});
</script>
  </body>
</html>
