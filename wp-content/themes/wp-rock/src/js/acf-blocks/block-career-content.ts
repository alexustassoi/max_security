
const initBlockCareerContent = () => {
	const file = document.querySelector('.js-file-button input[type="file"]') as HTMLInputElement;

	if (file) {
		file.onchange = () => {
			const fileNameSpan = document.querySelector('.js-file-name') as HTMLElement;

			if (fileNameSpan && file.files && file.files[0]) {
				fileNameSpan.innerHTML = file?.files[0].name;
			}
		}
	}
};

document.addEventListener('DOMContentLoaded', initBlockCareerContent, false);

// Initialize dynamic block preview (editor).
if (window['acf']) {
	window['acf']?.addAction('render_block_preview', initBlockCareerContent);
}

export { };
