<div class="row header">
  <div class="col-sm-6">
    <h1>
      <?php echo $prop->description; ?>
    </h1>
  </div>

  <div class="col-sm-6">
    <a class="btn btn-danger right" href="/props/delete?id=<?php echo $prop->id; ?>">Slet</a>
    <a class="btn btn-primary right" href="/props/edit?id=<?php echo $prop->id; ?>">Rediger</a>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <dl>
      <dt>
        Nummer:
      </dt>
      <dd>
        <?php echo $prop->prop_nr; ?>
      </dd>

      <dt>
        Gammelt nummer:
      </dt>
      <dd>
        <?php echo $prop->old_prop_nr; ?>
      </dd>

      <dt>
        Sektion:
      </dt>
      <dd>
        <?php echo $prop->section()->name; ?>
      </dd>

      <dt>
        Tilføjet den:
      </dt>
      <dd>
        <?php echo $prop->date_added; ?>
      </dd>

      <dt>
        Opdateret den:
      </dt>
      <dd>
        <?php echo $prop->date_updated; ?>
      </dd>

      <dt>
        Leverandør:
      </dt>
      <dd>
        <?php echo $h->link_to($prop->supplier()->name, $prop->supplier()); ?>
      </dd>

      <dt>
        Pris:
      </dt>
      <dd>
        <?php echo $prop->price; ?>
      </dd>

      <dt>
        Købt til:
      </dt>
      <dd>
        <?php echo $prop->bought_for()->title; ?>
      </dd>

      <dt>
        Brugt i:
      </dt>
      <dd>
        <?php
          $used_in_productions = $prop->used_in();
          echo "<select>";
          foreach ($used_in_productions as $production) {
            echo "<option>".$production->title."</option>";
          }
          echo "</select>";
        ?>
      </dd>

      <dt>
        Status:
      </dt>
      <dd>
        <span style="color: <?php echo $prop->status()->color ?>;">
          <?php echo $prop->status()->name ?>
        </span>
      </dd>

      <dt>
        Størrelse:
      </dt>
      <dd>
        <?php echo $prop->size; ?>
      </dd>

      <dt>
        Kategori:
      </dt>
      <dd>
        <?php echo $prop->category; ?>
      </dd>

      <dt>
        Underkategori:
      </dt>
      <dd>
        <?php echo $prop->subcategory; ?>
      </dd>

      <dt>
        Stilperiode:
      </dt>
      <dd>
        <?php echo $prop->period()->name; ?>
      </dd>

      <dt>
        Kategori:
      </dt>
      <dd>
        <?php echo $prop->category; ?>
      </dd>

      <dt>
        Slettet:
      </dt>
      <dd>
        <?php
          if ($prop->deleted) {
            echo "Ja";
          } else {
            echo "Nej";
          }
        ?>
      </dd>

      <dt>
        Creditor:
      </dt>
      <dd>
        <?php echo $prop->creditor; ?>
      </dd>

      <dt>
        Velligeholdsestid:
      </dt>
      <dd>
        <?php echo $prop->maintenance_time; ?>
      </dd>
    </dl>
  </div>

  <div class="col-sm-6">
    <img src="http://placehold.it/500x500" alt="Billede">
  </div>
</div>

<div class="description">
  <p>
    <?php echo $prop->comment; ?>
  </p>
</div>
