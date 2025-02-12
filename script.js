let movieData = [];
let currentPage = 1;
const resultsPerPage = 5;

function searchMovie() {
    let query = document.getElementById('searchBox').value.trim();
    if (!query) {
        alert('Please enter a movie title');
        return;
    }

    document.getElementById('loading').style.display = 'block'; // Show loading text
    console.log('Fetching URL:', `search.php?query=${encodeURIComponent(query)}`);

    fetch(`search.php?query=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('loading').style.display = 'none';
            console.log('Fetched Data:', data);
            movieData = data.Search || [];

            if (movieData.length === 0) {
                document.getElementById('results').innerHTML = '<p>No movies found. Please try a different search.</p>';
                document.getElementById('pagination').innerHTML = ''; // Clear pagination
            } else {
                currentPage = 1; // Reset to first page on new search
                displayResults();
                displayPagination();
            }
        })
        .catch(error => console.error('Error:', error));
}

function displayResults() {
    let resultsContainer = document.getElementById('results');
    resultsContainer.innerHTML = ''; // Clear previous results

    let startIndex = (currentPage - 1) * resultsPerPage;
    let endIndex = startIndex + resultsPerPage;
    let paginatedMovies = movieData.slice(startIndex, endIndex);

    paginatedMovies.forEach(movie => {
        let posterUrl = movie.poster_path ? 'https://image.tmdb.org/t/p/w500' + movie.poster_path : 'default-image.jpg';

        let movieElement = document.createElement('div');
        movieElement.classList.add('movie');
        movieElement.innerHTML = `
            <img src="${posterUrl}" alt="${movie.title}">
            <h3>${movie.title}</h3>
            <p>${movie.overview}</p>
            <button onclick="toggleFavorite('${movie.id}')">Add to Favorites</button>
        `;
        resultsContainer.appendChild(movieElement);
    });
}

function displayPagination() {
    let totalPages = Math.ceil(movieData.length / resultsPerPage);
    let pagination = document.getElementById('pagination');
    pagination.innerHTML = '';

    if (totalPages > 1) {
        for (let i = 1; i <= totalPages; i++) {
            let button = document.createElement('button');
            button.textContent = i;
            button.onclick = () => changePage(i);
            if (i === currentPage) {
                button.classList.add('active');
            }
            pagination.appendChild(button);
        }
    }
}

function changePage(page) {
    currentPage = page;
    displayResults();
    displayPagination();
}

function sortResults() {
    let sortOption = document.getElementById('sortOptions').value;

    if (sortOption === "title") {
        movieData.sort((a, b) => a.title.localeCompare(b.title));
    } else if (sortOption === "year") {
        movieData.sort((a, b) => new Date(b.release_date) - new Date(a.release_date));
    }
    
    currentPage = 1; // Reset to first page after sorting
    displayResults();
    displayPagination();
}

function toggleFavorite(movieId) {
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    let movieIndex = favorites.findIndex(movie => movie.id === movieId);

    if (movieIndex === -1) {
        // Movie not in favorites, add it
        let movie = movieData.find(movie => movie.id === movieId);
        favorites.push(movie);
    } else {
        // Movie is already in favorites, remove it
        favorites.splice(movieIndex, 1);
    }

    // Save updated favorites to localStorage
    localStorage.setItem('favorites', JSON.stringify(favorites));
    alert('Favorites updated!');
}

function showDetails(imdbID) {
    fetch(`details.php?id=${imdbID}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('movieTitle').innerText = data.Title;
            document.getElementById('movieRating').innerText = data.imdbRating || 'N/A';
            document.getElementById('movieGenres').innerText = data.Genre || 'N/A';
            document.getElementById('movieRuntime').innerText = data.Runtime || 'N/A';
            document.getElementById('movieDescription').innerText = data.Plot || 'No description available.';
            document.getElementById('movieModal').style.display = 'block';
        })
        .catch(error => console.error('Error:', error));
}

function closeModal() {
    document.getElementById('movieModal').style.display = 'none';
}
