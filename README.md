# Movie Search App

This project is a simple movie search app where users can search for movies, view details, and add movies to their favorites list. It uses the TMDb API to fetch movie data and allows users to interact with the app through a user-friendly interface.

## Features

- **Movie Search**: Allows users to search for movies by title.
- **Movie Details**: Displays detailed information about a movie, including rating, genres, runtime, and description.
- **Favorites**: Users can add and remove movies from their favorites list, which is stored locally in the browser.
- **Sorting**: Movies can be sorted by title or release year.

## Prerequisites

Before you can run the project, make sure you have the following installed:

- **PHP**: Version 7.4 or higher.
- **A local server environment** like **Laragon** (which comes with PHP, MySQL, and Apache/Nginx) or XAMPP, or any web server with PHP support.
- **Internet connection**: To fetch data from the TMDb API.

## Setup and Installation

### 1. Clone the Repository

Clone the repository to your local machine using Git:
git clone https://github.com/yourusername/movie-search-app.git

2. Place the Project in Your Local Server's Root Directory
If you're using Laragon:
Place the project inside the www folder (e.g., C:/laragon/www/movie-search-app).

If you're using XAMPP:
Place the project inside the htdocs folder (e.g., C:/xampp/htdocs/movie-search-app).

3. Run the Project
Using Laragon:
Open Laragon and click the Start All button (Apache + MySQL).
Open your browser and visit http://localhost/movie-search-app.

Using XAMPP:
Open XAMPP and start Apache.
Open your browser and visit http://localhost/movie-search-app.

4. Start Searching
You should now be able to search for movies, view details, and manage your favorites list.

Folder Structure
- index.php         # Main page where the user interacts with the app
- details.php       # Fetches and displays detailed movie information
- search.php        # Fetches search results from TMDb API
- script.js         # JavaScript for handling frontend interactions
- styles.css        # Stylesheet for the frontend
