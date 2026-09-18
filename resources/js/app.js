
const cart = new Map();
const money = new Intl.NumberFormat('fa-IR');

function updateCart(){
    const count = [...cart.values()].reduce((sum, item) => sum + item.qty, 0);
    const total = [...cart.values()].reduce((sum, item) => sum + item.qty * item.price, 0);
    const countEl = document.querySelector('[data-cart-count]');
    const totalEl = document.querySelector('[data-cart-total]');
    if(countEl) countEl.textContent = money.format(count);
    if(totalEl) totalEl.textContent = `${money.format(total)} تومان`;
}

function toast(message){
    const el = document.querySelector('[data-toast]');
    if(!el) return;
    el.textContent = message;
    el.classList.add('show');
    window.clearTimeout(window.__toastTimer);
    window.__toastTimer = window.setTimeout(() => el.classList.remove('show'), 2200);
}

document.addEventListener('click', (event) => {
    const add = event.target.closest('[data-add]');
    if(add){
        const id = add.dataset.add;
        const product = {
            id,
            title: add.dataset.title,
            price: Number(add.dataset.price || 0),
        };
        const current = cart.get(id) || {...product, qty: 0};
        current.qty += 1;
        cart.set(id, current);
        updateCart();
        toast(`${product.title} به سبد خرید اضافه شد`);
    }

    const searchBtn = event.target.closest('[data-search]');
    if(searchBtn){
        const input = document.querySelector('[data-search-input]');
        input?.focus();
    }
});

document.querySelector('[data-search-input]')?.addEventListener('input', (event) => {
    const term = event.target.value.trim().toLowerCase();
    document.querySelectorAll('[data-product]').forEach((card) => {
        const haystack = card.textContent.toLowerCase();
        card.hidden = term && !haystack.includes(term);
    });
});

updateCart();
