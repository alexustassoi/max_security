import Swiper, { Autoplay } from 'swiper';

const initBlockClients = () => {
    const clientSwiper = document.querySelector('.js-clients-swiper') as HTMLElement;
    if (clientSwiper) {
        // @ts-ignore
        const clientSlider = new Swiper(clientSwiper, {
            slidesPerView: 'auto',
            spaceBetween: 40,
            loop: true,
            modules: [Autoplay],
            speed: 5000,
            grabCursor: true,
            loopedSlides: 8,
            freeMode: {
                enabled: true,
                momentum: false,
            },
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
                waitForTransition: false,
            },
        });
    }
};

document.addEventListener('DOMContentLoaded', initBlockClients, false);

// Initialize dynamic block preview (editor).
// @ts-ignore
if (window.acf) {
    // @ts-ignore
    window.acf?.addAction('render_block_preview', initBlockClients);
}

export {};
