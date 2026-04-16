import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['content'];
    static classes = ['hidden'];

    toggle() {
        this.contentTargets.forEach(el => {
            el.classList.toggle(this.hiddenClasses[0] || 'd-none');
        });
    }

    show() {
        this.contentTargets.forEach(el => el.classList.remove(this.hiddenClasses[0] || 'd-none'));
    }

    hide() {
        this.contentTargets.forEach(el => el.classList.add(this.hiddenClasses[0] || 'd-none'));
    }
}
