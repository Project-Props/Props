<ul>
  <?php foreach ($props as $prop): ?>
    <li>
      <?php echo $prop->description; ?>
    </li>
  <?php endforeach; ?>
</ul>

<ul>
  <?php foreach ($productions as $production): ?>
    <li>
      <?php echo $production->title; ?>
    </li>
  <?php endforeach; ?>
</ul>
