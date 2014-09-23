<div class="audioplayer">
    <div id="jquery_jplayer_{$mp3.id}" class="jp-jplayer" data-id="{$mp3.id}" data-file="{$mp3.file}" data-auto="{$mp3autoplay}" data-loop="{$mp3loop}"></div>
    <div class="jp-single-player">
        <div id="jplayer_playlist_{$mp3.id}" class="jp-playlist">
            <ul>
                <li>{$mp3.displayname}</li>
            </ul>
        </div>
        <div id="jp_interface_{$mp3.id}" class="jp-interface">
            <ul class="jp-controls">
                <li><a href="#" id="jplayer_play{$mp3.id}" class="jp-play button btn btn-default" tabindex="1"><span class="glyphicon glyphicon-play"></span></a></li>
                <li><a href="#" id="jplayer_pause{$mp3.id}" class="jp-pause button btn btn-default" tabindex="1" style="display: none;"><span class="glyphicon glyphicon-pause"></span></a></li>
                <li><a href="#" id="jplayer_stop{$mp3.id}" class="jp-stop button btn btn-default" tabindex="1"><span class="glyphicon glyphicon-stop"></span></a></li>
                {if $mp3volumecontrol}<li><a href="#" id="jplayer_volume_min{$mp3.id}" class="jp-mute" tabindex="1"><span class="glyphicon glyphicon-volume-off"></span></a></li>
                <li><a href="#" id="jplayer_volume_max{$mp3.id}" class="jp-volume-max" tabindex="1"><span class="glyphicon glyphicon-volume-up"></span></a></li>{/if}
                {if $mp3download}<li><a href="{$SITEURL}/downloads/mp3s/{$mp3.file}" id="jplayer_download" class="jp-download button btn btn-default" tabindex="1"><span class="glyphicon glyphicon-cloud-download</span></a></li>{/if}
            </ul>
            <div class="jp-progress">
                <div id="jplayer_load_bar{$mp3.id}" class="jp-load-bar">
                    <div id="jplayer_play_bar{$mp3.id}" class="jp-play-bar"></div>
                </div>
            </div>
            <div id="jplayer_{$mp3.id}_current_time" class="jp-current-time"></div>
            <div id="jplayer_{$mp3.id}_duration" class="jp-duration"></div>
            {if $mp3volumecontrol}<div id="jplayer_volume_bar{$mp3.id}" class="jp-volume-bar">
                <div id="jplayer_volume_bar_value{$mp3.id}" class="jp-volume-bar-value"></div>
            </div>{/if}
        </div>
    </div>
</div>