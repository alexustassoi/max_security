import Swiper, { Navigation } from 'swiper';

Swiper.use([Navigation]);

const initBlockJourney = () => {
    const mirrorItem = document.querySelectorAll('.js-mirror-item') as NodeList;
    const loadMoreBtn = document.querySelector('.js-load-more') as HTMLElement;

    const openCoursesSliderLinks = document.querySelectorAll('.js-open-slide-course-popup-link') as NodeList;

    const coursePopupSwiper = document.querySelector('.js-popup__ccs') as HTMLElement;

    let courseSwiper = null;

    loadMoreBtn &&
        loadMoreBtn.addEventListener('click', () => {
            loadMoreBtn && loadMoreBtn.classList.add('hide');

            mirrorItem &&
                mirrorItem.forEach((item) => {
                    const el = item as HTMLElement;
                    el.classList.remove('hide');
                });
        });

    if (coursePopupSwiper) {
        // eslint-disable-next-line no-new
        // @ts-ignore
        courseSwiper = new Swiper(coursePopupSwiper, {
            slidesPerView: 1,
            spaceBetween: 0,
            autoHeight: true,
            navigation: {
                nextEl: '.js-next-course-slider-popup',
                prevEl: '.js-prev-course-slider-popup',
            },
        });
    }

    openCoursesSliderLinks &&
        coursePopupSwiper &&
        [...openCoursesSliderLinks].forEach((item) => {
            item.addEventListener('click', (event) => {
                console.log('openCoursesSliderLink');

                // @ts-ignore
                const slideIndex = event.target.dataset?.slide_index;
                setTimeout(() => {
                    // @ts-ignore
                    courseSwiper && courseSwiper.slideTo(slideIndex, 10);
                }, 15);
            });
        });
};

window.document.addEventListener('DOMContentLoaded', initBlockJourney, false);

// Initialize dynamic block preview (editor).
// eslint-disable-next-line dot-notation
window['acf']?.addAction('render_block_preview', initBlockJourney);

export {};
