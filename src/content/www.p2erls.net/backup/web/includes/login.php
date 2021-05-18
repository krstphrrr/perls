<script type="text/javascript" language="javascript" src="includes/required_fields.js"></script>
<tr>
	  <td align="center" valign="middle" id="login" style="background-image:url(images/header_whole.jpg); background-repeat:no-repeat; height:196px; ">
	<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="55%">&nbsp;</td>
        <td width="45%" align="right" valign="middle" style="padding-right:30px; "><br />
          <br />
          <br />
          <?php if($_SESSION["p2erls_username"] == '')
{ ?> 	<?php if($_GET["incorrect"] == "Y"){ ?>
		<font color="#ffffff"><b>Im sorry, that is an incorrect password/username combination. <br /></b></font>  
		<?php } ?>
          <form method="post" name="P2erls_Login" id="P2erls_Login" style="margin:0px;"  action="restricted/Security_Dept/redirect.php">
            <span class="header_medium">Username
            <input name="username" type="text" id="username" />
            <br />
            <br />
			Password
			<input name="password" type="password" id="password" />
			<br />
			<br />
			<input type="submit" name="Button" value="Go" />
            </span>
          </form>
          <span class="header_medium">
          <?php }

if($_SESSION["p2erls_username"] != '')
{ ?>
          </span>
        <span class="header_medium">You are logged in as <b><?php echo $_SESSION["p2erls_username"]; ?></b> - <a href="restricted/Security_Dept/logout.php">Logout &raquo;</a>
              
          </span> <?php } ?></td>
      </tr>
    </table> </td>
	</tr>