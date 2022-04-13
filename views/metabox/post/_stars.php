<?php
$star = self::getmeta('rating'); ?>
<span class="star-cb-group">
  <?php
  for ($i = 10; $i > 0; $i--) :
    $cls = "";
    if ($i == 0) :
      $cls = "star-cb-clear";
    endif;
  ?>
    <input type="radio" id="rating-<?= $i ?>" class="<?= $cls ?>" name="wppack_fields[rating]" value="<?= $i ?>" <?php if ($star == $i) echo "checked" ?> /><label for="rating-<?= $i ?>"><?= $i ?></label>

  <?php endfor; ?>
</span>