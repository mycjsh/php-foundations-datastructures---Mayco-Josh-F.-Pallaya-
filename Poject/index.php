<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Library Organizer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<body>
<?php
// Digital Library Organizer - Single-file PHP app (Integrated Part IV)

$library = [
    "Fiction" => [
        "Fantasy" => ["Harry Potter", "The Hobbit"],
        "Mystery" => ["Sherlock Holmes", "Gone Girl"]
    ],
    "Non-Fiction" => [
        "Science" => ["A Brief History of Time", "The Selfish Gene"],
        "Biography" => ["Steve Jobs", "Becoming"]
    ]
];

$bookInfo = [
    "Harry Potter" => ["author" => "J.K. Rowling", "year" => 1997, "genre" => "Fantasy"],
    "The Hobbit" => ["author" => "J.R.R. Tolkien", "year" => 1937, "genre" => "Fantasy"],
    "Sherlock Holmes" => ["author" => "Arthur Conan Doyle", "year" => 1892, "genre" => "Mystery"],
    "Gone Girl" => ["author" => "Gillian Flynn", "year" => 2012, "genre" => "Mystery"],
    "A Brief History of Time" => ["author" => "Stephen Hawking", "year" => 1988, "genre" => "Science"],
    "The Selfish Gene" => ["author" => "Richard Dawkins", "year" => 1976, "genre" => "Science"],
    "Steve Jobs" => ["author" => "Walter Isaacson", "year" => 2011, "genre" => "Biography"],
    "Becoming" => ["author" => "Michelle Obama", "year" => 2018, "genre" => "Biography"]
];

function getBookInfo($title, $bookInfo) {
    if (array_key_exists($title, $bookInfo)) {
        $info = $bookInfo[$title];
        return [
            "Title" => $title,
            "Author" => $info["author"],
            "Year" => $info["year"],
            "Genre" => $info["genre"]
        ];
    } else {
        return "Book not found";
    }
}

class Node {
    public $data;
    public $left;
    public $right;
    public function __construct($data) {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
    }
}

class BinarySearchTree {
    private $root;

    public function __construct() {
        $this->root = null;
    }

    public function insert($data) {
        $this->root = $this->insertRec($this->root, $data);
    }

    private function insertRec($node, $data) {
        if ($node === null) return new Node($data);
        if (strcmp($data, $node->data) < 0) {
            $node->left = $this->insertRec($node->left, $data);
        } elseif (strcmp($data, $node->data) > 0) {
            $node->right = $this->insertRec($node->right, $data);
        }
        return $node;
    }

    public function search($data) {
        return $this->searchRec($this->root, $data);
    }

    private function searchRec($node, $data) {
        if ($node === null) return false;
        if ($data === $node->data) return true;
        if (strcmp($data, $node->data) < 0) return $this->searchRec($node->left, $data);
        return $this->searchRec($node->right, $data);
    }

    public function inorderTraversal($node = null, &$arr = []) {
        if ($node === null) $node = $this->root;
        if ($node === null) return $arr;
        if ($node->left !== null) $this->inorderTraversal($node->left, $arr);
        $arr[] = $node->data;
        if ($node->right !== null) $this->inorderTraversal($node->right, $arr);
        return $arr;
    }
}

$bst = new BinarySearchTree();
$titlesForBST = [
    "A Brief History of Time",
    "Becoming",
    "Gone Girl",
    "Harry Potter",
    "Sherlock Holmes",
    "The Hobbit",
    "The Selfish Gene",
    "Steve Jobs"
];
foreach ($titlesForBST as $t) $bst->insert($t);

function displayLibrary($library, $indent = 0) {
    $output = "";
    foreach ($library as $key => $value) {
        if (is_array($value)) {
            $output .= str_repeat("&nbsp;", $indent) . htmlspecialchars($key) . "<br>";
            $output .= displayLibrary($value, $indent + 4);
        } else {
            $output .= str_repeat("&nbsp;", $indent) . htmlspecialchars($value) . "<br>";
        }
    }
    return $output;
}

