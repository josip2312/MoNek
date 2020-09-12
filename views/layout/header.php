<?php

    session_start();

?>

<header class="header">
    <div class="wrapper">
        <a href="/2019/g13/views" class="logo" >MoStan</a>
        <div class="hamburger-menu">
            <span></span>
        </div>
        <nav>

        <?php
            if (isset($_SESSION['userId'])) {
                echo '
                    <ul class="nav-items">
                        <li class="nav-item">
                            <a href="/2019/g13/views" class="nav-link">
                                <img src="../assets/img/icons/home.svg" alt="" />
                                <span>Pocetna</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="../controller/logout.inc.php" method="post">
                                <button type="submit" name="logout" class="nav-link">
                                    <img src="../assets/img/icons/logout.svg"  alt="" />
                                    <span>Odjavi se</span>
                                </button>
                            </form>
                        </li>
                            
                    </ul>
                ';
            } else {
                echo '
                    <ul class="nav-items">
                        <li class="nav-item">
                            <a href="/2019/g13/views" class="nav-link">
                                <img src="../assets/img/icons/home.svg" alt="" />
                                <span>Pocetna</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/2019/g13/views/login.php" class="nav-link">
                            <img src="../assets/img/icons/login.svg" alt="" />
                            <span>Prijava</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/2019/g13/views/register.php" class="nav-link">
                            <img src="../assets/img/icons/useradd.svg" alt="" />
                            <span>Registracija</span>
                            </a>
                        </li>
                    </ul>
                ';
            }
        ?>
        

        </nav>

        <?php
            if (isset($_SESSION['userId'])) {
                echo '
                <div class="mobile-nav">
                    <a href="/2019/g13/views" class="mobile-nav__home">
                        <img src="../assets/img/icons/home.svg" alt="" />
                        <span>Pocetna</span>
                    </a>

                    <form action="../controller/logout.inc.php" method="post" class="mobile-nav__logout">
                        <button type="submit" name="logout">
                        
                            <img src="../assets/img/icons/login.svg"  alt="" />
                            <span>Odjavi se</span>
                        </button>
                    </form>   
                </div>
                ';
            } else {
                echo '
                <div class="mobile-nav">
                    <a href="/2019/g13/views" class="mobile-nav__home">
                        <img src="../assets/img/icons/home.svg" alt="" />
                        <span>Pocetna</span>
                    </a>
                    <a href="/2019/g13/views/login.php" class="mobile-nav__login">
                        <img src="../assets/img/icons/login.svg"  alt="" />
                        <span>Prijava</span>
                    </a>
                    <a href="/2019/g13/views/register.php" class="mobile-nav__register">
                        <img src="../assets/img/icons/useradd.svg"  alt="" />
                        <span>Registracija</span>
                    </a>
                </div>
                ';
            }
        ?>


        
    </div>
</header>