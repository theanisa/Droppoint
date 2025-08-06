<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user'])) {
  header("Location: login.html");
  exit;
}

$user = $_SESSION['user'];
$userId = $user['id'];

// Fetch all posts from database
$sql = "SELECT posts.*, users.name FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home | DropPoint</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

  <!-- Navbar -->
  <header class="bg-white shadow">
    <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
      <h1 class="text-2xl font-bold text-blue-600">DropPoint</h1>
      <div class="flex gap-4 items-center">
        <form action="search.php" method="GET" class="flex gap-2">
          <input type="text" name="q" placeholder="Search lost/found..." class="border px-3 py-1 rounded-md">
          <select name="type" class="border rounded-md">
            <option value="">All</option>
            <option value="lost">Lost</option>
            <option value="found">Found</option>
          </select>
          <button type="submit" class="bg-blue-500 text-white px-3 rounded">Search</button>
        </form>
        <a href="profile.php">
          <img src="https://i.ibb.co/ZVh01dm/user-icon.png" alt="Profile" class="h-9 w-9 rounded-full border-2 border-blue-400">
        </a>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="max-w-3xl mx-auto px-4 py-6">
    <!-- Post Box -->
    <div class="bg-white rounded-lg p-4 shadow mb-6">
      <p class="font-semibold text-gray-700 mb-2">Lost something or found something?</p>
      <button onclick="document.getElementById('postForm').classList.toggle('hidden')" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
        Post Now
      </button>

      <!-- Hidden Form -->
      <form id="postForm" action="post_item.php" method="POST" enctype="multipart/form-data" class="hidden mt-4 space-y-3">
        <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
        <select name="type" required class="w-full border rounded px-3 py-2">
          <option value="">Select Type</option>
          <option value="lost">Lost</option>
          <option value="found">Found</option>
        </select>
        <textarea name="description" required placeholder="Item Description" class="w-full border rounded px-3 py-2"></textarea>
        <input type="text" name="location" required placeholder="Location" class="w-full border rounded px-3 py-2">
        <input type="date" name="item_date" required class="w-full border rounded px-3 py-2">
        <input type="file" name="image" accept="image/*" class="w-full">
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Submit Post</button>
      </form>
    </div>

    <!-- All Posts -->
    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="bg-white p-4 rounded shadow mb-4">
          <div class="flex justify-between items-center mb-2">
            <h3 class="font-semibold text-lg text-blue-700">
              <?php echo ucfirst($row['type']); ?> Item
            </h3>
            <span class="text-sm text-gray-500"><?php echo $row['item_date']; ?></span>
          </div>
          <p class="text-sm text-gray-600 mb-1">Posted by <strong><?php echo htmlspecialchars($row['name']); ?></strong></p>
          <p class="text-gray-700 mb-2"><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
          <?php if (!empty($row['image'])): ?>
            <img src="uploads/<?php echo $row['image']; ?>" alt="Item Image" class="w-full max-h-64 object-cover rounded mb-2">
          <?php endif; ?>
          <p class="text-sm text-gray-600">Location: <?php echo htmlspecialchars($row['location']); ?></p>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="text-center text-gray-500">No recent posts available.</div>
    <?php endif; ?>
  </main>

</body>
</html>
