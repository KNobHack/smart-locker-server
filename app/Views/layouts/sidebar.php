<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->
<!-- [ Mobile header ] start -->
<div class="pc-mob-header pc-header">
    <div class="pcm-logo">
        <img src="assets/images/170x30-bg-dark.png" alt="" class="logo logo-lg">
    </div>
    <div class="pcm-toolbar">
        <a href="#!" class="pc-head-link" id="mobile-collapse">
            <div class="hamburger hamburger--arrowturn">
                <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                </div>
            </div>
        </a>
        <a href="#!" class="pc-head-link" id="header-collapse">
            <i data-feather="more-vertical"></i>
        </a>
    </div>
</div>
<!-- [ Mobile header ] End -->

<!-- [ navigation menu ] start -->
<nav class="pc-sidebar ">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="private.html" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="assets/images/170x30-bg-dark.png" alt="" class="logo logo-lg">
                <img src="assets/images/170x30-bg-dark.png" alt="" class="logo logo-sm">
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Navigation</label>
                </li>
                <li class="pc-item">
                    <a href="private.html" class="pc-link ">
                        <span class="pc-micon">
                            <span class="material-icons-two-tone">
                                lock
                            </span>
                        </span>
                        <span class="pc-mtext">Private</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="public.html" class="pc-link ">
                        <span class="pc-micon">
                            <span class="material-icons-two-tone">
                                public
                            </span>
                        </span>
                        <span class="pc-mtext">Public</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->
<!-- [ Header ] start -->
<header class="pc-header ">
    <div class="header-wrapper">
        <div class="ml-auto">
            <ul class="list-unstyled">
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="assets/images/user/default-user.jpg" alt="user-image" class="user-avtar">
                        <span>
                            <span class="user-name"><?= $username ?></span>
                            <!-- <span class="user-desc">Administrator</span> -->
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pc-h-dropdown">

                        <a href="<?= route_to('logout') ?>" class="dropdown-item">
                            <i class="material-icons-two-tone">chrome_reader_mode</i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</header>
<!-- [ Header ] end -->
<!-- [ Main Content ] start -->