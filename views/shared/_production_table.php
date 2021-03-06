<table class="table sortable table-striped">
  <tbody>
    <thead>
      <tr>
        <th>Nr.</th>
        <th>Titel</th>
        <th>Status</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($productions as $production): ?>
        <tr>
          <td>
            <?php echo $h->link_to($production->id, $production); ?>
          </td>

          <td>
            <?php echo $h->link_to($production->title, $production); ?>
          </td>

          <td style="color: <?php echo $production->status()->color ?>;">
            <?php echo $production->status()->name ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </tbody>
</table>
