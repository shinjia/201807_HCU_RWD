$(function(){
  
  $('#btn1').click(function(){
    $('#1b').load('data/1.txt');
  });
  
  $('#btn2').click(function(){
    $('#2b').load('data/2.html');
  });
  
  $('#btn3').click(function(){
    $('#3b').load('data/3.php');
  });
  
  $('#btn4').click(function(){
    
        var showarea = $('#4b');
        showarea.html('loading...');

        $.ajax({
            url: 'data/4.php',
            type: 'GET',
            dataType: 'html',
            success: function(data,textStatus,jqXHR)
            {
                showarea.html(data);
            },
            error: function()
            {
                showarea.html('error !');
            },
            complete: function()
            {
               showarea.css('color', 'yellow');
            }    
        });
  });
    
});