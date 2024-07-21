<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        // If user is not logged in, check for remember_me cookie
        if (isset($_COOKIE['remember_me'])) {
            // Set session variables from cookies
            $_SESSION['user_id'] = $_COOKIE['remember_me'];
            $_SESSION['username'] = $_COOKIE['username'];
            $_SESSION['email'] = $_COOKIE['email'];
        } else {
            // Redirect to login page if not logged in and no remember_me cookie
            header("Location: ../LoginRegis/Login/Login.php");
            exit();
        }
    }

    $focusTime = $_SESSION['focusTime'] ?? $_COOKIE['focusTime'] ?? '25';
    $shortBreak = $_SESSION['shortBreak'] ?? $_COOKIE['shortBreak'] ?? '5';
    $longBreak = $_SESSION['longBreak'] ?? $_COOKIE['longBreak'] ?? '15';
    $autoSequence = $_SESSION['autoSequence'] ?? $_COOKIE['autoSequence'] ?? 'false';
    $timerMode = $_SESSION['timerMode'] ?? $_COOKIE['timerMode'] ?? 'pomodoro';
    
    $_SESSION['BackgroundURL'] = $_COOKIE['BackgroundURL'] ?? '../res/Background/BackgroundLogin.png';
?>
<!-- tes -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro Timer</title>

    <!-- <link rel="stylesheet" href="widget.css">
    <script src="widget.js" defer></script> -->
    <!-- Style CSS -->
    <link rel="stylesheet" href="Dashboard.css">

    
    <script src="Dashboard.js"></script>
    <script src="../index.js"></script>
    <script src="https://kit.fontawesome.com/0020352476.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>

    <style>
        .Background {
            background-image: url('<?php echo $_SESSION['BackgroundURL']; ?>');
        }
    </style>

</head>
<body>

<!--
    <script>

    //SCRIPT AUTO LOGOUT
    let timeout;

    function resetTimeout() {
        clearTimeout(timeout);
        timeout = setTimeout(logoutUser, 900000); // 15 menit
    }

    function logoutUser() {
        window.location.href = '../logout.php';
    }

    document.onmousemove = resetTimeout;
    document.onkeypress = resetTimeout;
    document.onscroll = resetTimeout;
    document.onclick = resetTimeout;

    resetTimeout();
    </script>

