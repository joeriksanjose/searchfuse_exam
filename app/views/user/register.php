<div class="col-md-2"></div>

<div class="col-md-8">

    <?php if (hasFlash()) { ?>
        <div class="alert alert-<?php echo Session::get('flash-level'); ?>" role="alert">
            <?php
                echo Session::get('flash-message');
                unset($_SESSION['flash-message']);
                unset($_SESSION['flash-level']);
            ?>
        </div>
    <?php } ?>

    <form class="form-horizontal" id="formRegister" method="post" action="<?php echo url('user/register'); ?>">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="firstname" name="firstname">
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="lastname" name="lastname">
            </div>
        </div>
        <div class="form-group">
            <label for="role" class="col-sm-2 control-label">Role</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="role" name="role">
            </div>
        </div>
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
            <label for="pass" class="col-sm-2 control-label">Retype Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="repass" name="repass">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Register</button>
                <a href="<?php echo url('login/index') ?>" class="btn btn-default"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Sign in</a>
            </div>
        </div>
    </form>

</div>

<div class="col-md-2"></div>
<script src="/public/js/signup.js"></script>
