import Swiper, { EffectFade, Navigation } from 'swiper';

Swiper.use([Navigation]);

const initBlockJourney = () => {
    const expertsSwiper = document.querySelector('.js-courses-slider') as HTMLElement;

    if (expertsSwiper) {
        const expertsSlider = new Swiper(expertsSwiper, {
            loop: true,
            navigation: {
                nextEl: '.js-next-courses',
                prevEl: '.js-prev-courses',
            },
        });
    }
};

document.addEventListener('DOMContentLoaded', initBlockJourney, false);

// Initialize dynamic block preview (editor).
// eslint-disable-next-line dot-notation
if (window['acf']) {
    // eslint-disable-next-line dot-notation
    window['acf']?.addAction('render_block_preview', initBlockJourney);
}

export {};
