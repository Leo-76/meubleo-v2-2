import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static values = { message: String };

    confirm(event) {
        const msg = this.messageValue || 'Are you sure?';
        if (!window.confirm(msg)) {
            event.preventDefault();
            event.stopPropagation();
        }
    }
}
