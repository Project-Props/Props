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
            <a href="/productions/show?id=<?= $production->id ?>">
              <?= $production->id ?>
            </a>
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
