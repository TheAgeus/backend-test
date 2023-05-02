function login() {
  $.ajax({
    url: 'http://sistemasdigitalesapi.test/api/usuarios.php',
    method: 'POST',
    dataType: 'json',
    data: {
      user: $('#login_user').val(),
      pass: $('#login_pass').val()
    },
    success: function(response) {
      console.log(response)
      if (response.estatus == 404) {
        alert(response.mensaje)
      }
      else if (response.estatus == 200) {
        alert(response.mensaje)
        if ('token' in response) {
          window.location.href = "http://sistemasdigitalesapi.test/dashboard.php";
        }
      }
    },
    error: function(xhr, status, error) {
      console.log(error)
    }
  })
}