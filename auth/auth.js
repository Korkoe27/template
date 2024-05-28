const gallery = document.getElementById('gallery');

// Function to fetch photos from JSONPlaceholder API
async function fetchPhotos() {
    try {
        const response = await fetch('https://jsonplaceholder.typicode.com/photos');
        const photos = await response.json();
        
        // Display only the first 10 photos
        const firstTenPhotos = photos.slice(0, 10);
        firstTenPhotos.forEach(photo => {
            const img = document.createElement('img');
            img.src = photo.thumbnailUrl;
            img.alt = photo.title;
            gallery.appendChild(img);
        });
    } catch (error) {
        console.error('Error fetching photos:', error);
    }
}

// Fetch and display photos when the page loads
fetchPhotos();