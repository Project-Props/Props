<div class="row header">
  <div class="col-sm-6">
    <h1>
      <?php echo $supplier->name; ?>
    </h1>
  </div>

  <div class="col-sm-6">
    <a class="btn btn-primary right" href="/suppliers/edit?id=<?php echo $supplier->id; ?>">Rediger</a>
  </div>
</div>

<dl>
  <dt>
    Navn:
  </dt>
  <dd>
    <?php echo $supplier->name; ?>
  </dd>

  <dt>
    Email:
  </dt>
  <dd>
    <!-- TODO: make mailto link -->
    <?php echo $supplier->email; ?>
  </dd>

  <dt>
    Hjemmeside:
  </dt>
  <dd>
    <!-- TODO: make link -->
    <?php echo $supplier->web_page; ?>
  </dd>

  <dt>
    Telefon:
  </dt>
  <dd>
    <?php echo $supplier->phone; ?>
  </dd>

  <dt>
    Adresse:
  </dt>
  <dd>
    <?php echo $supplier->street; ?>
  </dd>

  <dt>
    By:
  </dt>
  <dd>
    <?php echo $supplier->city; ?>
  </dd>

  <dt>
    Postnr.:
  </dt>
  <dd>
    <?php echo $supplier->zip_code; ?>
  </dd>

  <dt>
    Land:
  </dt>
  <dd>
    <?php echo $supplier->country; ?>
  </dd>
</dl>

<div class="description">
  <p>
    <?php echo $supplier->comment; ?>
  </p>
</div>
