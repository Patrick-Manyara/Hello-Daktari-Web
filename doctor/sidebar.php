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
                 <li class="menu-item <?= $page == "signature" ? "active" : "" ?>">
                    <a href="signature.php" class="menu-link">
                        <div data-i18n="New Signature">New Signature</div>
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
            <span class="menu-header-text">Sessions And Prescriptions</span>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-test-tube"></i>
                <div data-i18n="Sessions">Sessions</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "schedule" ? "active" : "" ?>">
                    <a href="schedule.php" class="menu-link">
                        <div data-i18n="My Schedule">My Schedule</div>
                    </a>
                </li>
                <li class="menu-item <?= $page == "sessions" ? "active" : "" ?>">
                    <a href="view_sessions.php" class="menu-link">
                        <div data-i18n="My Sessions">My Sessions</div>
                    </a>
                </li>
            </ul>
        </li>
        
        
        <!--<li class="menu-item">-->
        <!--    <a href="javascript:void(0);" class="menu-link menu-toggle">-->
        <!--        <i class="menu-icon tf-icons bx bx-capsule"></i>-->
        <!--        <div data-i18n="Prescriptions">Prescriptions</div>-->
        <!--    </a>-->
        <!--    <ul class="menu-sub">-->
        <!--        <li class="menu-item <?= $page == "prescription" ? "active" : "" ?>">-->
        <!--            <a href="prescription.php" class="menu-link">-->
        <!--                <div data-i18n="Write Prescription">Write Prescription</div>-->
        <!--            </a>-->
        <!--        </li>-->
        <!--        <li class="menu-item <?= $page == "prescriptions" ? "active" : "" ?>">-->
        <!--            <a href="view_prescriptions.php" class="menu-link">-->
        <!--                <div data-i18n="View Prescriptions">View Prescriptions</div>-->
        <!--            </a>-->
        <!--        </li>-->
        <!--    </ul>-->
        <!--</li>-->
        
        
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Patients">Patients</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= $page == "patients" ? "active" : "" ?>">
                    <a href="view_patients.php" class="menu-link">
                        <div data-i18n="View patients">View Patients</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>