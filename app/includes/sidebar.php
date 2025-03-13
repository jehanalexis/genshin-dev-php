<?php
ob_start();
define('BASE_URL', '/app/');
define('ROOT_URL', '/');
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<div id="sidebar1" class="sidebar1 d-flex flex-column flex-shrink-0 p-3 text-white bg-dark"
    style="width: 280px; height: calc(100vh - 0px); position: sticky; top: 0; left: 0; overflow-x: auto;">
    <a href="<?= BASE_URL ?>/dashboard.php"
        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">
            <img src="https://avatars.githubusercontent.com/u/72385945" alt="" width="" height="32"
                class="rounded me-2">
            Genshin Dev API
        </span>
    </a>
    <span class="badge rounded-pill bg-primary w-25 mt-2">Beta</span>
    <span class="mt-2" style="font-size: 0.855rem;"><i>This is a beta version of the app, which means it may contain
            bugs and unexpected behavior. Features and design may change.</i></span>
    <hr>
    <ul id="sidebar2" class="nav nav-pills flex-column mb-auto">
        <!-- idk what category is this -->
        <li class="nav-item">
            <a href="<?= BASE_URL ?>dashboard.php"
                class="nav-link <?php echo ($currentPage == 'dashboard.php') ? 'active' : 'text-white'; ?>"
                aria-current="page">
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                    fill="#e8eaed">
                    <path
                        d="M520-600v-240h320v240H520ZM120-440v-400h320v400H120Zm400 320v-400h320v400H520Zm-400 0v-240h320v240H120Zm80-400h160v-240H200v240Zm400 320h160v-240H600v240Zm0-480h160v-80H600v80ZM200-200h160v-80H200v80Zm160-320Zm240-160Zm0 240ZM360-280Z" />
                </svg>
                Dashboard
            </a>
        </li>
        <li>
            <a href="<?= BASE_URL ?>characters.php"
                class="nav-link <?php echo ($currentPage == 'characters.php') ? 'active' : 'text-white'; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                    fill="#e8eaed">
                    <path
                        d="M720-400v-120H600v-80h120v-120h80v120h120v80H800v120h-80Zm-360-80q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm80-80h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0-80Zm0 400Z" />
                </svg>
                Characters
            </a>
        </li>
        <li>
            <a href="<?= BASE_URL ?>materials.php"
                class="nav-link <?php echo ($currentPage == 'materials.php') ? 'active' : 'text-white'; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                    fill="#e8eaed">
                    <path
                        d="M200-80q-33 0-56.5-23.5T120-160v-451q-18-11-29-28.5T80-680v-120q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v120q0 23-11 40.5T840-611v451q0 33-23.5 56.5T760-80H200Zm0-520v440h560v-440H200Zm-40-80h640v-120H160v120Zm200 280h240v-80H360v80Zm120 20Z" />
                </svg>
                Materials
            </a>
        </li>

        <hr>

        <!-- Debug for testing the directory of the pages. Disregard -->

        <!-- <li>
            <a href="<?= BASE_URL ?>debug/debug.php"
                class="nav-link <?php echo ($currentPage == 'debug.php') ? 'active' : 'text-white'; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                    fill="#e8eaed">
                    <path
                        d="M200-520v-40q0-72 32.5-131.5T320-789l-75-75 35-36 85 85q26-12 55.5-18.5T480-840q30 0 59.5 6.5T595-815l85-85 35 36-75 75q55 38 87.5 97.5T760-560v40H200Zm400-80q17 0 28.5-11.5T640-640q0-17-11.5-28.5T600-680q-17 0-28.5 11.5T560-640q0 17 11.5 28.5T600-600Zm-240 0q17 0 28.5-11.5T400-640q0-17-11.5-28.5T360-680q-17 0-28.5 11.5T320-640q0 17 11.5 28.5T360-600ZM480-40q-117 0-198.5-81.5T200-320v-160h560v160q0 117-81.5 198.5T480-40Z" />
                </svg>
                a/debug.php
            </a>
        </li>
        <li>
            <a href="<?= BASE_URL ?>debug/debug/debug.php"
                class="nav-link <?php echo ($currentPage == 'debug.php') ? 'active' : 'text-white'; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                    fill="#e8eaed">
                    <path
                        d="M200-520v-40q0-72 32.5-131.5T320-789l-75-75 35-36 85 85q26-12 55.5-18.5T480-840q30 0 59.5 6.5T595-815l85-85 35 36-75 75q55 38 87.5 97.5T760-560v40H200Zm400-80q17 0 28.5-11.5T640-640q0-17-11.5-28.5T600-680q-17 0-28.5 11.5T560-640q0 17 11.5 28.5T600-600Zm-240 0q17 0 28.5-11.5T400-640q0-17-11.5-28.5T360-680q-17 0-28.5 11.5T320-640q0 17 11.5 28.5T360-600ZM480-40q-117 0-198.5-81.5T200-320v-160h560v160q0 117-81.5 198.5T480-40Z" />
                </svg>
                a/a/debug.php
            </a>
        </li> -->
    </ul>

    <hr>

    <!-- I plan to put a session so users can login. But in the meantime, the page is viewable without logging in -->
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="userDropDown"
            data-bs-toggle="dropdown" aria-expanded="false">
            <!-- <img src="<?php echo $userImage; ?>" alt="" width="32" height="32" class="rounded-circle me-2"> -->
            <img src="<?= ROOT_URL ?>img/icons/dev.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <!-- <strong><?php echo htmlspecialchars($userName); ?></strong> -->
            <strong>Test User</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="userDropDown">

            <!-- I plan to add a profile page -->

            <!-- 

            <li><a class="dropdown-item" href="<?= BASE_URL ?>user/settings.php">Settings</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>user/profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>user/about.php">About App</a></li>
            <li> 
                <hr class="dropdown-divider">
            </li>
            -->

            <!-- use this if you have a login page -->

            <li><a class="dropdown-item" href="<?= BASE_URL ?>logout.php">Sign out</a></li>
        </ul>
    </div>
</div>

<style>
    @media screen and (max-width: 700px) {
        .sidebar1 {
            display: none !important;
        }
    }
</style>