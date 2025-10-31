<script>
    document.addEventListener('DOMContentLoaded', () => {

        // --- Navbar Burger ---
        const $burgers = document.querySelectorAll('.navbar-burger');

        $burgers.forEach(el => {
            el.addEventListener('click', () => {
                const target = el.dataset.target;
                const $target = document.getElementById(target);
                
                el.classList.toggle('is-active');
                $target.classList.toggle('is-active');
            });
        });

        // --- Modal de Cierre de Sesión (Bulma) ---
        const modalLogout = document.getElementById('modal-logout');
        const btnAbrir = document.getElementById('btn-abrir-logout');
        const btnEjecutar = document.getElementById('btn-ejecutar-logout');
        const urlFinal = document.getElementById('btn-confirmar-logout');

        // Abrir Modal
        if (btnAbrir && modalLogout) {
            btnAbrir.addEventListener('click', (e) => {
                e.preventDefault(); 
                modalLogout.classList.add('is-active'); 
            });
        }
        
        // Cerrar Modal
        const closeElements = [
            document.getElementById('btn-cancelar-logout'),
            modalLogout.querySelector('.modal-background'),
            modalLogout.querySelector('.modal-close') 
        ];

        closeElements.forEach(el => {
            if (el) {
                el.addEventListener('click', () => modalLogout.classList.remove('is-active'));
            }
        });

        // Confirmar y Redirigir
        if (btnEjecutar && urlFinal) {
            btnEjecutar.addEventListener('click', () => {
                window.location.href = urlFinal.href;
            });
        }

        // --- Formularios AJAX ---
        const formsAjax = document.querySelectorAll(".FormularioAjax");
        
        function sendAjaxForm(e) {
            e.preventDefault(); 
            
            // Lógica de confirmación comentada para envío directo:
            /* let enviar = confirm("Quieres enviar el formulario");
            if (enviar == true) */
            
            {
                const form = this;
                const data = new FormData(form);
                const method = form.getAttribute("method");
                const action = form.getAttribute("action");

                const config = {
                    method: method,
                    headers: new Headers(),
                    mode: 'cors',
                    cache: 'no-cache',
                    body: data
                };

                fetch(action, config)
                    .then(response => response.text())
                    .then(response => {
                        const container = document.querySelector(".form-rest");
                        container.innerHTML = response;
                        // Opcional: form.reset(); aquí si el formulario debe limpiarse tras el éxito.
                        if (response.includes('is-success')) {
                        form.reset();
                }});
            }
        }

        formsAjax.forEach(form => {
            form.addEventListener("submit", sendAjaxForm);
        });

    }); 
</script>