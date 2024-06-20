<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Audio Player</title>
</head>
<body>


 <div class="row">
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="form-group">
                <div class="controls col-md-12">


                        <style>
                            .audio-player {
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                width: 90%;
                                margin: 50px auto;
                                font-family: Arial, sans-serif;
                                border: 1px solid #ccc;
                                padding: 10px;
                                border-radius: 5px;
                                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                            }
                            .audio-controls {
                                display: flex;
                                align-items: center;
                                justify-content: space-between;
                                width: 100%;
                            }
                            .audio-controls button {
                                background-color: #007BFF;
                                color: #fff;
                                border: none;
                                border-radius: 3px;
                                padding: 5px 10px;
                                cursor: pointer;
                            }
                            .audio-controls button:hover {
                                background-color: #0056b3;
                            }
                            .seek-bar {
                                width: 100%;
                                margin: 10px 0;
                            }
                            .time-display {
                                display: flex;
                                justify-content: space-between;
                                width: 100%;
                                font-size: 0.9em;
                            }
                            .audio--controllers {
                                display: flex;
                                flex-direction: row;
                                justify-content: space-between;
                            }
                            .audio--controllers .audio-controls {
                                display: block;
                                min-width: 130px;
                            }
                        </style>

                    <div class="audio-player">
                        <audio id="audio" controls autoplay preload="metadata" style="width: 100%;">
                            <source src="play_file.php?file=mp3_file.mp3&a=<?php echo uniqid();?>" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                        <div class="audio--controllers">
                           <div class="audio-controls">
                              <button id="backward-button" onclick="skipBackward()">&larr; 10s</button>
                              <button id="forward-button" onclick="skipForward()">&rarr; 10s</button>
                            </div>
                            <div class="audio-controls">
                                <button id="playback-normal" onclick="setPlaybackRate(1)">1x</button>
                                <button id="playback-1-5x" onclick="setPlaybackRate(1.5)">1.5x</button>
                                <button id="playback-2x" onclick="setPlaybackRate(2)">2x</button>
                            </div>
                        </div>

                    </div>

                    <script>
                        const audio = document.getElementById('audio');
                        const playPauseButton = document.getElementById('play-pause-button');
                        const currentTimeDisplay = document.getElementById('current-time');
                        const durationDisplay = document.getElementById('duration');
                        const skipDuration = 10;  // Duration to skip in seconds
                        let isSeeking = false;

                        function setPlaybackRate(rate) {
                            audio.playbackRate = rate;
                        }

                        function skipBackward() {
                            audio.currentTime = Math.max(0, audio.currentTime - skipDuration);
                        }

                        function skipForward() {
                            audio.currentTime = Math.min(audio.duration - 1, audio.currentTime + skipDuration);
                        }

                        function formatTime(time) {
                            const minutes = Math.floor(time / 60);
                            const seconds = Math.floor(time % 60);
                            return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                        }

                        audio.addEventListener('loadedmetadata', () => {
                            durationDisplay.textContent = formatTime(audio.duration);
                        });


                        // Ensure the audio element is enabled
                        audio.addEventListener('timeupdate', () => {
                          console.log('Current time: ' + audio.currentTime);
                        });


                    </script>

                </div>

            </div>
        </div>
    </div>
    <div class="files row"></div>


</body>
</html>