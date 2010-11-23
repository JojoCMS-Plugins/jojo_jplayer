<div id="jquery_jplayer_{$mp3.id}"></div>
<script type="text/javascript">
/*<![CDATA[*/
$(document).ready(function(){ldelim}
    // Local copy of jQuery selectors, for performance.
    var jpPlayTime{$mp3.id} = $("#jplayer_{$mp3.id}_play_time");
    var jpTotalTime{$mp3.id} = $("#jplayer_{$mp3.id}_total_time");
    $("#jquery_jplayer_{$mp3.id}").jPlayer({ldelim}
        ready: function () {ldelim}this.element.jPlayer("setFile", "{$SITEURL}/downloads/mp3s/{$mp3.file}"){if $mp3autoplay}.jPlayer("play"){/if};{rdelim},
        customCssIds: true,
        swfPath: "{$SITEURL}/external/jplayer"
   {rdelim})
   .jPlayer("cssId", "pause", "jplayer_pause{$mp3.id}")
    .jPlayer("cssId", "play", "jplayer_play{$mp3.id}")
    .jPlayer("cssId", "stop", "jplayer_stop{$mp3.id}")
    .jPlayer("cssId", "loadBar", "jplayer_load_bar{$mp3.id}")
    .jPlayer("cssId", "playBar", "jplayer_play_bar{$mp3.id}")
    .jPlayer("cssId", "volumeMin", "jplayer_volume_min{$mp3.id}")
    .jPlayer("cssId", "volumeMax", "jplayer_volume_max{$mp3.id}")
    .jPlayer("cssId", "volumeBar", "jplayer_volume_bar{$mp3.id}")
    .jPlayer("cssId", "volumeBarValue", "jplayer_volume_bar_value{$mp3.id}")
    .jPlayer("onProgressChange", function(loadPercent, playedPercentRelative, playedPercentAbsolute, playedTime, totalTime) {ldelim}
        jpPlayTime{$mp3.id}.text($.jPlayer.convertTime(playedTime));
        jpTotalTime{$mp3.id}.text($.jPlayer.convertTime(totalTime));
    {rdelim})
{if $mp3autoplay}    .jPlayer("onSoundComplete", function() {ldelim}this.element.jPlayer("play");{rdelim}){/if};
{rdelim});
/*]]>*/
</script>
<div class="jp-single-player">
    <div id="jplayer_playlist_{$mp3.id}" class="jp-playlist">
        <ul>
            <li>{$mp3.displayname}</li>
        </ul>
    </div>
    <div class="jp-interface">
        <ul class="jp-controls">
            <li><a href="#" id="jplayer_play{$mp3.id}" class="jp-play button shadow" tabindex="1">play</a></li>
            <li><a href="#" id="jplayer_pause{$mp3.id}" class="jp-pause button shadow" tabindex="1">pause</a></li>
            <li><a href="#" id="jplayer_stop{$mp3.id}" class="jp-stop button shadow" tabindex="1">stop</a></li>
{if $mp3volumecontrol}
            <li><a href="#" id="jplayer_volume_min{$mp3.id}" class="jp-volume-min" tabindex="1">min volume</a></li>
            <li><a href="#" id="jplayer_volume_max{$mp3.id}" class="jp-volume-max" tabindex="1">max volume</a></li>
{/if}
{if $mp3download}
            <li><a href="{$SITEURL}/downloads/mp3s/{$mp3.file}" id="jplayer_download" class="jp-download button shadow" tabindex="1">download</a></li>
{/if}
        </ul>
        <div class="jp-progress">
            <div id="jplayer_load_bar{$mp3.id}" class="jp-load-bar">
                <div id="jplayer_play_bar{$mp3.id}" class="jp-play-bar"></div>
            </div>
        </div>
        <div id="jplayer_{$mp3.id}_play_time" class="jp-play-time"></div>
        <div id="jplayer_{$mp3.id}_total_time" class="jp-total-time"></div>
{if $mp3volumecontrol}
        <div id="jplayer_volume_bar{$mp3.id}" class="jp-volume-bar">
            <div id="jplayer_volume_bar_value{$mp3.id}" class="jp-volume-bar-value"></div>
        </div>
{/if}
    </div>
</div>
