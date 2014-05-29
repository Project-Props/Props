<div class="row prop-header">
  <div class="col-sm-6">
    <h1>
      <?php echo $production->title; ?>
    </h1>
  </div>

  <div class="col-sm-6">
    <a class="btn btn-primary right" href="/production/edit?id=<?php echo $production->id; ?>">Rediger</a>
  </div>
</div>

<dl>
  <dt>
    Nummer:
  </dt>
  <dd>
    <?php echo $production->id; ?>
  </dd>

  <dt>
    Titel:
  </dt>
  <dd>
    <?php echo $production->title; ?>
  </dd>

  <dt>
    Status:
  </dt>
  <dd>
    <?php echo $production->status()->name; ?>
  </dd>

  <dt>
    Præmiere dato:
  </dt>
  <dd>
    <?php echo $production->premiere_date; ?>
  </dd>

  <dt>
    Spillested:
  </dt>
  <dd>
    <?php echo $production->venue; ?>
  </dd>

  <dt>
    Instruktør:
  </dt>
  <dd>
    <?php echo $production->instructor; ?>
  </dd>

  <dt>
    Scenograf:
  </dt>
  <dd>
    <?php echo $production->scenographer; ?>
  </dd>

  <dt>
    Choreograf:
  </dt>
  <dd>
    <?php echo $production->choreographer; ?>
  </dd>

  <dt>
    Scenemester:
  </dt>
  <dd>
    <?php echo $production->stage_manager; ?>
  </dd>

  <dt>
    Opbevaringssted:
  </dt>
  <dd>
    <?php echo $production->storage; ?>
  </dd>

  <dt>
    Tilføjet den:
  </dt>
  <dd>
    <?php echo $production->date_added; ?>
  </dd>

  <dt>
    Opdateret den:
  </dt>
  <dd>
    <?php echo $production->date_updated; ?>
  </dd>
</dl>

<div class="description">
  <p>
    <?php echo $production->comment; ?>
  </p>
</div>
