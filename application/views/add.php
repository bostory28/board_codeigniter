<form action="/board_codeigniter/index.php/topic/add" method="post" class="span10">
  <?php echo validation_errors(); ?>
  <input type="text" name="title" placeholder="제목" class="span10"/>
  <textarea name="description" placeholder="제목" class="span10" rows="15"></textarea><br>
  <input type="submit" class="btn"/>
</form>
