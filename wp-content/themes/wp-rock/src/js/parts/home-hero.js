/* eslint-disable */
import {gsap} from 'gsap';

import {ScrollTrigger} from 'gsap/ScrollTrigger';
import {MotionPathPlugin} from 'gsap/MotionPathPlugin';

gsap.registerPlugin(ScrollTrigger, MotionPathPlugin);

function debounce(func, wait, immediate) {
    let timeout;
    return function () {
        const context = this,
            args = arguments;
        const later = function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        const callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

export const HomeHeroAnimation = () => {
    const homeHeroSection = document.querySelector('.home-hero');
    if (homeHeroSection) {
        const bigFigures = document.querySelectorAll(
            '.square1 > .square2 > .figures > .bigfigure'
        );
        const pulses = [];
        [...bigFigures].forEach((figure, i) => {
            const anim = gsap.to(figure.querySelector(".pulse"), {scale: 1.2, opacity: 0, ease: 'none', duration: 1.5, repeat: -1, overwrite: 'auto' });
            anim.pause();
            anim.progress(0);
            pulses.push(anim);
        });
        let tl1;
        const createAnimation = () => {
            if (tl1) {
                tl1.scrollTrigger.kill();
            }

            tl1 = gsap.timeline({
                scrollTrigger: {
                    scroller: '#wrapper',
                    trigger: '.home-hero-wrapper',
                    scrub: 1.5,
                    start: 'top top',
                    end: 'bottom-=25% bottom',
                    invalidateOnRefresh: true,
                },
            });

            const square1 = document.querySelector('.square1');
            const contentWrapper2 = document.querySelector(
                '.home-hero > .content-wrapper'
            );
            const contentWrapper2H2 = document.querySelector(
                '.home-hero > .content-wrapper .h2-js'
            );

            const contentWrapper3 = document.querySelector(
                '.square3 > .content-wrapper'
            );
            const heroImg = document.querySelector('.hero-img');
            const heroImgMask = document.querySelector('.hero-img-mask');
            const square3 = document.querySelector('.square3');
            const smallFigures = document.querySelectorAll(
                '.home-hero  .smallfigure'
            );

            const bigFigures = document.querySelectorAll(
                '.square1 > .square2 > .figures > .bigfigure'
            );
            const bigFiguresSvg = document.querySelectorAll(
                '.square1 > .square2 > .figures > .bigfigure svg.fig'
            );

            const bigFigurePulsesPath = document.querySelectorAll(
                '.square1 > .square2 > .figures > .bigfigure svg.pulse path'
            );
            const bigFiguresText = document.querySelectorAll(
                '.square1 > .square2 > .figures > .bigfigure span'
            );

            tl1.to(
                square1,
                {scale: 1.2, marginTop: '82px', ease: 'none', duration: 0.5},
                0
            )
                .to(square1, {scale: 1, ease: 'none', duration: 0.5}, 0.5)
                .to(
                    heroImg,
                    {
                        opacity: 0,
                        scaleX: 0.5,
                        scaleY: 0.7,
                        ease: 'none',
                        duration: 0.5,
                    },
                    0
                )
                .to(
                    heroImgMask,
                    {
                        opacity: 0,
                        scaleX: 0.8,
                        scaleY: 1.3,
                        ease: 'none',
                        duration: 0.5,
                    },
                    0
                )
                .to(
                    contentWrapper2,
                    {opacity: 1, ease: 'none', duration: 0.5},
                    0.5
                )
                .to(
                    contentWrapper3,
                    {opacity: 0, ease: 'none', duration: 0.5},
                    0
                )
                .to(
                    square3,
                    {
                        opacity: 0,
                        width: 0,
                        height: 0,
                        ease: 'none',
                        duration: 0.5,
                    },
                    0.5
                );

            [...bigFigures].forEach((figure, i) => {
                tl1.to(figure, {scale: 1, ease: 'none', duration: 0.45}, 0.5);
            });
            [...bigFiguresText].forEach((figure) => {
                tl1.to(figure, {scale: 1, duration: 0.5, ease: 'none'}, 0.5);
            });

            tl1.set('.maskedPath', {attr: {mask: 'none'}}, 0);
            tl1.set('.maskedPath', {attr: {mask: 'url( #subtract)'}}, 0.95);



            const smallFiguresColors = {
                smallcircle: '#8DAFCF',
                smallsquare: '#CC9156',
                smallsquare1: '#CC9156',
            };

            let active = false;
            let actives = {
                0: false,
                1: false,
                2: false,
                3: false,
            };

            async function waitForComplete(index) {
                const lastTime = actives[index];
                return new Promise((resolve, reject) => {
                    setInterval(() => {
                        if (lastTime !== actives[index]) {
                            reject();
                        }
                        if (!actives[index]) {
                            resolve();
                        } else {
                            console.log('wait', index);
                        }
                    }, 50);
                });
            }

            document.querySelector('#wrapper').addEventListener('wheel', () => {
                if (tl1._time >= 0.95) {
                    pulses.forEach((anim) => {
                        anim.resume();
                    })
                }
                else {
                    pulses.forEach((anim) => {
                        anim.pause();
                        anim.progress(0);
                    })
                }
                if(active) {
                    active = false;

                    [...bigFigures].forEach((figure, i) => {
                        [...bigFiguresSvg].forEach((figure2) => {
                            gsap.to( figure2.querySelector('path'), {
                                fill: "#1E0202",
                                duration: 0.3,
                                overwrite: 'auto',
                            });
                        });
                        gsap.to('.slide' + (i + 1), {
                            opacity: 0,
                            duration: 0.3,
                            overwrite: 'auto',
                        });
                        gsap.to(figure, {
                            scale: 1,
                            duration: 0.3,
                            overwrite: 'auto',
                        });
                        gsap.to(figure.querySelector('.content-wrapper'), {
                            color: 'white',
                            scale: 0,
                            duration: 0.3,
                            overwrite: 'auto',
                        });
                        gsap.to(contentWrapper2H2, {
                            color: '#CC9156',
                            duration: 0.3,
                            overwrite: 'auto',
                        });
                        active = false;
                    });
                    [...smallFigures].forEach((figure) => {
                        if (figure.nodeName === 'svg') {
                            figure.style.fill = '#F44134';
                        } else {
                            figure.style.background =
                                smallFiguresColors[figure.classList[1]];
                        }
                    });
                }
            });

            [...bigFigures].forEach((figure, i) => {
                figure.addEventListener('mouseenter', async () => {
                    if (tl1._time >= 0.95) {
                        pulses.forEach((anim) => {
                            anim.pause();
                            anim.progress(0);
                        })
                        active = true
                        actives[i] = performance.now();
                        gsap.to('.slide' + (i + 1), {
                            opacity: 0.8,
                            duration: 0.3,
                            overwrite: 'auto',
                        });
                        gsap.to(figure, {
                            scale: 1.3,
                            duration: 0.3,
                            overwrite: 'auto',
                        });
                        gsap.to(figure.querySelector('.content-wrapper'), {
                            color: 'black',
                            scale: 1,
                            duration: 0.3,
                            overwrite: 'auto',
                        });

                        gsap.to(
                            figure.querySelector('svg').querySelector('path'),
                            {
                                fill: 'white',
                                duration: 0.3,
                                overwrite: 'auto',
                                onComplete() {
                                    actives[i] = false;
                                },
                            }
                        );

                        gsap.to(contentWrapper2H2, {
                            color: '#F2F1ED',
                            duration: 0.3,
                            overwrite: 'auto',
                        });

                        [...bigFigures].forEach((figure2) => {
                            if (figure2 !== figure) {
                                gsap.to(
                                    figure2
                                        .querySelector('svg')
                                        .querySelector('path'),
                                    {
                                        fill: 'transparent',
                                        duration: 0.3,
                                        overwrite: 'auto',
                                    }
                                );
                            }
                        });
                        [...smallFigures].forEach((figure) => {
                            if (figure.nodeName === 'svg') {
                                figure.style.fill = 'white';
                            } else {
                                figure.style.background = 'white';
                            }
                        });
                    }
                });
                figure.addEventListener('mouseleave', async () => {

                    if (tl1._time >= 0.95) {
                        active = false;
                        pulses.forEach((anim) => {
                            anim.resume();
                        });
                            [...bigFiguresSvg].forEach((figure2) => {
                            gsap.to(figure2.querySelector('path'), {
                                fill: '#1E0202',
                                duration: 0.3,
                                overwrite: 'auto',
                            });
                        });

                        gsap.to('.slide' + (i + 1), {
                            opacity: 0,
                            duration: 0.3,
                            overwrite: 'auto',
                        });
                        gsap.to(figure, {
                            scale: 1,
                            duration: 0.3,
                            overwrite: 'auto',
                        });
                        gsap.to(figure.querySelector('.content-wrapper'), {
                            color: 'white',
                            scale: 0,
                            duration: 0.3,
                            overwrite: 'auto',
                        });
                        gsap.to(contentWrapper2H2, {
                            color: '#CC9156',
                            duration: 0.3,
                            overwrite: 'auto',
                        });
                        [...smallFigures].forEach((figure) => {
                            if (figure.nodeName === 'svg') {
                                figure.style.fill = '#F44134';
                            } else {
                                figure.style.background =
                                    smallFiguresColors[figure.classList[1]];
                            }
                        });
                    }
                });
            });
        };

        createAnimation();

        let timeline = gsap.timeline({repeat: -1});
        let timeline2 = gsap.timeline({repeat: -1});
        let timeline3 = gsap.timeline({repeat: -1});
        let timeline4 = gsap.timeline({repeat: -1});
        let timeline5 = gsap.timeline({repeat: -1});
        let timeline6 = gsap.timeline({repeat: -1});

        const setBallMoves = (timeline, element, reload = false) => {
            const vw = innerWidth / 100;
            const longDuration = 3;
            const shortDuration = 0.4;
            const moves = [
                {
                    path: [
                        {x: 0 * vw, y: 5 * vw},
                        {x: 0 * vw, y: 58 * vw},
                    ],
                    duration: longDuration,
                    type: 'linear',
                },
                {
                    path: [
                        {x: 0 * vw, y: 58 * vw},
                        {x: 1.4 * vw, y: 61.6 * vw},
                        {x: 5 * vw, y: 63 * vw},
                    ],
                    duration: shortDuration,
                },
                {
                    path: [
                        {x: 5 * vw, y: 63 * vw},
                        {x: 58 * vw, y: 63 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 58 * vw, y: 63 * vw},
                        {x: 61.6 * vw, y: 61.6 * vw},
                        {x: 63 * vw, y: 58 * vw},
                    ],
                    duration: shortDuration,
                },
                {
                    path: [
                        {x: 63 * vw, y: 58 * vw},
                        {x: 63 * vw, y: 5 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 63 * vw, y: 5 * vw},
                        {x: 61.6 * vw, y: 1.4 * vw},
                        {x: 58 * vw, y: 0 * vw},
                    ],
                    duration: shortDuration,
                },
                {
                    path: [
                        {x: 58 * vw, y: 0 * vw},
                        {x: 5 * vw, y: 0 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 5 * vw, y: 0 * vw},
                        {x: 1.4 * vw, y: 1.4 * vw},
                        {x: 0 * vw, y: 5 * vw},
                    ],
                    duration: shortDuration,
                },
            ];
            if (reload) {
                gsap.set(element, {
                    ...moves[0].path[0],
                    rotation: 90,
                    opacity: 1,
                });
            }
            let tempTime = 1;
            moves.forEach((obj) => {
                timeline.to(element, {
                    motionPath: obj.path,
                    ease: 'none',
                    duration: obj.duration,
                    curviness: obj.curviness || 1,
                });
            });
            const disappears = [
                {time: 1.7, type: 'off'},
                {time: 2.45, type: 'on'},
                {time: 3.8, type: 'off'},
                {time: 4.65, type: 'on'},
                {time: 8.4, type: 'off'},
                {time: 9.15, type: 'on'},
                {time: 10.58, type: 'off'},
                {time: 11.45, type: 'on'},
            ];
            disappears.forEach((obj) => {
                timeline.to(
                    element,
                    {opacity: obj.type === 'on' ? 1 : 0, duration: 0.1},
                    obj.time
                );
            });
            return timeline;
        };

        const setTriangleMoves = (timeline, element, reload) => {
            const vw = innerWidth / 100;
            const longDuration = 3;
            const shortDuration = 0.4;
            const moves = [
                {
                    path: [
                        {x: 63 * vw, y: 58 * vw},
                        {x: 63 * vw, y: 5 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 63 * vw, y: 5 * vw},
                        {x: 61.6 * vw, y: 1.4 * vw},
                        {x: 58 * vw, y: 0 * vw},
                    ],
                    rotation: -45,
                    duration: shortDuration,
                },
                {
                    path: [
                        {x: 58 * vw, y: 0 * vw},
                        {x: 5 * vw, y: 0 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 5 * vw, y: 0 * vw},
                        {x: 1.4 * vw, y: 1.4 * vw},
                        {x: 0 * vw, y: 5 * vw},
                    ],
                    rotation: -135,

                    duration: shortDuration,
                },
                {
                    path: [
                        {x: 0 * vw, y: 5 * vw},
                        {x: 0 * vw, y: 58 * vw},
                    ],
                    duration: longDuration,
                    type: 'linear',
                },
                {
                    path: [
                        {x: 0 * vw, y: 58 * vw},
                        {x: 1.4 * vw, y: 61.6 * vw},
                        {x: 5 * vw, y: 63 * vw},
                    ],
                    rotation: -225,

                    duration: shortDuration,
                },
                {
                    path: [
                        {x: 5 * vw, y: 63 * vw},
                        {x: 58 * vw, y: 63 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 58 * vw, y: 63 * vw},
                        {x: 61.6 * vw, y: 61.6 * vw},
                        {x: 63 * vw, y: 58 * vw},
                    ],
                    duration: shortDuration,
                },
            ];
            let tempTime = 1;
            timeline.set(element, {
                x: 63 * vw,
                y: 58 * vw,
            });
            if (reload) {
                gsap.set(element, {
                    ...moves[0].path[0],
                    rotation: 45,
                    opacity: 1,
                });
            }
            let lastRotation = -45;
            moves.forEach((obj) => {
                timeline.to(element, {
                    motionPath: obj.path,
                    ease: 'none',
                    duration: obj.duration,
                    curviness: obj.curviness || 1,
                    rotation: obj.rotation,
                });
                lastRotation = obj.rotation || lastRotation;
            });

            const disappears = [
                {time: 1.7, type: 'off'},
                {time: 2.35, type: 'on'},
                {time: 3.75, type: 'off'},
                {time: 4.6, type: 'on'},
                {time: 8.4, type: 'off'},
                {time: 9.23, type: 'on'},
                {time: 10.58, type: 'off'},
                {time: 11.45, type: 'on'},
            ];
            disappears.forEach((obj) => {
                timeline.to(
                    element,
                    {opacity: obj.type === 'on' ? 1 : 0, duration: 0.1},
                    obj.time
                );
            });
            return timeline;
        };

        const setSquare1CircleMoves = (timeline, element, reload) => {
            const vw = innerWidth / 100;
            const longDuration = 3;
            const shortDuration = 2;
            const moves = [
                {
                    path: [
                        {x: 23 * vw, y: 0 * vw},
                        {x: 65 * vw, y: 0 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 67 * vw, y: 0 * vw},
                        {x: 74 * vw, y: 2 * vw},
                        {x: 82.5 * vw, y: 7.5 * vw},
                        {x: 87 * vw, y: 14 * vw},
                        {x: 90 * vw, y: 23 * vw},
                    ],
                    duration: shortDuration,
                },
                {
                    path: [
                        {x: 90 * vw, y: 25 * vw},
                        {x: 90 * vw, y: 67 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 90 * vw, y: 67 * vw},
                        {x: 88 * vw, y: 74 * vw},
                        {x: 82.5 * vw, y: 82.5 * vw},
                        {x: 74 * vw, y: 88 * vw},
                        {x: 67 * vw, y: 90 * vw},
                    ],
                    duration: shortDuration,
                },
                {
                    path: [
                        {x: 67 * vw, y: 90 * vw},
                        {x: 23 * vw, y: 90 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 23 * vw, y: 90 * vw},
                        {x: 14 * vw, y: 87 * vw},
                        {x: 7.5 * vw, y: 82.5 * vw},
                        {x: 2 * vw, y: 74 * vw},
                        {x: 0 * vw, y: 67 * vw},
                    ],
                    duration: shortDuration,
                },
                {
                    path: [
                        {x: 0 * vw, y: 67 * vw},
                        {x: 0 * vw, y: 23 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 0 * vw, y: 23 * vw},
                        {x: 3 * vw, y: 14 * vw},
                        {x: 7.5 * vw, y: 7.5 * vw},
                        {x: 14 * vw, y: 3 * vw},
                        {x: 23 * vw, y: 0 * vw},
                    ],
                    duration: shortDuration,
                },
            ];
            timeline.set(element, {
                x: 23 * vw,
                y: 0 * vw,
            });
            if (reload) {
                gsap.set(element, {
                    ...moves[0].path[0],
                    rotation: 0,
                    opacity: 1,
                });
            }
            moves.forEach((obj) => {
                timeline.to(element, {
                    motionPath: obj.path,
                    ease: 'none',
                    duration: obj.duration,
                    curviness: obj.curviness || 1,
                });
            });
            return timeline;
        };

        const setSquare1Square1Moves = (timeline, element, reload) => {
            const vw = innerWidth / 100;
            const longDuration = 3;
            const shortDuration = 2;
            const moves = [
                {
                    path: [
                        {x: 90 * vw, y: 23 * vw},
                        {x: 90 * vw, y: 67 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 90 * vw, y: 67 * vw},
                        {x: 88 * vw, y: 74 * vw},
                        {x: 82.5 * vw, y: 82.5 * vw},
                        {x: 74 * vw, y: 88 * vw},
                        {x: 67 * vw, y: 90 * vw},
                    ],
                    duration: shortDuration,
                },
                {
                    path: [
                        {x: 67 * vw, y: 90 * vw},
                        {x: 23 * vw, y: 90 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 23 * vw, y: 90 * vw},
                        {x: 14 * vw, y: 87 * vw},
                        {x: 7.5 * vw, y: 82.5 * vw},
                        {x: 2 * vw, y: 74 * vw},
                        {x: 0 * vw, y: 67 * vw},
                    ],
                    duration: shortDuration,
                },
                {
                    path: [
                        {x: 0 * vw, y: 67 * vw},
                        {x: 0 * vw, y: 23 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 0 * vw, y: 23 * vw},
                        {x: 3 * vw, y: 14 * vw},
                        {x: 7.5 * vw, y: 7.5 * vw},
                        {x: 14 * vw, y: 3 * vw},
                        {x: 23 * vw, y: 0 * vw},
                    ],
                    duration: shortDuration,
                },
                {
                    path: [
                        {x: 23 * vw, y: 0 * vw},
                        {x: 65 * vw, y: 0 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 67 * vw, y: 0 * vw},
                        {x: 74 * vw, y: 2 * vw},
                        {x: 82.5 * vw, y: 7.5 * vw},
                        {x: 87 * vw, y: 14 * vw},
                        {x: 90 * vw, y: 23 * vw},
                    ],
                    duration: shortDuration,
                },
            ];

            timeline.set(element, {
                x: 90 * vw,
                y: 23 * vw,
            });
            if (reload) {
                gsap.set(element, {
                    ...moves[0].path[0],
                    rotation: 0,
                    opacity: 1,
                });
            }
            moves.forEach((obj) => {
                timeline.to(element, {
                    motionPath: obj.path,
                    ease: 'none',
                    duration: obj.duration,
                    curviness: obj.curviness || 1,
                });
            });
            return timeline;
        };
        const setSquare1Square2Moves = (timeline, element, reload) => {
            const vw = innerWidth / 100;
            const longDuration = 3;
            const shortDuration = 2;
            const moves = [
                {
                    path: [
                        {x: 0 * vw, y: 67 * vw},
                        {x: 0 * vw, y: 23 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 0 * vw, y: 23 * vw},
                        {x: 3 * vw, y: 14 * vw},
                        {x: 7.5 * vw, y: 7.5 * vw},
                        {x: 14 * vw, y: 3 * vw},
                        {x: 23 * vw, y: 0 * vw},
                    ],
                    duration: shortDuration,
                },
                {
                    path: [
                        {x: 23 * vw, y: 0 * vw},
                        {x: 65 * vw, y: 0 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 67 * vw, y: 0 * vw},
                        {x: 74 * vw, y: 2 * vw},
                        {x: 82.5 * vw, y: 7.5 * vw},
                        {x: 87 * vw, y: 14 * vw},
                        {x: 90 * vw, y: 23 * vw},
                    ],
                    duration: shortDuration,
                },
                {
                    path: [
                        {x: 90 * vw, y: 23 * vw},
                        {x: 90 * vw, y: 67 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 90 * vw, y: 67 * vw},
                        {x: 88 * vw, y: 74 * vw},
                        {x: 82.5 * vw, y: 82.5 * vw},
                        {x: 74 * vw, y: 88 * vw},
                        {x: 67 * vw, y: 90 * vw},
                    ],
                    duration: shortDuration,
                },
                {
                    path: [
                        {x: 67 * vw, y: 90 * vw},
                        {x: 23 * vw, y: 90 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 23 * vw, y: 90 * vw},
                        {x: 14 * vw, y: 87 * vw},
                        {x: 7.5 * vw, y: 82.5 * vw},
                        {x: 2 * vw, y: 74 * vw},
                        {x: 0 * vw, y: 67 * vw},
                    ],
                    duration: shortDuration,
                },
            ];
            timeline.set(element, {x: 0 * vw, y: 67 * vw});
            if (reload) {
                gsap.set(element, {
                    ...moves[0].path[0],
                    rotation: 0,
                    opacity: 1,
                });
            }
            moves.forEach((obj) => {
                timeline.to(element, {
                    motionPath: obj.path,
                    ease: 'none',
                    duration: obj.duration,
                    curviness: obj.curviness || 1,
                });
            });
            return timeline;
        };

        const setSquare1TriangleMoves = (timeline, element, reload) => {
            const vw = innerWidth / 100;
            const longDuration = 3;
            const shortDuration = 2;
            const moves = [
                {
                    path: [
                        {x: 67 * vw, y: 90 * vw},
                        {x: 23 * vw, y: 90 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 23 * vw, y: 90 * vw},
                        {x: 14 * vw, y: 87 * vw},
                        {x: 7.5 * vw, y: 82.5 * vw},
                        {x: 2 * vw, y: 74 * vw},
                        {x: 0 * vw, y: 67 * vw},
                    ],
                    duration: shortDuration,
                    rotation: 45,
                },
                {
                    path: [
                        {x: 0 * vw, y: 67 * vw},
                        {x: 0 * vw, y: 23 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 0 * vw, y: 23 * vw},
                        {x: 3 * vw, y: 14 * vw},
                        {x: 7.5 * vw, y: 7.5 * vw},
                        {x: 14 * vw, y: 3 * vw},
                        {x: 23 * vw, y: 0 * vw},
                    ],
                    duration: shortDuration,
                    rotation: 135,
                },
                {
                    path: [
                        {x: 23 * vw, y: 0 * vw},
                        {x: 65 * vw, y: 0 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 67 * vw, y: 0 * vw},
                        {x: 74 * vw, y: 2 * vw},
                        {x: 82.5 * vw, y: 7.5 * vw},
                        {x: 87 * vw, y: 14 * vw},
                        {x: 90 * vw, y: 23 * vw},
                    ],
                    duration: shortDuration,
                    rotation: 225,
                },
                {
                    path: [
                        {x: 90 * vw, y: 25 * vw},
                        {x: 90 * vw, y: 67 * vw},
                    ],
                    type: 'linear',
                    duration: longDuration,
                },
                {
                    path: [
                        {x: 90 * vw, y: 67 * vw},
                        {x: 88 * vw, y: 74 * vw},
                        {x: 82.5 * vw, y: 82.5 * vw},
                        {x: 74 * vw, y: 88 * vw},
                        {x: 67 * vw, y: 90 * vw},
                    ],
                    duration: shortDuration,
                },
            ];

            timeline.set(element, {x: 67 * vw, y: 90 * vw});
            if (reload) {
                gsap.set(element, {
                    ...moves[0].path[0],
                    rotation: 90,
                    opacity: 1,
                });
            }
            moves.forEach((obj) => {
                timeline.to(element, {
                    motionPath: obj.path,
                    ease: 'none',
                    duration: obj.duration,
                    curviness: obj.curviness || 1,
                    rotation: obj.rotation,
                });
            });
            return timeline;
        };

        setBallMoves(
            timeline,
            '.home-hero > .square1 > .square2 > .figures > .smallcircle'
        );
        setTriangleMoves(
            timeline2,
            '.home-hero > .square1 > .square2 > .figures > .smalltriangle'
        );
        setSquare1CircleMoves(
            timeline3,
            '.home-hero > .square1 > .figures > .smallcircle'
        );
        setSquare1Square1Moves(
            timeline4,
            '.home-hero > .square1 > .figures > .smallsquare'
        );
        setSquare1TriangleMoves(
            timeline5,
            '.home-hero > .square1 > .figures > .smalltriangle'
        );
        setSquare1Square2Moves(
            timeline6,
            '.home-hero > .square1 > .figures > .smallsquare1'
        );

        const figures = [
            '.home-hero > .square1 > .square2 > .figures > .smallcircle',
            '.home-hero > .square1 > .square2 > .figures > .smalltriangle',
            '.home-hero > .square1 > .figures > .smallcircle',
            '.home-hero > .square1 > .figures > .smallsquare',
            '.home-hero > .square1 > .figures > .smalltriangle',
            '.home-hero > .square1 > .figures > .smallsquare1',
        ];

        window.addEventListener(
            'resize',
            debounce(() => {
                figures.forEach((figure) => {
                    document.querySelector(figure).style.display = 'none';
                });
                timeline.kill();
                timeline.clear();
                timeline2.kill();
                timeline2.clear();
                timeline3.kill();
                timeline3.clear();
                timeline4.kill();
                timeline4.clear();
                timeline5.kill();
                timeline5.clear();
                timeline6.kill();
                timeline6.clear();
                setBallMoves(
                    timeline,
                    '.home-hero > .square1 > .square2 > .figures > .smallcircle',
                    true
                );
                setTriangleMoves(
                    timeline2,
                    '.home-hero > .square1 > .square2 > .figures > .smalltriangle',
                    true
                );
                setSquare1CircleMoves(
                    timeline3,
                    '.home-hero > .square1 > .figures > .smallcircle',
                    true
                );
                setSquare1Square1Moves(
                    timeline4,
                    '.home-hero > .square1 > .figures > .smallsquare',
                    true
                );
                setSquare1TriangleMoves(
                    timeline5,
                    '.home-hero > .square1 > .figures > .smalltriangle',
                    true
                );
                setSquare1Square2Moves(
                    timeline6,
                    '.home-hero > .square1 > .figures > .smallsquare1',
                    true
                );
                figures.forEach((figure) => {
                    document.querySelector(figure).style.display = 'block';
                });
            }, 500)
        );
    }
};
