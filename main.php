<!DOCTYPE html>
<html lang="zxx">
  <head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>TEASTREETPH</title>
    
    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    
    <!--=============== FLICKITY ===============-->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

     <!--=============== JQUERY ===============-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!--=============== CUSTOM STYLES ===============-->
    <link rel="stylesheet" href="assets/css/homepage.css"/>
  

  </head>

  <style>

.menu-images-container {
    display: flex; /* Flexbox layout to place images inline */
    justify-content: center; /* Center the images horizontally */
    gap: 20px; /* Add space between the images */
}

.menu-image img {
  width: 450px;
    height: 600px;
    object-fit: cover;
    border-radius: 20px;
}

.bg-primary {
  background-color: var(--color-primary);
  color: var(--color-bg);
}
.bg-secondary {
  background-color: #CCF6C8;
  color: #000;
}
.bg-extra {
  background-color: var(--color-extra);
  color: var(--color-text);
}
.bg-dark {
  background-color: var(--color-dark);
  color: var(--color-text);
}
.footer {
  color: #000;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, auto));
  gap: 1.5rem;
  background: #F6D6AD;
}

.footer-box {
  display: flex;
  text-decoration: none;
  list-style: none;
  flex-direction: column;
  margin: 50px 50px 50px 50px;
}

.footer-box h2 {
  font-size: 1.2rem;
  font-weight: 600;
  margin-bottom: 10px;
}

.footer-box p {
  font-size: 0.938rem;
  margin-bottom: 10px;
}

.social {
  align-items: center;
  column-gap: 0.5rem;
}

.social a .bx {
  color: var(--color-text);
  font-size: 24px;
  padding: 10px;
  background: #F6D6AD;
  border-radius: 0.2rem;
}

.social a .bx:hover {
  background: var(--color-bg);
  color: var(--color-text);
}

.footer-box h3 {
  font-weight: 600;
  margin-bottom: 10px;
}

.footer-box li a {
  color: var(--color-text);
  text-decoration: none;
}

.footer-box li a:hover {
  color: var(--color-bg);
}

.contact {
  list-style: none;
  display: flex;
  flex-direction: column;
  row-gap: 0.5rem;
}

.contact span {
  display: flex;
  align-items: center;
}

.contact i {
  font-size: 20px;
  margin-right: 1rem;
}



  </style>
  
  <body>

   <?php include 'navigation.php'; ?>
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


     <!--=============== BOX A ===============-->

    <section class="box box-a bg-secondary text-center py-md">
      <div class="box-inner">
        <h2 class="text-xl">TEASTREETPH</h2>
        <p class="text-md">
             TEASTREETPH is our passion. We live to bring you quality teas, full of fresh ingredients,
            shaken up fresh to order by our dedicated brew crew.
        </p>
      </div>
    </section>

      <!--=============== IMAGE CAROUSEL ===============-->
     <div class="carousel" data-flickity='{"autoPlay": "true", "cellAlign": "left"}'>
      <div class="cell" style="background-image: url(images/c1.jpg)"></div>
      <div class="cell" style="background-image: url(images/c2.jpg)"></div>
      <div class="cell" style="background-image: url(images/c3.jpg)"></div>
      <div class="cell" style="background-image: url(images/c4.jpg)"></div>
      <div class="cell" style="background-image: url(images/c5.jpg)"></div>
      <div class="cell" style="background-image: url(images/c6.jpg)"></div>
      <div class="cell" style="background-image: url(images/c7.jpg)"></div>
      <div class="cell" style="background-image: url(images/c8.jpg)"></div>
    </div>

     <!--=============== ALL ABOUT US ===============-->

    <section class="col-section">
      <h2 class="title">All About Us</h2>
      <div class="border"> </div>
      <div class="col-container">
          <div class="col-box">
              <div class="col-img">
                  <img src="images/shops-2.png" alt="">
              </div>
              <div class="col-text">
                  <a href="stores.php" class="col-title">Our Location</a>
              </div>
          </div>
          <div class="col-box">
              <div class="col-img">
                  <img src="images/orderlist.png" alt="">
              </div>
              <div class="col-text">
                  <a href="menu.php" class="col-title">Our Menu</a>
              </div>
          </div>
          <div class="col-box">
              <div class="col-img">
                  <img src="images/story.jpeg" alt="">
              </div>
              <div class="col-text">
                  <a href="contact.php" class="col-title">Contact Us</a>
              </div>
          </div>
      </div>
  </section>
 
     <!--=============== BOX B - CHOCOLATE ===============-->

    <h2 class="title">Best Seller</h2>
    <div class="border"> </div>
    <section class="box box-b bg-secondary grid-col-2">
      <img src="images/chocolate.jpg" alt="chocolate bubble tea"/>
      <div class="box-text">
        <h2 class="text-xl">Dark Chocolate</h2>
        <p class="text-md">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam distinctio 
            reprehenderit asperiores deleniti. Tempore soluta repellat esse iusto laborum atque 
            sunt tempora veniam aspernatur corrupti. Libero accusantium ipsam ut quia?
        </p>
        <a href="listoforder.php" class="btn btn-light-outline">Order Now</a>
      </div>
    </section>

     <!--=============== BOX C - CLASSIC ===============-->

    <section class="box box-c bg-secondary grid-col-2 grid-reversed">
      <img src="images/Coffeelatte.jpg" alt="classic bubble tea" />
      <div class="box-text">
        <h2 class="text-xl">Cafe Latte</h2>
        <p class="text-md">
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam distinctio 
          reprehenderit asperiores deleniti. Tempore soluta repellat esse iusto laborum atque 
          sunt tempora veniam aspernatur corrupti. Libero accusantium ipsam ut quia?
      </p>
        <a href="listoforder.php" class="btn btn-light-outline">Order Now</a>
      </div>
    </section>

     <!--=============== BOX D - BROWN SUGAR ===============-->

    <section class="box box-d bg-secondary grid-col-2">
      <img src="images/salted.jpg" alt="brown sugar bubble tea"/>
      <div class="box-text">
        <h2 class="text-xl">Salted Caramel</h2>
        <p class="text-md">
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam distinctio 
          reprehenderit asperiores deleniti. Tempore soluta repellat esse iusto laborum atque 
          sunt tempora veniam aspernatur corrupti. Libero accusantium ipsam ut quia?
      </p>
        <a href="listoforder.php" class="btn btn-light-outline">Order Now</a>
      </div>
    </section>


    <!--=============== FOOTER ===============-->
    <?php include 'front/footer.php'; ?>
    <!--=============== CUSTOM JS ===============-->

    <script src="assets/js/homepage.js"></script>

     <!--=============== FLICKITY ===============-->

    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

   <script>
        $('.main-carousel').flickity({
            cellAlign: 'left',
            wrapAround: true,
            freeScroll: true
          });
          $(document).ready(function() {
            $('#menu-btn').on('click', function() {
                $('#menu').toggleClass('hidden'); // Toggle visibility of the mobile menu
            });
        });
   </script>
    
  </body>
</html>