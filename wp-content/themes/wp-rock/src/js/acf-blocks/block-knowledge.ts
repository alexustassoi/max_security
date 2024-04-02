import Swiper, { EffectFade, Navigation } from 'swiper';

Swiper.use([Navigation]);

const initBlockJourney = () => {
    const expertsSwiper = document.querySelector('.js-knowledge-slider') as HTMLElement;

    if (expertsSwiper) {
        const knowledgeSlider = new Swiper(expertsSwiper, {
            slidesPerView: 2,
            spaceBetween: 42,
            breakpoints: {
                1200: {
                    slidesPerView: 4,
                },
                991: {
                    slidesPerView: 3,
                },
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

export { };
