import { Controller } from '@hotwired/stimulus';
import Sortable from 'sortablejs';

export default class extends Controller {
    static values = {
        url:    String,
        handle: String,
    };

    connect() {
        this.sortable = Sortable.create(this.element, {
            handle:    this.handleValue || '[data-sort-handle]',
            animation: 150,
            onEnd: (event) => {
                if (!this.urlValue) return;

                const items = [...this.element.querySelectorAll('[data-id]')]
                    .map((el, index) => ({ id: el.dataset.id, order: index }));

                fetch(this.urlValue, {
                    method:  'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                    },
                    body: JSON.stringify({ items }),
                });
            },
        });
    }

    disconnect() {
        this.sortable?.destroy();
    }
}
