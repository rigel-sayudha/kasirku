    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/dist/css/adminlte.min.css'); ?>">
    <!-- Cashier Section -->
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Kasir</h3>
        </div>
        <div class="card-body">
            <!-- Search Input -->
            <div class="input-group mb-3">
                <input type="text" id="search" class="form-control" placeholder="Cari Barang">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="searchButton">Cari</button>
                </div>
            </div>

            <!-- Cart Items -->
            <div id="cartItems" class="row">
                <!-- Cart items will be displayed here -->
            </div>

            <!-- Total Section -->
            <div class="mt-4">
                <h4>Total: <span id="totalAmount">0</span></h4>
            </div>

            <!-- Checkout Button -->
            <button class="btn btn-success mt-3" id="checkoutBtn">Checkout</button>
        </div>
    </div>

    <!-- Add the following script at the end of your file -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var cartItems = [];
        var totalAmount = 0;

        // Function to update the cart items
        function updateCartItems() {
            var cartItemsContainer = document.getElementById('cartItems');
            var totalAmountSpan = document.getElementById('totalAmount');

            // Clear the container
            cartItemsContainer.innerHTML = '';
            totalAmount = 0;

            // Loop through the cart items
            cartItems.forEach(function (item, index) {
                var card = document.createElement('div');
                card.className = 'col-md-4 mb-4';

                card.innerHTML = `
                    <div class="card">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">${item.nama_barang}</h5>
                            <p class="card-text">Harga: ${item.harga}</p>
                            <p class="card-text">Jumlah: ${item.jumlah}</p>
                            <p class="card-text">Total: ${item.total}</p>
                            <button class="btn btn-danger btn-sm" onclick="removeItem(${index})">Remove</button>
                        </div>
                    </div>
                `;

                cartItemsContainer.appendChild(card);

                totalAmount += item.total;
            });

            // Update total amount
            totalAmountSpan.innerText = totalAmount;
        }

        // Function to add item to the cart
        function addItemToCart(item) {
            cartItems.push(item);
            updateCartItems();
        }

        // Function to remove item from the cart
        function removeItem(index) {
            cartItems.splice(index, 1);
            updateCartItems();
        }

        // Event listener for the search button
        document.getElementById('searchButton').addEventListener('click', function () {
            var searchInput = document.getElementById('search').value;
            // Your logic for searching items based on the input
            // Assume you get an item from the search

            var item = {
                nama_barang: 'Item Name', // Replace with the actual name
                harga: 100, // Replace with the actual price
                jumlah: 1,
                total: 100
            };

            addItemToCart(item);
        });

        // Event listener for the checkout button
        document.getElementById('checkoutBtn').addEventListener('click', function () {
            // Your logic for handling the checkout process
            // Send cartItems to the server or perform other actions
            // For now, let's just display an alert
            alert('Checkout successful! Total amount: ' + totalAmount);
            // Reset the cart after checkout
            cartItems = [];
            updateCartItems();
        });
    });
    </script>