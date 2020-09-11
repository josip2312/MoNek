<?php

    session_start();

?>

<header class="header">
    <div class="wrapper">
        <div class="logo">MoStan</div>
        <div class="hamburger-menu">
            <div class="menu-top"></div>
            <div class="menu-mid"></div>
            <div class="menu-down"></div>
        </div>
        <nav>

            <?php
                if (isset($_SESSION['userId'])) {
                    echo '
                        <ul class="nav-items">
                            <li class="nav-item">
                                <a href="/2019/g13/views" class="nav-link">Pocetna</a>
                            </li>
                            <li class="nav-item">
                                <form action="../controller/logout.inc.php" method="post">
                                    <button type="submit" name="logout" class="nav-link">Odjavi se</button>
                                </form>
                            </li>
                                
                        </ul>
                    ';
                } else {
                    echo '
                        <ul class="nav-items">
                            <li class="nav-item">
                                <a href="/2019/g13/views" class="nav-link">Pocetna</a>
                            </li>
                            <li class="nav-item">
                                <a href="/2019/g13/views/login.php" class="nav-link">Prijava</a>
                            </li>
                            <li class="nav-item">
                                <a href="/2019/g13/views/register.php" class="nav-link">Registracija</a>
                            </li>
                        </ul>
                    ';
                }
            ?>
            

        </nav>
    </div>
</header>