const repoUrl = 'https://api.github.com/repos/alekseykasyakov/DeveloperTest';
$(document).ready(async function() {
    $.getJSON(repoUrl).done(function(repo) {
        $("#github").html(
            '<strong>' + repo.name + ': </strong>' +  repo.description
        );

    });
});
$("#calculationForm").submit(function(e) {
    e.preventDefault();
    let text = $('#data_field').val();
    if (!text.length){
        alert('You try to send empty field');
    } else {
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'json',
            data: {
                text: text,
            },
            before: function(){
                $('#numbers').text('');
                $('#total').text('');
                $('#error').text('');
            },
            success: function (callback) {
                $('#numbers').text(callback.numbers);
                $('#total').text(callback.total);
                $('#error').text(callback.error);
            }
        });
    }
});

