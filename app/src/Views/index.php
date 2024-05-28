<?php include('nav.php'); ?>

<div class="container mt-4">
  <h1>Liste des Articles</h1>
  <ul class="list-group">
    <?php foreach ($posts as $post): ?>
      <li class="list-group-item">
        <h3><?php echo $post['title']; ?></h3>
        <p><?php echo $post['content']; ?></p>
      </li>
    <?php endforeach; ?>
  </ul>
</div>