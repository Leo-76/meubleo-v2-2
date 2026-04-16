/**
 * Meubleo Shop — Admin Panel JS Entry Point
 *
 * Registers all Stimulus controllers and initialises Bootstrap.
 */

import 'bootstrap';
import { Application } from '@hotwired/stimulus';

// ─── Import controllers ───────────────────────────────────────────────────────
import TableController      from './controllers/table_controller';
import FormController       from './controllers/form_controller';
import ModalController      from './controllers/modal_controller';
import ToastController      from './controllers/toast_controller';
import SelectController     from './controllers/select_controller';
import DatetimeController   from './controllers/datetime_controller';
import SortableController   from './controllers/sortable_controller';
import ConfirmController    from './controllers/confirm_controller';
import ToggleController     from './controllers/toggle_controller';

// ─── Start Stimulus ───────────────────────────────────────────────────────────
const application = Application.start();

application.register('meubleo-table',    TableController);
application.register('meubleo-form',     FormController);
application.register('meubleo-modal',    ModalController);
application.register('meubleo-toast',    ToastController);
application.register('meubleo-select',   SelectController);
application.register('meubleo-datetime', DatetimeController);
application.register('meubleo-sortable', SortableController);
application.register('meubleo-confirm',  ConfirmController);
application.register('meubleo-toggle',   ToggleController);

window.MeubleoApp = application;
