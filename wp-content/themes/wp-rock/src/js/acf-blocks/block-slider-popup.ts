import Swiper, { EffectFade, Navigation } from 'swiper';

Swiper.use([Navigation]);

const initBlockSliderPopup = () => {
    const sliderPopupSwiper1 = document.querySelector('.js-slider-popup-1') as HTMLElement;
    if (sliderPopupSwiper1) {
        const slidesCount = sliderPopupSwiper1?.dataset.slides_count ? sliderPopupSwiper1?.dataset.slides_count : 5;

        const sliderPopupBlock = new Swiper(sliderPopupSwiper1, {
            slidesPerView: 1,
            spaceBetween: 20,
            breakpoints: {
                991: {
                    slidesPerView: slidesCount as number,
                },
                670: {
                    slidesPerView: 3,
                    spaceBetween: 16,
                },
                330: {
                    slidesPerView: 2,
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
                btn.addEventListener('click', () => {
                    const btnElem = btn as HTMLElement;

                    if (btnElem?.dataset.slideIndex) {
                        const index = parseInt(btnElem.dataset.slideIndex, 10);

                        sliderPopup.slideTo(index);
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

export {};
