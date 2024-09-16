/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

import './sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.css';


// Importar Bootstrap y jQuery desde el vendor de SB Admin 2
import './sb-admin-2/vendor/jquery/jquery.min.js';
import './sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js';

// Importar el JavaScript principal de SB Admin 2
import './sb-admin-2/js/sb-admin-2.min.js';


// start the Stimulus application
import './bootstrap';
