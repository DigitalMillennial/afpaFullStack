<?php include 'header.php'; ?>

<main class="container-fluid">
  <div class="row">
    <!-- Корзина -->
    <div class="col-12" id="cart-section">
      <section class="cart-section p-3 bg-light rounded">
        <h2>Votre Panier</h2>
        <ul id="cart-items" class="list-group">
          <!-- Продукты будут динамически добавляться сюда -->
        </ul>
        <div class="cart-total mt-3" id="cart-total">
          <p>Total: <span id="total-price">0</span> €</p>
          <!-- Кнопка оплаты -->
          <button id="checkout-button" class="btn btn-primary">
            Procéder au paiement
          </button>
        </div>
      </section>
    </div>

    <!-- Форма -->
    <div class="col-12" id="form-section" style="display: none">
      <section class="contact-section p-3 bg-light rounded">
        <h1>Contactez-Nous</h1>
        <form class="contact-form" action="process_form.php" method="POST">  
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="name">Nom</label>
              <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                placeholder="Nom"
                required
              />
              <div class="invalid-feedback">Ce champ est obligatoire</div>
            </div>
            <div class="form-group col-md-6">
              <label for="surname">Prénom</label>
              <input
                type="text"
                class="form-control"
                id="surname"
                name="surname"
                placeholder="Prénom"
                required
              />
              <div class="invalid-feedback">Ce champ est obligatoire</div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="email">Email</label>
              <input
                type="email"
                class="form-control"
                id="email"
                name="email"
                placeholder="Email"
                required
              />
              <div class="invalid-feedback">Ce champ est obligatoire</div>
            </div>
            <div class="form-group col-md-6">
              <label for="phone">Téléphone</label>
              <input
                type="tel"
                class="form-control"
                id="phone"
                name="phone"
                placeholder="Téléphone"
                required
              />
              <div class="invalid-feedback">Ce champ est obligatoire</div>
            </div>
          </div>
          <div class="form-group">
            <label for="message">Votre demande</label>
            <textarea
              class="form-control"
              id="message"
              name="message"
              rows="4"
              placeholder="Votre message"
              required
            ></textarea>
            <div class="invalid-feedback">Ce champ est obligatoire</div>
          </div>
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
      </section>
    </div>
  </div>
</main>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