-->

    <div class="Background" id="Background"></div>




    <div class="MusicButton" id="MusicButton" onclick="OpenPopupPlaylist()"><i class="fa-solid fa-music"></i></div>


    <div class="PlaylistContainer" id="PlaylistContainer">
        <div class="x-wrapper"> <i class="fa-solid fa-x" onclick="ClosePopupPlaylist()"></i> </div>

        <div class="PlaylistDescWrapper">
            <div class="PlaylistTitle">Custom Playlist</div>
            <p class="PlaylistDesc">Use your own spotify playlist by copying your playlist URL below.</p>
        </div>

        <div id="CustomPlaylist" class="CustomPlaylist">
            <input type="text" placeholder="Enter your own playlist URL" class="inputPlaylist" id="inputPlaylist" style="font-size: 20px;">
            <button class="CustomPlaylistButton" onclick="UseCustomPlaylist()">Use</button>
        </div>

        <iframe id="SpotifyPlaylistFrame" class="SpotifyPlaylist" style="border-radius:12px" src="<?php echo isset($_SESSION['embedURL']) ? $_SESSION['embedURL'] : 'https://open.spotify.com/embed/playlist/64HYvPPbaFZEl5HWFVrunM?utm_source=generator&theme=0';?>" width="100%" frameBorder="0" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
    </div>


    <div class="WelcomeUserText">
        <?php echo 'Welcome, ' . $_SESSION['username'] . '!'; ?>
    </div>


    <button id="popupbtn" class="MenuButton PiP" title="Toggle PIP Mode" class="popupbtn"><img class="ImagePip" src="../res/Icons/Pip.png"></button>

    <div class="MenuButton" id="MenuButton" title="Settings" onclick="OpenMenu()"><i class="fa-solid fa-gear"></i></div>

    <div class="AddNoteButton" id="AddNoteButton" title="Add Note" onclick="OpenNotePopup()"><i class="fa-solid fa-note-sticky"></i> Add Notes</div>

    <div class="BackgroundBlur" id="BackgroundBlur" onclick="CloseMenu()">
        <div class="CloseMenuButton" onclick="CloseMenu()"><i class="fa-solid fa-arrow-right"></i></div>
    </div>

    <div class="Menu" id="Menu">
        <div class="NavBar">

            <div class="MenuTitle selected" id="Themes" onclick="ChangeMenu('Themes');">
                <i class="fa-solid fa-paint-roller"></i> <div class="MenuText">Themes</div>
            </div>

            <div class="MenuTitle" id="Mode" onclick="ChangeMenu('Mode');">
                <i class="fa-regular fa-clock"></i> <div class="MenuText">Mode</div>
            </div>

            <div class="MenuTitle" id="Stats" onclick="ChangeMenuStats();">
                <i class="fa-solid fa-signal"></i> <div class="MenuText">stats</div>
            </div>

            <div class="MenuTitle" id="Notes" onclick="ChangeMenuNote();">
                <i class="fa-solid fa-note-sticky"></i> <div class="MenuText">Notes</div>
            </div>

            <div class="MenuTitle" id="Profile" onclick="ChangeMenu('Profile');">
                <i class="fa-regular fa-user"></i> <div class="MenuText">Profile</div>
            </div>

            <div class="CloseMenuButtonMobile" onclick="CloseMenu()"><i class="fa-solid fa-arrow-right"></i></div>

        </div>

        <div class="MenuContent">

            <div class="ThemesMenu" id="ThemesMenu">
                <div class="ThemesGrid" id="ThemesGrid">
                    <div class="ThemeBackgroundContainer">
                        <img class="ThemeImage" id="Theme1" src="../res/Background/BackgroundLogin.png" onclick="ChangeBackground('../res/Background/BackgroundLogin.png')">
                        <div class="ThemeName">Default</div>
                    </div>

                    <div class="ThemeBackgroundContainer">
                        <img class="ThemeImage" id="Theme2" src="../res/Background/Themes/MedievalCastle.jpg" onclick="ChangeBackground('../res/Background/Themes/MedievalCastle.jpg')">
                        <div class="ThemeName">Medieval</div>
                    </div>

                    <div class="ThemeBackgroundContainer">
                        <img class="ThemeImage" id="Theme3" src="../res/Background/Themes/Grassland.jpg" onclick="ChangeBackground('../res/Background/Themes/Grassland.jpg')">
                        <div class="ThemeName">Vast Grassland</div>
                    </div>

                    <div class="ThemeBackgroundContainer">
                        <img class="ThemeImage" id="Theme4" src="../res/Background/Themes/Castle.png" onclick="ChangeBackground('../res/Background/Themes/Castle.png')">
                        <div class="ThemeName">Castle</div>
                    </div>

                    <div class="ThemeBackgroundContainer">
                        <img class="ThemeImage" id="Theme5" src="../res/Background/Themes/Countryside.jpg" onclick="ChangeBackground('../res/Background/Themes/Countryside.jpg')">
                        <div class="ThemeName">Countryside</div>
                    </div>

                    <div class="ThemeBackgroundContainer">
                        <img class="ThemeImage" id="Theme6" src="../res/Background/Themes/Anime.png" onclick="ChangeBackground('../res/Background/Themes/Anime.png')">
                        <div class="ThemeName">Anime</div>
                    </div>
                </div>
            </div>

            <!-- <div class="ModeMenu hidden" id="ModeMenu">
            
            </div> -->
            <div class="ModeMenu hidden" id="ModeMenu">

                <div class="Modecontainer">

                    <div class="mode-section">
                        <h3 class="mode-header">Select Timer Mode</h3>
                        <select class="mode-dropdown">
                        <option value="pomodoro" <?php echo $timerMode === 'pomodoro' ? 'selected' : ''; ?>>Pomodoro</option>
                        <option value="stopwatch" <?php echo $timerMode === 'stopwatch' ? 'selected' : ''; ?>>Stopwatch</option>
                        </select>
                    </div>

                    <div class="mode-section">
                        <h3 class="mode-header">Timer Lengths</h3>
                        <div class="timer-lengths">
                            <div class="timer-column">
                                <label for="focus-time">Focus Time</label>
                                <div class="timer-input-container">
                                    <input type="number" id="focus-time" class="timer-input" min="1" max="120" value="<?php echo $focusTime; ?>">
                                    <span class="timer-unit">mins</span>
                                </div>
                            </div>
                            <div class="timer-column">
                                <label for="short-break">Short Break</label>
                                <div class="timer-input-container">
                                    <input type="number" id="short-break" class="timer-input" min="1" max="30" value="<?php echo $shortBreak; ?>" onblur="checkShortLongBreak()">
                                    <span class="timer-unit">mins</span>
                                </div>
                            </div>
                            <div class="timer-column">
                                <label for="long-break">Long Break</label>
                                <div class="timer-input-container">
                                    <input type="number" id="long-break" class="timer-input" min="1" max="60" value="<?php echo $longBreak; ?>" onblur="checkShortLongBreak()">
                                    <span class="timer-unit">mins</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mode-section">
                        <div class="auto-sequence">
                            <label class="switch">
                            <input type="checkbox" id="AutoSeqCheck" <?php echo $autoSequence === 'true' ? 'checked' : ''; ?>>
                                <span class="slider round"></span>
                            </label>
                            <div class="auto-sequence-text">
                                <h3 class="mode-header">Auto Sequence</h3>
                                <p class="auto-sequence-description">4 Pomodoro -> Short Break -> Long Break</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="StatsMenu hidden" id="StatsMenu">
                
                <div class="StatsContainer">
                    Your Stats
                    <div class="date-range-selector" id="date-range-selector">
                    <input type="radio" id="all" name="dateRange" value="all" checked>
                    <label for="all">All Time</label>

                    <input type="radio" id="7days" name="dateRange" value="7days">
                    <label for="7days">Last 3 Days</label>

                    <input type="radio" id="biweekly" name="dateRange" value="biweekly">
                    <label for="biweekly">Bi-weekly</label>

                    <input type="radio" id="monthly" name="dateRange" value="monthly">
                    <label for="monthly">Monthly</label>
                </div>
                    <div class="chartContainer">
                        <canvas id="statsChart" class="statsChart"></canvas>
                    </div>
                </div>

                </canvas>
            </div>

            <div class="NotesMenu hidden" id="NotesMenu">

                <div class="NotesContainer">

                    <h1 class="NotesMenuTitle">Notes</h1>

                    <div class="NoteList" id="NoteList">


                        <div class="loader note" id="noteloader"></div>


                    <!--    
                        <div class="NoteItem">
                            <div class="NoteTitle">Title:</div>
                            <div class="NoteButtons">
                                <input class="NoteButton edit" type="button" value="Edit" id="ButtonNoteEdit(ID)">
                                <input class="NoteButton delete" type="button" value="Delete" id="ButtonNoteDelete(ID)">
                            </div>
                            <form id="HiddenNoteForm">
                                <input type="hidden" name="id" id="noteid">
                                <input type="hidden" name="title" id="notetitle">
                                <input type="hidden" name="contennt" id="notecontent">
                            </form>
                        </div>

                    -->

                    </div>

                </div>

            </div>

            <div class="ProfileMenu hidden" id="ProfileMenu">
                <div class="ProfileInformationContainer">
                    <h1>Profile</h1>
                    <br>
                    <div>
                        Username: 
                        <?php 
                            echo $_SESSION['username'];
                        ?>
                        <br>
                        Email:
                        <?php
                            echo $_SESSION['email'];
                        ?>
                    </div>
                </div>
                <button class="ButtonLogout" onclick="OpenPage('../Logout.php')"><i class="fa-solid fa-door-open"></i> Logout</button>
            </div>
            
        </div>
    </div>


    <!-- <div class="popup">
        <div class="popup-content">
            <h2>Enter your focus areas</h2>
            <input type="text" class="popup-input" placeholder="Focus area 1">
            <input type="text" class="popup-input" placeholder="Focus area 2">
            <input type="text" class="popup-input" placeholder="Focus area 3">
            <button class="popup-submit">Submit</button>
        </div>
    </div> -->

    <div class="popup">
        <div class="popup-content">
            <h2>Enter your focus areas</h2>
            <label class="custom-checkbox">
                <input type="checkbox" >
                <span class="checkbox-custom"></span>
                <input type="text" class="checkbox-input" placeholder="Focus area 1">
            </label>
            <label class="custom-checkbox">
                <input type="checkbox">
                <span class="checkbox-custom"></span>
                <input type="text" class="checkbox-input" placeholder="Focus area 2">
            </label>
            <label class="custom-checkbox">
                <input type="checkbox">
                <span class="checkbox-custom"></span>
                <input type="text" class="checkbox-input" placeholder="Focus area 3">
            </label>
            <button class="popup-submit">Submit</button>
        </div>
    </div>

    <!-- <div class="Brand">DORO</div> -->
    <a href="../index.php" style="text-decoration: none" class="Brand">DORO</a>
    <div class="container">  
        <div class="main">
            <!-- <input type="text" style="font-size: 25px;" placeholder="What do you want to focus on?" class="focus-input"> -->
            <div class="focus-container">
                 <input type="text" style="font-size: 25px;" placeholder="What do you want to focus on?" class="focus-input" readonly>
            </div>

            <div class="timer-option">
                <button id="work-button" class="selected">focus</button>
                <button id="short-button">short break</button>
                <button id="long-button">long break</button>
            </div>

            <!-- <div class="timer-area">
                <p id="work-timer"><span></span>25:00<span></span></p>
                <p id="short-timer" style="display:none;"><span></span>05:00<span></span></p>
                <p id="long-timer" style="display:none;"><span></span>15:00<span></span></p>
            </div> -->
            <div class="timer-area">
    <div id="pomodoro-timer">
        <p id="work-timer"><span></span>25:00<span></span></p>
        <p id="short-timer" style="display:none;"><span></span>05:00<span></span></p>
        <p id="long-timer" style="display:none;"><span></span>15:00<span></span></p>
    </div>
    <div id="stopwatch-timer" style="display:none;">
        <p id="stopwatch-display"><span></span>00:00:00<span></span></p>
    </div>
