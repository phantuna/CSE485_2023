<?php
include 'db.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra thông báo lỗi và lấy ID
$errorMsg = isset($_GET['error']) ? $_GET['error'] : '';
$articleId = isset($_GET['id']) ? $_GET['id'] : null;

if ($articleId) {
    // Truy vấn để lấy thông tin bài viết hiện tại
    $sql = "SELECT tieude, tomtat, ma_tloai, ma_tgia FROM baiviet WHERE ma_bviet = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $articleId);
    $stmt->execute();
    $stmt->bind_result($title, $summary, $categoryId, $authorId);
    $stmt->fetch();
    $stmt->close();
} else {
    header("Location: article.php?error=Mã bài viết không hợp lệ.");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    
<header>
<nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Trang ngoài</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="category.php">Thể loại</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="author.php">Tác giả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="article.php">Bài viết</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
</header>
<main class="container mt-5 mb-5">
    <h3 class="text-center text-uppercase fw-bold">Sửa thông tin bài viết</h3>
    <?php if ($errorMsg): ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($errorMsg); ?>
        </div>
    <?php endif; ?>

    <form action="process_edit_article.php" method="post">
        <div class="input-group mt-3 mb-3">
            <span class="input-group-text">Mã bài viết</span>
            <input type="text" class="form-control" name="articleId" value="<?php echo htmlspecialchars($articleId); ?>" readonly>
        </div>

        <div class="input-group mt-3 mb-3">
            <span class="input-group-text">Tiêu đề</span>
            <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($title); ?>" required>
        </div>

        <div class="input-group mt-3 mb-3">
            <span class="input-group-text">Tóm tắt</span>
            <textarea class="form-control" name="summary" required><?php echo htmlspecialchars($summary); ?></textarea>
        </div>

        <div class="form-group  float-end">
            <input type="submit" value="Lưu lại" class="btn btn-success">
            <a href="article.php" class="btn btn-warning">Quay lại</a>
        </div>
    </form>
</main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>