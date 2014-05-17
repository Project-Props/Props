<table>
  <tbody>
    <thead>
      <tr>
        <th>Nr.</th>
        <th>Beskrivelse</th>
        <th>Status</th>
        <th>Date added</th>
      </tr>
    </thead>

    <tbody>
      <? foreach ($props as $prop): ?>
        <tr>
          <td>
            <?= $h->link_to($prop->prop_nr, $prop); ?>
          </td>

          <td>
            <?= $prop->description ?>
          </td>

          <td style="color: <?= $prop->status()->color ?>;">
            <?= $prop->status()->name ?>
          </td>

          <td>
            <?= $prop->date_added ?>
          </td>
        </tr>
      <? endforeach; ?>
    </tbody>
  </tbody>
</table>
