<select class="form-control power-select" name="<?php echo $name ?>"
        id="<?php echo $name ?>"
        <?php if (isset($required) && $required) echo "data-validation='required'" ?>>
  <option value=""><?php echo $placeholder ?></option>

  <?php foreach (Production::all() as $production): ?>
    <option value="<?php echo $production->id ?>"
      <?php if (isset($id) && $id == $production->id) {
        echo "selected";
      } ?>>
      <?php echo $production->title ?>
      (<?php echo $production->id ?>)
    </option>
  <?php endforeach; ?>
</select>
