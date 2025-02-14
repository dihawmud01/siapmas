import GLightbox from 'glightbox';

export function Glightbox() {
    return GLightbox({
        selector: '.quote-lightbox',
        openEffect: 'fade',
        closeEffect: 'fade',
        loop: true,
        preload: true,
        zoomable: true,
    });
}
