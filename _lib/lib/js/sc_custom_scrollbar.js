/**------------------------------------------------------------------------
 * @class - Customização da barra de rolagem de elementos HTML.
 * @param {string} target - Seletor CSS.
 * @param {object} settings - Objeto de customização da barra de rolagem.
 * - minWidth {string} largura da scrollbar
 * - maxWidth {string} largura da scrollbar no evento hover
 *------------------------------------------------------------------------*/
class CustomScrollbar {
	static #DATASCROLLBAR = 'custom-scrollbar';
	static #CONFIG;
	static #SETTINGS;
    static #APPLIEDSTYLE;
    static #APPLIEDSCRIPT;
    static #TARGETS;
    static #SCROLLBARCSS;
    static #SCROLLBARSCRIPT;


    constructor(target, options) {
    	/** @public @type {string} seletor */
        this.target = target;
        /** @private @type {object}  Configurações default à customização da barra de rolagem */
        CustomScrollbar.#CONFIG =  {
        	minWidth:'8px',
        	maxWidth:'16px',
        	borderRadius: '16px',
        	lightColor: '#eaedf1',
        	mediumColor: '#d0d0d0',
        	darkColor: '#888888',

        	scrollbarBgColor: null,
        	scrollbarBgColorOnHover: null,

        	showTrack: false,
        	trackBgColor: 'transparent',
        	trackBgColorOnHover: 'transparent',

        	thumbBgColor: null,
        	thumbBgColorOnHover: null,
        	thumbBorder: null,
        	thumbBorderOnHover: null,

        	showArrow: true,
        	showArrowOnHover: true,
        	arrowColor: null,
        	arrowColorOnHover: null,
        	arrowBgColor: null,
        };
        /** @public @type {object}  Configurações do usuário à customização da barra de rolagem */
        this.options = options ? options : null;
        /** @private @type {object}  Merge dos objetos config e options */
        CustomScrollbar.#SETTINGS = {...CustomScrollbar.#CONFIG, ...options};
        /** @private @type {string} node element */
    	CustomScrollbar.#TARGETS = document.querySelectorAll(this.target);
    	/** @private @type {boolean} */
    	CustomScrollbar.#APPLIEDSTYLE = false;
    	/** @private @type {boolean} */
    	CustomScrollbar.#APPLIEDSCRIPT = false;
    	/** @private @type {string} */
    	CustomScrollbar.#SCROLLBARCSS = `
			:root {
				--scrollbar-min-size: ${CustomScrollbar.#SETTINGS.minWidth};
				--scrollbar-max-size: ${CustomScrollbar.#SETTINGS.maxWidth};
				--scrollbar-light-color: ${CustomScrollbar.#SETTINGS.lightColor};
				--scrollbar-medium-color: ${CustomScrollbar.#SETTINGS.mediumColor};
				--scrollbar-dark-color: ${CustomScrollbar.#SETTINGS.darkColor};

				--scrollbar-radius: ${CustomScrollbar.#SETTINGS.borderRadius};

				--scrollbar-background-color: ${CustomScrollbar.#SETTINGS.scrollbarBgColor ? CustomScrollbar.#SETTINGS.scrollbarBgColor : 'transparent'};
				--scrollbar-background-color-hover: ${CustomScrollbar.#SETTINGS.scrollbarBgColorOnHover ? CustomScrollbar.#SETTINGS.scrollbarBgColorOnHover : 'var(--scrollbar-light-color)'};

				--scrollbar-track-background-color: ${CustomScrollbar.#SETTINGS.trackBgColor};
				--scrollbar-track-background-color-hover: ${CustomScrollbar.#SETTINGS.trackBgColorOnHover};

				--scrollbar-thumb-background-color: ${CustomScrollbar.#SETTINGS.thumbBgColor ? CustomScrollbar.#SETTINGS.thumbBgColor :  'var(--scrollbar-medium-color)'};
				--scrollbar-thumb-background-color-hover: ${CustomScrollbar.#SETTINGS.thumbBgColorOnHover ? CustomScrollbar.#SETTINGS.thumbBgColorOnHover :  'var(--scrollbar-dark-color)'};
				--scrollbar-thumb-border: ${CustomScrollbar.#SETTINGS.thumbBorder ? CustomScrollbar.#SETTINGS.thumbBorder : '.75px solid var(--scrollbar-light-color)'};
				--scrollbar-thumb-border-hover: ${CustomScrollbar.#SETTINGS.thumbBorderOnHover ? CustomScrollbar.#SETTINGS.thumbBorderOnHover : '.75px solid var(--scrollbar-light-color)'};

				--scrollbar-button-min-width: calc(var(--scrollbar-min-size) / 2);
				--scrollbar-button-max-width: calc(var(--scrollbar-max-size) / 2);
				--scrollbar-arrow-background-color: ${CustomScrollbar.#SETTINGS.arrowBgColor ? CustomScrollbar.#SETTINGS.arrowBgColor : 'transparent'};
			}

			/* Scrollbar
			--------------------------------------*/
			*::-webkit-scrollbar {
				width: var(--scrollbar-min-size);
				height: var(--scrollbar-min-size);
				border-radius: var(--scrollbar-radius);
				background-color: var(--scrollbar-background-color);
			}
			*.change-width::-webkit-scrollbar {
				 width: var(--scrollbar-max-size);
				 height: var(--scrollbar-max-size);
				 background-color: var(--scrollbar-background-color-hover);
			}

			/* Scrollbar Track
			--------------------------------------*/
			*::-webkit-scrollbar-track {
				border-radius: var(--scrollbar-radius);
				background-color: ${CustomScrollbar.#SETTINGS.showTrack ? 'var(--scrollbar-track-background-color)' : 'transparent'};
			}
			*.change-width::-webkit-scrollbar-track {
				background-color: ${CustomScrollbar.#SETTINGS.showTrack ? 'var(--scrollbar-track-background-color-hover)' : 'transparent'};
			}

			/* Scrollbar Corner
			--------------------------------------*/
			*::-webkit-scrollbar-corner {
				background-color: transparent;
			}

			/* Scrollbar Thumb
			--------------------------------------*/
			*::-webkit-scrollbar-thumb {
				border: var(--scrollbar-thumb-border);
				border-radius: var(--scrollbar-radius);
				background-color: var(--scrollbar-thumb-background-color);
			}
			*::-webkit-scrollbar-thumb:hover {
				border: var(--scrollbar-thumb-border-hover);
				background-color: var(--scrollbar-thumb-background-color-hover);
			}
			*::-webkit-scrollbar-thumb,
			*::-webkit-scrollbar-thumb:hover,
			*::-webkit-scrollbar-thumb:active {
				background-clip: padding-box;
			}

			/* Scrollbar Button
			--------------------------------------*/
			::-webkit-scrollbar-button:single-button {
				width: auto;
				height: auto;
				background-size: 10px;
				background-repeat: no-repeat;
				display: ${CustomScrollbar.#SETTINGS.showArrow ? 'block' : 'none'};
		    }
		    *.change-width::-webkit-scrollbar-button:single-button {
		    	display: ${CustomScrollbar.#SETTINGS.showArrowOnHover ? 'block' : 'none'};
		    }

		    /*------- setas -------*/
		    ::-webkit-scrollbar-button:single-button:vertical:decrement,
		    ::-webkit-scrollbar-button:single-button:vertical:increment,
		    ::-webkit-scrollbar-button:single-button:horizontal:decrement,
		    ::-webkit-scrollbar-button:single-button:horizontal:increment {
		    	width: var(--scrollbar-min-size);
				height: var(--scrollbar-min-size);
		    }

		    /*------- seta horizontal esquerda -------*/
		    ::-webkit-scrollbar-button:single-button:horizontal:decrement {
				background-position: center calc(var(--scrollbar-min-size) / 4);
				background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512' fill='${CustomScrollbar.#SETTINGS.arrowColor}'><path d='M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z'/></svg>");
		    }
		    ::-webkit-scrollbar-button:single-button:horizontal:decrement:hover {
				background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512' fill='${CustomScrollbar.#SETTINGS.arrowColorOnHover}'><path d='M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z'/></svg>");
		    }

		    /*------- seta horizontal direita -------*/
		    ::-webkit-scrollbar-button:single-button:horizontal:increment {
				background-position: center calc(var(--scrollbar-min-size) / 4);
				background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512' fill='${CustomScrollbar.#SETTINGS.arrowColor}'><path d='M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z'/></svg>");
		    }
		    ::-webkit-scrollbar-button:single-button:horizontal:increment:hover {
				background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512' fill='${CustomScrollbar.#SETTINGS.arrowColorOnHover}'><path d='M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z'/></svg>");
		    }

		    /*------- seta vertical topo -------*/
		    ::-webkit-scrollbar-button:single-button:vertical:decrement {
			   background-position: center calc(var(--scrollbar-min-size) / 4);
			   background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512' fill='${CustomScrollbar.#SETTINGS.arrowColor}'><path d='M201.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 2.5-45.3 0L224 173.3 54.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z'/></svg>");
		    }
		    ::-webkit-scrollbar-button:single-button:vertical:decrement:hover {
				background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512' fill='${CustomScrollbar.#SETTINGS.arrowColorOnHover}'><path d='M201.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 2.5-45.3 0L224 173.3 54.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z'/></svg>");
		    }

		    /*------- seta vertical abaixo -------*/
		    ::-webkit-scrollbar-button:single-button:vertical:increment {
				background-position: center 0;
				background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512' fill='${CustomScrollbar.#SETTINGS.arrowColor}'><path d='M201.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 338.7 54.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z'/></svg>");
		    }
		    ::-webkit-scrollbar-button:vertical:single-button:increment:hover {
				background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512' fill='${CustomScrollbar.#SETTINGS.arrowColorOnHover}'><path d='M201.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 338.7 54.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z'/></svg>");
		    }
		`;
		CustomScrollbar.#SCROLLBARSCRIPT = `
			document.addEventListener("mousemove", event => {
		        let scrollElement = document.querySelectorAll('*');
		        let proximitThreshold = ${parseInt(CustomScrollbar.#SETTINGS.maxWidth.replace(/px/g, '')) * 2};

		        if (scrollElement) {
		            scrollElement.forEach(element => {
		                let distance = element.offsetLeft + element.offsetWidth - event.pageX;
		                distance < proximitThreshold && distance > (proximitThreshold * -1) ? element.classList.add('change-width') : element.classList.remove('change-width');
		            })
		        }
		    });
    	`;
    }

    /**
     * @private
     * @description Retorna uma mensagem de console de acordo com o contexto de aplicação e o idioma principal do navegador.
     * @return {string}
     */
    static #consoleMessages(ctx) {
    	const navigatorLang = window.navigator.language;

    	if (/^de\b/.test(navigatorLang)) {
    		return ctx === 'apply' ? 'Anpassung der Bildlaufleiste bereits angewendet!' : 'keine Scrollbar-Anpassung gefunden!'
    	}
    	else if (/^en\b/.test(navigatorLang)) {
    		return ctx === 'apply' ? 'scrollbar customization already applied!' : 'no scrollbar customization found!'
    	}
    	else if (/^es\b/.test(navigatorLang)) {
    		return ctx === 'apply' ? '¡Personalización de la barra de desplazamiento ya aplicada!' : '¡No se encontró ninguna personalización de la barra de desplazamiento!'
    	}
    	else if (/^fr\b/.test(navigatorLang)) {
    		return ctx === 'apply' ? 'personnalisation de la barre de défilement déjà appliquée!' : 'aucune personnalisation de la barre de défilement n\'a été trouvée!'
    	}
    	else if (/^pt\b/.test(navigatorLang)) {
    		return ctx === 'apply' ? 'customização de scrollbar já aplicada!' : 'nenhuma customização de scrollbar encontrada!'
    	}
    }


    /**
     * @private
     * @description Injeta código CSS necessário à customização da barra de rolagem
     * @param  {[type]} scrollContext - Node html
     * @return {object} CustomScrollbar
     */
    static #scrollbarInjectStyle(scrollContext) {
        const styleElementNode = document.createElement('style');
        	  styleElementNode.setAttribute('data-style', CustomScrollbar.#DATASCROLLBAR);
        let styleTextNode = document.createTextNode(CustomScrollbar.#SCROLLBARCSS);
        	styleElementNode.appendChild(styleTextNode);
        scrollContext.tagName === 'IFRAME' ? scrollContext.contentDocument.head.appendChild(styleElementNode) : document.head.appendChild(styleElementNode);

        CustomScrollbar.#APPLIEDSTYLE = true;

        return this;
    }

    /**
     * @private
     * @description Injeta código JavaScript necessário à customização da barra de rolagem
     * @param  {[type]} scrollContext - Node html
     * @return {object} CustomScrollbar
     */
    static #scrollbarInjectScript(scrollContext) {
        const scriptElementNode = document.createElement('script');
        	  scriptElementNode.setAttribute('data-script', CustomScrollbar.#DATASCROLLBAR);
        let scriptTextNode = document.createTextNode(CustomScrollbar.#SCROLLBARSCRIPT);
        	scriptElementNode.appendChild(scriptTextNode);
        scrollContext.tagName === 'IFRAME' ? scrollContext.contentDocument.body.appendChild(scriptElementNode) : document.body.appendChild(scriptElementNode);

        CustomScrollbar.#APPLIEDSCRIPT = true;

        return this;
    }

    /**
     * @public
     * @description Aplica a customização da barra de rolagem ao(s) elemento(s) alvo.
     * @return {object} CustomScrollbar
     */
    apply() {
    	if (!(CustomScrollbar.#APPLIEDSTYLE && CustomScrollbar.#APPLIEDSCRIPT)) {
            CustomScrollbar.#TARGETS.forEach(element => {
                CustomScrollbar.#scrollbarInjectStyle(element);
                CustomScrollbar.#scrollbarInjectScript(element);
                CustomScrollbar.#APPLIEDSTYLE = true;
                CustomScrollbar.#APPLIEDSCRIPT = true;
            });
    	} else {
    		console.warn(`CustomScrollbar.apply() ${CustomScrollbar.#consoleMessages('apply')}`);
    	}

        return this;
    }

    /**
     * @public
     * @description Remove a customização da barra de rolagem do(s) elemento(s) alvo.
     * @return {object} CustomScrollbar
     */
    destroy() {
    	if (CustomScrollbar.#APPLIEDSTYLE && CustomScrollbar.#APPLIEDSCRIPT) {
        	CustomScrollbar.#TARGETS.forEach(target => {
	        	target.tagName === 'IFRAME' ? target.contentDocument.body.removeChild(target.contentDocument.body.querySelector(`[data-script="${CustomScrollbar.#DATASCROLLBAR}"]`)) : document.body.removeChild(document.body.querySelector(`[data-script="${CustomScrollbar.#DATASCROLLBAR}"]`));
	        	target.tagName === 'IFRAME' ? target.contentDocument.head.removeChild(target.contentDocument.head.querySelector(`[data-style="${CustomScrollbar.#DATASCROLLBAR}"]`)) : document.head.removeChild(document.head.querySelector(`[data-style="${CustomScrollbar.#DATASCROLLBAR}"]`));
	        	CustomScrollbar.#APPLIEDSTYLE = false;
                CustomScrollbar.#APPLIEDSCRIPT = false;
        	});
    	} else {
    		console.warn(`CustomScrollbar.destroy(): ${CustomScrollbar.#consoleMessages('destroy')}`);
    	}

    	return this;
    }
}

//export {CustomScrollbar}
