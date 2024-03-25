const initBlockOurTeam = () => {
    const memberItem = document.querySelectorAll('.js-member-item') as NodeList;

    memberItem &&
        memberItem.forEach((item) => {
            const member = item as HTMLElement;
            member.addEventListener('click', () => member.classList.toggle('opened'));
        });
};

document.addEventListener('DOMContentLoaded', initBlockOurTeam, false);

// Initialize dynamic block preview (editor).
// eslint-disable-next-line dot-notation
if (window['acf']) {
    // eslint-disable-next-line dot-notation
    window['acf']?.addAction('render_block_preview', initBlockOurTeam);
}

export {};
