<select class="form-control power-select" name="<?php echo $name ?>"
        id="<?php echo $name ?>"
        <? if (isset($required) && $required) echo "data-validation='required'" ?>>
  <option value=""><?php echo $placeholder ?></option>

  <? foreach (Section::all() as $section): ?>
    <option value="<?php echo $section->id ?>"
      <?php if (isset($id) && $id == $section->id) {
        echo "selected";
      } ?>>
      <?php echo $section->name ?>
    </option>
  <? endforeach; ?>
</select>
