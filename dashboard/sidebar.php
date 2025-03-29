<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.php" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="../assets/img/images/logo_white.png" style="width:100px;height:auto;">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2"></span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">




        <!-- Dashboards -->
        <li class="menu-item <?= $page == "dashboard" ? "active" : "" ?>">
            <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Your Account">Your Account</div>
            </a>
            <ul class="menu-sub">

                <li class="menu-item <?= $page == "password" ? "active" : "" ?>">
                    <a href="password.php" class="menu-link">
                        <div data-i18n="Change Password">Change Password</div>
                    </a>
                </li>
            </ul>
        </li>
        
        
        
         <!-- Master Control -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Requests</span>
        </li>
        <li class="menu-item">
            <a href="shop_request" class="menu-link">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Shop Requests">Shop Requests</div>
            </a>
        </li>

<li class="menu-item">
            <a href="lab_request" class="menu-link">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Lab Requests">Lab Requests</div>
            </a>
        </li>


        

        <!-- Master Control -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Master Control</span>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Admins">Admins</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "admin" ? "active" : "" ?>">
                    <a href="admin.php" class="menu-link">
                        <div data-i18n="Create An Admin">Create An Admin</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "admins" ? "active" : "" ?>">
                    <a href="view_admins.php" class="menu-link">
                        <div data-i18n="View Admins">View Admins</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-coupon"></i>
                <div data-i18n="Vouchers">Vouchers</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "voucher" ? "active" : "" ?>">
                    <a href="voucher.php" class="menu-link">
                        <div data-i18n="Create A voucher">Create A voucher</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "vouchers" ? "active" : "" ?>">
                    <a href="view_vouchers.php" class="menu-link">
                        <div data-i18n="View Vouchers">View Vouchers</div>
                    </a>
                </li>
            </ul>
        </li>



        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-world"></i>
                <div data-i18n="Site">Site</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "manager" ? "active" : "" ?>">
                    <a href="banner.php" class="menu-link">
                        <div data-i18n="Create A Banner">Create A Banner</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "banners" ? "active" : "" ?>">
                    <a href="view_banners.php" class="menu-link">
                        <div data-i18n="View Banners">View Banners</div>
                    </a>
                </li>

                <li class="menu-item <?= $page == "statistics" ? "active" : "" ?>">
                    <a href="view_statistics.php" class="menu-link">
                        <div data-i18n="View Site Figures">View Site Figures</div>
                    </a>
                </li>
            </ul>
        </li>
        
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-first-aid"></i>
                <div data-i18n="Lab Services">Lab Services</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "lab" ? "active" : "" ?>">
                    <a href="lab.php" class="menu-link">
                        <div data-i18n="Add A service">Add A service</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "labs" ? "active" : "" ?>">
                    <a href="view_labs.php" class="menu-link">
                        <div data-i18n="View services">View services</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "lab_payments" ? "active" : "" ?>">
                    <a href="view_lab_payments.php" class="menu-link">
                        <div data-i18n="Service Requests">Service Requests</div>
                    </a>
                </li>

               
            </ul>
        </li>

        <li class="menu-item">
            <a href="?logout" class="menu-link">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Logout">Logout</div>
            </a>
        </li>

