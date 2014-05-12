<form method="POST" action="/props/create">
  <div class="field">
    <label for="prop[prop_nr]">Nummer</label>
    <input name="prop[prop_nr]" type="number" id="prop[prop_nr]" required>
  </div>

  <div class="field">
    <label for="prop[old_prop_nr]">Gammelt nummer</label>
    <input name="prop[old_prop_nr]" type="number" id="prop[old_prop_nr]">
  </div>

  <div class="field">
    <label for="prop[description]">Beskrivelse</label>
    <input name="prop[description]" type="text" id="prop[description]" required>
  </div>

  <div class="field">
    <label for="prop[section_id]">Sektion</label>

    <? $this->render_partial("shared/_select_section.php",
      ["name" => "prop[section_id]",
       "placeholder" => "Vælg en sektion",
       "required" => true]); ?>
  </div>

  <div class="field">
    <label for="prop[comment]">Kommentar</label>
    <textarea name="prop[comment]" id="prop[comment]"></textarea>
  </div>

  <div class="field">
    <label for="prop[supplier_id]">Leverandør</label>

    <select id="prop[supplier_id]" name="prop[supplier_id]">
      <option value="">Vælg en leverandør</option>
      <? foreach (Supplier::all() as $supplier): ?>
        <option value="<?= $supplier->id ?>"><?= $supplier->name ?></option>
      <? endforeach; ?>
    </select>
  </div>

  <div class="field">
    <label for="prop[price]">Pris</label>
    <input name="prop[price]" type="number" id="prop[price]">
  </div>

  <div class="field">
    <label for="prop[bought_for_id]">Købt til</label>

    <? $this->render_partial("shared/_select_production.php",
      ["name" => "prop[bought_for_id]",
       "placeholder" => "Brugt i"]); ?>
  </div>

  <div class="field">
    <label for="prop[status_id]">Status</label>

    <select id="prop[status_id]" name="prop[status_id]" required>
      <option value="">Vælg en status</option>
      <? foreach (PropStatus::all() as $status): ?>
        <option value="<?= $status->id ?>"><?= $status->name ?></option>
      <? endforeach; ?>
    </select>
  </div>

  <div class="field">
    <label for="prop[size]">Størrelse</label>
    <input name="prop[size]" type="text" id="prop[size]">
  </div>

  <div class="field">
    <label for="prop[category]">Kategori</label>
    <input name="prop[category]" type="text" id="prop[category]">
  </div>

  <div class="field">
    <label for="prop[subcategory]">Under kategori</label>
    <input name="prop[subcategory]" type="text" id="prop[subcategory]">
  </div>

  <div class="field">
    <label for="prop[period_id]">Stil periode</label>

    <select id="prop[period_id]" name="prop[period_id]">
      <option value="">Vælg en periode</option>
      <? foreach (Period::all() as $period): ?>
        <option value="<?= $period->id ?>"><?= $period->name ?></option>
      <? endforeach; ?>
    </select>
  </div>

  <div class="field">
    <label for="prop[creditor]">Creditor</label>
    <input name="prop[creditor]" type="text" id="prop[creditor]">
  </div>

  <div class="field">
    <label for="prop[maintenance_time]">Velligeholdsestid</label>
    <input name="prop[maintenance_time]" type="text" id="prop[maintenance_time]">
  </div>

  <div class="actions">
    <input type="submit" value="Tilføj">
  </div>
</form>
