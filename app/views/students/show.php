<table>
<?php
foreach ($resource as $field => $value):
?>
  <tr><th><?= Helper::humanise($field) ?></th><td><?= $value ?></td></tr>
<?php
endforeach;
?>
</table>
<a href="/students">Back</a>
