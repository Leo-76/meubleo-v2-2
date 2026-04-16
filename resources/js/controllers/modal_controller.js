import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['dialog'];

    open()  { this.dialogTarget?.showModal?.() || (this.dialogTarget.style.display = 'flex'); }
    close() { this.dialogTarget?.close?.()     || (this.dialogTarget.style.display = 'none'); }
}
