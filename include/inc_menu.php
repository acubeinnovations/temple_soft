<?php 
require(ROOT_PATH."/include/connection/connection.php");
require(ROOT_PATH."/include/class/class_menu_item/class_menu_item.php");

?>

<!-- Right Nav Section -->
<ul class="right">
    <li class="divider"></li>
    <?php
    if(isset($_SESSION[SESSION_TITLE.'pages'])){ 
      $pages = $_SESSION[SESSION_TITLE.'pages'];

      $menu_item = new MenuItem($myconnection);
      $menu_item->connection = $myconnection;
      //get all menu from table
      $menu_list = $menu_item->getMenuTreeArray();
     // echo "<pre>";print_r($menu_list);echo "</pre>";exit();

      //filter menu list with user pages
      $user_menu_list = $menu_item->filterMenuTreeArray($menu_list,$pages);
      //echo "<pre>";print_r($user_menu_list);echo "</pre>";exit();
      //print user menu list
      if($user_menu_list){
         // echo "<pre>";print_r($user_menu_list);echo "</pre>";exit();
        printMenuList($user_menu_list);  
      }

    }else{
    //default pages
    } ?>

    <?php if(isset($_SESSION[SESSION_TITLE.'userid']) && $_SESSION[SESSION_TITLE.'userid'] > 0){ ?>
      <li><a href="../logout.php"  >Logout</a></li>
    <?php }else{ ?>
      <li><a href="../index.php"  >Login</a></li>
    <?php } ?>

  </ul>

