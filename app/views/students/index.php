<table>
<thead>
  <th>#</th>
  <th>First Name</th>
  <th>Last Name</th>
  <th></th>
  <th></th>
  <th></th>
</thead>
<?php
foreach ($resource as $student):
?>
<tr>
  <td><?= $student->id ?></td>
  <td><?= $student->first_name ?></td>
  <td><?= $student->last_name ?></td>
  <td><a href="/students/<?= $student->id ?>">View</a></td>
  <td><a href="/students/<?= $student->id ?>/edit">Edit</a></td>
  <td><a href="/students/<?= $student->id ?>/destroy">Delete</a></td>
</tr>
<?php
endforeach;
?>
</table>

<a href="/students/new">New Student</a>