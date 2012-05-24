<form action="/students/<?= $resource->id ?>/update" method="POST" accept-charset="utf-8">
<input type="hidden" name="_method" value="PUT">
<input type="hidden" name="id" value="<?= $resource->id ?>">
<label for="first_name">First name</label><input type="text" name="first_name" value="<?= $resource->first_name ?>" id="first_name" required="required"><br>
<label for="last_name">Last name</label><input type="text" name="last_name" value="<?= $resource->last_name ?>" id="last_name" required="required"><br>
<label for="dob">Date of birth</label><input type="date" name="dob" value="<?= $resource->dob ?>" id="dob" class="datepicker"><br>
<label for="gender">Gender</label>
<select name="gender" id="gender">
  <option value="">Select...</option>
  <option value="Male"<?php if ($resource->gender == "Male") echo " selected='selected'"; ?>>Male</option>
  <option value="Female"<?php if ($resource->gender == "Female") echo " selected='selected'"; ?>>Female</option>
</select>
<br>
<label for="address_line_1">Address line 1</label><input type="text" name="address_line_1" value="<?= $resource->address_line_1 ?>" id="address_line_1"><br>
<label for="address_line_2">Address line 2</label><input type="text" name="address_line_2" value="<?= $resource->address_line_2 ?>" id="address_line_2"><br>
<label for="address_line_3">Address line 3</label><input type="text" name="address_line_3" value="<?= $resource->address_line_3 ?>" id="address_line_3"><br>
<label for="town_city">Town / City</label><input type="text" name="town_city" value="<?= $resource->town_city ?>" id="town_city"><br>
<label for="county">County</label><input type="text" name="county" value="<?= $resource->county ?>" id="county"><br>
<label for="postcode">Postcode</label><input type="text" name="postcode" value="<?= $resource->postcode ?>" id="postcode"><br>
<label for="email">Email</label><input type="email" name="email" value="<?= $resource->email ?>" id="email" required="required"><br>
<label for="current_year_group">Current year group</label><input type="number" min="7" max="11" name="current_year_group" value="<?= $resource->current_year_group ?>" id="current_year_group" required="required"><br>

  <p><input type="submit" value="Continue &rarr;"></p>
</form>
<a href="/students">Back</a>