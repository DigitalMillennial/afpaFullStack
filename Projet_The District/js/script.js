document.addEventListener('DOMContentLoaded', function () {

    // === Функциональность для страницы с товарами ===
    if (document.querySelector('.categories-section')) {
        document.querySelectorAll('.category').forEach(category => {
            const minusBtn = category.querySelector('.minus-btn');
            const plusBtn = category.querySelector('.plus-btn');
            const quantity = category.querySelector('.quantity');
            const itemName = category.querySelector('p').textContent;
            const itemPrice = parseFloat(category.querySelector('.price').textContent.replace('€', '').trim());
            const itemImage = category.querySelector('img').getAttribute('src'); // Получаем точный путь к изображению
  
            plusBtn.addEventListener('click', () => {
                let currentQuantity = parseInt(quantity.textContent);
                currentQuantity++;
                quantity.textContent = currentQuantity;
                minusBtn.disabled = false;
                updateCart(itemName, itemPrice, currentQuantity, itemImage); // Передаем путь к изображению
            });
  
            minusBtn.addEventListener('click', () => {
                let currentQuantity = parseInt(quantity.textContent);
                if (currentQuantity > 0) {
                    currentQuantity--;
                    quantity.textContent = currentQuantity;
                    updateCart(itemName, itemPrice, currentQuantity, itemImage); // Передаем путь к изображению
                }
                if (currentQuantity === 0) {
                    minusBtn.disabled = true;
                }
            });
        });
  
        function updateCart(name, price, quantity, image) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const itemIndex = cart.findIndex(item => item.name === name);
  
            if (itemIndex > -1) {
                if (quantity > 0) {
                    cart[itemIndex].quantity = quantity;
                } else {
                    cart.splice(itemIndex, 1);
                }
            } else {
                if (quantity > 0) {
                    cart.push({ name, price, quantity, image }); // Сохраняем путь к изображению
                }
            }
  
            localStorage.setItem('cart', JSON.stringify(cart));
        }
  
    } else if (document.getElementById('cart-section')) {
        const checkoutButton = document.getElementById('checkout-button');
        const cartSection = document.getElementById('cart-section');
        const formSection = document.getElementById('form-section');
        const totalPriceElement = document.getElementById('total-price');
  
        const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
        const cartItemsList = document.getElementById('cart-items');
  
        let total = 0;
  
        cartItems.forEach(item => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.innerHTML = `
                <div class="item-details d-flex align-items-center">
                    <img src="${item.image}" alt="${item.name}" style="width: 50px; height: 50px; margin-right: 10px;"> <!-- Используем путь из базы -->
                    <strong>${item.name}</strong>
                </div>
                <div class="quantity-control d-flex align-items-center">
                    <button class="minus-btn btn btn-light" data-name="${item.name}" style="margin-right: 5px;">-</button>
                    <span class="quantity">${item.quantity}</span>
                    <button class="plus-btn btn btn-light" data-name="${item.name}" style="margin-left: 5px;">+</button>
                </div>
                <span class="item-price" style="margin-left: 15px;">${item.price * item.quantity} €</span>
            `;
            cartItemsList.appendChild(li);
            total += item.quantity * item.price;
        });
  
        totalPriceElement.textContent = total;
  
        cartItemsList.addEventListener('click', (e) => {
            if (e.target.classList.contains('plus-btn')) {
                const itemName = e.target.getAttribute('data-name');
                updateCartInList(itemName, 1);
            }
  
            if (e.target.classList.contains('minus-btn')) {
                const itemName = e.target.getAttribute('data-name');
                updateCartInList(itemName, -1);
            }
        });
  
        function updateCartInList(name, change) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const itemIndex = cart.findIndex(item => item.name === name);
  
            if (itemIndex > -1) {
                cart[itemIndex].quantity += change;
  
                if (cart[itemIndex].quantity <= 0) {
                    cart.splice(itemIndex, 1);
                }
            }
  
            localStorage.setItem('cart', JSON.stringify(cart));
            location.reload();
        }
  
        checkoutButton.addEventListener('click', function () {
            cartSection.style.display = 'none';
            formSection.style.display = 'block';
            localStorage.removeItem('cart'); // Очистка корзины после перехода к оплате
        });
  
    } else {
        const searchButton = document.querySelector('button');
        const searchInput = document.querySelector('input[type="text"]');
  
        if (searchButton && searchInput) {
            searchButton.addEventListener('click', () => {
                const searchQuery = searchInput.value.toLowerCase();
                document.querySelectorAll('.category').forEach(category => {
                    const itemName = category.querySelector('p').textContent.toLowerCase();
                    if (itemName.includes(searchQuery)) {
                        category.style.display = 'block';
                    } else {
                        category.style.display = 'none';
                    }
                });
            });
  
            searchInput.addEventListener('keypress', (e) => {
                if (e.which == 13) {
                    searchButton.click();
                }
            });
        }
    }
  });
  