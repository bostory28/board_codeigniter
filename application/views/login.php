<div class="modal">
  <div class="modal-header">
    <h3>Login</h3>
  </div>
  <form class="form-horizontal" action="./authentication" method="post">
    <div class="modal-body">
        <div class="control-group">
          <label class="control-label" for="inputEmail">Username</label>
          <div class="controls">
            <input type="text" name="email" id="email" placeholder="email">
            <?php
              if ($this->session->flashdata('message')) {
            ?>
                <font color="red">failed login</font>
            <?php
              }
            ?>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputPassword">Password</label>
          <div class="controls">
            <input type="password" name="password" id="password" placeholder="Password">
          </div>
        </div>
    </div>
    <div class="modal-footer">
      <input type="submit" class="btn btn-primary" value="Save changes">
    </div>
  </form>
</div>
