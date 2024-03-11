import Swiper, { Autoplay } from 'swiper';

const initBlockClients = () => {
    const clientSwiper = document.querySelector('.js-clients-swiper') as HTMLElement;
    if (clientSwiper) {
        const clientSlider = new Swiper(clientSwiper, {
            spaceBetween: 32,
            loop: true,
            slidesPerView: 'auto',
            freeMode: true,
            modules: [Autoplay],
            autoplay: {
                delay: 1000,
                disableOnInteraction: false,
            },
        });
    }
};

document.addEventListener('DOMContentLoaded', initBlockClients, false);

// Initialize dynamic block preview (editor).
if (window['acf']) {
    window['acf']?.addAction('render_block_preview', initBlockClients);
}

export {};
