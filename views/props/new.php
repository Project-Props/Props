<form method="POST" action="/props/create">
  <div class="field">
    <label for="prop_nr">Nummer</label>
    <input name="prop[prop_nr]" type="number" id="prop_nr" required>
  </div>

  <div class="field">
    <label for="old_prop_nr">Gammelt nummer</label>
    <input name="prop[old_prop_nr]" type="number" id="old_prop_nr">
  </div>

  <div class="field">
    <label for="description">Beskrivelse</label>
    <input name="prop[description]" type="text" id="description" required>
  </div>

  <div class="field">
    <label for="section_id">Sektion</label>

    <select id="section_id" name="prop[section_id]" required>
      <option value="">Vælg en sektion</option>
      <? foreach (Section::all() as $section): ?>
        <option value="<?= $section->id ?>"><?= $section->name ?></option>
      <? endforeach; ?>
    </select>
  </div>

  <div class="field">
    <label for="comment">Kommentar</label>
    <textarea name="prop[comment]" id="comment"></textarea>
  </div>

  <div class="field">
    <label for="supplier_id">Leverandør</label>

    <select id="supplier_id" name="prop[supplier_id]">
      <option value="">Vælg en leverandør</option>
      <? foreach (Supplier::all() as $supplier): ?>
        <option value="<?= $supplier->id ?>"><?= $supplier->name ?></option>
      <? endforeach; ?>
    </select>
  </div>

  <div class="field">
    <label for="price">Pris</label>
    <input name="prop[price]" type="number" id="price">
  </div>

  <div class="field">
    <label for="bought_for_id">Købt til</label>

    <select id="bought_for_id" name="prop[bought_for_id]">
      <option value="">Vælg en forestilling</option>
      <? foreach (Production::all() as $production): ?>
        <option value="<?= $production->id ?>"><?= $production->title ?></option>
      <? endforeach; ?>
    </select>
  </div>

  <div class="field">
    <label for="status_id">Status</label>

    <select id="status_id" name="prop[status_id]" required>
      <option value="">Vælg en status</option>
      <? foreach (PropStatus::all() as $status): ?>
        <option value="<?= $status->id ?>"><?= $status->name ?></option>
      <? endforeach; ?>
    </select>
  </div>

  <div class="field">
    <label for="size">Størrelse</label>
    <input name="prop[size]" type="text" id="size">
  </div>

  <div class="field">
    <label for="category">Kategori</label>
    <input name="prop[category]" type="text" id="category">
  </div>

  <div class="field">
    <label for="subcategory">Under kategori</label>
    <input name="prop[subcategory]" type="text" id="subcategory">
  </div>

  <div class="field">
    <label for="period_id">Stil periode</label>

    <select id="period_id" name="prop[period_id]">
      <option value="">Vælg en periode</option>
      <? foreach (Period::all() as $period): ?>
        <option value="<?= $period->id ?>"><?= $period->name ?></option>
      <? endforeach; ?>
    </select>
  </div>

  <div class="field">
    <label for="creditor">Creditor</label>
    <input name="prop[creditor]" type="text" id="creditor">
  </div>

  <div class="field">
    <label for="maintenance_time">Velligeholdsestid</label>
    <input name="prop[maintenance_time]" type="text" id="maintenance_time">
  </div>

  <div class="actions">
    <input type="submit" value="Tilføj">
  </div>
</form>
