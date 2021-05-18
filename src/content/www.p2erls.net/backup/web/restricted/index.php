<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "https://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Admin Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="https://www.p2erls.net/web/includes/ajax_common.js"></script>
<script type="text/javascript" language="javascript" src="https://www.p2erls.net/web/restricted/includes/ajax_login.js"></script>
 
<link href="includes/admin_styles.css" rel="stylesheet" type="text/css">
</head>

<body>

  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="tableBorder">
    <tr>
      <td align="center" bgcolor="#eeeeee"><h1>Log In </h1></td>
    </tr>
    <tr>
      <td height="25" align="right">&nbsp;</td>
    </tr>
    <tr>
      <td>
	  <form  action="Security_Dept/redirect.php" name="form1" method="post">
	  <table width="440" border="0" align="center" cellpadding="4" cellspacing="1" class="tableBorder">
        <tr bgcolor="#eeeeee">
          <td colspan="2"><div id="loginDetails"><strong>Enter Username and Password</strong></div></td>
        </tr>
        <tr>
          <td>Username</td>
          <td><input name="username" type="text" id="username"></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input name="password" type="password" id="password"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
		  <input type="submit" name="Go" value="Go"> 
          </td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          </tr>
      </table>
	    </form>
	  </td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td height="30" align="center" bgcolor="#eeeeee">Copyright &copy; <?php echo date('Y'); ?> P2ERLS &amp; Digital Solutions. All Rights Reserved. Site Design by <a href="https://www.digitalsolutionslc.com/" target="_blank">Digital Solutions</a>.</td>
    </tr>
  </table>
  <p>&nbsp;</p>

</body>
</html>
