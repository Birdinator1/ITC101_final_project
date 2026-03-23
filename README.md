# To-Do List for Final Project

### Pages
* login.php
  
  This file will take the login request from the user, then when the user presses submit, it will take the login information and assign a cookie. If the user uses the correct given guest credentials, it gives them a cookie saying `user=guest`, which is encoded in base 64 like this: `dXNlcj1ndWVzdA==`. That cookie is used to decide whether the page now redirects to `guest.php` or `admin.php`. 
* guest.php
  
  This page is just a simple page saying that there's nothing really there for the guest because they are buns.
* admin.php
  
  This page has the flag, which is a win. Be sure to disallow browsing to either the guest or admin page through the url, only allow it through login.
  
