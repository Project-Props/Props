<h1 class="main-headline">
  Rediger leverandør
</h1>

<form class="clearfix validate" method="POST" action="/suppliers/create">
  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="supplier[name]">Navn</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="supplier[name]" type="text" id="supplier[name]" data-validation="required" value="<?php echo $supplier->name; ?>">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="supplier[email]">Email</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="supplier[email]" type="text" id="supplier[email]" value="<?php echo $supplier->email; ?>">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="supplier[web_page]">Hjemmeside</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="supplier[web_page]" type="url" id="supplier[web_page]" value="<?php echo $supplier->web_page; ?>">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="supplier[phone]">Telefonnummber</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="supplier[phone]" type="tel" id="supplier[phone]" value="<?php echo $supplier->phone; ?>">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="supplier[street]">Adresse</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="supplier[street]" type="text" id="supplier[street]" value="<?php echo $supplier->street; ?>">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="supplier[city]">By</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="supplier[city]" type="text" id="supplier[city]" value="<?php echo $supplier->city; ?>">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="supplier[zip_code]">Postnr.</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="supplier[zip_code]" type="text" id="supplier[zip_code]" value="<?php echo $supplier->zip_code; ?>">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="supplier[country]">Land</label>
      </div>

      <div class="col-sm-8">
        <input class="form-control" name="supplier[country]" type="text" id="supplier[country]" value="<?php echo $supplier->country; ?>">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="row">
      <div class="col-sm-4">
        <label class="label-inline" for="supplier[comment]">Kommentar</label>
      </div>

      <div class="col-sm-8">
        <textarea class="form-control" name="supplier[comment]" id="supplier[comment]"><?php echo $supplier->comment; ?></textarea>
      </div>
    </div>
  </div>

  <button class="btn btn-primary right" type="submit">Rediger</button>
</form>
