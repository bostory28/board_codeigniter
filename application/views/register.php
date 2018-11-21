<div>
  <div class="span4"></div>
  <div class="span4">
    <?php echo validation_errors(); ?>
    <form class="form-horizontal" action="./register" method="post">
      <div class="control-group" style="display: inline-block;">
        <label class="control-label" for="inputEmail">Email</label>
        <div class="controls">
          <input type="text" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="nickname">Nickname</label>
        <div class="controls">
          <input type="text" id="nickname" name="nickname" placeholder="Nickname">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="password">Password</label>
        <div class="controls">
          <input type="password" id="password" name="password" placeholder="Password">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="re_password">Confirm Password</label>
        <div class="controls" style="">
          <input type="password" id="re_password" name="re_password" placeholder="Confirm Password">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label"></label>
        <div class="controls">
          <input type="submit" class="btn btn-primary" value="Register" />
        </div>
      </div>
    </form>
  </div>
  <div class="span4"></div>
</div>
