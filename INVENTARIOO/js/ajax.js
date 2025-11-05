const formularios_ajax = document.querySelectorAll(".FormularioAjax");

function enviar_formulario_ajax(e) {
    e.preventDefault();

    let data = new FormData(this);
    let method = this.getAttribute("method");
    let action = this.getAttribute("action");

    let encabezados = new Headers();

    let config = {
        method: method,
        headers: encabezados,
        mode: 'cors',
        cache: 'no-cache',
        body: data
    };

    fetch(action, config)
        .then(respuesta => respuesta.text())
        .then(respuesta => {
            let contenedor = document.querySelector(".form-rest");
            contenedor.innerHTML = respuesta;

            const mensaje_exito_categoria = "CATEGORIA REGISTRADA";
            const mensaje_exito_usuario = "USUARIO REGISTRADO";
            const mensaje_exito_producto = "PRODUCTO REGISTRADO";

            // Lógica para resetear el formulario
            if (respuesta.includes(mensaje_exito_categoria) ||
                respuesta.includes(mensaje_exito_usuario) ||
                respuesta.includes(mensaje_exito_producto)) {
                // Si la respuesta incluye CUALQUIERA de los mensajes de éxito, reseteamos.
                this.reset();
            }

        });

}

formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit", enviar_formulario_ajax);
});