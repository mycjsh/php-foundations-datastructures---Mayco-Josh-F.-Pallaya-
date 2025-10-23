# php-foundations-datastructures---Mayco-Josh-F.-Pallaya-

README.md

Project Title: Digital Library Organizer

Project purpose
- Build a compact, single-file PHP application that demonstrates core data-structure concepts in a concrete, real-world scenario: a Digital Library Organizer.
- Reinforce recursive data structures (directory-like categories), associative arrays (hash tables) for metadata, and a binary search tree (BST) for efficient title lookup.
- Provide a responsive, violet-themed UI with accessible styling and interactive features.

What the project includes
- Part I — Recursive Directory Display
  - A nested PHP array represents book categories and subcategories.
  - A recursive function traverses the structure and prints a hierarchical, indented view of categories and books.
- Part II — Hash Table for Book Details
  - An associative array stores book metadata (author, year, genre) keyed by title.
  - A function retrieves details for a given title; if not found, an appropriate message is returned.
- Part III — Binary Search Tree (BST) for Book Titles
  - A simple Node class and a BinarySearchTree class implemented in PHP.
  - Supports insert, search, and inorder traversal to display titles in alphabetical order.
- Part IV — Integration (Bonus)
  - An integrated UI that combines recursion display, hash-based lookups, and BST-based search in a single page or section.
  - Interactive controls allow exploring categories, querying details by title, and searching titles alphabetically.

How to run
- The project is provided as a single PHP file with embedded HTML and CSS (plus Bootstrap for optional styling).
- To run locally:
  1. Save the script as index.php (or any PHP file) in your web server's document root (e.g., htdocs or www directory).
  2. Start your local PHP-enabled web server (e.g., via XAMPP/WAMPP or hosting with PHP support).
  3. Navigate to http://localhost/your-path/index.php in a browser.
- Requirements:
  - PHP 7.x or newer.
  - A web server (Apache/Nginx) with PHP support or a local PHP server.

Usage notes
- Part I: Recursive Directory Display
  - The UI renders a compact card showing the category tree. Use the “Toggle Collapse” button to hide or show the contents for readability on small screens.
- Part II: Hash Table for Book Details
  - Enter a book title in the input field to fetch details (author, year, genre).
  - If the title exists in the dataset, details appear in the results area; otherwise, a not-found message is shown.
- Part III: Binary Search Tree (BST)
  - The Inorder Traversal section displays all titles in alphabetical order.
  - Use the search field to check if a title exists in the BST. The result indicates Found or Not Found.
- Part IV: Integration (Bonus)
  - All parts are presented in a unified layout with a consistent violet theme.
  - A Reset Demo button reloads the page to its initial state.

Implementation notes
- The repository embeds data structures and a client-side interface within a single PHP/HTML file to satisfy the “one script” constraint.
- Interactive features are implemented with a mix of server-side PHP for data definitions and client-side JavaScript for quick responsiveness (e.g., displaying hash map results without page reload).
- Styling uses a violet palette and responsive CSS to maintain readability across devices. The UI is designed to maintain accessibility with clear contrast and readable typography.
- The code includes:
  - A nested library array for Part I.
  - A bookInfo associative array for Part II.
  - Node and BinarySearchTree classes for Part III.
  - A displayLibrary($library, $indent) function for recursive rendering.
  - A combined Part IV integration section that demonstrates all three parts in one interface.

Potential enhancements (optional)
- Persisted storage (e.g., SQLite) for CRUD operations on books and categories.
- Drag-and-drop reordering for categories or books.
- Accessibility theme toggle (light/dark violet) and keyboard shortcuts.
- Export options (CSV/PDF) for library data and search results.

Questions
- Would you like me to separate Part IV into a collapsible panel or keep it as a single integrated section?
- Do you want to include a API endpoint to query the BST or hash table from JavaScript for a more dynamic client-side experience?
