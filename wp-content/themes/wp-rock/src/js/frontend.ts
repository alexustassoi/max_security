/**
 * SASS
 */
import '../scss/frontend.scss';
import initAccordion from './components/accordion';
/**
 * JavaScript
 */
import Sliders from './components/swiper-init';
import initAnimation from './parts/animation';
import tabsNavigation from './parts/navi-tabs';
import Popup from './parts/popup-window';
import initBlockBlogReadMore from './acf-blocks/block-blog-read-more';

function ready() {
    const popupInstance = new Popup();
    const header = document.querySelector('.site-header') as HTMLElement;
    const maxWords = document.querySelectorAll('.js-max-words');
    const headerMaxWords = document.querySelector('.js-header-max-words') as HTMLElement;
    const closeMenu = document.querySelector('.js-close-menu') as HTMLElement;
    const mobileMenu = document.querySelector('.js-mobile-menu') as HTMLElement;
    const openMobileMenu = document.querySelector('.js-open-mobile-menu') as HTMLElement;
    const openSubmenu = document.querySelectorAll('.js-open-submenu > a') as NodeListOf<Element>;
    const submenuItems = document.querySelectorAll('.js-open-submenu .sub-menu .menu-item') as NodeListOf<Element>;

    const handleBrowseTopicActivefilter = () => {
        const bTopicLoadMoreBtn = window.document.querySelector('.js-b-topic-load-more') as HTMLElement;
        const browseTopicFilters = window.document.querySelectorAll('.js-browse-topic-filter') as NodeList;

        if (!browseTopicFilters || !bTopicLoadMoreBtn) return;

        [...browseTopicFilters].forEach((item) => {
            // @ts-ignore
            const filetCategory = item.dataset.category;
            const activeFilterCategory = bTopicLoadMoreBtn.dataset.category;

            if (!filetCategory || !activeFilterCategory) return;
            const actionType = filetCategory === activeFilterCategory ? 'add' : 'remove';
            // @ts-ignore
            item.classList[actionType]('active');
        });
    };
    handleBrowseTopicActivefilter();

    const checkScrollPosition = () => {
        const scrollPosition = localStorage.getItem('scrollPosition');
        if (scrollPosition) {
            window.scrollTo({
                // @ts-ignore
                top: scrollPosition,
                behavior: 'smooth',
            });

            localStorage.removeItem('scrollPosition');
        }
    };
    checkScrollPosition();

    initBlockBlogReadMore();

    tabsNavigation('.js-tab-block-link', '.js-tab-block-panel');
    initAnimation();
    initAccordion();

    openMobileMenu &&
        openMobileMenu.addEventListener('click', (event) => {
            if (mobileMenu) {
                mobileMenu.classList.add('open');
                document.body.classList.add('no-scroll');
            }
        });

    closeMenu &&
        closeMenu.addEventListener('click', (event) => {
            if (mobileMenu) {
                mobileMenu.classList.remove('open');
                document.body.classList.remove('no-scroll');
            }
        });

    openSubmenu &&
        openSubmenu.forEach((item) => {
            item.addEventListener('click', (event) => {
                event.preventDefault();
                const clickElem = event.target;
                // @ts-ignore
                const parent = clickElem.closest('.js-open-submenu');
                parent.querySelector('.sub-menu')?.classList.toggle('open');
                // @ts-ignore
                clickElem.classList.toggle('open');
            });
        });

    submenuItems &&
    submenuItems.forEach((item) => {
        item.addEventListener('click', () => {
            if (mobileMenu) {
                mobileMenu.classList.remove('open');
                document.body.classList.remove('no-scroll');
            }
        });
    });

    maxWords &&
        maxWords.forEach((item) => {
            item.addEventListener('mouseenter', (event) => {
                event.preventDefault();
                if (headerMaxWords) {
                    headerMaxWords.classList.add('open');

                    const html = window.document.querySelector('html');
                    document.body.classList.add('popup-opened-max');
                    html && html.classList.add('popup-opened-max');
                }
            });
        });

    maxWords &&
        maxWords.forEach((item) => {
            item.addEventListener('mouseleave', (event) => {
                event.preventDefault();
                if (headerMaxWords) {
                    headerMaxWords.classList.remove('open');

                    const html = window.document.querySelector('html');
                    document.body.classList.remove('popup-opened-max');
                    html && html.classList.remove('popup-opened-max');
                }
            });
        });

    popupInstance.init();

    window.document.addEventListener('scroll', () => {
        const operationType = header && Math.floor(window.scrollY) > 20 ? 'add' : 'remove';
        header.classList[operationType]('scroll-header');
        document.body.classList[operationType]('scroll-header');
    });

    {
        // Detect Initial scroll of page
        const operationType = header && Math.floor(window.scrollY) > 20 ? 'add' : 'remove';
        header.classList[operationType]('scroll-header');
        document.body.classList[operationType]('scroll-header');

        // if (document.body.classList.contains('single-resources') || document.body.querySelector('.browse-topic')) {
        //     const siteHeader = document.querySelector('.js-site-header');
        //     siteHeader && siteHeader.classList.add('added-scroll-header');
        // }
    }

    document.body.addEventListener('click', (e) => {
        const target = e.target as HTMLElement;
        const { role } = target.dataset;

        const hoverQuery = window.matchMedia('(hover: hover)');

        if (target.classList.contains('menu-item-has-children') && !hoverQuery.matches) {
            target.classList.toggle('opened');
        }

        if (!role) return;

        switch (role) {
            case 'load-more-browse-topic': {
                e.preventDefault();
                const currentOffset = target.dataset.offset;
                const currentCategory = target.dataset.category;
                const totalCountPosts = target.dataset.count;
                const browseTopicPosts = window.document.querySelector('.js-browse-topic-posts') as HTMLElement;

                if (!currentOffset || !browseTopicPosts) return;

                const data = new FormData();
                data.append('action', 'load_more_browse_topic_post');
                // @ts-ignore
                data.append('offset', +currentOffset);
                // @ts-ignore
                data.append('category', currentCategory);

                // @ts-ignore
                fetch(var_from_php.ajax_url, {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: data,
                })
                    .then((response) => response.json())
                    // eslint-disable-next-line no-shadow
                    .then((data) => {
                        if (data.success && data.data) {
                            browseTopicPosts.insertAdjacentHTML('beforeend', data.data);

                            // @ts-ignore
                            target.dataset.offset = +currentOffset + +var_from_php.posts_per_page;

                            // @ts-ignore
                            if (+currentOffset + +var_from_php.posts_per_page >= +totalCountPosts) {
                                const BTopicLoadMoreBtn = window.document.querySelector(
                                    '.js-b-topic-load-more'
                                ) as HTMLElement;

                                if (!BTopicLoadMoreBtn) return;
                                BTopicLoadMoreBtn.classList.remove('active');
                            }
                        }
                    });

                break;
            }

            case 'browse-topic-filter': {
                e.preventDefault();
                const targetHref = target.getAttribute('href');
                // @ts-ignore
                localStorage.setItem('scrollPosition', window.scrollY);
                setTimeout(() => {
                    // @ts-ignore
                    window.location.href = targetHref;
                }, 300);
                break;
            }

            case 'load-more-courses': {
                e.preventDefault();
                const currentOffset = target.dataset.offset;
                const totalPost = target.dataset.postCounts;
                // @ts-ignore
                const { lastKey } = target.dataset;
                const coursesWrap = window.document.querySelector('.js-mirror-repeater') as HTMLElement;

                if (!currentOffset || !coursesWrap || !lastKey) return;
                const data = new FormData();
                data.append('action', 'load_more_courses');
                data.append('offset', currentOffset);
                data.append('last_key', lastKey);

                // @ts-ignore
                fetch(var_from_php.ajax_url, {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: data,
                })
                    .then((response) => response.json())
                    .then((response) => {
                        if (response.success && response.data) {
                            coursesWrap.insertAdjacentHTML('beforeend', response.data.posts);
                            // @ts-ignore
                            target.dataset.offset = +currentOffset + +var_from_php.posts_per_page;
                            // @ts-ignore
                            target.dataset.lastKey = +lastKey + +var_from_php.posts_per_page;

                            // @ts-ignore
                            if (+currentOffset + +var_from_php.posts_per_page >= +totalPost) {
                                target.classList.add('hide');
                            }
                        }
                    });

                break;
            }

            case 'open-popup-portal-demo': {
                e.preventDefault();
                const targetPopupId = target.getAttribute('href');

                if (!popupInstance && !targetPopupId) return;
                popupInstance.forceCloseAllPopup();
                // @ts-ignore
                popupInstance.openOnePopup(targetPopupId);

                break;
            }
            default:
                break;
        }
    });

    window.document.addEventListener('wpcf7mailsent', (event) => {
        const form = event.target as HTMLFormElement;
        const isRedirect = form?.id && form.id === 'redirect-to-thank';
        const header = document.querySelector('#site-header') as HTMLElement;
        const pageToRedirect = header && header?.dataset.redirect_to ? header.dataset.redirect_to : false;

        if (isRedirect && pageToRedirect) {
            window.location.replace(pageToRedirect);
        }
    });
}

window.document.addEventListener('DOMContentLoaded', ready);
