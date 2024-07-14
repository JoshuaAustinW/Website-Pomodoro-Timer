<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro</title>

    <link rel="stylesheet" href="index.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Alata&display=swap');
    </style>
    <script src="index.js"></script>
    <script>
        function scrollToSection() {
        document.getElementById("section").scrollIntoView({ behavior: 'smooth' });
    }
    </script>
</head>
<body>


    <div class="content-wrapper">

            <div class="MenuBar">

                <div class="Title"> DORO </div>
                
                <div class="Right">
                    <div class="Button" id="About" onclick="OpenPage('About.html')">About</div>
                    <div class="Button" id="Features" onclick="scrollToSection()">Features</div>
                    <div class="Button Filled" id="LoginButton" onclick="OpenPage('LoginRegis/Login/Login.php')" style="font-weight:bold !important">Login</div>
                </div>

            </div>

            <h4 class="wordCarousel" style="font-family: Alata-Regular;">
            <span>We are </span>
            <div>
                <ul class="flip" style="font-family: Alata-Regular;">
                    <li>efficient</li>
                    <li>effective</li>
                    <li>flexible</li>
                    <li>trackable</li>
                    <!-- <li>Doro</li> -->
                </ul>
            </div>
        </h4>

        <div class="Description" style="font-size:30px !important;"> DORO, your ultimate<br>productivity companion  </div>
        </div>
            

            <button class="Button Gotobrand" onclick="OpenPage('LoginRegis/Login/Login.php')"> Go to DORO</button>

            <div class="whitebox">

                <div class="slideshow-container">
                    <div class="slides">

                        <div class="slide" id="s1">
                            <img src="res/Images/Image1.png" alt="Image 1">
                        </div>

                        <div class="slide" id="s2">
                            <img src="res/Images/Image2.png" alt="Image 2">
                        </div>

                        <div class="slide" id="s3">
                            <img src="res/Images/Image3.png" alt="Image 3">
                        </div>

                    </div>
                </div>

            </div>

            <div class="Description">
                <h1 id="section">Designed for you to get all done</h1>

                <div> We’re here to redefine the way you work and recharge every day, without overcomplicating it.  </div>
            </div>

            <div class="features-container">

                <div class="features">
                    <img class="Icon" src="res/Icons/Clock.png" alt="clock.png">
                    <h1 class="IconTitle">Focus timer</h1>
                    <div class="IconDesc">Our Focus Timer offers three modes—Pomodoro, Countdown, and Stopwatch</div>
                </div>

                <div class="features">
                    <img class="Icon" src="res/Icons/Checkbox.png" alt="clock.png">
                    <h1 class="IconTitle">Focus to-do</h1>
                    <div class="IconDesc">Focus To-Do List helps you prioritize tasks, track progress, and stay organized effortlessly.</div>
                </div>

                <div class="features">
                    <img class="Icon" src="res/Icons/Stats.png" alt="clock.png">
                    <h1 class="IconTitle">Focus stats</h1>
                    <div class="IconDesc">Focus Stats track your history, giving you insights into your productivity and progress over time.</div>
                </div>
                
                <div class="features">
                    <img class="Icon" src="res/Icons/Themes.png" alt="clock.png">
                    <h1 class="IconTitle">Varied themes</h1>
                    <div class="IconDesc">let you personalize your experience with different styles and colors to match your mood and preferences.</div>
                </div>

                <div class="features">
                    <img class="Icon" src="res/Icons/Notes.png" alt="clock.png">
                    <h1 class="IconTitle">Notes</h1>
                    <div class="IconDesc">Our Notes feature offers various styles, including Basic Notes and Cornell Notes, to suit your different note-taking needs.</div>
                </div>

                <div class="features">
                    <img class="Icon" src="res/Icons/More.png" alt="clock.png">
                    <h1 class="IconTitle">Lots more</h1>
                    <div class="IconDesc">Enjoy many other features to enhance your productivity and user experience.</div>
                </div>

            </div>


            <div class="Preview">
                <div class="PreviewImg">
                    <div class="PreviewImg-container Dashboard">
        
                    </div>
                </div>

                <div class="PreviewDesc">
                    <h1 class="PreviewTitle">Dashboard</h1>
                    <p class="PreviewParagraph">We’re here to redefine the way you work and recharge every day, without overcomplicating it.</p>
                </div>
            </div>


            <div class="Preview">
                <div class="PreviewDescLeft">
                    <h1 class="PreviewTitle">Focus Mode</h1>
                    <p class="PreviewParagraph">We’re here to redefine the way you work and recharge every day, without overcomplicating it.</p>
                </div>

                <div class="PreviewImgLeft">
                    <div class="PreviewImg-container">
                        
                    </div>
                </div>
            </div>


            <div class="Preview">
                <div class="PreviewImg">
                    <div class="PreviewImg-container Notes">

                    </div>
                </div>

                <div class="PreviewDesc">
                    <h1 class="PreviewTitle">Notes</h1>
                    <p class="PreviewParagraph">We’re here to redefine the way you work and recharge every day, without overcomplicating it.</p>
                </div>
            </div>
            

            <div style="margin-bottom: 3%; margin-top: 5%;" class="Description">
                <h1 style="margin-bottom: 0;">Your personal dashboard awaits</h1>

                <div> Lorem ipsum dolor de amet  </div>
            </div>

            <button class="Button Gotobrand" onclick="OpenPage('LoginRegis/Login/Login.php')"> Get started now</button>

    </div>

    <div class="footer">
        <div class="footerDesc">
            <div class="footerTitle">DORO</div>
            <div class="footerContacts">
                <div class="footerButton">contact</div>
                <div class="footerButton">support</div>
                <div class="footerButton">privacy policy</div>
            </div>
        </div>

        <div class="footerCopyright">&copy; DORO. All right reserved.</div>
    </div>

</body>
</html>