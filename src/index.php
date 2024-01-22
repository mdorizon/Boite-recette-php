<?php require_once 'parts/header.php'; ?>

<section id="form-post" class="container mt-5">
  <form action="scripts/post-create-script.php" method="POST">
    <div class="mb-3">
      <input type="text" class="form-control" placeholder="Title" name="title">
    </div>

    <?php if(isset($_GET['error'])) : ?>
    <div class="alert alert-danger">
      <?php echo $_GET['error']; ?>
    </div>
    <?php endif; ?>

    <?php if(isset($_GET['success'])) : ?>
    <div class="alert alert-success">
      <?php echo $_GET['success']; ?>
    </div>
    <?php endif; ?>

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