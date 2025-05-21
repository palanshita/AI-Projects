<?php
session_start();

// ✅ Protect the page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Driven Traffic Sign Recognition</title>
    <link rel="stylesheet" href="style.css"> 
</head><style>
 #scrollBtn {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 99;
    background-color: #39b1f6;
    color: white; /* Peachy pink */
    box-shadow: 0px 4px 8px rgba(0,0,0,0.2);
    border: none;
    padding: 12px 16px;
    border-radius: 50%;
    font-size: 18px;
    cursor: pointer;
    box-shadow: 0px 4px 8px rgba(0,0,0,0.2);
    transition: background-color 0.3s ease, transform 0.2s ease;
}

#scrollBtn:hover {
    background-color: #2c4858;
    transform: translateY(-2px);
}

#scrollBtn:active {
    transform: translateY(1px);
} 
</style>
<body>
       <!-- index section -->
    <header>
         <nav class="navbar">
            <div class="logo">TSR</div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#aboutus">About Us</a></li>
                <li><a href="#RoadSmart">Road Smart</a></li>
                <li><a href="#contactus">Contact Us</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav> 
            
    </header>

            <!-- Home section -->
    <section id="home"   class="content">
        <h1 style="font-size: 50px; padding-top: 50px;">AI Driven Traffic Sign Recognition</h1>
        <p>Our Traffic Sign Recognition System website leverages AI to enhance road safety by accurately identifying and interpreting traffic signs in real time.</p>
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

            <form action="sign_recognition.php" method="get">
                <button type="submit">Recognize Sign</button>
            </form>
    </section>


    <!-- About us section -->
    <section id="aboutus" class="about-container">
        <h1>About Us</h1>
        <p style="text-align: justify;">About Us
            RoadSmart Signs is an innovative solution designed to enhance road safety education and awareness through advanced technology. Our final-year project focuses on Traffic Sign Recognition and improving recognition accuracy, with potential applications in supporting autonomous vehicles. This system aims to provide an efficient and accurate learning platform for individuals preparing for their learning license test (2/4-wheeler vehicles) and children who wish to understand traffic signs effectively.</p>
        <br> <br>
           <h2 > Why RoadSmart Signs?</h2>
          <ul class="about-us-ul"><li> <p>🚦 Increased Accuracy – Utilizing deep learning techniques and AI-driven models, our system ensures high precision in recognizing and interpreting Indian roadway signs. This makes it a reliable source for both learners and educators.</li>
          </p>
          <li> <p>  📚 Educational Tool for Children – Understanding traffic signs from an early age fosters responsible behavior on the road. Our platform serves as an interactive and engaging way for children to learn about road safety.</li>
          </p>
          <li><p>  🛣️ Efficient Learning for License Tests – Preparing for a driving test can be challenging. Our platform provides a structured and informative learning experience, covering all Indian road signs in a user-friendly manner to enhance retention and understanding.</li>
          </p>
           <li><p> With RoadSmart Signs, we aim to create a smarter and safer driving community by offering an effective, technology-driven learning approach. Whether you're a new driver, a student, or an enthusiast eager to expand your knowledge, our platform ensures you grasp traffic rules with ease and confidence.</li></p>
        </ul>
        <p>   🚗 Learn Smart, Drive Safe! 🚦</p>
    </section>

    <!-- roadsmart section -->
    <section id="RoadSmart" class="roadsmart">
        <section class="road-smart">
            <h2>🚦 Road Smart: Know Your Signs 🚦</h2>
            <div class="signs-container">
                <!-- Sign Box 1 -->
                <div class="sign-box">
                    <img src="stop-sign1.jpg" alt="Stop Sign">
                    <div class="sign-info">
                        <h3>Stop Sign</h3>
                        <p>🚗 You must stop completely before proceeding.</p>
                    </div>
                </div>
        
                <!-- Sign Box 2 -->
                <div class="sign-box">
                    <img src="speedlimit-sign.jpg" alt="Speed Limit">
                    <div class="sign-info">
                        <h3>Speed Limit</h3>
                        <p>🚦 Follow the speed limit to ensure road safety.</p>
                    </div>
                </div>
        
                <!-- Sign Box 3 with Arrow to Full Page -->
                <div class="sign-box">
                    <img src="pedestrian-sign.jpg" alt="Pedestrian Crossing">
                    <div class="sign-info">
                        <h3>Pedestrian Crossing</h3>
                        <p>🚶 Yield to pedestrians at crosswalks.</p>
                    </div>
                </div>
        
                <!-- Arrow to Main Traffic Education Page -->
                <div class="arrow-box">
                    <a href="Roadsmart-1.html">Learn More ➡</a>
                </div>
            </div>
        </section>

        <!-- contact us section -->
    <section id="contactus" class="contact-container">
        <h1>Contact Us</h1>
        <p>We'd love to hear from you! Fill out the form below and we'll get back to you soon.</p>
        
        <form id="contactForm">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Your Name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Your Email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" placeholder="Your Message" required></textarea>
            
            <button type="submit">Send Message</button>
        </form>

        <p id="successMessage" class="hidden">✅ Your message has been sent successfully!</p>
    </section>
        
    </section>

    <script src="script.js"></script>

    <footer>
        <div class="container">
            <p>&copy; <span id="copyright-year"></span> Traffic Sign Recognition. All rights reserved.</p>
        </div>
    </footer>
    
    <script>
        // JavaScript to dynamically set the current year in the copyright notice
        document.getElementById("copyright-year").textContent = new Date().getFullYear();
    </script>
    <button onclick="scrollToTop()" id="scrollBtn" title="Go to top">
        ↑
    </button>
   <script>
   window.onscroll = function() { 
        let scrollBtn = document.getElementById("scrollBtn");
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollBtn.style.display = "block";
        } else {
            scrollBtn.style.display = "none";
        }
    };

    // Scroll to top smoothly
    function scrollToTop() {
        window.scrollTo({top: 0, behavior: 'smooth'});
    }
</script>
</body>
</html>
