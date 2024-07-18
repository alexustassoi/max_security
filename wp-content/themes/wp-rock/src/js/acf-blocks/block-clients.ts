import Swiper, { Autoplay } from 'swiper';

const initBlockClients = () => {
    const clientSwiper = document.querySelector('.js-clients-swiper') as HTMLElement;
    if (clientSwiper) {
        const clientSlider = new Swiper(clientSwiper, {
            spaceBetween: 40,
            grabCursor: true,
            freeMode: {
                enabled: true,
                momentum: false,
                momentumBounce: false,
                momentumRatio: 0,
            },
            speed: 11000,
            loop: true,
            loopAdditionalSlides: 5,
            slidesPerView: 'auto',
            centeredSlides: false,
            allowTouchMove: false,
            modules: [Autoplay],
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
                stopOnLastSlide: false,
                reverseDirection: false,
                waitForTransition: false,
            },
            preventInteractionOnTransition: true,
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
