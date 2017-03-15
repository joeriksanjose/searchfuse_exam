<div class="col-md-3"></div>
<div class="col-md-6">
    <?php if (hasFlash()) { ?>
        <div class="alert alert-<?php echo Session::get('flash-level'); ?>" role="alert">
            <?php
                echo Session::get('flash-message');
                unset($_SESSION['flash-message']);
            ?>
        </div>
    <?php } ?>
    <form class="form-horizontal" id="formLogin" method="post" action="<?php echo url('user/login'); ?>">
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username">
            </div>
        </div>
        <div class="form-group">
            <label for="pass" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="pass" name="pass">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Log in
                </button>
                <a href="<?php echo url("user/register"); ?>" type="button" class="btn btn-default">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Sign up
                </a>
            </div>
        </div>
    </form>
</div>
<div class="col-md-3"></div>
<script src="/public/js/login.js"></script>
