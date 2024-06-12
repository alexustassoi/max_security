import Swiper, { EffectFade, Navigation } from 'swiper';

Swiper.use([Navigation]);

const initBlockJourney = () => {
    const expertsSwiper = document.querySelector('.js-reviews-slider') as HTMLElement;
    const historySwiper = document.querySelector('.js-history-slider') as HTMLElement;

    if (historySwiper) {
        const historySlider = new Swiper(historySwiper, {
            spaceBetween: 156,
            loop: true,
            slidesPerView: 'auto',
            freeMode: true,
            navigation: {
                // nextEl: '.journey__history-btn-next',
                prevEl: '.journey__history-btn-prev',
            },
            breakpoints: {
                320: {
                    centeredSlides: true,
                    spaceBetween: 88,
                },
                481: {
                    centeredSlides: true,
                    spaceBetween: 100,
                },
                769: {
                    centeredSlides: true,
                    spaceBetween: 156,
                },
            },
        });

    }

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
