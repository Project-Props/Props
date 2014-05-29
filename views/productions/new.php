<h1 class="main-headline">
  Lav ny forestilling
</h1>

<form class="clearfix validate" method="POST" action="/productions/create">
  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="production[id]">Nummer</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="production[id]" type="text" id="production[id]" data-validation="required">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="production[title]">Titel</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="production[title]" type="text" id="production[title]" data-validation="required">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="production[status_id]">Status</label>
      </div>

      <div class="col-sm-8">
        <select class="form-control power-select" id="production[status_id]" name="production[status_id]" data-validation="required">
          <option value="">Vælg en status</option>
          <?php foreach (ProductionStatus::all() as $status): ?>
          <option value="<?php echo $status->id ?>"><?php echo $status->name ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="production[premiere_date]">Præmiere dato</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="production[premiere_date]" type="date" id="production[premiere_date]">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="production[venue]">Spillested</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="production[venue]" type="text" id="production[venue]">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="production[instructor]">Instruktør</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="production[instructor]" type="text" id="production[instructor]">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="production[venue]">Spillested</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="production[venue]" type="text" id="production[venue]">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="production[scenographer]">Scenograf</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="production[scenographer]" type="text" id="production[scenographer]">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="production[choreographer]">Chorekograf</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="production[choreographer]" type="text" id="production[choreographer]">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="production[stage_manager]">Scenemester</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="production[stage_manager]" type="text" id="production[stage_manager]">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="production[storage]">Opbevaringssted</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="production[storage]" type="text" id="production[storage]">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="production[comment]">Kommatrer</label>
      </div>

      <div class="col-sm-8">
        <textarea class="form-control" name="production[comment]" id="production[comment]"></textarea>
      </div>
    </div>
  </div>

  <button class="btn btn-primary right" type="submit">Tilføj</button>
</form>
