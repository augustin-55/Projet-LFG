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

    // affichage joueurs d'un groupes

    $('.nb-joueurs-link').click(function (e) {

        $(this).parents('.groupe-affichage').children('.group-part').hide()

        $(this).parents('.groupe-affichage').children('.affichage-membres').show();
        e.stopPropagation();

    });

    $(document).click(function (e) {

        $('.group-part').show();

        $('.affichage-membres').hide();
        e.stopPropagation();

    });
    
    // Script follow
    function initFollowBtn()
    {
        $('.follow-btn').unbind('click');
        $('.follow-btn').click(function(e) {
            e.preventDefault();
            var $self = $(this);
            var url = $self.attr('href');
            $.getJSON(url, {}, function(data) {
                if (data.isFollow) {
                    var userId = $self.closest('.membre').attr('data-id');
                    var $obj = $('.membre.unfollow[data-id="' + userId + '"]');
                    
                    $('.membre[data-id="' + userId + '"] .follow-btn').html('Ne plus suivre');
                    $obj.addClass('follow').removeClass('unfollow');
                    $obj.remove();
                    
                    $('.section-content-amis .user-follow').append($obj);
                    initFollowBtn();
                } else {
                    var userId = $self.closest('.membre').attr('data-id');
                    var $obj = $('.membre.follow[data-id="' + userId + '"]');
                    
                    $obj.addClass('unfollow').removeClass('follow');
                    $('.membre[data-id="' + userId + '"] .follow-btn').html('Suivre');
                    $obj.remove();
                    
                    $('.liste-membres').append($obj);
                    initFollowBtn();
                }
            });
        });
    } 

    initFollowBtn();

    

});