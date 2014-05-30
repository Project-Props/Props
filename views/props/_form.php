<div class="form-group">
  <div class="row">
    <div class="col-sm-4">
      <label class="label-inline" for="prop[prop_nr]">Nummer</label>
    </div>

    <div class="col-sm-8">
      <?php echo $h->input($prop, "prop_nr", "number",
                           ["data-validation" => "required, format:[number]"]); ?>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
    <div class="col-sm-4">
      <label class="label-inline" for="prop[old_prop_nr]">Gammelt nummer</label>
    </div>

    <div class="col-sm-8">
      <?php echo $h->input($prop, "old_prop_nr", "number"); ?>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
    <div class="col-sm-4">
      <label class="label-inline" for="prop[description]">Beskrivelse</label>
    </div>

    <div class="col-sm-8">
      <?php echo $h->input($prop, "description", "text", ["data-validation" => "required"]); ?>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
    <div class="col-sm-4">
      <label class="label-inline" for="prop[section_id]">Sektion</label>
    </div>

    <div class="col-sm-8">
      <?php echo $h->select($prop, "section_id", ["placeholder" => "Vælg en sektion", "data-validation" => "required"]); ?>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
    <div class="col-sm-4">
      <label class="label-inline" for="prop[comment]">Kommentar</label>
    </div>

    <div class="col-sm-8">
    <textarea class="form-control" name="prop[comment]" id="prop[comment]"><?php echo $prop->comment; ?></textarea>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
    <div class="col-sm-4">
      <label class="label-inline" for="prop[supplier_id]">Leverandør</label>
    </div>

    <div class="col-sm-8">
      <?php echo $h->select($prop, "supplier_id", ["placeholder" => "Vælg en leverandør"]); ?>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
    <div class="col-sm-4">
      <label class="label-inline" for="prop[price]">Pris</label>
    </div>

    <div class="col-sm-8">
      <?php echo $h->input($prop, "price", "number"); ?>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
    <div class="col-sm-4">
      <label class="label-inline" for="prop[bought_for_id]">Købt til</label>
    </div>

    <div class="col-sm-8">
      <?php echo $h->select($prop, "bought_for_id", ["placeholder" => "Ingen forestilling"]); ?>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
    <div class="col-sm-4">
      <label class="label-inline" for="prop[status_id]">Status</label>
    </div>

    <div class="col-sm-8">
      <?php echo $h->select($prop, "status_id", ["placeholder" => "Vælg en status"]); ?>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
    <div class="col-sm-4">
      <label class="label-inline" for="prop[size]">Størrelse</label>
    </div>

    <div class="col-sm-8">
      <?php echo $h->input($prop, "size"); ?>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
    <div class="col-sm-4">
      <label class="label-inline" for="prop[category]">Kategori</label>
    </div>

    <div class="col-sm-8">
      <?php echo $h->input($prop, "category"); ?>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
    <div class="col-sm-4">
      <label class="label-inline" for="prop[subcategory]">Under kategori</label>
    </div>

    <div class="col-sm-8">
      <?php echo $h->input($prop, "subcategory"); ?>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
    <div class="col-sm-4">
      <label class="label-inline" for="prop[period_id]">Stil periode</label>
    </div>

    <div class="col-sm-8">
      <?php echo $h->select($prop, "period_id", ["placeholder" => "Vælg en periode"]); ?>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
    <div class="col-sm-4">
      <label class="label-inline" for="prop[creditor]">Creditor</label>
    </div>

    <div class="col-sm-8">
      <?php echo $h->input($prop, "creditor"); ?>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
    <div class="col-sm-4">
      <label class="label-inline" for="prop[maintenance_time]">Velligeholdsestid</label>
    </div>

    <div class="col-sm-8">
      <?php echo $h->input($prop, "maintenance_time"); ?>
    </div>
  </div>
</div>
