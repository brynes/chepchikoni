/* COMPONENT - Example 1.0 */

(function () {
	'use strict';
    
	/*********************************************************************************/
	/*****   ON DOCUMENT LOAD                                            ************/
	/*******************************************************************************/
	jQuery(function() {
		if (document.querySelector('section.component.nearby-gyms')) {
            document.querySelector('section.component.nearby-gyms .gym-btn').addEventListener('click', function () {
                var panel = this.parentElement.querySelector('.gym-panel');
                
                this.classList.toggle('open');
                panel.classList.toggle('open');
                if (this.classList.contains('open')) {
                    panel.style.height = panel.querySelector('.gym-container').offsetHeight + 'px';
                } else {
                    panel.style.height = '0px';
                }
            });
            document.querySelector('section.component.nearby-gyms .gym-btn').click();
        }
	});

})();