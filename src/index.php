<?php require_once 'parts/header.php'; ?>

<section id="form-post" class="container mt-5">
  <form action="scripts/post-create-script.php" method="POST">
    <div class="mb-3">
      <input type="text" class="form-control" placeholder="Title">
    </div>
    <input type="submit" value="Envoyer">
  </form>
</section>

<section id="post-list" class="container mt-5">
  <ul>
    <li>Lorem, ipsum dolor.</li>
    <li>Enim, corrupti veniam!</li>
    <li>Fugit, doloribus voluptatem!</li>
    <li>Laboriosam, voluptas fugit.</li>
  </ul>
</section>

<?php require_once 'parts/footer.php'; ?>