document.addEventListener("DOMContentLoaded", function() {
    const cartForm = document.getElementById("cart-form");

    cartForm.addEventListener("change", function(event) {
        if (event.target.classList.contains("quantity")) {
            const productId = event.target.dataset.id;
            const newQuantity = event.target.value;

            const itemPriceElement = event.target.closest('.cart-item').querySelector('.item-price');
            const itemPrice = parseFloat(itemPriceElement.textContent.replace('$', '').trim());

            const newTotalPrice = itemPrice * newQuantity;

            const totalPriceElement = document.querySelector(`.total-price[data-id='${productId}']`);
            if (totalPriceElement) {
                totalPriceElement.textContent = `${newTotalPrice}$`;
            }
            updateCartTotal();
            updateCartDatabase(productId, newQuantity);
        }
        
        if (event.target.type === "checkbox") {
            updateCartTotal();
        }
    });

    // Thêm sự kiện khi bấm nút remove
    document.querySelectorAll(".remove-item").forEach(function(removeButton) {
        removeButton.addEventListener("click", function() {
            const productId = this.dataset.id;
            removeCartItem(productId);
        });
    });

    function updateCartTotal() {
        let totalCartPrice = 0;
    
        document.querySelectorAll('.cart-item input[type="checkbox"]:checked').forEach(function(checkbox) {
            const productId = checkbox.value; 
            const totalPriceElement = document.querySelector(`.total-price[data-id='${productId}']`);
            
            if (totalPriceElement) {
                totalCartPrice += parseFloat(totalPriceElement.textContent.replace('$', '').trim());
            }
        });
        document.getElementById('cart-total').textContent = `${totalCartPrice}`;
    }
    
    function updateCartDatabase(productId, newQuantity) {
        const formData = new FormData();
        formData.append('product_id', productId);
        formData.append('new_quantity', newQuantity);

        fetch('../CLASS/giohang_update.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Giỏ hàng đã được cập nhật');
            } else {
                console.error('Có lỗi khi cập nhật giỏ hàng');
            }
        })
        .catch(error => {
            console.error('Lỗi:', error);
        });
    }

    function removeCartItem(productId) {
        const cartItem = document.getElementById(`cart-item-${productId}`);
        if (cartItem) {
            cartItem.remove();
        }

        updateCartTotal();
// Gửi yêu cầu xóa sản phẩm khỏi db
        const formData = new FormData();
        formData.append('product_id', productId);

        fetch('../CLASS/giohang_remove.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Sản phẩm đã được xóa khỏi giỏ hàng');
            } else {
                console.error('Có lỗi khi xóa sản phẩm');
            }
        })
        .catch(error => {
            console.error('Lỗi:', error);
        });
    }
});
