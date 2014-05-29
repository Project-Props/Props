<h1 class="main-headline">Lav ny prop</h1>

<form class="clearfix validate" method="POST" action="/props/create">
  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="prop[prop_nr]">Nummer</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" data-validation="required, format:[number]" name="prop[prop_nr]" type="number" id="prop[prop_nr]">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="prop[old_prop_nr]">Gammelt nummer</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="prop[old_prop_nr]" type="number" id="prop[old_prop_nr]">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="prop[description]">Beskrivelse</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="prop[description]" type="text" id="prop[description]" data-validation="required">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="prop[section_id]">Sektion</label>
      </div>

      <div class="col-sm-8">
        <?php $this->render_partial("shared/_select_section.php",
        ["name" => "prop[section_id]",
        "placeholder" => "Vælg en sektion",
        "required" => true]); ?>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="prop[comment]">Kommentar</label>
      </div>

      <div class="col-sm-8">
        <textarea class="form-control" name="prop[comment]" id="prop[comment]"></textarea>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="prop[supplier_id]">Leverandør</label>
      </div>

      <div class="col-sm-8">
        <select class="form-control power-select" id="prop[supplier_id]" name="prop[supplier_id]">
          <option value="">Vælg en leverandør</option>
          <?php foreach (Supplier::all() as $supplier): ?>
          <option value="<?php echo $supplier->id ?>"><?php echo $supplier->name ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="prop[price]">Pris</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="prop[price]" type="number" id="prop[price]">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="prop[bought_for_id]">Købt til</label>
      </div>

      <div class="col-sm-8">
        <?php $this->render_partial("shared/_select_production.php",
        ["name" => "prop[bought_for_id]",
        "placeholder" => "Brugt i"]); ?>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="prop[status_id]">Status</label>
      </div>

      <div class="col-sm-8">
        <select class="form-control power-select" id="prop[status_id]" name="prop[status_id]" data-validation="required">
          <option value="">Vælg en status</option>
          <?php foreach (PropStatus::all() as $status): ?>
          <option value="<?php echo $status->id ?>"><?php echo $status->name ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="prop[size]">Størrelse</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="prop[size]" type="text" id="prop[size]">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="prop[category]">Kategori</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="prop[category]" type="text" id="prop[category]">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="prop[subcategory]">Under kategori</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="prop[subcategory]" type="text" id="prop[subcategory]">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="prop[period_id]">Stil periode</label>
      </div>

      <div class="col-sm-8">
        <select class="form-control power-select" id="prop[period_id]" name="prop[period_id]">
          <option value="">Vælg en periode</option>
          <?php foreach (Period::all() as $period): ?>
          <option value="<?php echo $period->id ?>"><?php echo $period->name ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="prop[creditor]">Creditor</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="prop[creditor]" type="text" id="prop[creditor]">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="prop[maintenance_time]">Velligeholdsestid</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="prop[maintenance_time]" type="text" id="prop[maintenance_time]">
      </div>
    </div>
  </div>

  <button class="btn btn-primary right" type="submit">Tilføj</button>
</form>
