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
<?php 
// connect to db
$connectDatabase = new PDO("mysql:host=db;dbname=wordpress", "root", "admin");
// prepare request INSERT INTO posts (title) VALUES (:title)
$request = $connectDatabase->prepare("SELECT * FROM `posts`");
// execute request
$request->execute();
// fetch all data from table posts
$posts = $request->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- show data in html -->
<section id="post-list" class="container mt-5">
  <ul>
    <?php foreach ($posts as $post) : ?>
    <li>
      <!-- htmlspecialchars pour protection contre attaque xss -->
      <?php echo htmlspecialchars($post['title']); ?>
      <a href="scripts/post-delete-script.php?id=<?php echo $post['id']; ?>">DELETE</a>
    </li>
    <?php endforeach; ?>
  </ul>
</section>

<?php require_once 'parts/footer.php'; ?>