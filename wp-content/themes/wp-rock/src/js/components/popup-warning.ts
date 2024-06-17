const popupWarningTrigger = (button) => {
    if (button instanceof HTMLElement) {
        const idWarning = button.getAttribute('data-id');
        const formData = new FormData();
        const action = 'get_popup_warning';

        if (!idWarning) {
            return false;
        }

        formData.append('action', action);
        formData.append('id', idWarning);

        const popupBody = document.querySelector('#popup-request-demo');

        // @ts-ignore
        fetch(var_from_php.ajax_url, {
            method: 'POST',
            credentials: 'same-origin',
            body: formData,
        })
            .then((response) => response.json())
            .then((response) => {
                if (response.success && response.data && popupBody) {
                    const wrap = popupBody.querySelector('.js-popup-inner');

                    if (wrap) {
                        wrap.innerHTML = response.data;
                    }
                }
            });

        console.log('button', button, idWarning);
    }
};

export default popupWarningTrigger;
