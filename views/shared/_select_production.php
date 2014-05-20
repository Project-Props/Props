<select class="form-control" name="<?= $name ?>"
        id="<?= $name ?>"
        <? if (isset($required) && $required) echo "data-validation='required'" ?>>
  <option value=""><?= $placeholder ?></option>

  <? foreach (Production::all() as $production): ?>
    <option value="<?= $production->id ?>">
      <?= $production->title ?>
      (<?= $production->id ?>)
    </option>
  <? endforeach; ?>
</select>
