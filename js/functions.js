$(document).ready(function(){
    initialiseJPlayers();
});

function initialiseJPlayers() {
    if ($('.jp-jplayer').length>0) {
        $('.jp-jplayer').each( function(){
            var id = $(this).attr('data-id');
            var file = $(this).attr('data-file');
            var id = $(this).attr('data-id');
            $(this).jPlayer({
                ready: function () {
                    $(this).jPlayer("setMedia", {
                        mp3: siteurl + '/downloads/mp3s/' + file
                    });
                    if ($(this).attr('data-auto')) {
                        $(this).jPlayer('play');
                    }
                },
                loop: $(this).attr('data-loop'),
                solution: "flash, html",
                swfPath: siteurl + "/external/jQuery.jPlayer.2",
                supplied: "mp3",
                cssSelectorAncestor: "#jp_interface_" +id
            });
            $(this).bind($.jPlayer.event.play, function() {
              $(this).jPlayer("pauseOthers");
            });
        });
    }
}