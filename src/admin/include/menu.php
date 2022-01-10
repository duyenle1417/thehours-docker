<div class="menu">
        <ul id="main-menu">
            <li>
                <a href="<?php echo BASE_URL . "profile/". $_SESSION['user_id'] ?>" style="text-transform: none;"><span><i class="fas fa-portrait"></i></span> <?php echo $_SESSION['user_username'] ?> <span><i class="fas fa-sort-down"></i></span></a>
                <div class="sub-menu">
                    <ul> 
                        <li>
                            <a href="<?php echo BASE_URL . "profile/" . $_SESSION['user_id'] ?>">
                            My Profile
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo BASE_URL; ?>">
                            <span><i class="fas fa-home"></i></span> Home
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo BASE_URL . "dashboard/"; ?>">
                            Dashboard
                            </a>
                        </li>
                    
                        <li>
                            <a href="<?php echo BASE_URL . "logout" ?>">
                            <span><i class="fas fa-sign-out-alt"></i></span>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>