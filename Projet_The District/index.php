<?php include 'header.php';
include 'connection.php';
include 'demande.php'; ?>

<section class="premier">
  <div class="overlay"></div>
    <section>
      <div class="search-container">
        <form method="GET" action="demande.php">
            <input type="text" name="query" placeholder="Recherche...">
            <button type="submit">Rechercher</button>
        </form>
      </div>
    </section>
  
  <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="/img/economiseur.mp4" type="video/mp4">
  </video>
  
  <div class="container h-100 d-flex flex-column justify-content-center align-items-center ">
    <h1>Bienvenue dans notre restaurant!</h1>
    <a href="#categories-section" class="btn btn-primary">Voir les catégories</a>
  </div>
</section>

<?php
// Получение популярных категорий из базы
$popcat = populair(); 
?>

<section id="categories-section" class="categories-section">
  <div class="categories-container">
    <?php
    foreach ($popcat as $categori):
        // Экранирование данных для безопасного вывода
        $categoryId = htmlspecialchars($categori->id, ENT_QUOTES, 'UTF-8');
        $categoryImage = htmlspecialchars($categori->image, ENT_QUOTES, 'UTF-8');
        $categoryLabel = htmlspecialchars($categori->libelle, ENT_QUOTES, 'UTF-8');
    ?>
    <div class="category">
      <a href="plats.php?id=<?php echo $categoryId; ?>">
        <img src="img/category/<?php echo $categoryImage; ?>" alt="Beverages">
        <p><?php echo $categoryLabel; ?></p>
      </a>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<?php include 'footer.php'; ?>
