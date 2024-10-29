<style>
    .collapse a {
        text-indent: 10px;
    }
    
    nav#sidebar {
        height: calc(100%);
        position: fixed;
        z-index: 99;
        left: 0;
        width: 225px;
        font-size: 13px;
        top: 10em;
        transition: transform 0.3s ease;
    }
    
    nav#sidebar.hidden {
        transform: translateX(-100%);
    }
    a.nav-item {
    position: relative;
    display: block;
    padding: .75rem 1.25rem;
    margin-bottom: 18px;
    /*border: 1px solid rgba(0,0,0,.125);*/
    background-color: #ffffffc4;
    color: #adb5bd;
    font-weight: 400;
}
    .hamburger {
        position: fixed;
        z-index: 100;
        top: 2.5em; /* Adjust this value as needed */
        left: 10px;
        cursor: pointer;
        background: none;
        border: none;
        font-size: 30px;
    }
</style>

<button class="hamburger" id="toggleSidebar">
    &#9776; <!-- Hamburger Icon -->
</button>

<nav id="sidebar" class='mx-lt-5 bg-white'>
    <div class="sidebar-list">
        <a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-tachometer-alt mr-3"></i></span> Dashboard</a>
        <a href="index.php?page=sales" class="nav-item nav-email_author"><span class='icon-field'><i class="fa fa-briefcase mr-3"></i></span> Sales</a>
        <a href="billing/index.php" class="nav-item nav-takeorders"><span class='icon-field'><i class="fa fa-list-ol mr-3"></i></span> Take Orders</a>
        <?php if($_SESSION['login_type'] == 1): ?>
        <a href="index.php?page=orders" class="nav-item nav-orders"><span class='icon-field'><i class="fa fa-clipboard-list mr-3"></i></span> Orders</a>
        <a href="index.php?page=categories" class="nav-item nav-categories"><span class='icon-field'><i class="fa fa-list-alt mr-3"></i></span> Manage Categories</a>
        <a href="index.php?page=products" class="nav-item nav-products"><span class='icon-field'><i class="fa fa-th-list mr-3"></i></span> Manage Products</a>
        <?php endif; ?>
        <a href="index.php?page=sales_report" class="nav-item nav-sales_report"><span class='icon-field'><i class="fa fa-th-list mr-3"></i></span> Sales Report</a>
        <?php if($_SESSION['login_type'] == 1): ?>
        <a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users mr-3"></i></span> Users</a>
        <a href="index.php?page=support" class="nav-item nav-support"><span class='icon-field'><i class="fa fa-users mr-3"></i></span> Support</a>
        <?php endif; ?>
    </div>
</nav>

<script>
    document.getElementById('toggleSidebar').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');
    });
    
    $('.nav_collapse').click(function() {
        console.log($(this).attr('href'));
        $($(this).attr('href')).collapse();
    });
    
    $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active');
</script>

