<select class="form-control" name="<?= $name ?>"
        id="<?= $name ?>"
        <? if (isset($required) && $required) echo "data-validation='required'" ?>>
  <option value=""><?= $placeholder ?></option>

  <? foreach (Production::all() as $production): ?>
    <option value="<?= $production->id ?>"
      <?php if (isset($id) && $id == $production->id) {
        echo "selected";
      } ?>>
      <?= $production->title ?>
      (<?= $production->id ?>)
    </option>
  <? endforeach; ?>
</select>
