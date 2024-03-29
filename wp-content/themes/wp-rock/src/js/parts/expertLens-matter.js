/* eslint-disable */
import { gsap } from 'gsap';

import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { MotionPathPlugin } from 'gsap/MotionPathPlugin';

export const ExpertLensMatterAnimation = () => {
    const expertLensMatter = document.querySelector('.expertLens-matter');
    if (expertLensMatter) {
        const tl3 = gsap.timeline({
            scrollTrigger: {
                scroller: '#wrapper',
                trigger: '.expertLens-matter',
                scrub: 1.5,
                start: 'top+=12% top',
                end: 'bottom-=10% bottom',
            },
        });

        const expertLens = document.querySelector('#expert-lens');
        const matter = document.querySelector('#matter');
        const matterContainer = document.querySelector('.matter__container');
        const matterContent = document.querySelector('.matter__content');

        tl3.to(
            expertLens,
            { scale: 0, opacity: 0, ease: 'none', duration: 1 },
            0
        )
            .to(
                matterContainer,
                { scale: 1, opacity: 1, ease: 'none', duration: 1 },
                0
            )
            .to(matterContent, { opacity: 1, ease: 'none', duration: 1 }, 0);
    }
};
