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

     // affichage des contenus principaux de la page - colonne milieu

    $('.btn-content').click(function() {

        var classBtn = $(this).attr('class');

        var nameBtn = classBtn.substr(24, 40);

        switch (nameBtn) {
            case 'default':
                $('.content-milieu').hide();
                $('.content-default').fadeIn();
                break;

            case 'amis':
                $('.content-milieu').hide();
                $('.content-amis').fadeIn();
                break;

            case 'groupes':
                $('.content-milieu').hide();
                $('.content-groupes').fadeIn();
                break;

            case 'messages':
                $('.content-milieu').hide();
                $('.content-messages').fadeIn();
                break;

            case 'profil':
                $('.content-milieu').hide();
                $('.content-profil').fadeIn();
                break;
        }

    });

});