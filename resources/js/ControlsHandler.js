
// ControlsHandler.js

export default function getControls() {   
    const helper_calculateDuration = duration => {
        let seconds = parseInt(duration % 60);
        let minutes = parseInt((duration % 3600) / 60);
        let hours = parseInt(duration / 3600);
      
        return {
            hours: helper_pad(hours),
            minutes: helper_pad(minutes.toFixed()),
            seconds: helper_pad(seconds.toFixed())
        };
    };

    const helper_pad = number => {
        if (number > -10 && number < 10) {
            return '0' + number;
        } 
        else {
            return number;
        }
    };

    const updateCurrentTime = () => {
        $(eleStartTime).html(
          `${currentDuration.hours}:${currentDuration.minutes}:${currentDuration.seconds}`
        );
    };

    let currentTimeInSeconds = 0;
    let currentDuration = null;
    let volumeValue = 1;
    let video = $(".user_video")[0];
    let volumeBar = $("#volume-bar")[0];               
    let elePlayPauseBtn = ".toggle-play-pause";
    let eleStartTime = ".start-time";
    let eleToggleVolume = ".toggle-volume";

    // Play the video
    $(elePlayPauseBtn).on('click', () => {
        $(elePlayPauseBtn).hasClass('play')
        ? video.play()
        : video.pause();
        $(elePlayPauseBtn).toggleClass('play pause');
    });

    // Toggle volume on/off
    $(eleToggleVolume).on('click', () => {
        video.volume = video.volume ? 0 : volumeValue;
        $(eleToggleVolume).toggleClass('on off');
    });

    // Update the video volume
    volumeBar.addEventListener("change", function() {
        video.volume = volumeBar.value;
    });
    
    // Update the current time
    $(".user_video").on('timeupdate', () => {
        currentTimeInSeconds = video.currentTime;
        currentDuration = helper_calculateDuration(currentTimeInSeconds);
        updateCurrentTime();
    });          
}
  

    
