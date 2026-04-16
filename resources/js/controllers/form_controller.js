import { Controller } from '@hotwired/stimulus';

/**
 * form_controller — intercepts screen method calls and submits to the correct URL.
 */
export default class extends Controller {
    static values = { action: String };

    submit(event) {
        const btn    = event.currentTarget;
        const method = btn.dataset.method ?? 'save';
        const base   = window.location.pathname.replace(/\/$/, '');

        this.element.action = `${base}/${method}`;
        this.element.submit();
    }
}
