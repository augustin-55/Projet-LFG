import 'bootstrap';

$(document).ready(function() {

    var $form = $('#follow-form');
    $form.submit(function() {

        var $self = $(this); // Récupère l'objet jQuery form
        $.post($self.attr('action'), $self.serialize(), function(data) {

            $self.closest('article').find('.follower-count').html(data.message);
            if (data.isFollow) {
                // Ajoute la classe "text-warning", supprime la classe "text-muted"
                $self
                    .find('button[type="submit"]')
                    .addClass('text-warning')
                    .removeClass('text-muted');

            } else {
                // Ajoute la classe "text-muted", supprime la classe "text-warning"
                $self
                .find('button[type="submit"]')
                .addClass('text-muted')
                .removeClass('text-warning');
            }

        }, 'json');

        return false;

    });

     // requête AJAX formulaire inscription

    /* $('.btn-content').click(function(e)
    {
        $.ajax({
            url: '/register/',
            method: 'POST',
            dataType: 'html',

            // si la requête est envoyée

            success: function(data)
            {
                console.log( 'ok' );
            }
        });
    }); */

    $('.btn-content').click(function() {

        var classBtn = $(this).attr('class');

        var nameBtn = classBtn.substr(24, 40);

        console.log(nameBtn);

        switch (key) {
            case value:
                
                break;
        
            default:
                break;
        }

    });

});