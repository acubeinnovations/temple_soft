
      <!-- Right Nav Section -->
      <ul class="right">
<?php if(isset($_SESSION[SESSION_TITLE.'user_type']) && $_SESSION[SESSION_TITLE.'user_type'] == ADMINISTRATOR && isset($_SESSION[SESSION_TITLE.'admin_userid']) && $_SESSION[SESSION_TITLE.'admin_userid'] > 0){ ?>
        <li class="divider"></li>
        <li>
		<a href="dashboard.php" >Dash Board</a>
        </li>



        <li class="divider"></li>

        <li class="has-dropdown">
          <a href="#">Administrator</a>
          <ul class="dropdown">
            <li><a href="users.php">Users</a></li>
            <li><a href="change_password.php">Change Password</a></li>
            <li class="divider"></li>
          </ul>
        </li>

<?php } ?>
        <li class="divider"></li>
         <?php if(isset($_SESSION[SESSION_TITLE.'admin_userid']) && $_SESSION[SESSION_TITLE.'admin_userid'] > 0){ ?>
			   <li><a href="logout.php"  >Logout</a></li>
         <?php } else {?>
		  <li><a href="index.php"  >Login</a></li>
          <?php }?>



      </ul>
