// JavaScript Document
function alterar_div() {
  $.ajax({
    type: "POST",
    url: "graficos.php",
    data: {
      ano: $('#argAno').val()
    },
    success: function(data) {
      $('#QtdOcorrencias').html(data);
    }
  });
}