<div class="span10">
  <article>
    <h1><?=$topic->title?></h1>
    <div>
      <div><?=kdate($topic->created)?></div>
      <?=auto_link($topic->description)?>
    </div>
  </article>
  <div>
    <a href="./add" class="btn">ADD</a>
    <a href="./remove/<?=$topic->id?>" class="btn">REMOVE</a>
  </div>
</div>
