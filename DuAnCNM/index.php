<?php
    session_start();
    ob_start();

    if (isset($_GET['mod'])) {
        switch ($_GET['mod']) {
            case 'login':
                include_once('View/vLogin.php');
                break;
            case 'logout':
                include_once('View/vLogout.php');
                break;
            case 'register':
                include_once('View/vRegister.php');
                break;
                    
            case 'baiviet':
                include_once("Includes/Templates/header.php");
                include_once("Includes/Templates/navbar.php");
                include_once("View/vBaiviet.php");
                include_once("Includes/Templates/footer.php");
                include_once("Includes/Templates/bot.php"); 
                break;
            case 'chitietBV':
                if (isset($_GET['Idbaiviet'])) {
                    include_once("Includes/Templates/header.php");
                    include_once("Includes/Templates/navbar.php");
                    include_once("View/vChitietBV.php"); 
                    include_once("Includes/Templates/footer.php");
                    include_once("Includes/Templates/bot.php"); 
                }   else {
                        echo "Không có ID bài viết được cung cấp.";
                    }
                break;
            case 'gioithieu':
                include_once("Includes/Templates/header.php");
                include_once("Includes/Templates/navbar.php");
                include_once("View/gioithieu.php");
                include_once("Includes/Templates/footer.php");
                include_once("Includes/Templates/bot.php"); 
                break;
         case 'Profile':
                include_once("Includes/Templates/header.php");
                include_once("Includes/Templates/navbar.php");
                include_once("View/vprofile.php");
                include_once("Includes/Templates/footer.php");
                include_once("Includes/Templates/bot.php"); 
                break;  
            case 'buoitv':
                    include_once("Includes/Templates/header.php");
                    include_once("Includes/Templates/navbar.php");
                    include_once("View/vBuoiTV.php");
                    include_once("Includes/Templates/footer.php");
                    include_once("Includes/Templates/bot.php"); 
                    break;
            case 'chitietBTV':
                if (isset($_GET['Idbuoituvan'])) {
                    include_once("Includes/Templates/header.php");
                    include_once("Includes/Templates/navbar.php");
                    include_once("View/vChitietBTV.php");
                    
                    include_once("Includes/Templates/footer.php");
                    include_once("Includes/Templates/bot.php"); 
                }   else {
                        echo "Không có ID buổi tư vấn được cung cấp.";
                    }
                break;
                    
            default:
                include_once("Includes/Templates/header.php");
                include_once("Includes/Templates/navbar.php");
                include_once("View/vindex.php");
                include_once("Includes/Templates/footer.php");
                include_once("Includes/Templates/bot.php"); 
                break;
            }
    }else {
        include_once("Includes/Templates/header.php");
        include_once("Includes/Templates/navbar.php");
        include_once("View/vindex.php");
        include_once("Includes/Templates/footer.php");
        include_once("Includes/Templates/bot.php"); 
    }
    
?>