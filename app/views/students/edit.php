<form action="/students/<?= $resource->id ?>/update" method="POST" accept-charset="utf-8">
<input type="hidden" name="_method" value="PUT">
<input type="hidden" name="id" value="<?= $resource->id ?>">
<?php foreach ($resource as $field => $value): ?>
<?php if ($field != "id"): ?>
  <label for="<?= $field ?>"><?= Helper::humanise($field) ?></label><input type="text" name="<?= $field ?>" value="<?= $value ?>" id="<?= $field ?>"><br>
<?php endif; ?>
<?php endforeach; ?>
  <p><input type="submit" value="Continue &rarr;"></p>
</form>
<a href="/students">Back</a>