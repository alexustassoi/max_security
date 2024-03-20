import Swiper, { EffectFade, Navigation } from 'swiper';

Swiper.use([Navigation]);

const initBlockSliderPopup = () => {
    const sliderPopupSwiper1 = document.querySelector('.js-slider-popup-1') as HTMLElement;
    if (sliderPopupSwiper1) {
        const sliderPopupBlock = new Swiper(sliderPopupSwiper1, {
            slidesPerView: 2,
            spaceBetween: 20,
            breakpoints: {
                991: {
                    slidesPerView: 5,
                },
                670: {
                    slidesPerView: 3,
                },
            },
        });
    }

    const sliderPopupSwiper2 = document.querySelector('.js-slider-popup-2') as HTMLElement;
    if (sliderPopupSwiper2) {
        const sliderPopupsBtn = document.querySelectorAll('.js-open-slide-popup-link    ');

        const sliderPopup = new Swiper(sliderPopupSwiper2, {
            slidesPerView: 1,
            navigation: {
                nextEl: '.js-next-slider-popup',
                prevEl: '.js-prev-slider-popup',
            },
        });

        sliderPopupsBtn &&
            sliderPopupsBtn.forEach((btn) => {
                btn.addEventListener('click', (e) => {
                    const btnElem = btn as HTMLElement;
                    const slide = btnElem.closest('.slider-popup__slide') as HTMLElement;

                    if (slide?.dataset.swiperSlideIndex) {
                        const index = parseInt(slide.dataset.swiperSlideIndex, 10);

                        sliderPopup.slideTo(index + 1);
                    }
                });
            });
    }
};

document.addEventListener('DOMContentLoaded', initBlockSliderPopup, false);

// Initialize dynamic block preview (editor).
// eslint-disable-next-line dot-notation
if (window['acf']) {
    // eslint-disable-next-line dot-notation
    window['acf']?.addAction('render_block_preview', initBlockSliderPopup);
}

export { };
