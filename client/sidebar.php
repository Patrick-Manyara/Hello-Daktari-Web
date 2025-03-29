<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.php" style="color:white;" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="../assets/img/images/logo_white.png" style="width:100px;height:auto;">
            </span>
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

        <!-- Sessions and Bookings -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Account</span>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Your Account">Your Account</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "profile" ? "active" : "" ?>">
                    <a href="my_profile.php" class="menu-link">
                        <div data-i18n="Current Profile">Current Profile</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "edit_profile" ? "active" : "" ?>">
                    <a href="edit_profile.php" class="menu-link">
                        <div data-i18n="Edit Profile">Edit Profile</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "password" ? "active" : "" ?>">
                    <a href="password.php" class="menu-link">
                        <div data-i18n="Change Password">Change Password</div>
                    </a>
                </li>
            </ul>
        </li>




        <li class="menu-item">
            <a href="?logout" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Logout">Logout</div>
            </a>
        </li>


        <!-- Sessions and Bookings -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">doctor</span>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Doctors">Doctors</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "all_doctors" ? "active" : "" ?>">
                    <a href="saved_doctors" class="menu-link">
                        <div data-i18n="Saved Doctors">Saved Doctors</div>
                    </a>
                </li>
            </ul>
        </li>
        
        
        <!-- Sessions and Bookings -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Orders</span>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
                <div data-i18n="Orders">Orders</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "orders" ? "active" : "" ?>">
                    <a href="view_orders" class="menu-link">
                        <div data-i18n="Orders">Orders</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Sessions and Bookings -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Sessions And Prescriptions</span>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dna"></i>
                <div data-i18n="Sessions">Sessions</div>
            </a>
            <ul class="menu-sub">

                <li class="menu-item <?= $page == "sessions" ? "active" : "" ?>">
                    <a href="view_sessions.php" class="menu-link">
                        <div data-i18n="My Sessions">My Sessions</div>
                    </a>
                </li>
            </ul>
        </li>
        
         <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-capsule"></i>
                <div data-i18n="Prescriptions">Prescriptions</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "prescriptions" ? "active" : "" ?>">
                    <a href="view_prescriptions.php" class="menu-link">
                        <div data-i18n="View Prescriptions">View Prescriptions</div>
                    </a>
                </li>
            </ul>
        </li>





    </ul>
</aside>