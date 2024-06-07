const handleFaqItem = () => {
    document.body.addEventListener('click', (e) => {
        const target = e.target as HTMLElement;
        const { role } = target.dataset;

        if (!role) return;

        switch (role) {
            case 'handle-faq-item': {
                e.preventDefault();
                const parentFaqItem = target.closest('.js-faq-item') as HTMLElement;

                if (!parentFaqItem) return;
                const actionType = parentFaqItem.classList.contains('active') ? 'remove' : 'add';
                parentFaqItem.classList[actionType]('active');

                break;
            }

            default:
                break;
        }
    });
};

document.addEventListener('DOMContentLoaded', handleFaqItem, false);

// Initialize dynamic block preview (editor).
if (window['acf']) {
    window['acf']?.addAction('render_block_preview', handleFaqItem);
}

export {};
