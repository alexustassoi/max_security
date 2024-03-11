import Swiper, { EffectFade, Navigation } from 'swiper';

Swiper.use([Navigation]);

const initBlockExperts = () => {
    const expertsSwiper = document.querySelector('.js-experts-slider') as HTMLElement;
    if (expertsSwiper) {
        const expertsSlider = new Swiper(expertsSwiper, {
            loop: true,
            navigation: {
                nextEl: '.js-next-expert',
                prevEl: '.js-prev-expert',
            },
        });
    }
};

document.addEventListener('DOMContentLoaded', initBlockExperts, false);

// Initialize dynamic block preview (editor).
if (window['acf']) {
    window['acf']?.addAction('render_block_preview', initBlockExperts);
}

export {};
