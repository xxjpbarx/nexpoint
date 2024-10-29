<!DOCTYPE html>
<html lang="zxx">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TEASTREETPH</title>
    
    <!--=============== BOXICONS ===============-->

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

     <!--=============== CUSTOM STYLES ===============-->
  
    <link rel="stylesheet" href="assets/css/homepage.css" />

    <link rel="stylesheet" href="assets/css/stores.css" />
   

  </head>
  <body>

    <!--=============== NAVIGATION BAR ===============-->

    <nav class="navbar">
  <div class="navbar-container">
    <div class="navbar-brand">
      <a href="main.php">
        <img src="images/mainlogo.png" alt="Logo"/>
      </a>
    </div>

    <ul class="navbar-nav-left">
      <li><a href="menu.php">Menu</a></li>
      <li><a href="listoforder.php">Order Now</a></li>
      <li><a href="contact.php">Contact</a></li>
    </ul>

    <ul class="navbar-nav-right">
      <li>
        <a href="stores.php">
          <img src="images/marker.svg" alt="" />
          <span>Find a store</span>
        </a>
      </li>
      <a href="login.php">
    <button class="btn btn-dark-outline">Sign in</button>
      </a>
      <li>
  <a href="signup.php">
    <button class="btn btn-dark">Sign Up</button>
  </a>
</li>
    </ul>
  </div>
</nav>

         <!--=============== HAMBURGER MENU ===============-->

        <button type="button" class="hamburger" id="menu-btn">
          <span class="hamburger-top"></span>
          <span class="hamburger-middle"></span>
          <span class="hamburger-bottom"></span>
        </button>
      </div>
    </nav>

     <!--=============== MOBILE MENU ===============-->

     <div class="mobile-menu hidden" id="menu">
  <ul>
    <li><a href="menu.php">Menu</a></li>
    <li><a href="listoforder.php">Order Now</a></li>
    <li><a href="contact.php">Contact</a></li>
  </ul>
  <div class="mobile-menu-bottom">
    <button class="btn btn-dark-outline">Sign in</button>
    <button class="btn btn-dark">Join now</button>
    <div>
      <a href="stores.php">
        <img src="images/marker.svg" alt="" />
        <span>Find a store</span>
      </a>
    </div>
  </div>
</div>


<section>
    <div class="store-container" style="max-width: 980px; height: 470px; overflow: hidden;">
        <div class="content-container" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%; text-align: center;">
            <h3>Towerville brgy sto.cristo Infront of Towerville Elementary School</h3>
            <p>Opened Monday - Sunday: 11am - 9pm</p>
        </div>
        <div class="map" style="width: 100%; height: 100%;">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!3m2!1sen!2sph!4v1728569776287!5m2!1sen!2sph!6m8!1m7!1smCbUkUgbDwB_uPIyafLlSw!2m2!1d14.83542018262453!2d121.0825282756222!3f233.64601484512502!4f-12.705632903232242!5f0.7820865974627469" 
                width="980" 
                height="470" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>




    <!--=============== FOOTER ===============-->
<?php include 'front/footer.php'; ?>


    <script src="assets/js/homepage.js"></script>
</body>
</html>