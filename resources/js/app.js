const cart = new Map();
const money = new Intl.NumberFormat('fa-IR');

function updateCart() {
    const count = [...cart.values()].reduce((sum, item) => sum + item.qty, 0);
    const total = [...cart.values()].reduce((sum, item) => sum + item.qty * item.price, 0);

    document.querySelectorAll('[data-cart-count]').forEach((el) => {
        el.textContent = money.format(count);
    });

    document.querySelectorAll('[data-cart-total]').forEach((el) => {
        el.textContent = money.format(total) + ' تومان';
    });
}

function toast(message) {
    const el = document.querySelector('[data-toast]');
    if (!el) return;
    el.textContent = message;
    el.classList.add('show');
    window.clearTimeout(window.__toastTimer);
    window.__toastTimer = window.setTimeout(() => el.classList.remove('show'), 2200);
}

function filterProducts(value) {
    const term = value.trim().toLocaleLowerCase('fa');
    let visibleCount = 0;

    document.querySelectorAll('[data-product]').forEach((card) => {
        const haystack = card.textContent.toLocaleLowerCase('fa');
        const visible = !term || haystack.includes(term);
        card.hidden = !visible;
        if (visible) visibleCount += 1;
    });

    const empty = document.querySelector('[data-empty-state]');
    if (empty) empty.hidden = visibleCount !== 0;

    const clearButton = document.querySelector('[data-search-clear]');
    if (clearButton) clearButton.hidden = !term;
}

document.addEventListener('click', (event) => {
    const add = event.target.closest('[data-add]');
    if (add) {
        const id = add.dataset.add;
        const product = {
            id,
            title: add.dataset.title,
            price: Number(add.dataset.price || 0),
        };

        const current = cart.get(id) || { ...product, qty: 0 };
        current.qty += 1;
        cart.set(id, current);
        updateCart();

        add.classList.add('added');
        const original = add.innerHTML;
        add.innerHTML = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="m6 12 4 4 8-9"></path></svg> اضافه شد';

        window.clearTimeout(add.__restoreTimer);
        add.__restoreTimer = window.setTimeout(() => {
            add.classList.remove('added');
            add.innerHTML = original;
        }, 1000);

        toast(product.title + ' به سبد خرید اضافه شد');
    }

    const searchButton = event.target.closest('[data-search]');
    if (searchButton) {
        const input = document.querySelector('[data-search-input]');
        input?.focus();
        input?.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    const clearButton = event.target.closest('[data-search-clear]');
    if (clearButton) {
        const input = document.querySelector('[data-search-input]');
        if (input) {
            input.value = '';
            filterProducts('');
            input.focus();
        }
    }

    const resetButton = event.target.closest('[data-search-reset]');
    if (resetButton) {
        const input = document.querySelector('[data-search-input]');
        if (input) {
            input.value = '';
            filterProducts('');
            input.focus();
        }
    }

    const copyButton = event.target.closest('[data-copy-code]');
    if (copyButton) {
        const code = copyButton.dataset.copyCode;
        if (navigator.clipboard?.writeText) {
            navigator.clipboard.writeText(code).then(() => {
                copyButton.classList.add('copied');
                toast('کد ' + code + ' کپی شد');
                window.setTimeout(() => copyButton.classList.remove('copied'), 1000);
            }).catch(() => toast('کد تخفیف: ' + code));
        } else {
            toast('کد تخفیف: ' + code);
        }
    }

    const category = event.target.closest('[data-category]');
    if (category) {
        const value = category.dataset.category;
        const input = document.querySelector('[data-search-input]');
        if (input) {
            input.value = value;
            filterProducts(value);
            document.querySelector('#products')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }
});

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
if (!reduceMotion && 'IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));
} else {
    document.querySelectorAll('.reveal').forEach((el) => el.classList.add('is-visible'));
}

updateCart();