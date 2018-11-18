<form action="./add" method="post" class="span10">
  <?php echo validation_errors(); ?>
  <input type="text" name="title" placeholder="title" class="span10"/>
  <textarea name="description" placeholder="description" class="span10" rows="15"></textarea><br>
  <input type="submit" class="btn"/>
</form>
<script type="text/javascript" src="/board_codeigniter/static/lib/ckeditor/ckeditor.js"></script>
<script>
  CKEDITOR.replace('description', {
    'filebrowserUploadUrl': './upload_receive_from_ck',
  });
</script>
