<table class="table table-striped">
  <tbody>
    <thead>
      <tr>
        <th>Nr.</th>
        <th>Title</th>
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
            <?php echo $production->title ?>
          </td>

          <td style="color: <?= $production->status()->color ?>;">
            <?php echo $production->status()->name ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </tbody>
</table>
