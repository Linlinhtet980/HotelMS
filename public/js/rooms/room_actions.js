/**
 * Room Management Actions
 */

document.addEventListener('DOMContentLoaded', function() {
    // --- Delete Confirmation ---
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const confirmed = confirm('Are you sure you want to delete this room? This action cannot be undone.');
            if (!confirmed) {
                e.preventDefault();
            }
        });
    });

    // --- Live Search Filtering ---
    const searchInput = document.querySelector('.search-input');
    const tableRows = document.querySelectorAll('.hotel-table tbody tr');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();

            tableRows.forEach(row => {
                // If the row is an empty state row, skip it
                if (row.querySelector('.empty-state')) return;

                // Get text from Room Number and Bed Type columns
                const roomNumberText = row.querySelector('.room-number').textContent.toLowerCase();
                const bedTypeText = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

                // Check if search term matches either column
                if (roomNumberText.includes(searchTerm) || bedTypeText.includes(searchTerm)) {
                    row.style.display = ''; // Show row
                } else {
                    row.style.display = 'none'; // Hide row
                }
            });

            // Handle "No results" visual if needed
            // (Optional: can add a dynamic row if all are hidden)
        });
    }
});
