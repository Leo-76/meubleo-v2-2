import { Controller } from '@hotwired/stimulus';
import TomSelect from 'tom-select';

export default class extends Controller {
    static values = {
        url:        String,
        multiple:   Boolean,
        create:     Boolean,
        maxOptions: Number,
    };

    connect() {
        this.select = new TomSelect(this.element, {
            plugins:    this.multipleValue ? ['remove_button'] : [],
            create:     this.createValue,
            maxOptions: this.maxOptionsValue || 50,
            ...(this.urlValue ? {
                load: (query, callback) => {
                    fetch(`${this.urlValue}?search=${encodeURIComponent(query)}`)
                        .then(r => r.json())
                        .then(callback)
                        .catch(() => callback());
                },
            } : {}),
        });
    }

    disconnect() {
        this.select?.destroy();
    }
}
