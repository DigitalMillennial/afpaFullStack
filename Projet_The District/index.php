<?php include 'header.php';
include 'connection.php';
include 'demande.php'; ?>

<section class="premier">
  <div class="overlay"></div>
  <section>
    <div class="search-container">
    <input type="text" placeholder="Recherche...">
    <button>Rechercher</button>
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
$popcat = populair(); 

?>
<section id="categories-section" class="categories-section">
  <div class="categories-container">
    <?php
    foreach($popcat as $categori):
    ?>
    <div class="category">
      <a href="plats.php?id=<?php echo $categori->id;?>">
        <img src="img/category/<?php echo $categori->image;?>" alt="Beverages">
        <p><?php echo $categori->libelle;?></p>
      </a>
    </div>
    <?php endforeach;?>
  </div>
</section>
<?php include 'footer.php'; ?>