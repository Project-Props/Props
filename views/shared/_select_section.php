<select name="<?= $name ?>"
        id="<?= $name ?>"
        <? if (isset($required) && $required) echo "required" ?>>
  <option value=""><?= $placeholder ?></option>

  <? foreach (Section::all() as $section): ?>
    <option value="<?= $section->id ?>">
      <?= $section->name ?>
    </option>
  <? endforeach; ?>
</select>
