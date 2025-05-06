
<?php session_start(); $nav_links = select_all('navigation');?>

<nav class="main-menu">
    <ul class="menu-area-main">
    <?php 
        foreach ($nav_links as $link):
    ?>
    <li class="active"> 
        <a id='<?="nav" . $link->id_nav?>' href="<?=$link->href?>">
            <?=$link->link_name?>
        </a> 
    </li>
    <?php endforeach; ?>
    <?php if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
            if($user->id_role == 1){ ?>
            <li>
                <a href='administrator-access.php'><i class="fa-solid fa-circle-user"></i> Admin dashboard</a>
            </li>  
            <li>
                <a href='models/logout.php'><i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </li>
                <?php
            } elseif($user->id_role == 2){ ?>
                <li>
                    <a href="user-data.php"><i class="fa-solid fa-circle-user"></i><?= $user->first_name ?></a>
                </li>
                <li>
                    <a href='models/logout.php'><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                </li>
        <?php
            }
        } ?>
    </ul>
</nav>