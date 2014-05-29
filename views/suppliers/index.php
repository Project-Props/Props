<?php if (sizeof($suppliers) == 0): ?>
  Der er ingen leverandører
<?php else: ?>
  <h1 class="main-headline">Leverandører</h1>

  <table class="table sortable table-striped">
    <tbody>
      <thead>
        <tr>
          <th>Navn</th>
          <th>Email</th>
          <th>Adresse</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($suppliers as $supplier): ?>
          <tr>
            <td>
              <?php echo $h->link_to($supplier->name, $supplier); ?>
            </td>

            <td>
              <?php echo $h->link_to($supplier->email, $supplier); ?>
            </td>

            <td>
              <?php echo $supplier->street; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </tbody>
  </table>
<?php endif; ?>
