import { Controller } from '@hotwired/stimulus';
import flatpickr from 'flatpickr';

export default class extends Controller {
    static values = {
        enableTime: Boolean,
        noCalendar: Boolean,
        format:     String,
        minDate:    String,
        maxDate:    String,
    };

    connect() {
        this.picker = flatpickr(this.element, {
            enableTime: this.enableTimeValue || true,
            noCalendar: this.noCalendarValue || false,
            dateFormat: this.formatValue     || 'Y-m-d H:i',
            minDate:    this.minDateValue    || null,
            maxDate:    this.maxDateValue    || null,
            allowInput: true,
            time_24hr:  true,
        });
    }

    disconnect() {
        this.picker?.destroy();
    }
}
