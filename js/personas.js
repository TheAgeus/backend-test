/*
    HTML ATTACHED TO IT
<button id="traer_personas">Traer personas</button>
<ul id="personas"></ul>
*/

$(document).ready(function() {
  $("#traer_personas").click(function() {
    $.ajax({
      url: 'http://sistemasdigitalesapi.test/api/personas.php',
      method: 'GET',
      dataType: 'json',
      headers: {
        'Authorization': 'aquidebeestareltoken'
      },
      success: function(response) {
        // Handle successful response
        const list = document.getElementById('personas');

        if (response.estatus == 500) {
          const newLi = document.createElement('li');
          newLi.textContent = response.mensaje;
          list.appendChild(newLi);
        }
        else {
          response.data.forEach(e => {
            const newLi = document.createElement('li');
            newLi.textContent = `Nombre: ${e.nombre} Edad: ${e.edad}`;
            list.appendChild(newLi);
          });
        }
      },
      error: function(xhr, status, error) {
        // Handle error
      }
    });
  });
})