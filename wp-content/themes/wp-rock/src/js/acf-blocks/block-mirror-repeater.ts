const initBlockJourney = () => {
    const mirrorItem = document.querySelectorAll('.js-mirror-item') as NodeList;
    const loadMoreBtn = document.querySelector('.js-load-more') as HTMLElement;

    loadMoreBtn &&
        loadMoreBtn.addEventListener('click', () => {
            loadMoreBtn && loadMoreBtn.classList.add('hide');

            mirrorItem &&
                mirrorItem.forEach((item) => {
                    const el = item as HTMLElement;
                    el.classList.remove('hide');
                });
        });
};

document.addEventListener('DOMContentLoaded', initBlockJourney, false);

// Initialize dynamic block preview (editor).
// eslint-disable-next-line dot-notation
if (window['acf']) {
    // eslint-disable-next-line dot-notation
    window['acf']?.addAction('render_block_preview', initBlockJourney);
}

export {};