</div>


            <div class="timer-settings">
                <button id="start-button">Start</button>
                <button id="pause-button" style="display:none;">Pause</button>
                <button id="continue-button" style="display:none;">Continue</button>
                <button id="reset-button" style="display:none;">Reset</button>
                
            </div>
        </div>
    </div>


    <div class="NoteBackgroundBlur hidden" id="NoteBackgroundBlur" onclick="CloseNotePopup()">
        <i class="fa-solid fa-x NoteBackground"></i>
    </div>
    <div class="PopupNote hidden" id="PopupNote">
        <div class="notewrapper">
            <input class="PopupNoteTitle" id="PopupNoteTitle" type="text" placeholder="Enter your note title here">
            <textarea class="PopupNoteContent" id="PopupNoteContent" placeholder="Enter your note content here"></textarea>
            <input type="hidden" name="popupnoteid" id="popupnoteid" value="">
            <div class="PopupNoteButtonWrapper">
                <div class="loader popupnote" id="popupnoteloader"></div>
                <input type="button" id="NoteSaveButton" class="PopupNoteButton Save" value="Save" onclick="SaveNoteToDB()">
                <input type="button" id="NoteDeleteButton" class="PopupNoteButton Cancel" value="Cancel" onclick="CloseNotePopup()">
            </div>
        </div>
    </div>






    <!-- AUDIOOOOOOOOO -->
    <audio id="notification-sound" src="../res/Notif/happybells.wav" preload="auto"></audio>



    <div class="PotraitModeProhibited">

    </div>
</body>
</html>