// Part IV: Integrated UI for Part I–III in a single section
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Digital Library Organizer - Integrated Part IV</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<style>
  :root {
    --violet-50: #f5f0ff;
    --violet-100: #e0d6ff;
    --violet-200: #c6b3ff;
    --violet-300: #9f7aff;
    --violet-400: #7b4dca;
    --violet-500: #6b2bd0;
    --violet-600: #5a23a8;
    --violet-700: #4b1e8a;
    --bg: #0b1020;
    --card: #141a34;
    --text: #e9e9f7;
    --muted: #a8b3d1;
    --accent: #a78bfa;
    --accent-2: #8b5cf6;
    --shadow: 0 10px 25px rgba(0,0,0,.08);
  }
  * { box-sizing: border-box; }
  html, body { height: 100%; }
  body {
    margin: 0;
    font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, Arial;
    background: linear-gradient(135deg, #0b1020 0%, #1a1140 100%);
    color: var(--text);
  }
  header { position: sticky; top: 0; z-index: 10;
    background: rgba(20,26,52,.92); color: white;
    border-bottom: 1px solid rgba(255,255,255,.15);
    backdrop-filter: saturate(1.2) blur(6px);
  }
  .container { width: 92%; max-width: 1200px; margin: 0 auto; }
  .brand { display: flex; align-items: center; justify-content: space-between; padding: 14px 0; }
  .logo { display: inline-flex; align-items: center; gap: 12px; }
  .logo-box { width: 40px; height: 40px; border-radius: 8px;
              background: linear-gradient(135deg, var(--violet-500), var(--accent)); }
  .title { font-weight: 700; font-size: 1.05rem; color: #f8f5ff; }
  nav a { margin: 0 8px; color: #f7f3ff; text-decoration: none; font-weight: 500; }
  main { padding: 20px 0 40px; }
  .section { background: rgba(255,255,255,.98); border-radius: 16px;
              padding: 20px; box-shadow: var(--shadow);
              border: 1px solid rgba(99,102,241,.25); margin: 12px 0; }
  .section .title { color: #1f1140; }
  .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
  .card { background: #f7f5ff; border: 1px solid #e6dcff; border-radius: 12px; padding: 14px; color: #1f1140; }
  .card-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px; }
  .badge { padding: 4px 10px; border-radius: 999px; background: #efe1ff; color: #4c1d95; font-weight: 700; font-size: 11px; }
  .btn { padding: 10px 14px; border-radius: 8px; border: none; cursor: pointer;
          background: var(--violet-500); color: white; font-weight: 700; transition: transform 0.2s ease; }
  .btn:hover { transform: translateY(-1px); background: var(--violet-600); }
  .btn.secondary { background: #6e52ff; }
  input[type="text"] {
    width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid #c4b5fd;
    background: #fff; font-size: 14px; color: #111827;
  }
  pre { white-space: pre-wrap; background: #0b0f26; color: #e6e6ff; padding: 12px; border-radius: 8px;
        border: 1px solid #2a2f62; }
  ul { padding-left: 20px; margin: 6px 0; color: #1f1f3a; }
  footer { padding: 16px; text-align: center; color: #d1d5db; font-size: 0.9em; }
  @media (max-width: 1024px) { .grid { grid-template-columns: 1fr 1fr; } }
  @media (max-width: 768px) { .grid { grid-template-columns: 1fr; } }
  .indent { font-family: "Courier New", monospace; white-space: normal; line-height: 1.6; color: #0b1020; }
  .section:hover { border-color: rgba(167,139,250,.6); }
  .hint { color: #4c1d95; font-weight: 600; }
  /* Small card sizing per request: ensure sections render as compact cards with margins */
  .compact { padding: 12px; border-radius: 12px; }
</style>
</head>
<body>
<header>
  <div class="container brand">
    <div class="logo">
      <span class="logo-box" aria-label="Logo"></span>
      <span class="title">Digital Library Organizer</span>
    </div>
    <nav aria-label="Main">
      <a href="#part1">Part I</a>
      <a href="#part2">Part II</a>
      <a href="#part3">Part III</a>
      <a href="#part4">Part IV</a>
    </nav>
  </div>
</header>

<main class="container">
  <!-- Part I — Recursive Directory Display (compact card) -->
  <section class="section compact" id="part1" aria-labelledby="part1-title">
    <div class="card-header">
      <h2 id="part1-title" class="title" style="font-size:1rem; margin:0;">Part I — Recursive Directory Display</h2>
      <span class="badge">Recursion</span>
    </div>
    <div class="card" style="padding:12px;">
      <div class="indent" id="part1Content" style="line-height:1.6;">
        <?php echo displayLibrary($library, 0); ?>
      </div>
      <div style="margin-top:8px;">
        <button class="btn" onclick="toggleP1()">Toggle Collapse</button>
        <span class="hint" style="margin-left:12px;">Tip: collapse to hide details on small screens.</span>
      </div>
    </div>
  </section>

  <!-- Part II — Book Details (Hash Table) -->
  <section class="section compact" id="part2" aria-labelledby="part2-title">
    <div class="card-header">
      <h2 id="part2-title" class="title" style="font-size:1rem; margin:0;">Part II — Book Details (Hash Table)</h2>
      <span class="badge">Hash Map</span>
    </div>
    <div class="split" style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
      <div class="card" style="padding:12px;">
        <form id="lookupForm" onsubmit="event.preventDefault(); showBookInfo();">
          <label for="titleInput" style="display:block; margin-bottom:6px; color:#1f1140;">Enter a book title to fetch details:</label>
          <input type="text" id="titleInput" placeholder="e.g., Harry Potter" />
          <button type="submit" class="btn" style="margin-top:8px;">Get Details</button>
        </form>
        <div id="resultArea" style="margin-top:12px; min-height:60px;"></div>
      </div>
      <div class="card" aria-label="All known books" style="padding:12px;">
        <strong>All Known Books</strong>
        <ul>
          <?php foreach ($bookInfo as $t => $info): ?>
            <li><?= htmlspecialchars($t) ?></li>
          <?php endforeach; ?>
        </ul>
        <p class="hint" style="margin-top:6px;">Tip: Details appear to the right when available.</p>
      </div>
    </div>
  </section>

  <!-- Part III — BST (compact) -->
  <section class="section compact" id="part3" aria-labelledby="part3-title">
    <div class="card-header">
      <h2 id="part3-title" class="title" style="font-size:1rem; margin:0;">Part III — Binary Search Tree (BST)</h2>
      <span class="badge">Alphabetical Order</span>
    </div>
    <div class="split" style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
      <div class="card" aria-label="Inorder traversal" style="padding:12px;">
        <strong>Inorder Traversal (Alphabetical):</strong>
        <pre id="inorderBox" style="margin-top:6px;">
<?php
$sortedTitles = $bst->inorderTraversal();
echo implode("\n", $sortedTitles);
?>
        </pre>
      </div>
      <div class="card" aria-label="BST Search" style="padding:12px;">
        <form id="searchForm" onsubmit="event.preventDefault(); searchBST();">
          <label for="searchInput" style="display:block; margin-bottom:6px; color:#1f1140;">Search title in BST:</label>
          <input type="text" id="searchInput" placeholder="e.g., The Hobbit" />
          <button type="submit" class="btn" style="margin-top:8px;">Search</button>
        </form>
        <div id="searchResult" style="margin-top:12px;"></div>
      </div>
    </div>
  </section>

  <!-- Part IV — Integration (Bonus) -->
  <section class="section compact" id="part4" aria-labelledby="part4-title" style="margin-top:14px;">
    <div class="card-header">
      <h2 id="part4-title" class="title" style="font-size:1rem; margin:0;">Part IV — Integration (Bonus)</h2>
      <span class="badge">Integrated UI</span>
    </div>
    <div class="card" style="padding:12px;">
      <p>All parts are integrated in this single script. Use recursion to display categories, hash table lookups for details, and the BST for alphabetical search. This is the integrated Part IV experience.</p>
      <button class="btn secondary" onclick="location.reload()">Reset Demo</button>
    </div>
  </section>
</main>

<footer>
  &copy; <?= date('Y') ?> Digital Library Organizer
</footer>

<script>
function showBookInfo() {
  const title = document.getElementById('titleInput').value.trim();
  if (!title) {
    document.getElementById('resultArea').innerHTML = '<em>Please enter a title.</em>';
    return;
  }

  const infoMap = <?php
  $jsMap = [];
  foreach ($bookInfo as $t => $info) { $jsMap[$t] = $info; }
  echo json_encode($jsMap);
  ?>;
  if (title in infoMap) {
    const d = infoMap[title];
    document.getElementById('resultArea').innerHTML =
      '<strong>Title:</strong> ' + title + '<br>' +
      '<strong>Author:</strong> ' + d.author + '<br>' +
      '<strong>Year:</strong> ' + d.year + '<br>' +
      '<strong>Genre:</strong> ' + d.genre;
  } else {
    document.getElementById('resultArea').innerHTML = '<em>Book not found</em>';
  }
}

function toggleP1() {
  const el = document.getElementById('part1Content');
  if (!el) return;
  if (el.style.display === 'none') {
    el.style.display = 'block';
  } else {
    el.style.display = 'none';
  }
}

function searchBST() {
  const query = document.getElementById('searchInput').value.trim();
  if (!query) {
    document.getElementById('searchResult').innerHTML = '<em>Please enter a title to search.</em>';
    return;
  }
  const all = <?php echo json_encode($titlesForBST); ?>;
  const found = all.includes(query);
  document.getElementById('searchResult').innerHTML =
    'Searching for "' + query + '": ' + (found ? 'Found!' : 'Not Found.');
}
</script>
</body>
</html>
