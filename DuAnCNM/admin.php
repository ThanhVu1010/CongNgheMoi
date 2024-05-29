<?php
session_start();
ob_start();

if (isset($_SESSION['login'])) {
    $role = $_SESSION['is_login']['Vaitro'];
    if (isset($_GET['mod'])) {
        $mod = $_GET['mod'];
        switch ($role) {
            case '1':
                switch ($_GET['mod']) {
                    case 'login':
                        include_once('View/vLogin.php');
                        break;
                    case 'logout':
                        include_once('View/vLogout.php');
                        break;
                

                    case 'PH/HS':
                        include_once("Includes/Templates/adminHeader.php");
                        include_once("Includes/Templates/adminNavbar.php");
                        include_once('View/admin/User/vCuslist.php');
                        include_once("Includes/Templates/adminFooter.php");
                        break;
                    case 'Chuyenvien':
                            include_once("Includes/Templates/adminHeader.php");
                            include_once("Includes/Templates/adminNavbar.php");
                            include_once('View/admin/User/vStaff.php');
                            include_once("Includes/Templates/adminFooter.php");
                            break;
                    case 'addUser':
                                include_once("Includes/Templates/adminHeader.php");
                                include_once("Includes/Templates/adminNavbar.php");
                                include_once('View/admin/User/vAddUser.php');
                                include_once("Includes/Templates/adminFooter.php");
                                break;
                    case 'DeleteUser':
                            include_once("Includes/Templates/adminHeader.php");
                            include_once("Includes/Templates/adminNavbar.php");
                            include_once('View/admin/User/vDeleteUser.php');
                            include_once("Includes/Templates/adminFooter.php");
                            break;
                    case 'UpdateUser':
                            include_once("Includes/Templates/adminHeader.php");
                            include_once("Includes/Templates/adminNavbar.php");
                            include_once('View/admin/User/vUpdateUser.php');
                            include_once("Includes/Templates/adminFooter.php");
                            break;
                    case 'ListBV':
                            include_once("Includes/Templates/adminHeader.php");
                            include_once("Includes/Templates/adminNavbar.php");
                            include_once('View/admin/Baiviet/vListBV.php');
                            include_once("Includes/Templates/adminFooter.php");
                            break;
                    case 'ViewBaiviet':
                            include_once("Includes/Templates/adminHeader.php");
                            include_once("Includes/Templates/adminNavbar.php");
                            include_once('View/admin/Baiviet/vXemBV.php');
                            include_once("Includes/Templates/adminFooter.php");
                            break;
                    case 'UpdateBV':
                            include_once("Includes/Templates/adminHeader.php");
                            include_once("Includes/Templates/adminNavbar.php");
                            include_once('View/admin/Baiviet/vUpdateBV.php');
                            include_once("Includes/Templates/adminFooter.php");
                            break;         
                    case 'DeleteBaiViet':
                            include_once("Includes/Templates/adminHeader.php");
                            include_once("Includes/Templates/adminNavbar.php");
                            include_once('View/admin/Baiviet/vXoaBV.php');
                            include_once("Includes/Templates/adminFooter.php");
                            break; 
                case 'AddBV':
                            include_once("Includes/Templates/adminHeader.php");
                            include_once("Includes/Templates/adminNavbar.php");
                            include_once('View/admin/Baiviet/vAddBV.php');
                            include_once("Includes/Templates/adminFooter.php");
                            break;
                    case 'Approve':
                            include_once("Includes/Templates/adminHeader.php");
                            include_once("Includes/Templates/adminNavbar.php");
                            include_once('View/admin/Baiviet/vDuyetBV.php');
                            include_once("Includes/Templates/adminFooter.php");
                            break;
                    case 'InsertChatbot':
                            include_once("Includes/Templates/adminHeader.php");
                            include_once("Includes/Templates/adminNavbar.php");
                            include_once('View/admin/chat/vInsertchatbot.php');
                            include_once("Includes/Templates/adminFooter.php");
                            break;
                     case 'Viewchatbot':
                            include_once("Includes/Templates/adminHeader.php");
                            include_once("Includes/Templates/adminNavbar.php");
                            include_once('View/admin/chat/vChatbot.php');
                            include_once("Includes/Templates/adminFooter.php");
                            break;
                    case 'DeleteChatbot':
                            include_once("Includes/Templates/adminHeader.php");
                            include_once("Includes/Templates/adminNavbar.php");
                            include_once('View/admin/chat/vDeleteChatbot.php');
                            include_once("Includes/Templates/adminFooter.php");
                            break;          
                case 'UpdateChatbot':
                            include_once("Includes/Templates/adminHeader.php");
                            include_once("Includes/Templates/adminNavbar.php");
                            include_once('View/admin/chat/vUpdateChatbot.php');
                            include_once("Includes/Templates/adminFooter.php");
                            break;
                            
                    default:
                        include_once("Includes/Templates/adminHeader.php");
                        include_once("Includes/Templates/adminNavbar.php");
                        include_once("View/admin/vadmin.php");
                        include_once("Includes/Templates/adminFooter.php");
                        break;
                    }

            case '2':
                switch ($_GET['mod']) {
                    case 'login':
                        include_once('View/vLogin.php');
                        break;
                    case 'logout':
                        include_once('View/vLogout.php');
                        break;
                    case 'ListBV':
                            include_once("Includes/Templates/adminHeader.php");
                            include_once("Includes/Templates/adminNavbar.php");
                            include_once('View/admin/Baiviet/vListBV.php');
                            include_once("Includes/Templates/adminFooter.php");
                            break;
                            case 'ViewBaiviet':
                                include_once("Includes/Templates/adminHeader.php");
                                include_once("Includes/Templates/adminNavbar.php");
                                include_once('View/admin/Baiviet/vXemBV.php');
                                include_once("Includes/Templates/adminFooter.php");
                                break;
                        case 'UpdateBV':
                                include_once("Includes/Templates/adminHeader.php");
                                include_once("Includes/Templates/adminNavbar.php");
                                include_once('View/admin/Baiviet/vUpdateBV.php');
                                include_once("Includes/Templates/adminFooter.php");
                                break;         
                        case 'DeleteBaiViet':
                                include_once("Includes/Templates/adminHeader.php");
                                include_once("Includes/Templates/adminNavbar.php");
                                include_once('View/admin/Baiviet/vXoaBV.php');
                                include_once("Includes/Templates/adminFooter.php");
                                break;  
                    case 'AddBV':
                            include_once("Includes/Templates/adminHeader.php");
                            include_once("Includes/Templates/adminNavbar.php");
                            include_once('View/admin/Baiviet/vAddBV.php');
                            include_once("Includes/Templates/adminFooter.php");
                            break;        
                        
                    }
        }
    }else {
        include_once("Includes/Templates/adminHeader.php");
        include_once("Includes/Templates/adminNavbar.php");
        include_once("View/admin/vadmin.php");
        include_once("Includes/Templates/adminFooter.php");
    }
}
?>