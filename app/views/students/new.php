<form action="/students/create" method="POST" accept-charset="utf-8">
<?php foreach ($resource as $field => $value): ?>
<?php if ($field != "id"): ?>
  <label for="<?= $field ?>"><?= Helper::humanise($field) ?></label><input type="text" name="<?= $field ?>" value="" id="<?= $field ?>"><br>
<?php endif; ?>
<?php endforeach; ?>
  <p><input type="submit" value="Continue &rarr;"></p>
</form>
<a href="/students">Back</a>