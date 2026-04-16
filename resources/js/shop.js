/**
 * Meubleo Shop — Front-end JS Entry Point
 */

// ─── Gallery ──────────────────────────────────────────────────────────────────
document.querySelectorAll('.shop-gallery__thumb').forEach(thumb => {
    thumb.addEventListener('click', () => {
        const mainImg = document.getElementById('main-img');
        if (mainImg) mainImg.src = thumb.src;
        document.querySelectorAll('.shop-gallery__thumb')
            .forEach(t => t.classList.remove('active'));
        thumb.classList.add('active');
    });
});

// ─── Cart quantity auto-submit ─────────────────────────────────────────────────
document.querySelectorAll('.shop-input--qty').forEach(input => {
    input.addEventListener('change', () => {
        input.closest('form')?.submit();
    });
});

// ─── Flash message auto-dismiss ───────────────────────────────────────────────
document.querySelectorAll('.shop-flash').forEach(el => {
    setTimeout(() => {
        el.style.transition = 'opacity .5s';
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 500);
    }, 4000);
});