<li class="menu-item">
            <a href="shop" class="menu-link">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Shop">Shop</div>
            </a>
        </li>



        <!-- E-Registry -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Users</span>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Doctor">Doctor</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "doctor" ? "active" : "" ?>">
                    <a href="doctor" class="menu-link">
                        <div data-i18n="Create A doctor">Create A doctor</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "all_doctors" ? "active" : "" ?>">
                    <a href="view_doctors" class="menu-link">
                        <div data-i18n="View All doctors">View All doctors</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "approved_doctors" ? "active" : "" ?>">
                    <a href="view_approved_doctors" class="menu-link">
                        <div data-i18n="View Approved doctors">View Approved doctors</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "applied_doctors" ? "active" : "" ?>">
                    <a href="view_applied_doctors" class="menu-link">
                        <div data-i18n="View Applied doctors">View Applied doctors</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "doc_category" ? "active" : "" ?>">
                    <a href="doc_category" class="menu-link">
                        <div data-i18n="Create A Specialty">Create A Specialty</div>
                    </a>
                </li> 
                <li class="menu-item <?= $page == "all_doc_categories" ? "active" : "" ?>">
                    <a href="view_doc_categories" class="menu-link">
                        <div data-i18n="View All Specialties">View All Specialties</div>
                    </a>
                </li>

            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Categories">Categories</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "category" ? "active" : "" ?>">
                    <a href="category" class="menu-link">
                        <div data-i18n="Create A category">Create A category</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "all_categories" ? "active" : "" ?>">
                    <a href="view_categories" class="menu-link">
                        <div data-i18n="View All categories">View All categories</div>
                    </a>
                </li>


            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Clients">Clients</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "user" ? "active" : "" ?>">
                    <a href="user" class="menu-link">
                        <div data-i18n="Create A Client">Create A Client</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "view_users" ? "active" : "" ?>">
                    <a href="view_users" class="menu-link">
                        <div data-i18n="View All Clients">View All Clients</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "view_subscribers" ? "active" : "" ?>">
                    <a href="view_subscribers" class="menu-link">
                        <div data-i18n="View All Subscribers">View All Subscribers</div>
                    </a>
                </li>


            </ul>
        </li>


        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxl-microsoft-teams"></i>
                <div data-i18n="Groups">Groups</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "group" ? "active" : "" ?>">
                    <a href="group" class="menu-link">
                        <div data-i18n="Create A Group">Create A Group</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "view_groups" ? "active" : "" ?>">
                    <a href="view_groups" class="menu-link">
                        <div data-i18n="View All Groups">View All Groups</div>
                    </a>
                </li>


            </ul>
        </li>


        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pharmacy</span>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-basket"></i>
                <div data-i18n="products">products</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "product" ? "active" : "" ?>">
                    <a href="product" class="menu-link">
                        <div data-i18n="Create A product">Create A product</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "view_products" ? "active" : "" ?>">
                    <a href="view_products" class="menu-link">
                        <div data-i18n="View products">View products</div>
                    </a>
                </li>

            </ul>
        </li>
        
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-basket"></i>
                <div data-i18n="Prescriptions">Prescriptions</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "pharmacies" ? "active" : "" ?>">
                    <a href="view_pharmacy" class="menu-link">
                        <div data-i18n="View All Prescriptions">View All Prescriptions</div>
                    </a>
                </li>
                

            </ul>
        </li>
        
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
                <div data-i18n="orders">orders</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "view_orders" ? "active" : "" ?>">
                    <a href="view_orders" class="menu-link">
                        <div data-i18n="View orders">View orders</div>
                    </a>
                </li>

            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-t-shirt"></i>
                <div data-i18n="brands">brands</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "brand" ? "active" : "" ?>">
                    <a href="brand" class="menu-link">
                        <div data-i18n="Create A brand">Create A brand</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "view_brands" ? "active" : "" ?>">
                    <a href="view_brands" class="menu-link">
                        <div data-i18n="View brands">View brands</div>
                    </a>
                </li>

            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-purchase-tag"></i>
                <div data-i18n="tags">tags</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "tag" ? "active" : "" ?>">
                    <a href="tag" class="menu-link">
                        <div data-i18n="Create A tag">Create A tag</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "view_tags" ? "active" : "" ?>">
                    <a href="view_tags" class="menu-link">
                        <div data-i18n="View tags">View tags</div>
                    </a>
                </li>

            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="units">units</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "unit" ? "active" : "" ?>">
                    <a href="unit" class="menu-link">
                        <div data-i18n="Create A unit">Create A unit</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "view_units" ? "active" : "" ?>">
                    <a href="view_units" class="menu-link">
                        <div data-i18n="View units">View units</div>
                    </a>
                </li>

            </ul>
        </li>


        <!-- Sessions and Bookings -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Sessions And Bookings</span>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dna"></i>
                <div data-i18n="Sessions">Sessions</div>
            </a>
            <ul class="menu-sub">

                <li class="menu-item <?= $page == "view_sessions" ? "active" : "" ?>">
                    <a href="view_sessions" class="menu-link">
                        <div data-i18n="View Sessions">View Sessions</div>
                    </a>
                </li>
            </ul>
        </li>


    </ul>
</aside>