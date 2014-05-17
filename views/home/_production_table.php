<table>
  <tbody>
    <thead>
      <tr>
        <th>Nr.</th>
        <th>Title</th>
        <th>Status</th>
      </tr>
    </thead>

    <tbody>
      <? foreach ($productions as $production): ?>
        <tr>
          <td>
            <?= $h->link_to($production->id, $production); ?>
          </td>

          <td>
            <?= $production->title ?>
          </td>

          <td style="color: <?= $production->status()->color ?>;">
            <?= $production->status()->name ?>
          </td>
        </tr>
      <? endforeach; ?>
    </tbody>
  </tbody>
</table>
