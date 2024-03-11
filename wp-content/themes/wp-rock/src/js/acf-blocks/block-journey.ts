import Swiper, { EffectFade, Navigation } from 'swiper';

Swiper.use([Navigation]);

const initBlockJourney = () => {
    const expertsSwiper = document.querySelector('.js-reviews-slider') as HTMLElement;
    if (expertsSwiper) {
        const expertsSlider = new Swiper(expertsSwiper, {
            loop: true,
            navigation: {
                nextEl: '.js-next-reviews',
                prevEl: '.js-prev-reviews',
            },
        });
    }
};

document.addEventListener('DOMContentLoaded', initBlockJourney, false);

// Initialize dynamic block preview (editor).
if (window['acf']) {
    window['acf']?.addAction('render_block_preview', initBlockJourney);
}

export {};
