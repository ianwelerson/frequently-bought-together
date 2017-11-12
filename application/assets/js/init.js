// MaterializeCSS
(function($){
  $(function(){

    $('.button-collapse').sideNav();

  });
})(jQuery);

$(document).ready(function() {
  $('select').material_select();
});

// Others

// Add products to the list
function addProducts(){
  // Checks if there is any option selected
  if($("#prod-select").val() != null) {
    // Grab the place to put the items on the list
    var container = $("#itens")[0];
    // Grab the number of itens inside de #itens
    var number = $('#itens input').length;
    // Create a input field
    var input = $('<div class="row col s12">' +
      '<input type="checkbox" checked="checked" name="item['  + number +']" id="item['  + number +']" value="' + $("#prod-select option:selected").val() + '">' +
      '<label for="item' + number + '">' + $("#prod-select option:selected").text() + '</label>' +
      '</div>');
    // Append itens
    $('#itens').append(input[0]);
  } else {
    // If there no product selected, shows alert in page
    alert('Selecione uma opção')
  }
}
