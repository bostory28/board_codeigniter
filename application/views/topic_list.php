<div class="span2">
  <ul class="nav nav-tabs nav-stacked">
  <?php
  foreach ($topics as $entry) {
  ?>
    <li> <a href="./<?=$entry->id?>"><?= $entry->title ?></a></li>
  <?php
  }
  ?>
  </ul>
</div>
