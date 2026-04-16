import { Controller } from '@hotwired/stimulus';

/**
 * table_controller — handles column sorting and row selection.
 */
export default class extends Controller {
    static targets = ['checkbox', 'selectAll'];

    connect() {
        this.updateSelectAll();
    }

    toggleAll(event) {
        this.checkboxTargets.forEach(cb => {
            cb.checked = event.target.checked;
        });
    }

    updateSelectAll() {
        if (!this.hasSelectAllTarget) return;
        const total   = this.checkboxTargets.length;
        const checked = this.checkboxTargets.filter(cb => cb.checked).length;
        this.selectAllTarget.checked       = checked === total && total > 0;
        this.selectAllTarget.indeterminate = checked > 0 && checked < total;
    }

    sort(event) {
        const th  = event.currentTarget;
        const key = th.dataset.column;
        const url = new URL(window.location.href);
        const current = url.searchParams.get('sort');

        url.searchParams.set('sort', key);
        url.searchParams.set('direction', current === key ? 'desc' : 'asc');
        window.location.href = url.toString();
    }
}
