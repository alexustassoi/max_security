import Swiper, { EffectFade, Navigation } from 'swiper';

Swiper.use([Navigation]);

const initBlockBlogReadMore = () => {
    const blogReadMoreSwiper = document.querySelector('.js-blog-read-more-slider') as HTMLElement;

    console.log('Hello 987777');

    if (blogReadMoreSwiper) {

        console.log('blogReadMoreSwiper', blogReadMoreSwiper);
        const blogReadMoreSlider = new Swiper(blogReadMoreSwiper, {
            spaceBetween: 42,
            slidesPerView: 3,
            loop: true,
            freeMode: true,
            navigation: {
                nextEl: '.js-next-read-more',
                prevEl: '.js-prev-read-more',
            },

            breakpoints: {
                320: {
                    loop: true,
                    slidesPerView: 1,
                    // centeredSlides: true,
                    spaceBetween: 0,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 42,
                    // centeredSlides: false,
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 42,
                    // centeredSlides: false,
                },
            },
        });
    }
};

export default initBlockBlogReadMore;
