// Kadiha Muhamad

/**
 * Updates the subtotal of a cart row when the quantity changes.
 * @param {HTMLInputElement} input - The quantity input element
 */
function updateSubtotal(input) {
    const row      = input.closest('tr');
    const price    = parseFloat(row.querySelector('[data-price]').dataset.price);
    const quantity = parseInt(input.value) || 0;
    const subtotal = price * quantity;

    row.querySelector('[data-subtotal]').textContent =
        '$ ' + subtotal.toLocaleString('es-CO');
}

/**
 * Initializes quantity input listeners for all cart rows.
 */
function initCartListeners() {
    document.querySelectorAll('input[name="quantity"]').forEach(function (input) {
        input.addEventListener('input', function () {
            updateSubtotal(this);
        });
    });
}

document.addEventListener('DOMContentLoaded', initCartListeners);