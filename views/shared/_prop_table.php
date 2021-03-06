<table class="table sortable table-striped">
  <tbody>
    <thead>
      <tr>
        <th>Nr.</th>
        <th>Beskrivelse</th>
        <th>Status</th>
        <th>Sidst opdateret</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($props as $prop): ?>
        <tr>
          <td>
            <?php echo $h->link_to($prop->prop_nr, $prop); ?>
          </td>

          <td>
            <?php echo $h->link_to($prop->description, $prop); ?>
          </td>

          <td style="color: <?php echo $prop->status()->color ?>;">
            <?php echo $prop->status()->name ?>
          </td>

          <td>
            <?php echo $prop->date_added ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </tbody>
</table>
