/**
 * Tooltip plugin for Craft CMS 3.x
 *
 * Transforms Craft's CP field instructions into a tooltip.
 *
 * @link      github.com/bryantwells
 * @copyright Copyright (c) 2020 Bryant Wells
 */

function generateTooltips() {
    const tooltips = [...document.querySelectorAll('.instructions')]
    .map(el => new Tooltip(el))
}

class Tooltip {
    constructor(element) {
        this.element = element;
        this.instructions = this.element.innerHTML;
        this.parent = this.element.closest('.field');
        this.heading = this.parent.querySelector('.heading');
        this.label = this.heading.querySelector('label') || this.heading.querySelector('legend');
        
        this.tooltip = document.createElement('div');

        this.init();
    }

    init() {
        // hide instructions
        this.element.classList.add('u-hidden--tooltip');

        // build and insert icon
        this.tooltip.innerHTML = `
            <div class="Tooltip">
                <div class="Tooltip-icon" data-icon="info"></div>
                <div class="Tooltip-body">${ this.instructions }</div>
            </div>
        `;
        this.label.after(this.tooltip);
    }
}
