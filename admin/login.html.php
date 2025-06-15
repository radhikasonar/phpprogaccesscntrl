<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/php-class/Session13/includes/helpers.inc.php'; ?>
	
	<!--*************************************************************
				Don't forget to change server path
	************************************************************* -->
	
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Log In</title>
  </head>
  <body>
    <h1>Log In</h1>
    <p>Please log in to view the page that you requested.</p>
    <?php if (isset($loginError)): ?><!-- 	1. 	If the user submits the login form with an incorrect email
												address or password, the user will be denied access, simply 
												being presented with the login form again. We need a way to 
												tell the user what went wrong in this situation; this template 
												will check if a variable named $loginError exists, and if so, 
												will display it above the form - Page 290  -->
	
      <p><?php htmlout($loginError); ?></p>
    <?php endif; ?>
    <form action="" method="post"><!--      2.	The <form> tag has an empty action attribute, so this form will
												be submitted back to the same URL that produced it. Thus, if the
												user’s login attempt is successful, the controller will display
												the page that the browser originally requested - Page 291 -->
     <div>
        <label for="email">Email: <input type="text" name="email"
            id="email"></label>
      </div>
      <div>
        <label for="password">Password: <input type="password"
            name="password" id="password"></label><!--
											3.	Notice the second <input> tag has its type attribute set to password. 
												This tells the browser to hide the value that the user types in, to shield 
												the password from prying eyes - Page 291 -->
      </div>
      <div>
        <input type="hidden" name="action" value="login">
        <input type="submit" value="Log in"><!--
											4.	This hidden field will be submitted with the form, to act as a signal to the 
												userIsLoggedIn function that the user has submitted
												this form in an attempt to log in. You might be tempted simply to
												put the name="action" attribute on the submit button’s <input> tag 
												and watch for that—but if the user submits the form by hitting Enter while 
												editing one of the two text fields, the submit button will not be sent with 
												the form. Using a hidden field like this ensures Cookies, Sessions, and Access 
												Control that the action variable will be submitted no matter how the submission 
												is triggered - Page 291 -->
      </div>
    </form>
    <p><a href="/admin/">Return to JMS home</a></p><!--
											5.	A user might request a protected page by accident, or might be unaware that a 
												page is protected until they see the login form. We therefore provide a link 
												back to an unprotected page as a way
												out - Page 291 -->
  </body>
</html>
