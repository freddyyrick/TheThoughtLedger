<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.html");
  exit();
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Journal Dashboard</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
  <!-- Demure background ey -->
  <div class="slideshow-container">
    <div class="slide" style="background-image: url('imgs/13.jpg');"></div>
    <div class="slide" style="background-image: url('imgs/12.jpg');"></div>
    <div class="slide" style="background-image: url('imgs/11.jpg');"></div>
    <div class="slide" style="background-image: url('imgs/10.jpg');"></div>
    <div class="slide" style="background-image: url('imgs/9.jpg');"></div>
  </div>

  <div class="dashboard">
    <aside class="sidebar">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
</svg>
      <div class="user-name"><?php echo htmlspecialchars($username); ?></div>
      <nav>
        <a href = "#" id="home-link" class="active">HOME</a>
        <a href = "#" id="add-entry-link">ADD NEW ENTRY</a>
        <a href = "#" id="view-journals-link">VIEW JOURNALS</a>
        <a href = "logout.php" class="logout">Logout</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <!-- Pag human sa login-->
      <section id="home-section">
        <header>
          <div class="header-content">
            <h1>Hello, <?php echo htmlspecialchars($username); ?>! <span class="emoji">🌞</span></h1>
            <div class="date-time">
              <div class="date" id="current-date"></div>
              <div class="time" id="current-time"></div>
            </div>
          </div>
          <div class="quote-of-the-day">A QUOTE FOR YOU:</div>
          <div class="quote-text" id="quote-text">Loading quote...</div>
          <div class="quote-author" id="quote-author"></div>
          <button onclick="loadQuote()" class="quote-button">New Quote</button>

          <button class="new-journal" id="new-journal-btn"> New Journal</button>
        </header>
      </section>

     
      <section id="add-entry-section" style="display: none;" class="add-entry-section">
        <h2>Add New Journal Entry</h2>
        <form id="journal-form">
          <input type="text" id="journal-title" placeholder="Entry Title" required />
          <textarea id="journal-content" placeholder="Write your journal here..." rows="6" required></textarea>
          <button type="submit">Save Entry</button>
        </form>
      </section>

      <section id="view-journals-section" style="display: none;">
        <h2>View Journals</h2>
        <p>Your past entries will be shown here...</p>

        
      </section>
    </main>
  </div>

  <script src="dashboard.js"></script>
</body>
</html>
