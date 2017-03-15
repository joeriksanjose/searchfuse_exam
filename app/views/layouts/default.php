<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <title>Task Manager</title>
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
      <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  </head>

  <body>
      <div class="container">
          <nav class="navbar navbar-default">
              <a class="navbar-brand" href="<?php echo url('user/index'); ?>">SearchFuse</a>
              <?php if (isset($user) && $user) { ?>
                  <p class="navbar-text pull-right">
                      Welcome <?php echo $user['username']; ?>! |
                      <a href="<?php echo url('user/logout'); ?>">Logout</a>
                  </p>
              <?php } ?>
          </nav>
      </div>
      <div class="container">
          <?php echo $_content_ ?>
      </div>
  </body>
</html>
