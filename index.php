<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Search App</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Link to the external JavaScript file -->
    <script src="script.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Movie Search</h1>
        <input type="text" id="searchBox" placeholder="Enter movie title...">
        <button onclick="searchMovie()">Search</button>
        
        <label for="sortOptions">Sort by:</label>
        <select id="sortOptions" onchange="sortResults()">
            <option value="title">Title</option>
            <option value="year">Release Year</option>
        </select>

        <div id="loading" style="display:none;">Loading...</div>
        <div id="results"></div>
        <div id="pagination"></div>
    </div>

    <div id="movieModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="movieTitle"></h2>
            <p><strong>Rating:</strong> <span id="movieRating"></span></p>
            <p><strong>Genres:</strong> <span id="movieGenres"></span></p>
            <p><strong>Runtime:</strong> <span id="movieRuntime"></span></p>
            <p><strong>Description:</strong> <span id="movieDescription"></span></p>
        </div>
    </div>
</body>
</html>
