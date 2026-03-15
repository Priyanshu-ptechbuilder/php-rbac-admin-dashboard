<?php
// setup.php — Run this ONCE after importing metronic_app.sql
// Access: http://localhost/metronic_project/setup.php
// DELETE this file after running!

require_once 'config/database.php';
require_once 'core/Database.php';

$db = Database::getInstance()->getConnection();

// Hash passwords correctly
$adminPass = password_hash('admin123', PASSWORD_BCRYPT);
$userPass  = password_hash('user123',  PASSWORD_BCRYPT);

// Update admin password
$stmt = $db->prepare("UPDATE users SET password=? WHERE email='admin@admin.com'");
$stmt->bind_param('s', $adminPass);
$stmt->execute();

// Update/create test user
$exists = $db->query("SELECT id FROM users WHERE email='john@example.com'")->fetch_assoc();
if ($exists) {
    $stmt2 = $db->prepare("UPDATE users SET password=? WHERE email='john@example.com'");
    $stmt2->bind_param('s', $userPass);
    $stmt2->execute();
} else {
    $stmt2 = $db->prepare("INSERT INTO users (name, email, password, role, status) VALUES ('John Doe', 'john@example.com', ?, 'user', 'active')");
    $stmt2->bind_param('s', $userPass);
    $stmt2->execute();
    $userId = $db->insert_id;

    // Init permissions for john
    $features = $db->query("SELECT * FROM features");
    while ($f = $features->fetch_assoc()) {
        $s = $db->prepare("INSERT IGNORE INTO feature_permissions (user_id, feature_key, feature_label, is_enabled) VALUES (?, ?, ?, 0)");
        $s->bind_param('iss', $userId, $f['feature_key'], $f['feature_label']);
        $s->execute();
    }
}

echo "<div style='font-family:Poppins,sans-serif;max-width:500px;margin:60px auto;padding:40px;border:2px solid #50cd89;border-radius:12px;background:#e8fff3;'>";
echo "<h2 style='color:#50cd89;'>✅ Setup Complete!</h2>";
echo "<p>Your database accounts are ready:</p>";
echo "<table style='width:100%;border-collapse:collapse;'>";
echo "<tr><td style='padding:8px;font-weight:bold;'>Admin Login:</td><td style='padding:8px;'><code>admin@admin.com</code> / <code>admin123</code></td></tr>";
echo "<tr><td style='padding:8px;font-weight:bold;'>User Login:</td><td style='padding:8px;'><code>john@example.com</code> / <code>user123</code></td></tr>";
echo "</table>";
echo "<p style='color:#f1416c;margin-top:20px;'><strong>⚠️ Delete this file now:</strong> <code>setup.php</code></p>";
echo "<a href='public/index.php' style='display:inline-block;margin-top:10px;padding:10px 24px;background:#009ef7;color:#fff;border-radius:6px;text-decoration:none;'>Go to App →</a>";
echo "</div>";
