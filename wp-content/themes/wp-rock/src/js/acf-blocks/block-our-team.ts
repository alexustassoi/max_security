const initBlockOurTeam = () => {
	const memberItem = document.querySelectorAll( '.js-member-item' ) as NodeList;
	const body = window.document.querySelector('body') as HTMLElement;
	const html = window.document.querySelector('html') as HTMLElement;
	
	memberItem &&
	memberItem.forEach( ( item ) => {
		const member = item as HTMLElement;
		if ( window.innerWidth > 680 ) {
			member.addEventListener( 'click', () => member.classList.toggle( 'opened' ) );
		} else {
			member.addEventListener( 'click', (event) => {
				
				const target = event.target as HTMLElement;
				if (target.classList.contains('js-member-item-btn')) {
					member.classList.remove( 'opened' );
					body.classList.remove( 'scroll-off' );
					html.classList.remove( 'scroll-off' );
				} else {
					member.classList.add( 'opened' );
					body.classList.add( 'scroll-off' );
					html.classList.add( 'scroll-off' );
				}
				
			} );
		}
	} );
};

document.addEventListener( 'DOMContentLoaded', initBlockOurTeam, false );

// Initialize dynamic block preview (editor).
// eslint-disable-next-line dot-notation
if ( window['acf'] ) {
	// eslint-disable-next-line dot-notation
	window['acf']?.addAction( 'render_block_preview', initBlockOurTeam );
}

export {};
