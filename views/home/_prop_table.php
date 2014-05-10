<table>
  <tbody>
    <thead>
      <tr>
        <th>Nr.</th>
        <th>Beskrivelse</th>
        <th>Status</th>
      </tr>
    </thead>

    <tbody>
      <? foreach ($props as $prop): ?>
        <tr>
          <td>
            <a href="/props/show?id=<?= $prop->id ?>">
              <?= $prop->prop_nr ?>
            </a>
          </td>

          <td>
            <?= $prop->description ?>
          </td>

          <td style="color: <?= $prop->status()->color ?>;">
            <?= $prop->status()->name ?>
          </td>
        </tr>
      <? endforeach; ?>
    </tbody>
  </tbody>
</table>
