<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />
    <title>Home Music</title>
    <style type="text/css">
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: radial-gradient(ellipse at bottom, #0d1d31 0%, #0c0d13 100%);
            overflow: hidden;
        }

        html,
        body,
        .view {
            height: 100%;
        }

        #mobile-box {
            width: 360px;
        }

        .card {
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        .card .view {
            -webkit-border-top-left-radius: 10px;
            border-top-left-radius: 10px;
            -webkit-border-top-right-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card h5 a {
            color: #0d47a1;
        }

        .card h5 a:hover {
            color: #072f6b;
        }

        #pButton {
            float: left;
        }

        #timeline {
            width: 90%;
            height: 2px;
            margin-top: 20px;
            margin-left: 10px;
            float: left;
            -webkit-border-radius: 15px;
            border-radius: 15px;
            background: rgba(0, 0, 0, 0.3);
            position: relative;
        }

        #pButton {
            margin-top: 12px;
            cursor: pointer;
        }

        #playhead {
            width: 8px;
            height: 8px;
            -webkit-border-radius: 50%;
            border-radius: 50%;
            margin-top: -3px;
            background: black;
            cursor: pointer;
            position: absolute;
            z-index: 1;
        }

        .cant {

            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .music {

            margin-bottom: 10px;
        }


        .music:hover {

            background-color: #f7f7f7;
            border-radius: 3px;
            cursor: pointer;
        }


        .color {

            color: #ff7e3d;
        }

        .playlist {
            height: 51px;
        }


        .btn-danger {
            color: #fff;
            background-color: #ff7e3d;
            border-color: #ff7e3d;
        }


        .btn-danger:hover,
        .btn-danger:active {
            color: #fff;
            background-color: #ff7e3d;
            border-color: #ff7e3d;
        }



        .btn-danger:focus {
            box-shadow: none;
        }
    </style>
</head>

<body>
    <!-- Content -->
    <div class="container d-flex justify-content-center my-4 mb-5">
        <div id="mobile-box">
            <!-- Card -->
            <div class="card">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <img class="card-img-top" src="https://mdbootstrap.com/wp-content/uploads/2019/02/flam.jpg"
                        alt="Card image cap">
                    <a href="#!">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                </div>
                <div class="card-body text-center">
                    <h5 class="h5 font-weight-bold"><a href="#" target="_blank"
                            id='author'>{{$songs->first()->Author}}</a></h5>
                    <p class="mb-0" id='title'>{{$songs->first()->Title}}</p>
                    <audio id="music" preload="true">
                        @php
                        $contents = Storage::get("musics/" . $songs->first()->File_name);
                        $base64Music = base64_encode($contents);
                        @endphp
                        <source id="song" src="data:audio/mp3;base64,{{ $base64Music }}" type="audio/mp3">
                    </audio>
                    <div id="audioplayer">
                        <i id="pButton" class="fas fa-play"></i>
                        <div id="timeline">
                            <div id="playhead"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card -->
        </div>
        <div class="col-md-6">
            <div class="p-3 card">
                @foreach ($songs as $song)
                <div class="d-flex justify-content-between align-items-center p-3 music" id="SM{{$loop->index}}">
                    <div class="d-flex flex-row align-items-center">
                        <i class="fa fa-music color"></i>
                        <small class="ml-2">{{$song->Author}} - {{$song->Title}}</small>
                    </div>
                    @if ($loop ->last)
                    <input type="hidden" id="last" value="{{$loop->index}}">
                    @endif
                    @if ($loop ->odd)
                    <i class="fa fa-check color"></i>
                    @else
                    <i class="fa fa-plus text-muted"></i>
                    @endif
                </div>
                @php
                $contents = Storage::get("musics/" . $song->File_name);
                $base64Music = base64_encode($contents);
                @endphp
                <script>
                    var audio = document.getElementById('music');
                    var playButton = document.getElementById('pButton');
                    var playhead = document.getElementById('playhead');
                    var author = document.getElementById('author');
                    var title = document.getElementById('title');
                    var song = document.getElementById('song');
                    var switchButton = document.getElementById('SM{{$loop->index}}');
                    switchButton.addEventListener('click', function() {
                        song.setAttribute('src', 'data:audio/mp3;base64,{{ $base64Music }}');
                        audio.load();
                        author.textContent = '{{$song->Author}}';
                        title.textContent = '{{$song->Title}}';
                        playhead.style.marginLeft = 0 + '%';
                        playButton.className = 'fas fa-play';
                    });
                </script>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Content -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js">
    </script>
    <script>
        var playButton = document.getElementById('pButton');
    var timeline = document.getElementById('timeline');
    var playhead = document.getElementById('playhead');

    playButton.addEventListener('click', function() {
        if (audio.paused) {
            audio.play();
            playButton.className = 'fas fa-pause';
        } else {
            audio.pause();
            playButton.className = 'fas fa-play';
        }
    });
    audio.addEventListener('timeupdate', function() {
        var duration = audio.duration;
        var currentTime = audio.currentTime;
        var progress = (currentTime / duration) * 100;
        playhead.style.marginLeft = progress + '%';
    });

    timeline.addEventListener('click', function(event) {
        var timelineWidth = timeline.offsetWidth;
        var clickPosition = event.clientX - timeline.getBoundingClientRect().left;
        var clickProgress = (clickPosition / timelineWidth) * audio.duration;
        audio.currentTime = clickProgress;
    });

    </script>
</body>

</html>